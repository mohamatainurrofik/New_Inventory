<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Alternatif;
use App\Models\Detailunit;
use App\Models\Kriteria;
use App\Models\Logactivities;
use App\Models\PairWiseKriteria;
use App\Models\Unitkerja;

class AlgorithmController extends BaseController
{

    public function __construct()
    {
        $this->kriteria = new Kriteria();
        $this->alternatif = new Alternatif();
        $this->pairwise = new PairWiseKriteria();
        $this->unitkerja = new Unitkerja();
        $this->detailunit = new Detailunit();
        $this->logactivities = new Logactivities();
    }

    public function index()
    {
        //
    }

    public function viewKriteria()
    {
        return view('FAHP/kriteria/kriteriaList');
    }

    public function viewAlternatif()
    {
        return view('FAHP/alternatif/alternatifList');
    }

    public function viewBobotKriteria()
    {
        $data['kriteria'] = $this->db->table('kriteria')->orderBy('kode_kriteria', 'ASC')->get()->getResultArray();
        $data['pairwise'] = $this->db->table('pairwisekriteria')->orderBy('kriteria_baris', 'ASC')->get()->getResultArray();

        $data['fuzzy'] = $this->db->table('fuzzymaster')->where('fuzzy_type !=', 'r')->get()->getResultArray();
        return view('FAHP/kriteria/bobotkriteria', $data);
    }

    public function viewPermohonanMaintanance()
    {
        $data['kriteria'] = $this->db->table('kriteria')->orderBy('kode_kriteria', 'ASC')->get()->getResultArray();
        $data['pairwise'] = $this->db->table('pairwisekriteria')->orderBy('kriteria_baris', 'ASC')->get()->getResultArray();
        $data['ruangan'] = $this->unitkerja->where('parent_id_unitkerja is not null')->findAll();
        $data['fuzzyPairwise'] = $this->db->table('pairwisekriteria')->select('pairwisekriteria.*,fuzzymaster.up,fuzzymaster.middle,fuzzymaster.low')->join('fuzzymaster', 'fuzzymaster.value = pairwisekriteria.value')->orderBy('pairwisekriteria.kriteria_baris', 'ASC')->get()->getResultArray();
        return view('Form/CekMaintanance', $data);
    }


    public function kriteriaList()
    {
        $data = $this->kriteria->where('parent_kode_kriteria is null')->findAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            // $linked = $this->unitkerja->where('parent_id_unitkerja', $data[$i]['id_unitkerja'])->countAllResults();
            $jsonData[] = array(
                "id" => $data[$i]['id_kriteria'],
                "kode" => $data[$i]['kode_kriteria'],
                "nama" => $data[$i]['kriteria'],
                "atribut" => $data[$i]['atribut'],
                "linked" => 0,
            );
        }

