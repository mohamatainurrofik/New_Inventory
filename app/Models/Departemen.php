<?php

namespace App\Models;

use CodeIgniter\Model;

class Departemen extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'departements';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id', 'parent_id', 'content', 'lokasi_id', 'depth_dep', 'status_dep', 'description'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function listkaryawaninDepartemen($id)
    {
        $data = $this->db->query("SELECT karyawans.nama,karyawans.nrp,karyawans.is_pic, b.content, users.email
                                        FROM departements as a 
                                            INNER JOIN departements as b on a.id = b.parent_id 
                                            INNER JOIN karyawans on karyawans.jabatan_id = b.id 
                                            INNER JOIN users on users.karyawan_id = karyawans.id_karyawan 
                                                    WHERE a.id = $id")->getResultArray();

        return $data;
    }

    public function listkaryawaninJabatan($id)
    {
        $data = $this->db->query("SELECT karyawans.nama,karyawans.nrp,karyawans.is_pic, b.content, users.email
                                        FROM departements as a 
                                            INNER JOIN departements as b on a.id = b.parent_id 
                                            INNER JOIN karyawans on karyawans.jabatan_id = b.id 
                                            INNER JOIN users on users.karyawan_id = karyawans.id_karyawan 
                                                    WHERE b.id = $id")->getResultArray();

        return $data;
    }

    public function listJabataninDepartemen($id)
    {
        $data = $this->db->query("SELECT b.*, unitkerja.unitkerja, unitkerja.id_unitkerja
                                        FROM departements as a 
                                            INNER JOIN departements as b on a.id = b.parent_id 
                                            INNER JOIN unitkerja on unitkerja.id_unitkerja = b.lokasi_id 
                                                    WHERE b.parent_id = $id")->getResultArray();
        return $data;
    }

    public function listRuanganbySelect2($searchTerm)
    {
        if ($searchTerm == null) {
            $query = $this->db->query("SELECT *
                                                FROM unitkerja
                                                        WHERE unitkerja.parent_id_unitkerja is not null AND unitkerja.deleted_at is null LIMIT 5");
            $log = $query->getResultArray();
        } else {
            $query1 = $this->db->query("SELECT *
                                            FROM unitkerja
                                                WHERE unitkerja.unitkerja like '%$searchTerm%' AND unitkerja.parent_id_unitkerja is not null AND departements.deleted_at is null");
            $log = $query1->getResultArray();
        }
        return $log;
    }

    public function listDepartemenbySelect2($searchTerm)
    {
        if ($searchTerm == null) {
            $query = $this->db->query("SELECT *
                                                FROM departements
                                                        WHERE departements.parent_id is null AND departements.deleted_at is null LIMIT 5");
            $log = $query->getResultArray();
        } else {
            $query1 = $this->db->query("SELECT *
                                            FROM departements
                                                WHERE departements.content like '%$searchTerm%' AND departements.parent_id is null AND departements.deleted_at is null");
            $log = $query1->getResultArray();
        }
        return $log;
    }

    public function listJabatanbySelect2($searchTerm)
    {
        if ($searchTerm == null) {
            $query = $this->db->query("SELECT *
                                                FROM departements
                                                        WHERE departements.parent_id is not null AND departements.deleted_at is null LIMIT 5");
            $log = $query->getResultArray();
        } else {
            $query1 = $this->db->query("SELECT *
                                            FROM departements
                                                WHERE departements.content like '%$searchTerm%' AND departements.parent_id is not null AND departements.deleted_at is null");
            $log = $query1->getResultArray();
        }
        return $log;
    }
}
