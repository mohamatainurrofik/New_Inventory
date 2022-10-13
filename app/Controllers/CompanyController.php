<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Departemen;
use App\Models\Karyawan;
use App\Models\Logactivities;
use App\Models\Unitkerja;
use Myth\Auth\Models\UserModel;

class CompanyController extends BaseController
{
    public function __construct()
    {
        $this->unitkerja = new Unitkerja();
        $this->logactivities = new Logactivities();
        $this->departemen = new Departemen();
        $this->karyawan = new Karyawan();
        $this->users = new UserModel();
    }

    public function index()
    {
        //
    }

    public function viewUnitkerja()
    {
        return view('Master/Company/unitkerjalist');
    }

    public function viewRuangan()
    {
        return view('Master/Company/ruanganlist');
    }
    public function viewDepartemen()
    {
        return view('Master/Company/departemenlist');
    }
    public function viewJabatan()
    {
        return view('Master/Company/jabatanlist');
    }
    public function viewKaryawan()
    {
        return view('Master/Company/karyawanlist');
    }

    public function unitkerjaDetail($id)
    {
        $data['unitkerja'] = $this->unitkerja->where('id_unitkerja', $id)->findAll();
        $data['allUnitkerja'] = $this->unitkerja->where('parent_id_unitkerja is null')->findAll();
        $data['ruanganAtUnitkerja'] = $this->unitkerja->where('parent_id_unitkerja', $id)->findAll();
        $data['thisLogActivities'] = $this->logactivities->where('table_id', $id)->findAll();

        return view('Master/Company/unitkerjaDetail', $data);
    }

    public function ruanganDetail($id)
    {
        $data['ruangan'] = $this->db->query("SELECT a.unitkerja as unit_kerja, b.* FROM unitkerja as a INNER JOIN unitkerja as b on a.id_unitkerja = b.parent_id_unitkerja WHERE b.id_unitkerja = $id")->getRowArray();
        $data['allRuangan'] = $this->unitkerja->where('parent_id_unitkerja is not null')->findAll();
        $data['ruanganAtRuangan'] = $this->unitkerja->where('parent_id_unitkerja', $id)->findAll();
        $data['thisLogActivities'] = $this->logactivities->where('table_id', $id)->findAll();

        return view('Master/Company/ruanganDetail', $data);
    }


    public function departemenDetail($id)
    {
        $data['departemen'] = $this->db->query("SELECT b.unitkerja , a.* FROM departements as a INNER JOIN unitkerja as b on a.lokasi_id = b.id_unitkerja WHERE a.id = $id")->getRowArray();
        $data['allDepartemen'] = $this->departemen->where('parent_id is null')->findAll();
        $data['ruanganAtDepartemen'] = $this->departemen->where('parent_id', $id)->findAll();
        $data['thisLogActivities'] = $this->logactivities->where('table_id', $id)->findAll();

        return view('Master/Company/departemenDetail', $data);
    }

    public function jabatanDetail($id)
    {
        $data['jabatan'] = $this->db->query("SELECT c.unitkerja , a.* FROM departements as a INNER JOIN departements as b on a.parent_id = b.id INNER JOIN unitkerja as c on a.lokasi_id = c.id_unitkerja WHERE a.id = $id")->getRowArray();
        $data['allJabatan'] = $this->departemen->where('parent_id is not null')->findAll();
        $data['ruanganAtJabatan'] = $this->departemen->where('parent_id', $id)->findAll();
        $data['thisLogActivities'] = $this->logactivities->where('table_id', $id)->findAll();

        return view('Master/Company/jabatanDetail', $data);
    }

    public function karyawanDetail($id)
    {
        $data['karyawan'] = $this->db->query("SELECT departements.content, unitkerja.unitkerja, users.email , karyawans.* FROM karyawans LEFT JOIN users on karyawans.id_karyawan = users.karyawan_id INNER JOIN departements on karyawans.jabatan_id = departements.id INNER JOIN unitkerja on unitkerja.id_unitkerja = departements.lokasi_id WHERE karyawans.id_karyawan = $id")->getRowArray();
        $data['allKaryawan'] = $this->karyawan->findAll();
        // $data['ruanganAtKaryawan'] = $this->departemen->where('parent_id', $id)->findAll();
        // $data['thisLogActivities'] = $this->logactivities->where('table_id', $id)->findAll();

        return view('Master/Company/karyawanDetail', $data);
    }

