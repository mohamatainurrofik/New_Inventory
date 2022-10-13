<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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

class LaporanController extends BaseController
{

    public function __construct()
    {
        $this->detailunit = new Detailunit();
    }

    public function viewLaporanInventaris()
    {
        return view('Laporan/laporanInventaris');
    }

    public function viewLaporanQRCode()
    {
        $data['lokasi'] = $this->db->table('unitkerja as a')->select('b.id_unitkerja as id, a.unitkerja as unitkerja, b.unitkerja as ruangan')->join('unitkerja as b', 'a.id_unitkerja = b.parent_id_unitkerja')->get()->getResultArray();
        return view('Laporan/laporanqrcode', $data);
    }

    public function laporanInventarisList()
    {
        $data = $this->detailunit->listLaporanInventaris();
        if (sizeof($data)) {
            for ($i = 0; $i < sizeof($data); $i++) {
                $jsonData[] = array(
                    "id" => $data[$i]['id_unit'],
                    "nama" => $data[$i]['nama_unit'],
                    "brand" => $data[$i]['brand'],
                    "satuan" => $data[$i]['satuan'],
                    "jenis" => $data[$i]['jenis_unit'],
                    "stok" => $data[$i]['totalstok'],
                    "harga" => $data[$i]['totalharga'],
                );
            }

            return json_encode($jsonData);
        } else {
            return json_encode(null);
        }
    }

    public function getDataPrint($ruangan)
    {
        try {
            $this->dompdf = new Dompdf();
            $this->options = $this->dompdf->getOptions();
            $this->options->setPdfBackend(true);
            $this->options->setDebugCss(true);
            $this->options->setIsHtml5ParserEnabled(true);
            $this->options->setIsPhpEnabled(true);
            $this->dompdf->setOptions($this->options);
            $data['detailunit'] = $this->detailunit->barcodeDetailunit($ruangan);
            $barcode['barcode'] = [];
            foreach ($data['detailunit'] as $key => $value) {
                $writer = new PngWriter();
                $qrCode = QrCode::create('' . base_url() . '/data/inventaris/' . $value['id_detailunit'] . '')
                    ->setEncoding(new Encoding('UTF-8'))
                    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                    ->setSize(300)
                    ->setMargin(10)
                    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                    ->setForegroundColor(new Color(0, 0, 0))
                    ->setBackgroundColor(new Color(255, 255, 255));

                // Create generic logo
                $logo = Logo::create(FCPATH . 'assets/media/img/logo.png')
                    ->setResizeToWidth(75);

                // Create generic label
                $label = Label::create($value['kode'])
                    ->setTextColor(new Color(255, 0, 0));

                $result = $writer->write($qrCode, $logo, $label);
                $dataUri = $result->getDataUri();
                array_push($barcode['barcode'], $dataUri);
            }

            $this->dompdf->loadHtml(view('print/laporanqr',  $barcode));
            $this->dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
            $this->dompdf->render();
            $output = $this->dompdf->output();
            return $this->response->download('laporan.pdf', $output);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
