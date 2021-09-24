<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AturModel;
use App\Models\UnitModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use ErrorException;

class UserCtrl extends BaseController
{

    protected $aturModel;
    protected $unitModel;

    public function __construct()
    {
        $db = \db_connect();
        $this->aturModel = new AturModel($db);
        $this->unitModel = new UnitModel($db);
    }

    public function user()
    {
        $data['title'] = 'User Setting';
        $data['skpd'] = $this->unitModel->getUnit();
        $data['role'] = $this->aturModel->getRole();
        echo view('atur/user', $data);
    }

    public function getUserId()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->aturModel->getUserId($id);
        if (isset($data->id_user)) {
            return \json_encode($data);
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    public function getUser()
    {
        $data = $this->aturModel->getUser();
        $ajax = [];
        $no = 1;
        foreach ($data as $t) {
            $id = $t->id_user;
            $opsi = '<div class="dropdown text-center">
                        <a href="#" class="btn btn-outline-primary btn-pill dropdown-toggle" data-toggle="dropdown">
                            <i class="mdi mdi-view-list"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item" id="btnEdit" data-id="' . \encrypt_url($id)  . '">
                                <i class="mdi mdi-pencil"></i> Edit
                            </a>
                            <a href="#" class="dropdown-item" id="btnReset" data-id="' . \encrypt_url($id)  . '">
                                <i class="mdi mdi-reset"></i> Reset Password
                            </a>
                                <a href="#" class="dropdown-item" id="btnHapus" data-id="' . \encrypt_url($id) . '">
                                <i class="mdi mdi-delete"></i> Hapus</a>
                        </div>
                    </div>';
            $row = array(
                'no' => $no++,
                'nama' => $t->nama_lengkap,
                'username' => $t->xusername,
                'role' => $t->role,
                'skpd' => $t->nama_skpd,
                'opsi' => $opsi,
            );
            $ajax[] = $row;
        }
        $output = array(
            'data' => $ajax,
        );
        return json_encode($output);
    }

    public function tambah()
    {
        if ($_POST) {
            $defautlPass = "pangandarankab";
            $skpd = $this->request->getPost('skpd');
            if (empty($skpd) || $skpd == \null) {
                $id_skpd = \null;
            } else {
                $id_skpd = $skpd;
            }
            $params = array(
                'nama_lengkap' => $this->request->getPost('nama'),
                'xusername' => $this->request->getPost('user'),
                'xpassword' => \password_hash($defautlPass, \PASSWORD_BCRYPT),
                'id_role' => $this->request->getPost('role'),
                'id_skpd' => $id_skpd,
            );
            $insert = $this->aturModel->addUser($params);
            if ($insert) {
                return \json_encode($insert);
            } else {
                throw new ErrorException("Insert Gagal");
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    public function edit()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->aturModel->getUserId($id);
        if (isset($data->id_user)) {
            $params = array(
                'nama_lengkap' => $this->request->getPost('x_nama'),
                'xusername' => $this->request->getPost('x_user'),
                'id_role' => $this->request->getPost('x_role'),
                'id_skpd' => $this->request->getPost('x_skpd'),
            );
            $update = $this->aturModel->updateUser($id, $params);
            if ($update) {
                return \json_encode($update);
            } else {
                throw new ErrorException("Update Gagal");
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    public function resetPassword()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->aturModel->getUserId($id);
        if (isset($data->id_user)) {
            $defautlPass = "pangandarankab";
            $params = array(
                'xpassword' => \password_hash($defautlPass, \PASSWORD_BCRYPT),
            );
            $update = $this->aturModel->updateUser($id, $params);
            if ($update) {
                return \json_encode($update);
            } else {
                throw new ErrorException("Update Gagal");
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    public function hapus()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->aturModel->getUserId($id);
        if (isset($data->id_user)) {
            $remove =  $this->aturModel->deleteUser($id);
            if ($remove) {
                return \json_encode($remove);
            } else {
                throw new ErrorException("remove Gagal");
            }
        } else {
            throw new PageNotFoundException("Halaman tidak ditemukan");
        }
    }
}