        return json_encode($jsonData);
    }

    public function alternatifList()
    {
        $data = $this->alternatif->findAll();
        if (sizeof($data)) {
            for ($i = 0; $i < sizeof($data); $i++) {
                // $linked = $this->unitkerja->where('parent_id_unitkerja', $data[$i]['id_unitkerja'])->countAllResults();
                $jsonData[] = array(
                    "id" => $data[$i]['id_alternatif'],
                    "kode" => $data[$i]['kode_alternatif'],
                    "nama" => $data[$i]['alternatif'],
                    "linked" => 0,
                );
            }
            return json_encode($jsonData);
        } else {
            return json_encode(null);
        }
    }

    public function addPreventifAset()
    {
        $jsonData = $this->request->getJSON(TRUE);
        foreach ($jsonData['aset'] as $key => $value) {
            $tempData = array(
                'foto_unit' => $value['preventif']
            );
            $message = array(
                'before' => '',
                'after' => 'Telah Dilakukan Cek Maintanance Aset dengan hasil ' . $value['preventif'] . '',
            );
            $this->db->table('detailunits')->update($tempData, array('id_detailunit' => $value['id_alternatif']));
            $this->logactivities->createLog($value['id_alternatif'], 'detailunits', user()->username, $message);
        }
    }

    public function kriteriaCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData = array(
            'kode_kriteria' => $jsonData->kriteria_kode,
            'parent_kode_kriteria' => null,
            'kriteria' => $jsonData->kriteria_name,
            'level' => 0,
            'atribut' => $jsonData->kriteria_atribut,
            'deskripsi' => null,
        );
        $isValid = $this->validate([
            'kriteria_kode'  => 'is_unique[kriteria.kode_kriteria]',
        ]);
        try {
            if ($isValid) {
                # code...
                $this->kriteria->insert($tempData);
                $kriteria = $this->kriteria->findAll();
                for ($i = 0; $i < (sizeof($kriteria) - 1); $i++) {
                    $addPairwise = array(
                        'fuzzy_id' => 0,
                        'kriteria_kolom' => $tempData['kode_kriteria'],
                        'kriteria_baris' => $kriteria[$i]['kode_kriteria'],
                        'value' => 1,
                        'deskripsi' => '',
                    );
                    $this->pairwise->insert($addPairwise);
                }
                for ($i = 0; $i < sizeof($kriteria); $i++) {
                    $addPairwise2 = array(
                        'fuzzy_id' => 0,
                        'kriteria_kolom' => $kriteria[$i]['kode_kriteria'],
                        'kriteria_baris' => $tempData['kode_kriteria'],
                        'value' => 1,
                        'deskripsi' => '',
                    );
                    $this->pairwise->insert($addPairwise2);
                }
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
                # code...
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function alternatifCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData = array(
            'kode_alternatif' => $jsonData->alternatif_kode,
            'alternatif' => $jsonData->alternatif_name,
            'deskripsi' => null,
        );
        try {
            $this->alternatif->insert($tempData);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function kriteriaUpdate()
    {
        $jsonData = $this->request->getJSON();
        $oldData = $this->db->table('kriteria')->select('kode_kriteria, kriteria, atribut')->where('id_kriteria', $jsonData->kriteria_id)->get()->getRowArray();
        $tempData = array(
            'kode_kriteria' => $jsonData->kriteria_kode,
            'kriteria' => $jsonData->kriteria_name,
            'atribut' => $jsonData->kriteria_atribut,
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
        $isValid = $this->validate([
            'kriteria_kode'  => 'is_unique[kriteria.kode_kriteria,kriteria.id_kriteria,' . $jsonData->kriteria_id . ']',
        ]);
        try {
            if ($isValid) {
                # code...
                $this->db->table('kriteria')->update($tempData, array('id_kriteria' => $jsonData->kriteria_id));
                $this->logactivities->createLog($jsonData->kriteria_id, 'kriteria', user()->username, $message);
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
            }
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function alternatifUpdate()
    {
        $jsonData = $this->request->getJSON();
        $oldData = $this->db->table('alternatif')->select('kode_alternatif, alternatif')->where('id_alternatif', $jsonData->alternatif_id)->get()->getRowArray();
        $tempData = array(
            'kode_alternatif' => $jsonData->alternatif_kode,
            'alternatif' => $jsonData->alternatif_name,
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
            $this->db->table('alternatif')->update($tempData, array('id_alternatif' => $jsonData->alternatif_id));
            $this->logactivities->createLog($jsonData->alternatif_id, 'alternatif', user()->username, $message);
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function bobotKriteriaUpdate()
    {
        try {
            $jsonData = $this->request->getJSON(TRUE);
            // $this->pairwise->where('id_pairwise is not null')->delete();
            // $this->db->table('bobotkriteria')->where('id_bobotkriteria is not null')->delete();
            foreach ($jsonData['pairwise'] as $key => $value) {
                $input = array(
                    'fuzzy_id' => $value['fuzzy_id'],
                    'kriteria_kolom' => $value['kriteria_kolom'],
                    'kriteria_baris' => $value['kriteria_baris'],
                    'value' => $value['value'],
                    'deskripsi' => '',
                );
                $this->db->table('pairwisekriteria')->where(['kriteria_kolom' => $input['kriteria_kolom'], 'kriteria_baris' => $input['kriteria_baris']])->update($input);
            }
            foreach ($jsonData['bobot'] as $key => $value1) {
                $input1 = array(
                    'kriteria_kode' => $value1['kriteria_kode'],
                    'value' => $value1['value'],
                    'deskripsi' => '',
                );
                $this->db->table('bobotkriteria')->where('kriteria_kode', $input1['kriteria_kode'])->update($input1);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function alternatifDelete()
    {
        try {
            //code...
            $jsonData = $this->request->getJSON(TRUE);
            foreach ($jsonData as $key => $value) {
                $this->alternatif->where('id_alternatif', $value['id'])->delete();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function kriteriaDelete()
    {
        try {
            //code...
            $jsonData = $this->request->getJSON(TRUE);
            foreach ($jsonData as $key => $value) {
                $kriteria = $this->kriteria->where('id_kriteria', $value['id'])->get()->getRowArray();
                $this->pairwise->where('kriteria_kolom', $kriteria['kode_kriteria'])->orWhere('kriteria_baris', $kriteria['kode_kriteria'])->delete();
                $this->kriteria->where('id_kriteria', $value['id'])->delete();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
