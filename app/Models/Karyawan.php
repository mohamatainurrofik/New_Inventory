<?php

namespace App\Models;

use CodeIgniter\Model;

class Karyawan extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'karyawans';
    protected $primaryKey       = 'id_karyawan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_karyawan', 'jabatan_id', 'nama', 'nrp', 'email', 'alamat', 'foto', 'status_karyawan', 'deskripsi', 'is_pic'
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

    public function listAsetInkaryawan($id)
    {
        $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', detailunits.kode_unit, '.', detailunits.tahun_perolehan) as kode,
        c.jenis_product,d.content_product,
        units.brand, units.nama_unit,
        detailunits.status_unit,
        karyawans.nama
           FROM unitkerja as a
               INNER JOIN unitkerja as b on b.parent_id_unitkerja = a.id_unitkerja
               INNER JOIN detailunits on detailunits.unitkerja_id = b.id_unitkerja
               INNER JOIN karyawans on karyawans.id_karyawan = detailunits.karyawan_id
               INNER JOIN units on units.id_unit = detailunits.unit_id
               INNER JOIN products as c on c.id_product = units.product_id
               INNER JOIN products as d on c.parent_id_product = d.id_product
                   WHERE karyawans.id_karyawan = $id ")->getResultArray();
        return $data;
    }

    public function listKaryawanbySelect2($searchTerm)
    {
        if ($searchTerm == null) {
            // $query = $this->db->query("SELECT *
            //                                     FROM karyawans
            //                                         WHERE karyawans.deleted_at is null AND karyawans.id_karyawan NOT IN (SELECT karyawan_id FROM users) LIMIT 5");
            $query = $this->db->query("SELECT *
                                                FROM karyawans
                                                    WHERE karyawans.deleted_at is null LIMIT 5");
            $log = $query->getResultArray();
        } else {
            $query1 = $this->db->query("SELECT *
                                            FROM karyawans
                                                WHERE karyawans.deleted_at is null AND karyawans.nama like '%$searchTerm%'");
            $log = $query1->getResultArray();
        }
        return $log;
    }

    public function karyawanListSession($id)
    {
        $query1 = $this->db->query("SELECT departements.parent_id
                                        FROM karyawans
                                            INNER JOIN users ON users.karyawan_id = karyawans.id_karyawan
                                            INNER JOIN departements ON departements.id = karyawans.jabatan_id
                                                WHERE users.id = '$id'");

        $karyawan = $query1->getRowArray();

        $query = $this->db->query("SELECT c.*
                                        FROM karyawans c
                                            WHERE c.jabatan_id IN
                                                (SELECT a.id
                                                    FROM departements a
                                                    WHERE a.parent_id = '{$karyawan['parent_id']}')");
        $log = $query->getResultArray();
        return $log;
    }
}
