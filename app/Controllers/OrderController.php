<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Dataorder;
use App\Models\History;
use App\Models\Karyawan;
use App\Models\Logactivities;
use App\Models\Order;
use App\Libraries\Ciqrcode;
use App\Models\Detailunit;
use Dompdf\Dompdf;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


class OrderController extends BaseController
{

    public function __construct()
    {
        $this->ciqrcode = new Ciqrcode();
        $this->order = new Order();
        $this->karyawan = new Karyawan();
        $this->dataorder = new Dataorder();
        $this->logactivities = new Logactivities();
        $this->history = new History();
        $this->detailunit = new Detailunit();
    }

    public function index()
    {
        //
    }

    public function viewDataTransaksi()
    {
        // $data['product'] = $this->product->findAll();
        // $data['supplier'] = $this->supplier->findAll();
        // $data['karyawan'] = $this->karyawan->findAll();
        // $data['lokasi'] = $this->db->table('unitkerja as a')->select('b.id_unitkerja as id, a.unitkerja as unitkerja, b.unitkerja as ruangan')->join('unitkerja as b', 'a.id_unitkerja = b.parent_id_unitkerja')->get()->getResultArray();
        return view('Inventaris/transaksilist');
    }

    public function detailDataTransaksi($id)
    {
        $data['order'] = $this->db->table('orders')->select('orders.*,karyawans.nama,unitkerja.unitkerja')->join('users', 'users.username = orders.created_by')->join('karyawans', 'karyawans.id_karyawan = users.karyawan_id')->join('unitkerja', 'unitkerja.id_unitkerja = orders.order_lokasi')->where('id_order', $id)->get()->getRowArray();
        $data['dataorder'] = $this->order->listDataorder($id);
        return view('Inventaris/transaksiDetail', $data);
    }

    public function addPemakaianHabisPakai()
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

