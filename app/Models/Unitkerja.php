<?php

namespace App\Models;

use CodeIgniter\Model;

class Unitkerja extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'unitkerja';
    protected $primaryKey       = 'id_unitkerja';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_unitkerja', 'parent_id_unitkerja', 'kode_unitkerja',
        'unitkerja', 'depth_unitkerja', 'status_unitkerja'
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
    protected $beforeUpdate   = ['callBeforeUpdate'];
    protected $afterUpdate    = ['callAfterUpdate'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];



    protected function callBeforeUpdate($id)
    {
        $data = $this->unitkerja->where('id_unitkerja', $id)->findAll();
        return $data;
    }

    protected function callAfterUpdate(array $data)
    {
        $oldData = $this->unitkerja->callBeforeUpdate($data['id'][0]);

        $data = array(
            'table_names' => 'unitkerja',
            'table_id' => $data['id'][0],
            'description' => "update data unitkerja {$data['data']['unitkerja']} dengan id : {$data['id']}",
            'before' => '',
            'after' => $data['id'],
            'created_by' => user()->username,
        );
        $this->logActivities->save($data);
    }

    public function listRuangan()
    {
        $data = $this->db->query("SELECT a.*,b.unitkerja as unit_kerja
                                        FROM unitkerja as a
                                            INNER JOIN unitkerja as b on b.id_unitkerja = a.parent_id_unitkerja
                                                WHERE a.parent_id_unitkerja is not null AND a.deleted_at is null")->getResultArray();
        return $data;
    }

    public function listkaryawaninUnitkerja($id_unitkerja)
    {
        $data = $this->db->query("SELECT unitkerja.*,karyawans.nrp,karyawans.nama,karyawans.is_pic,users.email,departements.content 
                                        FROM unitkerja 
                                            INNER JOIN unitkerja as a on unitkerja.parent_id_unitkerja = a.id_unitkerja 
                                            INNER JOIN departements on departements.lokasi_id = unitkerja.id_unitkerja 
                                            INNER JOIN karyawans on karyawans.jabatan_id = departements.id 
                                            INNER JOIN users on users.karyawan_id = karyawans.id_karyawan 
                                                    WHERE a.id_unitkerja = $id_unitkerja")->getResultArray();

        return $data;
    }
    public function listkaryawaninRuangan($id_unitkerja)
    {
        $data = $this->db->query("SELECT unitkerja.*,karyawans.nrp,karyawans.nama,karyawans.is_pic,users.email,departements.content 
                                        FROM unitkerja 
                                            INNER JOIN unitkerja as a on unitkerja.parent_id_unitkerja = a.id_unitkerja 
                                            INNER JOIN departements on departements.lokasi_id = unitkerja.id_unitkerja 
                                            INNER JOIN karyawans on karyawans.jabatan_id = departements.id 
                                            INNER JOIN users on users.karyawan_id = karyawans.id_karyawan 
                                                    WHERE unitkerja.id_unitkerja = $id_unitkerja")->getResultArray();

        return $data;
    }

    public function listAsetInunitkerja($id_unitkerja)
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
                                                    WHERE a.id_unitkerja = $id_unitkerja ")->getResultArray();
        return $data;
    }

    public function listAsetInruangan($id_unitkerja)
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
                                                    WHERE b.id_unitkerja = $id_unitkerja ")->getResultArray();
        return $data;
    }

    public function listUnitkerjabySelect2($searchTerm)
    {
        if ($searchTerm == null) {
            $query = $this->db->query("SELECT *
                                                FROM unitkerja
                                                        WHERE unitkerja.parent_id_unitkerja is null AND unitkerja.deleted_at is null LIMIT 5");
            $log = $query->getResultArray();
        } else {
            $query1 = $this->db->query("SELECT *
                                            FROM unitkerja
                                                WHERE unitkerja.unitkerja like '%$searchTerm%' AND unitkerja.parent_id_unitkerja is null AND unitkerja.deleted_at is null");
            $log = $query1->getResultArray();
        }
        return $log;
    }
}
