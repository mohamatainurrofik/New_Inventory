<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'products';
    protected $primaryKey       = 'id_product';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_product', 'parent_id_product', 'kode_content_product', 'content_product', 'jenis_product', 'pj_departement', 'deskripsi_product', 'created_by'
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

    public function listAsetInSubKategori($id)
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
                   WHERE c.id_product = $id ")->getResultArray();
        return $data;
    }
}