    public function unitkerjaList()
    {
        $data = $this->unitkerja->where('parent_id_unitkerja is null')->findAll();
        if (sizeof($data)) {
            for ($i = 0; $i < sizeof($data); $i++) {
                $linked = $this->unitkerja->where('parent_id_unitkerja', $data[$i]['id_unitkerja'])->countAllResults();
                $jsonData[] = array(
                    "id" => $data[$i]['id_unitkerja'],
                    "kode" => $data[$i]['kode_unitkerja'],
                    "nama" => $data[$i]['unitkerja'],
                    "status" => $data[$i]['status_unitkerja'],
                    "linked" => $linked,
                );
            }
            return json_encode($jsonData);
        } else {
            return json_encode(null);
        }
    }

    public function ruanganList()
    {
        $data = $this->unitkerja->listRuangan();

        if (sizeof($data)) {
            for ($i = 0; $i < sizeof($data); $i++) {
                $linked = $this->db->table('unitkerja')->select('unitkerja.id_unitkerja')->join('detailunits', 'detailunits.unitkerja_id = unitkerja.id_unitkerja')->where('id_unitkerja', $data[$i]['id_unitkerja'])->countAllResults();
                $jsonData[] = array(
                    "id" => $data[$i]['id_unitkerja'],
                    "kode" => $data[$i]['kode_unitkerja'],
                    "nama" => $data[$i]['unitkerja'],
                    "unitkerja" => $data[$i]['unit_kerja'],
                    "status" => $data[$i]['status_unitkerja'],
                    "linked" => $linked,
                );
            }
            return json_encode($jsonData);
        } else {
            return json_encode(null);
        }
    }

    public function departemenList()
    {
        $data = $this->db->table('departements')->select('departements.*, unitkerja.unitkerja, unitkerja.id_unitkerja')->join('unitkerja', 'unitkerja.id_unitkerja = departements.lokasi_id')->get()->getResultArray();
        if (sizeof($data)) {
            for ($i = 0; $i < sizeof($data); $i++) {
                $linked = $this->db->table('departements')->select('unitkerja.id_unitkerja')->join('karyawans', 'karyawans.jabatan_id = departements.id')->where('departements.id', $data[$i]['id'])->countAllResults();
                $jsonData[] = array(
                    "id" => $data[$i]['id'],
                    "nama" => $data[$i]['content'],
                    "unitkerja" => $data[$i]['unitkerja'],
                    "status" => $data[$i]['status_dep'],
                    "linked" => $linked,
                );
            }
            return json_encode($jsonData);
        } else {
            return json_encode(null);
        }
    }

    public function jabatanList()
    {
        $data = $this->db->table('departements as a')->select('a.*, unitkerja.unitkerja, unitkerja.id_unitkerja')->join('departements as b', 'a.parent_id = b.id')->join('unitkerja', 'a.lokasi_id = unitkerja.id_unitkerja')->get()->getResultArray();
        if (sizeof($data)) {
            for ($i = 0; $i < sizeof($data); $i++) {
                $linked = $this->db->table('departements')->select('departements.id')->join('karyawans', 'karyawans.jabatan_id = departements.id')->join('unitkerja', 'unitkerja.id_unitkerja = departements.lokasi_id')->where('departements.id', $data[$i]['id'])->countAllResults();
                $jsonData[] = array(
                    "id" => $data[$i]['id'],
                    "nama" => $data[$i]['content'],
                    "unitkerja" => $data[$i]['unitkerja'],
                    "status" => $data[$i]['status_dep'],
                    "linked" => $linked,
                );
            }

            return json_encode($jsonData);
        } else {
            return json_encode(null);
        }
    }

