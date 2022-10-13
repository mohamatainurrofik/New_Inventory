<?php

namespace App\Models;

use CodeIgniter\Model;

class Unit extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'units';
    protected $primaryKey       = 'id_unit';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_unit', 'product_id', 'brand', 'nama_unit', 'satuan', 'jenis_unit'
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

    public function listAsetInProduct($id)
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
                   WHERE units.id_unit = $id ")->getResultArray();
        return $data;
    }

    public function listProductbySelect2($searchTerm)
    {
        if ($searchTerm == null) {
            $query = $this->db->query("SELECT *
                                                FROM units
                                                        WHERE units.deleted_at is null LIMIT 5");
            $log = $query->getResultArray();
        } else {
            $query1 = $this->db->query("SELECT *
                                            FROM units
                                                WHERE units.nama_unit like '%$searchTerm%' AND units.deleted_at is null");
            $log = $query1->getResultArray();
        }
        return $log;
    }
}
