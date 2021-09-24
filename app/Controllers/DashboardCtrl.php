<?php

namespace App\Controllers;

class DashboardCtrl extends BaseController
{

     public function adminarea()
    {
        $data['title'] = 'Selamat Datang!';
        echo view('dashboard/adminarea', $data);
    }

    public function verifarea()
    {
        $data['title'] = 'Selamat Datang!';
        echo view('dashboard/verifarea', $data);
    }

    public function userarea()
    {
        $data['title'] = 'Selamat Datang!';
        echo view('dashboard/userarea', $data);
    }
}
