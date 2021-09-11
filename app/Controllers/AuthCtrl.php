<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use ErrorException;

class AuthCtrl extends BaseController
{
    protected $authModel;

    public function __construct()
    {
        $db = \db_connect();
        $this->authModel = new AuthModel($db);
    }

    public function index()
    {
        $data['title'] = "Login";
        $data['tahun'] = $this->authModel->getTahun();
        return view('auth/login', $data);
    }

    private function addLoginLog($idUser)
    {
        $agent = $this->request->getUserAgent();
        $browser = $agent->getBrowser();
        $browserVersion = $agent->getVersion();
        $platform = $agent->getPlatform();
        $ipAddress = $this->request->getIPAddress();

        $logParams = array(
            'id_user' => $idUser,
            'tipe_log' => 1,
            'ip_address' => $ipAddress,
            'browser' => $browser . ' ' . $browserVersion,
            'platform' => $platform
        );
        return $this->authModel->addLog($logParams);
    }

    private function addLogoutLog($idUser)
    {
        $agent = $this->request->getUserAgent();
        $browser = $agent->getBrowser();
        $browserVersion = $agent->getVersion();
        $platform = $agent->getPlatform();
        $ipAddress = $this->request->getIPAddress();

        $logParams = array(
            'id_user' => $idUser,
            'tipe_log' => 2,
            'ip_address' => $ipAddress,
            'browser' => $browser . ' ' . $browserVersion,
            'platform' => $platform
        );
        return $this->authModel->addLog($logParams);
    }

    public function login()
    {
        if ($_POST) {
            $session = session();
            $user = $this->request->getPost('xuser');
            $pass = $this->request->getPost('xpass');
            $data = $this->authModel->getUsername($user);
            if (isset($data->xusername)) {
                if (password_verify($pass, $data->xpassword)) {
                    $thn = $this->request->getPost('xthn');;
                    $sesParams = array(
                        'ses_login' => true,
                        '  ' => $data->id_user,
                        'ses_role' => $data->id_role,
                        'ses_user' => $data->xusername,
                        'ses_nama' => $data->nama_lengkap,
                        'ses_tahun' => $thn,
                    );
                    $session->set($sesParams);
                    $insertLog = $this->addLoginLog($data->id_user);
                    if ($insertLog) {
                        if ($data->id_role == 1) {
                            $url = site_url('adminarea');
                        } elseif ($data->id_role == 2) {
                            $url = site_url('verifarea');
                        } elseif ($data->id_role == 3) {
                            $url = site_url('userarea');
                            $session->set('ses_skpd', $data->id_skpd);
                        } else {
                            throw new ErrorException("Error Processing Request", 1);
                        }
                        return \redirect()->to($url);
                    } else {
                        throw new ErrorException("Error Processing Request", 1);
                    }
                } else {
                    $session->setFlashdata('error', 'Username atau Password salah');
                    return redirect()->to(site_url());
                }
            } else {
                $session->setFlashdata('error', 'Username atau Password salah!');
                return redirect()->to(\site_url());
            }
        } else {
            return \redirect()->to(\site_url());
        }
    }

    public function logout()
    {
        $session = session();
        $idUser = $session->get('ses_id');
        $insertLog = $this->addLogoutLog($idUser);
        if ($insertLog) {
            $session->destroy();
            return redirect()->to(\site_url());
        } else {
            throw new ErrorException("Error Processing Request", 1);
        }
    }

    public function gantiTahun()
    {
        if ($_POST) {
            $thn = $this->request->getGetPost('xtahun');
            $sesParams = array(
                'ses_tahun' => $thn,
            );
            session()->set($sesParams);
        } else {
            throw new PageNotFoundException("Halaman tidak ditemukan");
        }
    }

    public function cobaxml()
    {
        $data = simplexml_load_file('public/uploads/data.xml');
        // \print_r($data);
        return \json_encode($data);
    }
}
