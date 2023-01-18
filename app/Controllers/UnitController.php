<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Ciqrcode;
use App\Models\Dataorder;
use App\Models\Detailunit;
use App\Models\History;
use App\Models\Karyawan;
use App\Models\Logactivities;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Unit;

class UnitController extends BaseController
{

    public function __construct()
    {
        $this->detailunit = new Detailunit();
        $this->product = new Unit();
        $this->supplier = new Supplier();
        $this->karyawan = new Karyawan();
        $this->ciqrcode = new Ciqrcode();
        $this->logactivities = new Logactivities();
        $this->order = new Order();
        $this->dataorder = new Dataorder();
        $this->history = new History();
    }

    public function index()
    {
        //
    }

    public function viewDataInventaris()
    {
        $data['product'] = $this->product->findAll();
        $data['supplier'] = $this->supplier->findAll();
        $data['karyawan'] = $this->karyawan->findAll();
        $data['lokasi'] = $this->db->table('unitkerja as a')->select('b.id_unitkerja as id, a.unitkerja as unitkerja, b.unitkerja as ruangan')->join('unitkerja as b', 'a.id_unitkerja = b.parent_id_unitkerja')->get()->getResultArray();
        return view('Inventaris/inventarislist', $data);
    }

    public function detailDataInventaris($id)
    {
        $data['inventaris'] = $this->detailunit->unitDetail($id);
        $data['product'] = $this->product->findAll();
        $data['supplier'] = $this->supplier->findAll();
        $data['karyawan'] = $this->karyawan->findAll();
        $data['lokasi'] = $this->db->table('unitkerja as a')->select('b.id_unitkerja as id, a.unitkerja as unitkerja, b.unitkerja as ruangan')->join('unitkerja as b', 'a.id_unitkerja = b.parent_id_unitkerja')->get()->getResultArray();
        return view('Inventaris/inventarisDetail', $data);
    }

    public function inventarisHistoryList($id)
    {
        $data = $this->logactivities->where(['table_id' => $id, 'table_names' => 'detailunits'])->findAll();


        return json_encode($data);
    }

    public function inventarisList()
    {
        $data = $this->detailunit->listInventaris();

        return json_encode($data);
    }

