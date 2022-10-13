<?php

namespace App\Models;

use CodeIgniter\Model;

class Order extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'orders';
    protected $primaryKey       = 'id_order';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_order', 'order_type', 'order_lokasi', 'description', 'status_order', 'dokumen_order', 'created_by', 'updated_by', 'feedbackdescription'
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

    public function listDataorder($id)
    {
        $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', detailunits.kode_unit, '.', detailunits.tahun_perolehan) as kode,
        c.jenis_product,d.content_product,
        units.brand, units.nama_unit, dataorder.qty,
        detailunits.status_unit,b.unitkerja as ruangan,
        karyawans.nama
           FROM orders
               INNER JOIN unitkerja as b on orders.order_lokasi = b.id_unitkerja
               INNER JOIN unitkerja as a on b.parent_id_unitkerja = a.id_unitkerja
               INNER JOIN dataorder on dataorder.kode_order = orders.id_order
               INNER JOIN detailunits on detailunits.id_detailunit = dataorder.detailunit_id
               LEFT JOIN karyawans on karyawans.id_karyawan = dataorder.peruntukan
               INNER JOIN units on units.id_unit = detailunits.unit_id
               INNER JOIN products as c on c.id_product = units.product_id
               INNER JOIN products as d on c.parent_id_product = d.id_product
                   WHERE orders.id_order = $id ")->getResultArray();

        return $data;
    }

    public function getApproval($jenis)
    {
        $data = $this->db->query("SELECT karyawans.nama, auth_groups.name FROM users INNER JOIN auth_groups_users as a on a.user_id = users.id INNER JOIN auth_groups on auth_groups.id = a.group_id INNER JOIN karyawans on users.karyawan_id = karyawans.id_karyawan WHERE auth_groups.description = '$jenis' LIMIT 1")->getRowArray();
        return $data;
    }

    public function listInventarisSelect2($searchTerm, $jenis)
    {
        if ($searchTerm == null) {
            $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', lpad(detailunits.id_detailunit, 4, 0), '.', detailunits.tahun_perolehan) as kode,
            c.jenis_product,d.content_product as kategori,
            units.brand, units.nama_unit, units.satuan,
            detailunits.status_unit,detailunits.id_detailunit,detailunits.stok,
            karyawans.nama,karyawans.id_karyawan,detailunits.id_detailunit,suppliers.id_supplier,suppliers.supplier,detailunits.harga,detailunits.kondisi,b.unitkerja as ruangan,b.id_unitkerja as id_ruangan,detailunits.tahun_perolehan,detailunits.invoice,detailunits.nota_dinas
               FROM unitkerja as a
                   INNER JOIN unitkerja as b on b.parent_id_unitkerja = a.id_unitkerja
                   INNER JOIN detailunits on detailunits.unitkerja_id = b.id_unitkerja
                   LEFT JOIN karyawans on karyawans.id_karyawan = detailunits.karyawan_id
                   INNER JOIN units on units.id_unit = detailunits.unit_id
                   INNER JOIN products as c on c.id_product = units.product_id
                   INNER JOIN products as d on c.parent_id_product = d.id_product
                   INNER JOIN suppliers on suppliers.id_supplier = detailunits.supplier_id
                    WHERE detailunits.status_unit = 'Available' AND units.jenis_unit = 'Habis Pakai' AND c.jenis_product = '$jenis' AND detailunits.deleted_at is null LIMIT 5")->getResultArray();
        } else {
            $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', lpad(detailunits.id_detailunit, 4, 0), '.', detailunits.tahun_perolehan) as kode,
            c.jenis_product,d.content_product as kategori,
            units.brand, units.nama_unit, units.satuan,
            detailunits.status_unit,detailunits.id_detailunit,detailunits.stok,
            karyawans.nama,karyawans.id_karyawan,detailunits.id_detailunit,suppliers.id_supplier,suppliers.supplier,detailunits.harga,detailunits.kondisi,b.unitkerja as ruangan,b.id_unitkerja as id_ruangan,detailunits.tahun_perolehan,detailunits.invoice,detailunits.nota_dinas
               FROM unitkerja as a
                   INNER JOIN unitkerja as b on b.parent_id_unitkerja = a.id_unitkerja
                   INNER JOIN detailunits on detailunits.unitkerja_id = b.id_unitkerja
                   LEFT JOIN karyawans on karyawans.id_karyawan = detailunits.karyawan_id
                   INNER JOIN units on units.id_unit = detailunits.unit_id
                   INNER JOIN products as c on c.id_product = units.product_id
                   INNER JOIN products as d on c.parent_id_product = d.id_product
                   INNER JOIN suppliers on suppliers.id_supplier = detailunits.supplier_id
                    WHERE detailunits.status_unit = 'Available' AND units.jenis_unit = 'Habis Pakai' AND c.jenis_product = '$jenis' AND detailunits.deleted_at is null AND units.nama_unit like '%$searchTerm%'")->getResultArray();
        }
        return $data;
    }

    public function listInventarisSelect2_1($searchTerm, $jenis)
    {
        if ($searchTerm == null) {
            $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', lpad(detailunits.id_detailunit, 4, 0), '.', detailunits.tahun_perolehan) as kode,
            c.jenis_product,d.content_product as kategori,
            units.brand, units.nama_unit, units.satuan,
            detailunits.status_unit,detailunits.id_detailunit,detailunits.stok,
            karyawans.nama,karyawans.id_karyawan,detailunits.id_detailunit,suppliers.id_supplier,suppliers.supplier,detailunits.harga,detailunits.kondisi,b.unitkerja as ruangan,b.id_unitkerja as id_ruangan,detailunits.tahun_perolehan,detailunits.invoice,detailunits.nota_dinas
               FROM unitkerja as a
                   INNER JOIN unitkerja as b on b.parent_id_unitkerja = a.id_unitkerja
                   INNER JOIN detailunits on detailunits.unitkerja_id = b.id_unitkerja
                   LEFT JOIN karyawans on karyawans.id_karyawan = detailunits.karyawan_id
                   INNER JOIN units on units.id_unit = detailunits.unit_id
                   INNER JOIN products as c on c.id_product = units.product_id
                   INNER JOIN products as d on c.parent_id_product = d.id_product
                   INNER JOIN suppliers on suppliers.id_supplier = detailunits.supplier_id
                    WHERE detailunits.status_unit = 'Available' AND units.jenis_unit = 'Tidak Habis Pakai' AND c.jenis_product = '$jenis' AND detailunits.deleted_at is null LIMIT 5")->getResultArray();
        } else {
            $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', lpad(detailunits.id_detailunit, 4, 0), '.', detailunits.tahun_perolehan) as kode,
            c.jenis_product,d.content_product as kategori,
            units.brand, units.nama_unit, units.satuan,
            detailunits.status_unit,detailunits.id_detailunit,detailunits.stok,
            karyawans.nama,karyawans.id_karyawan,detailunits.id_detailunit,suppliers.id_supplier,suppliers.supplier,detailunits.harga,detailunits.kondisi,b.unitkerja as ruangan,b.id_unitkerja as id_ruangan,detailunits.tahun_perolehan,detailunits.invoice,detailunits.nota_dinas
               FROM unitkerja as a
                   INNER JOIN unitkerja as b on b.parent_id_unitkerja = a.id_unitkerja
                   INNER JOIN detailunits on detailunits.unitkerja_id = b.id_unitkerja
                   LEFT JOIN karyawans on karyawans.id_karyawan = detailunits.karyawan_id
                   INNER JOIN units on units.id_unit = detailunits.unit_id
                   INNER JOIN products as c on c.id_product = units.product_id
                   INNER JOIN products as d on c.parent_id_product = d.id_product
                   INNER JOIN suppliers on suppliers.id_supplier = detailunits.supplier_id
                    WHERE detailunits.status_unit = 'Available' AND units.jenis_unit = 'Tidak Habis Pakai' AND c.jenis_product = '$jenis' AND detailunits.deleted_at is null AND units.nama_unit like '%$searchTerm%'")->getResultArray();
        }
        return $data;
    }
}
