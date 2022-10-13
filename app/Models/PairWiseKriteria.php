<?php

namespace App\Models;

use CodeIgniter\Model;

class PairWiseKriteria extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'pairwisekriteria';
    protected $primaryKey       = 'id_pairwise';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pairwise', 'fuzzy_id', 'kriteria_kolom', 'kriteria_baris', 'value', 'deskripsi'
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
}


// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0001','C0001',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0001','C0002',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0001','C0003',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0001','C0004',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0002','C0001',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0002','C0002',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0002','C0003',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0002','C0004',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0003','C0001',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0003','C0002',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0003','C0003',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0003','C0004',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0004','C0001',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0004','C0002',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0004','C0003',1,'');
// INSERT INTO `pairwisekriteria`(`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`) VALUES ('','0','C0004','C0004',1,'');