    public function karyawanList()
    {
        $data = $this->db->table('karyawans')->select('karyawans.*, departements.content, users.email')->join('departements', 'karyawans.jabatan_id = departements.id')->join('users', 'users.karyawan_id = karyawans.id_karyawan', 'LEFT')->get()->getResultArray();
        if (sizeof($data)) {
            for ($i = 0; $i < sizeof($data); $i++) {
                $linked = $this->db->table('karyawans')->select('karyawans.id_karyawan')->join('detailunits', 'detailunits.karyawan_id = karyawans.id_karyawan')->where('karyawans.id_karyawan', $data[$i]['id_karyawan'])->countAllResults();
                $jsonData[] = array(
                    "id" => $data[$i]['id_karyawan'],
                    "nama" => $data[$i]['nama'],
                    "nrp" => $data[$i]['nrp'],
                    "jabatan" => $data[$i]['content'],
                    "email" => $data[$i]['email'],
                    "status" => $data[$i]['status_karyawan'],
                    "linked" => $linked,
                );
            }

            return json_encode($jsonData);
        } else {
            return json_encode(null);
        }
    }

    public function unitkerjaLinked($id)
    {
        $data = $this->unitkerja->where('parent_id_unitkerja', $id)->findAll();

        return json_encode($data);
    }

    public function karyawanInUnitkerja($id)
    {
        $data = $this->unitkerja->listKaryawaninUnitkerja($id);

        return json_encode($data);
    }

    public function karyawanInRuangan($id)
    {
        $data = $this->unitkerja->listKaryawaninRuangan($id);

        return json_encode($data);
    }

    public function karyawanInDepartemen($id)
    {
        $data = $this->departemen->listKaryawaninDepartemen($id);

        return json_encode($data);
    }

    public function jabatanInDepartemen($id)
    {
        $data = $this->departemen->listJabataninDepartemen($id);

        return json_encode($data);
    }

    public function karyawanInJabatan($id)
    {
        $data = $this->departemen->listKaryawaninJabatan($id);

        return json_encode($data);
    }


    public function asetInUnitkerja($id)
    {
        $data = $this->unitkerja->listAsetInunitkerja($id);

        return json_encode($data);
    }

    public function asetInRuangan($id)
    {
        $data = $this->unitkerja->listAsetInruangan($id);

        return json_encode($data);
    }

    public function asetInKaryawan($id)
    {
        $data = $this->karyawan->listAsetInkaryawan($id);

        return json_encode($data);
    }

    public function usersInKaryawan($id)
    {
        $data = $this->users->where(['karyawan_id' => $id])->findAll();

        return json_encode($data);
    }

    public function unitkerjaHistoryList($id)
    {
        $data = $this->logactivities->where(['table_id' => $id, 'table_names' => 'unitkerja'])->findAll();


        return json_encode($data);
    }

    public function departemenHistoryList($id)
    {
        $data = $this->logactivities->where(['table_id' => $id, 'table_names' => 'departements'])->findAll();


        return json_encode($data);
    }

    public function karyawanHistoryList($id)
    {
        $data = $this->logactivities->where(['table_id' => $id, 'table_names' => 'karyawans'])->findAll();


        return json_encode($data);
    }

