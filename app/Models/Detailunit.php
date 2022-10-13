<?php

namespace App\Models;

use CodeIgniter\Model;

class Detailunit extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detailunits';
    protected $primaryKey       = 'id_detailunit';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_detailunit', 'unit_id', 'supplier_id', 'karyawan_id', 'unitkerja_id', 'milik', 'status_unit', 'kode_unit', 'foto_unit', 'kondisi', 'tahun_perolehan', 'invoice', 'nota_dinas', 'pj', 'harga', 'stok', 'barcode', 'created_by', 'updated_by'
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

    public function listInventaris()
    {
        $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', lpad(detailunits.id_detailunit, 4, 0), '.', detailunits.tahun_perolehan) as kode,
        c.jenis_product,d.content_product as kategori,
        units.brand, units.nama_unit, units.satuan,
        detailunits.status_unit,
        karyawans.nama,detailunits.id_detailunit
           FROM unitkerja as a
               INNER JOIN unitkerja as b on b.parent_id_unitkerja = a.id_unitkerja
               INNER JOIN detailunits on detailunits.unitkerja_id = b.id_unitkerja
               LEFT JOIN karyawans on karyawans.id_karyawan = detailunits.karyawan_id
               INNER JOIN units on units.id_unit = detailunits.unit_id
               INNER JOIN products as c on c.id_product = units.product_id
               INNER JOIN products as d on c.parent_id_product = d.id_product")->getResultArray();
        return $data;
    }

    public function listInventarisMaintanance()
    {
        $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', lpad(detailunits.id_detailunit, 4, 0), '.', detailunits.tahun_perolehan) as kode,
        c.jenis_product,d.content_product as kategori,
        units.brand, units.nama_unit, units.satuan,
        detailunits.status_unit,detailunits.foto_unit,
        karyawans.nama,detailunits.id_detailunit
           FROM unitkerja as a
               INNER JOIN unitkerja as b on b.parent_id_unitkerja = a.id_unitkerja
               INNER JOIN detailunits on detailunits.unitkerja_id = b.id_unitkerja
               LEFT JOIN karyawans on karyawans.id_karyawan = detailunits.karyawan_id
               INNER JOIN units on units.id_unit = detailunits.unit_id
               INNER JOIN products as c on c.id_product = units.product_id
               INNER JOIN products as d on c.parent_id_product = d.id_product WHERE detailunits.foto_unit >0")->getResultArray();
        return $data;
    }

    public function unitDetail($id)
    {
        $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', lpad(detailunits.id_detailunit, 4, 0), '.', detailunits.tahun_perolehan) as kode,
        c.jenis_product,d.content_product as kategori,
        units.brand, units.nama_unit, units.satuan,
        detailunits.status_unit,detailunits.id_detailunit,
        karyawans.nama,karyawans.id_karyawan,detailunits.id_detailunit,suppliers.id_supplier,suppliers.supplier,detailunits.harga,detailunits.kondisi,b.unitkerja as ruangan,b.id_unitkerja as id_ruangan,detailunits.tahun_perolehan,detailunits.invoice,detailunits.nota_dinas
           FROM unitkerja as a
               INNER JOIN unitkerja as b on b.parent_id_unitkerja = a.id_unitkerja
               INNER JOIN detailunits on detailunits.unitkerja_id = b.id_unitkerja
               LEFT JOIN karyawans on karyawans.id_karyawan = detailunits.karyawan_id
               INNER JOIN units on units.id_unit = detailunits.unit_id
               INNER JOIN products as c on c.id_product = units.product_id
               INNER JOIN products as d on c.parent_id_product = d.id_product
               INNER JOIN suppliers on suppliers.id_supplier = detailunits.supplier_id
                WHERE detailunits.id_detailunit = $id")->getRowArray();
        return $data;
    }

    public function barcodeDetailunit($ruangan)
    {
        $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', lpad(detailunits.id_detailunit, 4, 0), '.', detailunits.tahun_perolehan) as kode,
            c.jenis_product,d.content_product as kategori,
            units.brand, units.nama_unit, units.satuan,
            detailunits.status_unit,detailunits.id_detailunit,
            karyawans.nama,karyawans.id_karyawan,detailunits.id_detailunit,suppliers.id_supplier,suppliers.supplier,detailunits.harga,detailunits.kondisi,b.unitkerja as ruangan,b.id_unitkerja as id_ruangan,detailunits.tahun_perolehan,detailunits.invoice,detailunits.nota_dinas
               FROM unitkerja as a
                   INNER JOIN unitkerja as b on b.parent_id_unitkerja = a.id_unitkerja
                   INNER JOIN detailunits on detailunits.unitkerja_id = b.id_unitkerja
                   LEFT JOIN karyawans on karyawans.id_karyawan = detailunits.karyawan_id
                   INNER JOIN units on units.id_unit = detailunits.unit_id
                   INNER JOIN products as c on c.id_product = units.product_id
                   INNER JOIN products as d on c.parent_id_product = d.id_product
                   INNER JOIN suppliers on suppliers.id_supplier = detailunits.supplier_id
                    WHERE detailunits.unitkerja_id = $ruangan ")->getResultArray();
        return $data;
    }

    public function listInventarisSelect2($searchTerm, $id)
    {
        if ($searchTerm == null) {
            $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', lpad(detailunits.id_detailunit, 4, 0), '.', detailunits.tahun_perolehan) as kode,
            c.jenis_product,d.content_product as kategori,
            units.brand, units.nama_unit, units.satuan,
            detailunits.status_unit,detailunits.id_detailunit,
            karyawans.nama,karyawans.id_karyawan,detailunits.id_detailunit,suppliers.id_supplier,suppliers.supplier,detailunits.harga,detailunits.kondisi,b.unitkerja as ruangan,b.id_unitkerja as id_ruangan,detailunits.tahun_perolehan,detailunits.invoice,detailunits.nota_dinas
               FROM unitkerja as a
                   INNER JOIN unitkerja as b on b.parent_id_unitkerja = a.id_unitkerja
                   INNER JOIN detailunits on detailunits.unitkerja_id = b.id_unitkerja
                   LEFT JOIN karyawans on karyawans.id_karyawan = detailunits.karyawan_id
                   INNER JOIN units on units.id_unit = detailunits.unit_id
                   INNER JOIN products as c on c.id_product = units.product_id
                   INNER JOIN products as d on c.parent_id_product = d.id_product
                   INNER JOIN suppliers on suppliers.id_supplier = detailunits.supplier_id
                    WHERE detailunits.unitkerja_id = $id AND detailunits.status_unit != 'Assign To Employee' AND units.jenis_unit = 'Tidak Habis Pakai' AND detailunits.deleted_at is null LIMIT 5")->getResultArray();
        } else {
            $data = $this->db->query("SELECT CONCAT(a.kode_unitkerja, ' ', b.kode_unitkerja, '.', d.kode_content_product, c.kode_content_product, '.', lpad(detailunits.id_detailunit, 4, 0), '.', detailunits.tahun_perolehan) as kode,
            c.jenis_product,d.content_product as kategori,
            units.brand, units.nama_unit, units.satuan,
            detailunits.status_unit,detailunits.id_detailunit,
            karyawans.nama,karyawans.id_karyawan,detailunits.id_detailunit,suppliers.id_supplier,suppliers.supplier,detailunits.harga,detailunits.kondisi,b.unitkerja as ruangan,b.id_unitkerja as id_ruangan,detailunits.tahun_perolehan,detailunits.invoice,detailunits.nota_dinas
               FROM unitkerja as a
                   INNER JOIN unitkerja as b on b.parent_id_unitkerja = a.id_unitkerja
                   INNER JOIN detailunits on detailunits.unitkerja_id = b.id_unitkerja
                   LEFT JOIN karyawans on karyawans.id_karyawan = detailunits.karyawan_id
                   INNER JOIN units on units.id_unit = detailunits.unit_id
                   INNER JOIN products as c on c.id_product = units.product_id
                   INNER JOIN products as d on c.parent_id_product = d.id_product
                   INNER JOIN suppliers on suppliers.id_supplier = detailunits.supplier_id
                    WHERE detailunits.unitkerja_id = $id AND detailunits.status_unit != 'Assign To Employee' AND units.jenis_unit = 'Tidak Habis Pakai' AND detailunits.deleted_at is null AND units.nama_unit like '%$searchTerm%'")->getResultArray();
        }



        return $data;
    }

    public function listLaporanInventaris()
    {
        $data = $this->db->query("SELECT units.*, SUM(detailunits.stok) as totalstok, SUM(detailunits.harga) as totalharga FROM detailunits
                                            INNER JOIN units on units.id_unit = detailunits.unit_id
                                                GROUP BY detailunits.unit_id")->getResultArray();
        return $data;
    }
}