    public function inventarisAdd()
    {
        try {
            $jsonData = $this->request->getJSON(TRUE);
            $config['cacheable']    = true;
            $config['cachedir']     = './public/assets/media/barcode/';
            $config['errorlog']     = './public/assets/media/barcode/';
            $config['imagedir']     =  'assets/media/barcode/';
            $config['quality']      = true;
            $config['size']         = '1024';
            $config['black']        = array(224, 255, 255);
            $config['white']        = array(70, 130, 180);
            $this->ciqrcode->initialize($config);
            $path = FCPATH . 'assets/media/barcode';
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            foreach ($jsonData as $key => $value) {
                $id = $this->detailunit->insert($value);
                $params['data'] = base_url('data/inventaris/' . $id); //data yang akan di jadikan QR CODE
                $params['level'] = 'H'; //H=High
                $params['size'] = 10;
                $params['savename'] = $path . '/' . $id . '.png';
                // dd($params['savename']);   
                $this->ciqrcode->generate($params);
            }
            return json_encode($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function inventarisMutasi()
    {
        try {
            $jsonData = $this->request->getJSON(TRUE);
            $lokasi = $this->db->table('unitkerja')->select('unitkerja')->where('id_unitkerja', $jsonData['order'][0]['order_lokasi'])->get()->getRowArray();
            $data = array(
                'order_type' => $jsonData['order'][0]['order_type'],
                'order_lokasi' => $jsonData['order'][0]['order_lokasi'],
                'description' => $jsonData['order'][0]['deskripsi'],
                'status_order' => $jsonData['order'][0]['status_order'],
                'dokumen_order' => '1',
                'created_by' => $jsonData['order'][0]['created_by'],
            );
            $id_order = $this->order->insert($data);

            $datahistory = array(
                'detailunit_id' => null,
                'order_id' => $id_order,
                'keterangan' => 'Mengajukan Permohonan <strong>' . $jsonData['order'][0]['order_type'] . '</strong> beberapa inventaris dengan keterangan <strong>' . $jsonData['order'][0]['deskripsi'] . '</strong> ke <strong>' . $lokasi['unitkerja'] . '</strong>',
                'aksi' => 'Berhasil',
                'created_by' => user()->username,
            );
            foreach ($jsonData['dataorder'] as $key => $value) {
                $input = array(
                    'kode_order' => $id_order,
                    'detailunit_id' => $value['detailunit_id'],
                    'qty' => $value['qty'],
                    'peruntukan_awal' => 0,
                    'peruntukan' => $value['peruntukan'],
                    'status_dataorder' => $value['status_dataorder'],
                );
                if ($value['peruntukan'] != '') {
                    # code...
                    $karyawan = $this->db->table('karyawans')->select('nama')->where('id_karyawan', $value['peruntukan'])->get()->getRowArray();
                    $message = array(
                        'before' => '',
                        'after' => 'Telah dilakukan Mutasi oleh ' . user()->username . ' ke ' . $lokasi['unitkerja'] . ' dengan peruntukan ' . $karyawan['nama'] . '',
                    );
                } else {
                    $message = array(
                        'before' => '',
                        'after' => 'Telah dilakukan Mutasi oleh ' . user()->username . ' ke ' . $lokasi['unitkerja'] . ' ',
                    );
                }
                $update = array(
                    'karyawan_id' => $value['peruntukan'],
                    'unitkerja_id' => $jsonData['order'][0]['order_lokasi'],
                    'milik' => $jsonData['order'][0]['order_lokasi'],
                    'status_unit' => $value['status_dataorder'],
                );
                $this->dataorder->insert($input);
                $this->db->table('detailunits')->update($update, array('id_detailunit' => $value['detailunit_id']));
                $this->logactivities->createLog($value['detailunit_id'], 'detailunits', user()->username, $message);
            }
            $this->history->insert($datahistory);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function inventarisUpdate()
    {
        try {
            $jsonData = $this->request->getJSON();
            $oldData = $this->db->table('detailunits')->select('supplier_id,harga,status_unit,kondisi,unitkerja_id,karyawan_id,tahun_perolehan,nota_dinas,invoice')->where('id_detailunit', $jsonData->id)->get()->getRowArray();
            $tempData = array(
                'supplier_id' => $jsonData->editInventarisSupplier,
                'harga' => $jsonData->editInventarisHarga,
                'status_unit' => $jsonData->editInventarisStatus,
                'kondisi' => $jsonData->editInventarisKondisi,
                'unitkerja_id' => $jsonData->editInventarisLokasi,
                'karyawan_id' => $jsonData->editInventarisPeruntukan,
                'tahun_perolehan' => $jsonData->editInventarisTahun,
                'nota_dinas' => $jsonData->editInventarisNotadinas,
                'invoice' => $jsonData->editInventarisInvoice,
            );
            $dataOldUpdated = array_diff_assoc($oldData, $tempData);
            $dataNewUpdated = array_diff_assoc($tempData, $oldData);
            $dataOldUpdateds = array();
            $dataNewUpdateds = array();
            if (sizeof($dataOldUpdated) == sizeof($dataNewUpdated)) {
                foreach ($dataOldUpdated as $key => $value) {
                    $d =  "<strong>" . $key . "</strong> : " . $value . " ";
                    $e =  "<strong>" . $key . "</strong> : " . $dataNewUpdated[$key] . " ";
                    array_push($dataOldUpdateds, $d);
                    array_push($dataNewUpdateds, $e);
                }
            }
            $message = array(
                'before' => implode('<br>', $dataOldUpdateds),
                'after' => implode('<br>', $dataNewUpdateds),
            );
            try {
                $this->db->table('detailunits')->update($tempData, array('id_detailunit' => $jsonData->id));
                $this->logactivities->createLog($jsonData->id, 'detailunits', user()->username, $message);
            } catch (\Throwable $th) {
                echo '<script>console.log(' . $th . ')</script>';
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function listProductSelect2()
    {
        $data = $this->product->listProductbySelect2($this->request->getPost('searchTerm'));

        for ($i = 0; $i < sizeof($data); $i++) {
            $jsonData[] = array(
                "id" => $data[$i]['id_unit'],
                "text" => $data[$i]['nama_unit'],
                "brand" => $data[$i]['brand'],
                "satuan" => $data[$i]['satuan'],
                "jenis" => $data[$i]['jenis_unit'],
            );
        }

        return json_encode($jsonData);
    }

    public function listInventaris($id)
    {
        $data = $this->detailunit->listInventarisSelect2($this->request->getPost('searchTerm'), $id);

        for ($i = 0; $i < sizeof($data); $i++) {
            $jsonData[] = array(
                "id" => $data[$i]['id_detailunit'],
                "text" => $data[$i]['nama_unit'],
                "brand" => $data[$i]['brand'],
                "kode" => $data[$i]['kode'],
            );
        }

        return json_encode($jsonData);
    }
}
