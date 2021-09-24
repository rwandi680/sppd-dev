<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AturModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use ErrorException;

class DashboardCtrl extends BaseController
{
    protected $aturModel;

    public function __construct()
    {
        $db = \db_connect();
        $this->aturModel = new AturModel($db);
    }

    public function adminarea()
    {
        $data['title'] = 'Selamat Datang!';
        echo view('dashboard/adminarea', $data);
    }
}