    public function unitkerjaCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData = array(
            'parent_id_unitkerja' => null,
            'kode_unitkerja' => $jsonData->unitkerja_kode,
            'unitkerja' => $jsonData->unitkerja_name,
            'depth_unitkerja' => 0,
            'status_unitkerja' => $jsonData->unitkerja_status
        );
        $isValid = $this->validate([
            'unitkerja_kode'  => 'is_unique[unitkerja.kode_unitkerja]',
        ]);
        try {
            if ($isValid) {
                $this->unitkerja->insert($tempData);
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
            }
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function ruanganCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData1 = array(
            'parent_id_unitkerja' => $jsonData->ruangan_unitkerja,
            'kode_unitkerja' => $jsonData->ruangan_kode,
            'unitkerja' => $jsonData->ruangan_name,
            'depth_unitkerja' => 1,
            'status_unitkerja' => $jsonData->ruangan_status
        );
        $isValid = $this->validate([
            'ruangan_kode'  => 'is_unique[unitkerja.kode_unitkerja]',
        ]);
        try {
            if ($isValid) {
                $this->unitkerja->insert($tempData1);
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
            }
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function departemenCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData1 = array(
            'parent_id' => null,
            'content' => $jsonData->departemen_name,
            'lokasi_id' => $jsonData->departemen_unitkerja,
            'depth_dep' => 0,
            'status_dep' => $jsonData->departemen_status
        );
        try {
            $this->departemen->insert($tempData1);
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function jabatanCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData1 = array(
            'parent_id' => $jsonData->jabatan_departemen,
            'content' => $jsonData->jabatan_name,
            'lokasi_id' => $jsonData->jabatan_ruangan,
            'depth_dep' => 1,
            'status_dep' => $jsonData->jabatan_status
        );
        try {
            $this->departemen->insert($tempData1);
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function karyawanCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData1 = array(
            'jabatan_id' => $jsonData->karyawan_jabatan,
            'nrp' => $jsonData->karyawan_nrp,
            'email' => 'tes@gmail.com',
            'nama' => $jsonData->karyawan_name,
            'alamat' => $jsonData->karyawan_alamat,
            'foto' => 'default.png',
            'status_karyawan' => 'PKWT',
            'deskripsi' => null,
            'is_pic' => '1',
        );
        $isValid = $this->validate([
            'karyawan_nrp'  => 'is_unique[karyawans.nrp]',
        ]);
        try {
            if ($isValid) {
                $this->karyawan->insert($tempData1);
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
            }
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }


    public function unitkerjaUpdate()
    {
        $jsonData = $this->request->getJSON();
        $oldData = $this->db->table('unitkerja')->select('kode_unitkerja, unitkerja, status_unitkerja')->where('id_unitkerja', $jsonData->id)->get()->getRowArray();
        $tempData = array(
            'kode_unitkerja' => $jsonData->editUnitkerjaKode,
            'unitkerja' => $jsonData->editUnitkerjaName,
            'status_unitkerja' => $jsonData->editstatus,
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
            'editUnitkerjaKode'  => 'is_unique[unitkerja.kode_unitkerja,unitkerja.id_unitkerja,' . $jsonData->id . ']',
        ]);
        try {
            if ($isValid) {
                # code...
                $this->db->table('unitkerja')->update($tempData, array('id_unitkerja' => $jsonData->id));
                $this->logactivities->createLog($jsonData->id, 'unitkerja', user()->username, $message);
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
            }
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function ruanganUpdate()
    {
        $jsonData = $this->request->getJSON();
        $oldData = $this->db->table('unitkerja')->select('kode_unitkerja, unitkerja, status_unitkerja')->where('id_unitkerja', $jsonData->id)->get()->getRowArray();
        $tempData = array(
            'kode_unitkerja' => $jsonData->editRuanganKode,
            'unitkerja' => $jsonData->editRuanganName,
            'status_unitkerja' => $jsonData->editstatus,
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
            'editRuanganKode'  => 'is_unique[unitkerja.kode_unitkerja,unitkerja.id_unitkerja,' . $jsonData->id . ']',
        ]);
        try {
            if ($isValid) {
                $this->db->table('unitkerja')->update($tempData, array('id_unitkerja' => $jsonData->id));
                $this->logactivities->createLog($jsonData->id, 'unitkerja', user()->username, $message);
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function departemenUpdate()
    {
        try {
            $jsonData = $this->request->getJSON();
            $oldData = $this->db->table('departements')->select('content, status_dep')->where('id', $jsonData->id)->get()->getRowArray();
            $tempData = array(
                'content' => $jsonData->editDepartemenName,
                'status_dep' => $jsonData->editstatus,
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
            $this->db->table('departements')->update($tempData, array('id' => $jsonData->id));
            $this->logactivities->createLog($jsonData->id, 'departements', user()->username, $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function jabatanUpdate()
    {
        try {
            $jsonData = $this->request->getJSON();
            $oldData = $this->db->table('departements as a')->select('content, lokasi_id, status_dep')->where('id', $jsonData->id)->get()->getRowArray();
            $tempData = array(
                'content' => $jsonData->editJabatanName,
                'lokasi_id' => $jsonData->editJabatanLokasi,
                'status_dep' => $jsonData->editstatus,
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
            $this->db->table('departements')->update($tempData, array('id' => $jsonData->id));
            $this->logactivities->createLog($jsonData->id, 'departements', user()->username, $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function karyawanUpdate()
    {
        $jsonData = $this->request->getJSON();
        $oldData = $this->db->table('karyawans')->select('nama, nrp, jabatan_id, alamat, status_karyawan')->where('id_karyawan', $jsonData->id)->get()->getRowArray();
        $tempData = array(
            'nama' => $jsonData->editKaryawanName,
            'nrp' => $jsonData->editKaryawanNrp,
            'jabatan_id' => $jsonData->editKaryawanJabatan,
            'alamat' => $jsonData->editKaryawanAlamat,
            'status_karyawan' => $jsonData->editstatus,
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
            'editKaryawanNrp'  => 'is_unique[karyawans.nrp,karyawans.id_karyawan,' . $jsonData->id . ']',
        ]);
        try {
            if ($isValid) {
                $this->db->table('karyawans')->update($tempData, array('id_karyawan' => $jsonData->id));
                $this->logactivities->createLog($jsonData->id, 'karyawans', user()->username, $message);
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function unitkerjaDelete()
    {
        try {
            //code...
            $jsonData = $this->request->getJSON(TRUE);
            foreach ($jsonData as $key => $value) {
                $this->unitkerja->where('id_unitkerja', $value['id'])->delete();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function departemenDelete()
    {
        try {
            //code...
            $jsonData = $this->request->getJSON(TRUE);
            foreach ($jsonData as $key => $value) {
                $this->departemen->where('id', $value['id'])->delete();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function jabatanDelete()
    {
        try {
            //code...
            $jsonData = $this->request->getJSON(TRUE);
            foreach ($jsonData as $key => $value) {
                $this->departemen->where('id', $value['id'])->delete();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function karyawanDelete()
    {
        try {
            //code...
            $jsonData = $this->request->getJSON(TRUE);
            foreach ($jsonData as $key => $value) {
                $this->karyawan->where('id_karyawan', $value['id'])->delete();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }












    public function listUnitkerjaSelect2()
    {
        $data = $this->unitkerja->listUnitkerjabySelect2($this->request->getPost('searchTerm'));

        for ($i = 0; $i < sizeof($data); $i++) {
            $jsonData[] = array(
                "id" => $data[$i]['id_unitkerja'],
                "text" => $data[$i]['unitkerja'],
            );
        }

        return json_encode($jsonData);
    }
    public function listRuanganSelect2()
    {
        $data = $this->departemen->listRuanganbySelect2($this->request->getPost('searchTerm'));

        for ($i = 0; $i < sizeof($data); $i++) {
            $jsonData[] = array(
                "id" => $data[$i]['id_unitkerja'],
                "text" => $data[$i]['unitkerja'],
            );
        }

        return json_encode($jsonData);
    }

    public function listDepartemenSelect2()
    {
        $data = $this->departemen->listDepartemenbySelect2($this->request->getPost('searchTerm'));

        for ($i = 0; $i < sizeof($data); $i++) {
            $jsonData[] = array(
                "id" => $data[$i]['id'],
                "text" => $data[$i]['content'],
            );
        }

        return json_encode($jsonData);
    }

    public function listJabatanSelect2()
    {
        $data = $this->departemen->listJabatanbySelect2($this->request->getPost('searchTerm'));

        for ($i = 0; $i < sizeof($data); $i++) {
            $jsonData[] = array(
                "id" => $data[$i]['id'],
                "text" => $data[$i]['content'],
            );
        }

        return json_encode($jsonData);
    }
}
