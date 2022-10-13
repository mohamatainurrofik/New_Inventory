<?php

namespace App\Models;

use CodeIgniter\Model;

class Logactivities extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'logactivities';
    protected $primaryKey       = 'id_log';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'table_names', 'table_id', 'description',
        'before', 'after', 'created_by'
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

    public function createLog($table_id, $table_name, $user, $data)
    {
        $saveData = array(
            'table_names' => $table_name,
            'table_id' => $table_id,
            'description' => "update data ",
            'before' => $data['before'],
            'after' => $data['after'],
            'created_by' => $user,
        );
        $this->db->table('logactivities')->insert($saveData);
    }
    public function createLogOrder($table_id, $table_name, $user, $data, $deskripsi)
    {
        $saveData = array(
            'table_names' => $table_name,
            'table_id' => $table_id,
            'description' => $deskripsi,
            'before' => $data['before'],
            'after' => $data['after'],
            'created_by' => $user,
        );
        $this->db->table('logactivities')->insert($saveData);
    }
}
