<?php

namespace App\Controllers;

use App\Models\UsulanModel;

class DashboardCtrl extends BaseController
{

    protected $usulanModel;

    public function __construct()
    {
        $db = \db_connect();

        $this->usulanModel = new UsulanModel($db);
    }
    private function stsUsulan()
    {
        $data = array(
            '0' => '<span class="badge badge-info">Draft</span>',
            '1' => '<span class="badge badge-primary">Final</span>',
            '2' => '<span class="badge badge-success">Diusulkan</span>',
            '3' => '<span class="badge badge-primary">Verifikasi</span>',
            '30' => '<span class="badge badge-warning">Revisi</span>', //Revisi Usulan
            '31' => '<span class="badge badge-warning">Verifikasi Ulang</span>', //Verifikasi Ulang
            '4' => '<span class="badge badge-primary">Rekomendasi</span>', //Usulan Lulus
            '5' => '<span class="badge badge-success">Disetujui</span>',
            '6' => '<span class="badge badge-danger">Ditolak</span>',
        );
        return $data;
    }

    public function adminarea()
    {
        $data['title'] = 'Selamat Datang!';
        echo view('dashboard/adminarea', $data);
    }

    public function verifarea()
    {
        $thn = \session()->get('ses_tahun');
        $data['title'] = 'Selamat Datang!';
        $data['stsUsulan'] = $this->stsUsulan();
        $data['usulan'] = $this->usulanModel->tapdUsulanDashboard($thn);
        echo view('dashboard/verifarea', $data);
    }

    public function userarea()
    {
        $thn = \session()->get('ses_tahun');
        $idSkpd = \session()->get('ses_skpd');
        $data['title'] = 'Selamat Datang!';
        $data['stsUsulan'] = $this->stsUsulan();
        $data['usulan'] = $this->usulanModel->skpdUsulanDashboard($thn, $idSkpd);
        echo view('dashboard/userarea', $data);
    }
}