            $message1 = array(
                'before' => '',
                'after' => 'Mengajukan Transaksi Permohonan <strong>' . $jsonData['order'][0]['order_type'] . '</strong> beberapa inventaris dengan keterangan <strong>' . $jsonData['order'][0]['deskripsi'] . '</strong> ke <strong>' . $lokasi['unitkerja'] . '</strong>',
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
                        'after' => 'Telah dilakukan Permohonan Penggunaan Inventaris oleh ' . user()->username . ' ke ' . $lokasi['unitkerja'] . ' dengan peruntukan ' . $karyawan['nama'] . '',
                    );
                } else {
                    $message = array(
                        'before' => '',
                        'after' => 'Telah dilakukan Permohonan Penggunaan Inventaris oleh ' . user()->username . ' ke ' . $lokasi['unitkerja'] . ' ',
                    );
                }
                $this->dataorder->insert($input);
                $this->logactivities->createLogOrder($value['detailunit_id'], 'detailunits', user()->username, $message, 'Pengajuan Penggunaan');
            }
            $this->logactivities->createLogOrder($id_order, 'orders', user()->username, $message1, 'Pengajuan Penggunaan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addPemakaianTidakHabisPakai()
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

            $message1 = array(
                'before' => '',
                'after' => 'Mengajukan Transaksi Permohonan <strong>' . $jsonData['order'][0]['order_type'] . '</strong> beberapa inventaris dengan keterangan <strong>' . $jsonData['order'][0]['deskripsi'] . '</strong> ke <strong>' . $lokasi['unitkerja'] . '</strong>',
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
                        'after' => 'Telah dilakukan Permohonan Penggunaan Inventaris oleh ' . user()->username . ' ke ' . $lokasi['unitkerja'] . ' dengan peruntukan ' . $karyawan['nama'] . '',
                    );
                } else {
                    $message = array(
                        'before' => '',
                        'after' => 'Telah dilakukan Permohonan Penggunaan Inventaris oleh ' . user()->username . ' ke ' . $lokasi['unitkerja'] . ' ',
                    );
                }
                $this->dataorder->insert($input);
                $this->logactivities->createLogOrder($value['detailunit_id'], 'detailunits', user()->username, $message, 'Pengajuan Penggunaan');
            }
            $this->logactivities->createLogOrder($id_order, 'orders', user()->username, $message1, 'Pengajuan Penggunaan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    public function approve($id)
    {
        try {
            $dataupdate = array(
                'status_order' => 'Berhasil',
                'updated_by' => user()->username,
            );
            $dataorder = $this->db->table('orders')->select('dataorder.*,units.jenis_unit, detailunits.stok,detailunits.id_detailunit, karyawans.nama')->join('dataorder', 'orders.id_order = dataorder.kode_order')->join('detailunits', 'dataorder.detailunit_id = detailunits.id_detailunit')->join('units', 'units.id_unit = detailunits.unit_id')->join('karyawans', 'karyawans.id_karyawan = dataorder.peruntukan', 'LEFT')->where('orders.id_order', $id)->get()->getResultArray();
            $order = $this->db->table('orders')->select('orders.*, karyawans.nama, unitkerja.unitkerja')->join('users', 'users.username = orders.created_by')->join('karyawans', 'karyawans.id_karyawan = users.karyawan_id')->join('unitkerja', 'unitkerja.id_unitkerja = orders.order_lokasi')->where('id_order', $id)->get()->getRowArray();
            $message1 = array(
                'before' => '',
                'after' => 'transaksi telah disetujui, pengajuan penggunaan oleh <strong>' . user()->username . '</strong> dengan Id Pengajuan <strong>' . $order['id_order'] . '</strong> ke <strong>' . $order['unitkerja'] . '</strong>',
            );
            $this->db->table('orders')->update($dataupdate, array('id_order' => $id));
            $this->logactivities->createLogOrder($order['id_order'], 'orders', user()->username, $message1, 'Approve Pengajuan Penggunaan');
            for ($i = 0; $i < sizeof($dataorder); $i++) {
                if ($dataorder[$i]['jenis_unit'] == 'Habis Pakai') {
                    $updatepemakaian1 = array(
                        'stok' => $dataorder[$i]['stok'] - $dataorder[$i]['qty'],
                    );
                    $updatedataorder = array(
                        'status_dataorder' => 'Berhasil',
                    );
                    $message = array(
                        'before' => '<strong>Stok</strong> => ' . $dataorder[$i]['stok'] . '',
                        'after' => '<strong>Stok</strong> => ' . $updatepemakaian1['stok'] . '',
                    );
                    $this->db->table('detailunits')->update($updatepemakaian1, array('id_detailunit' => $dataorder[$i]['id_detailunit']));
                    $this->db->table('dataorder')->update($updatedataorder, array('id_dataorder' => $dataorder[$i]['id_dataorder']));
                    $this->logactivities->createLogOrder($dataorder[$i]['id_detailunit'], 'detailunits', user()->username, $message, 'Approve Pengajuan Penggunaan');
                } else {
                    $oldData = $this->db->table('detailunits')->select('karyawan_id, unitkerja_id, status_unit')->where('id_detailunit', $dataorder[$i]['id_detailunit'])->get()->getRowArray();
                    $updateunit = array(
                        'karyawan_id' => $dataorder[$i]['peruntukan'],
                        'unitkerja_id' => $order['order_lokasi'],
                        'status_unit' => $dataorder[$i]['peruntukan'] == '' ? 'Assign To Location' : 'Assign To Employee',
                    );
                    $dataOldUpdated = array_diff_assoc($oldData, $updateunit);
                    $dataNewUpdated = array_diff_assoc($updateunit, $oldData);
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
                    $message2 = array(
                        'before' => implode('<br>', $dataOldUpdateds),
                        'after' => implode('<br>', $dataNewUpdateds),
                    );
                    $updatedataorder1 = array(
                        'status_dataorder' => 'Berhasil',
                    );
                    $this->db->table('detailunits')->update($updateunit, array('id_detailunit' => $dataorder[$i]['id_detailunit']));
                    $this->db->table('dataorder')->update($updatedataorder1, array('id_dataorder' => $dataorder[$i]['id_dataorder']));
                    $this->logactivities->createLogOrder($dataorder[$i]['id_detailunit'], 'detailunits', user()->username, $message2, 'Approve Pengajuan Penggunaan');
                }
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function tolak($id)
    {
        $jsonData = $this->request->getJSON();
        $dataupdate = array(
            'status_order' => 'Ditolak',
            'updated_by' => user()->username,
            'feedbackdescription' => $jsonData->login
        );

        $this->db->table('orders')->update($dataupdate, array('id_order' => $id));
    }


    public function cetak()
    {
        $jsonData = $this->request->getJSON();
        $this->dompdf = new Dompdf();
        $this->options = $this->dompdf->getOptions();
        $this->options->setPdfBackend(true);
        $this->options->setDebugCss(true);
        $this->options->setIsPhpEnabled(true);
        $this->options->setIsHtml5ParserEnabled(true);

        $this->dompdf->setOptions($this->options);
        $data['order'] = $this->db->table('orders')->select('orders.*,karyawans.nama,karyawans.nrp,unitkerja.unitkerja, departements.content')->join('users', 'users.username = orders.created_by')->join('karyawans', 'karyawans.id_karyawan = users.karyawan_id')->join('unitkerja', 'unitkerja.id_unitkerja = orders.order_lokasi')->join('departements', 'karyawans.jabatan_id = departements.id')->where('id_order', $jsonData->id)->get()->getRowArray();
        $data['dataorder'] = $this->order->listDataorder($jsonData->id);
        if ($data['order']['order_type'] == 'Penggunaan') {
            $data['approval'] = $this->order->getApproval($data['dataorder'][0]['jenis_product']);
            $data['barcode'] = $this->makerTransaksi($jsonData->id);
            $data['barcode1'] = $this->appoverTransaksi($data['approval']['nama'], $data['order']['status_order'], $data['order']['order_type']);
            $this->dompdf->loadHtml(view('print/buktipengajuan',  $data));
            $this->dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
            $this->dompdf->render();
            $output = $this->dompdf->output();
            return $this->response->download('' . $jsonData->id . '.pdf', $output);
        } else {
            $data['approval'] = [
                'name' => null,
                'nama' => null,
            ];
            $data['barcode'] = $this->makerTransaksi($jsonData->id);
            $data['barcode1'] = $this->appoverTransaksi($data['approval']['nama'], $data['order']['status_order'], $data['order']['order_type']);
            $this->dompdf->loadHtml(view('print/buktipengajuan',  $data));
            $this->dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
            $this->dompdf->render();
            $output = $this->dompdf->output();
            return $this->response->download('' . $jsonData->id . '.pdf', $output);
        }
    }



    public function cetak1($id)
    {
        // $jsonData = $this->request->getJSON();
        $this->dompdf = new Dompdf();
        $this->options = $this->dompdf->getOptions();
        $this->options->setPdfBackend(true);
        $this->options->setDebugCss(true);
        $this->options->setIsHtml5ParserEnabled(true);
        $this->options->setIsPhpEnabled(true);
        $this->dompdf->setOptions($this->options);
        $data['order'] = $this->db->table('orders')->select('orders.*,karyawans.nama,karyawans.nrp,unitkerja.unitkerja, departements.content')->join('users', 'users.username = orders.created_by')->join('karyawans', 'karyawans.id_karyawan = users.karyawan_id')->join('unitkerja', 'unitkerja.id_unitkerja = orders.order_lokasi')->join('departements', 'karyawans.jabatan_id = departements.id')->where('id_order', $id)->get()->getRowArray();
        $data['dataorder'] = $this->order->listDataorder($id);
        if ($data['order']['order_type'] == 'Penggunaan') {
            $data['approval'] = $this->order->getApproval($data['dataorder'][0]['jenis_product']);
            $data['barcode'] = $this->makerTransaksi($id);
            $data['barcode1'] = $this->appoverTransaksi($data['approval']['nama'], $data['order']['status_order'], $data['order']['order_type']);
            $this->dompdf->loadHtml(view('print/buktipengajuan',  $data));
            $this->dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
            $this->dompdf->render();
            $output = $this->dompdf->output();
            return $this->response->download('' . $id . '.pdf', $output);
        } else {
            $data['approval'] = [
                'name' => null,
                'nama' => null,
            ];
            $data['barcode'] = $this->makerTransaksi($id);
            $data['barcode1'] = $this->appoverTransaksi($data['approval']['nama'], $data['order']['status_order'], $data['order']['order_type']);
            $this->dompdf->loadHtml(view('print/buktipengajuan',  $data));
            $this->dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
            $this->dompdf->render();
            $output = $this->dompdf->output();
            return $this->response->download('' . $id . '.pdf', $output);
        }
    }

    function makerTransaksi($id_transaksi)
    {
        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create('' . base_url() . '/Cetak/' . $id_transaksi . '')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        // $logo = Logo::create(FCPATH . 'assets/logo.png')
        //     ->setResizeToWidth(150);

        // Create generic label
        // $label = Label::create('Sobatcoding.com')
        //     ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, null, null);

        $dataUri = $result->getDataUri();
        return $dataUri;
    }

    function appoverTransaksi($id_approval, $status, $tipe)
    {
        $writer = new PngWriter();

        // Create QR code
        if ($status == "Berhasil" && $tipe == 'Penggunaan') {
            $qrCode = QrCode::create('Dokumen Ini sudah di approve oleh ' . $id_approval . '')
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                ->setSize(300)
                ->setMargin(10)
                ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->setForegroundColor(new Color(0, 0, 0))
                ->setBackgroundColor(new Color(255, 255, 255));

            $result = $writer->write($qrCode, null, null);

            $dataUri = $result->getDataUri();
            return $dataUri;
        } else {
            return null;
        }
    }

    public function transaksilist()
    {
        if (in_groups([1, 2, 3])) {
            # code...
            $data = $this->db->table('orders')->select('orders.*,karyawans.nama,unitkerja.unitkerja')->join('users', 'users.username = orders.created_by')->join('karyawans', 'karyawans.id_karyawan = users.karyawan_id')->join('unitkerja', 'orders.order_lokasi = unitkerja.id_unitkerja')->get()->getResultArray();
        } else {
            $data = $this->db->table('orders')->select('orders.*,karyawans.nama,unitkerja.unitkerja')->join('users', 'users.username = orders.created_by')->join('karyawans', 'karyawans.id_karyawan = users.karyawan_id')->join('unitkerja', 'orders.order_lokasi = unitkerja.id_unitkerja')->where('orders.created_by', user()->username)->get()->getResultArray();
        }

        if (sizeof($data)) {
            for ($i = 0; $i < sizeof($data); $i++) {
                $jsonData[] = array(
                    "id" => $data[$i]['id_order'],
                    "nama" => $data[$i]['nama'],
                    "unitkerja" => $data[$i]['unitkerja'],
                    "status" => $data[$i]['status_order'],
                    "linked" => 0,
                    "tanggal" => $data[$i]['created_at'],
                    "tipe" => $data[$i]['order_type'],
                    "dokumen" => $data[$i]['dokumen_order'],
                );
            }
        } else {
            return json_encode(null);
        }

        return json_encode($jsonData);
    }

    public function viewFormPengajuan()
    {
        $data['peruntukan'] = $this->karyawan->karyawanListSession(user()->id);
        $data['lokasi'] = $this->db->table('users')->select('unitkerja.*')->join('karyawans', 'karyawans.id_karyawan = users.karyawan_id')->join('departements', 'departements.id = karyawans.jabatan_id')->join('unitkerja', 'unitkerja.id_unitkerja = departements.lokasi_id')->where('users.id', user()->id)->get()->getRowArray();
        return view('Form/Permintaan', $data);
    }


    public function listInventarisHabisPakai()
    {
        $data = $this->order->listInventarisSelect2($this->request->getPost('searchTerm'), $this->request->getPost('jenisProduk'));

        for ($i = 0; $i < sizeof($data); $i++) {
            $jsonData[] = array(
                "id" => $data[$i]['id_detailunit'],
                "text" => $data[$i]['nama_unit'],
                "brand" => $data[$i]['brand'],
                "kode" => $data[$i]['kode'],
                "satuan" => $data[$i]['satuan'],
                "stok" => $data[$i]['stok'],
                "jenis" => $data[$i]['jenis_product'],
            );
        }

        return json_encode($jsonData);
    }

    public function listInventarisTidakHabisPakai()
    {
        $data = $this->order->listInventarisSelect2_1($this->request->getPost('searchTerm'), $this->request->getPost('jenisProduk'));

        for ($i = 0; $i < sizeof($data); $i++) {
            $jsonData[] = array(
                "id" => $data[$i]['id_detailunit'],
                "text" => $data[$i]['nama_unit'],
                "brand" => $data[$i]['brand'],
                "kode" => $data[$i]['kode'],
                "satuan" => $data[$i]['satuan'],
                "stok" => $data[$i]['stok'],
                "jenis" => $data[$i]['jenis_product'],
            );
        }

        return json_encode($jsonData);
    }
}
