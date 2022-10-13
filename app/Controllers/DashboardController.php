<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Detailunit;
use App\Models\Logactivities;

class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->detailunit = new Detailunit();
        $this->logactivities = new Logactivities();
    }

    public function index()
    {
        return view('content');
    }

    public function listMaintananceAsetPriority()
    {
        $data = $this->detailunit->listInventarisMaintanance();

        return json_encode($data);
    }

    public function listAllActivity()
    {
        $data = $this->logactivities->findAll();
        return json_encode($data);
    }

    public function viewUnitkerja()
    {
        return view('Master/Company/unitkerjalist');
    }

    public function viewDepartemen()
    {
        return view('Master/Company/departemenlist');
    }

    public function tes()
    {
        return view('content');
    }
}
