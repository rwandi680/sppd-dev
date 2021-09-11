<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReferensiModel;

class RefCtrl extends BaseController
{

    protected $refModel;

    public function __construct()
    {
        $db = \db_connect();
        $this->refModel = new ReferensiModel($db);
    }

    public function urusan()
    {
        $data['title'] = 'Urusan';
        echo \view('referensi/urusan', $data);
    }

    public function getUrusan()
    {
        $data = $this->refModel->getUrusan();
        $ajax = [];
        foreach ($data as $t) {
            $row = array(
                'kode' => $t->kode_urusan,
                'urusan' => $t->nama_urusan
            );
            $ajax[] = $row;
        }
        $output = array(
            'data' => $ajax,
        );
        return json_encode($output);
    }

    public function bidang()
    {
        $data['title'] = 'Bidang Urusan';
        echo view('referensi/bidang', $data);
    }

    public function getBidang()
    {
        $data = $this->refModel->getBidang();
        $ajax = [];
        foreach ($data as $t) {
            $row = array(
                'urusan' => $t->nama_urusan,
                'kode_bidang' => $t->kode_bidang_urusan,
                'nama_bidang' => $t->nama_bidang_urusan
            );
            $ajax[] = $row;
        }
        $output = array(
            'data' => $ajax,
        );
        return json_encode($output);
    }

    public function program()
    {
        $data['title'] = 'Program';
        echo view('referensi/program', $data);
    }

    public function getProgram()
    {
        $data = $this->refModel->getProgram();
        $ajax = [];
        foreach ($data as $t) {
            $row = array(
                'urusan' => $t->nama_urusan,
                'nama_bidang' => $t->nama_bidang_urusan,
                'nama_program' => $t->nama_program,
            );
            $ajax[] = $row;
        }
        $output = array(
            'data' => $ajax,
        );
        return json_encode($output);
    }

    public function kegiatan()
    {
        $data['title'] = 'Kegiatan';
        echo view('referensi/kegiatan', $data);
    }

    public function getKegiatan()
    {
        $data = $this->refModel->getKegiatan();
        $ajax = [];
        foreach ($data as $t) {
            $row = array(
                'urusan' => $t->nama_urusan,
                'nama_bidang' => $t->nama_bidang_urusan,
                'nama_program' => $t->nama_program,
                'nama_kegiatan' => $t->nama_kegiatan,
            );
            $ajax[] = $row;
        }
        $output = array(
            'data' => $ajax,
        );
        return json_encode($output);
    }

    public function subKegiatan()
    {
        $data['title'] = 'Sub Kegiatan';
        echo view('referensi/sub_kegiatan', $data);
    }

    public function getSubKegiatan()
    {
        $data = $this->refModel->getSubKegiatan();
        $ajax = [];
        foreach ($data as $t) {
            $row = array(
                'urusan' => $t->nama_urusan,
                'nama_bidang' => $t->nama_bidang_urusan,
                'nama_program' => $t->nama_program,
                'nama_kegiatan' => $t->nama_kegiatan,
                'nama_sub_kegiatan' => $t->nama_sub_kegiatan,
            );
            $ajax[] = $row;
        }
        $output = array(
            'data' => $ajax,
        );
        return json_encode($output);
    }

    public function akun()
    {
        $data['title'] = 'Akun';
        echo view('referensi/akun', $data);
    }

    public function getAkun()
    {
        $data = $this->refModel->getAkun();
        $ajax = [];
        foreach ($data as $t) {
            $row = array(
                'kode_akun' => $t->kode_akun,
                'nama_akun' => $t->nama_akun,
            );
            $ajax[] = $row;
        }
        $output = array(
            'data' => $ajax,
        );
        return json_encode($output);
    }

    public function getRefAkunBl($idJenisBl)
    {
        $data['jenisbl'] = $this->refModel->getJenisBlId($idJenisBl);
        if (isset($data['jenisbl']->id_ref_jenis_belanja)) {
            $isRefAkun = $data['jenisbl']->is_ref_akun;
        } else {
            $isRefAkun = \false;
        }
        $data['akun'] = $this->refModel->getRefAkunBl($isRefAkun);
        if ($data['akun'] != null) {
            $ajax = [];
            foreach ($data['akun'] as $t) {
                $row = array(
                    'id' => $t->id_ref_akun,
                    'text' => $t->kode_akun . ' ' . $t->nama_akun,
                );
                $ajax[] = $row;
            }
            $output = array(
                'data' => $ajax,
            );
            return json_encode($output);
        } else {
            return \null;
        }
    }

    public function komponen($jenis)
    {
        # code...
    }

    public function satuan()
    {
        $data['title'] = 'Satuan';
        echo view('referensi/satuan', $data);
    }

    public function getSatuanId()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->refModel->getSatuanId($id);
        if (isset($data->id_satuan)) {
            return \json_encode($data);
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    public function getSatuan()
    {
        $data = $this->refModel->getSatuan();
        $ajax = [];
        $no = 1;
        foreach ($data as $t) {

            $id = $t->id_satuan;
            $opsi = '<div class="dropdown text-right">
                        <button type="button" class="btn btn-outline-primary btn-circle btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa=list"></i>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="#" id="btnEdit" data-id="' . \encrypt_url($id)  . '"><i class="material-icons">edit</i>Edit</a>
                            </li>
                            <li>
                                <a href="#" id="btnHapus" data-id="' . \encrypt_url($id) . '"><i class="material-icons">delete</i>Hapus</a>
                            </li>
                        </ul>
                    </div>';
            $row = array(
                'no' => $no++,
                'satuan' => $t->satuan,
                'opsi' => $opsi,
            );
            $ajax[] = $row;
        }
        $output = array(
            'data' => $ajax,
        );
        return json_encode($output);
    }

    public function tambahSatuan()
    {
        if ($_POST) {
            $params = array(
                'satuan' => $this->request->getPost('satuan'),
            );
            $insert = $this->refModel->addSatuan($params);
            if ($insert) {
                return \json_encode($insert);
            } else {
                throw new ErrorException('Insert Gagal');
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan.');
        }
    }

    public function editSatuan()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->refModel->getSatuanId($id);
        if (isset($data->id_satuan)) {
            $params = array(
                'satuan' => $this->request->getPost('x_satuan'),
            );
            $update = $this->refModel->updateSatuan($id, $params);
            if ($update) {
                return \json_encode($update);
            } else {
                throw new ErrorException('Update Gagal');
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan.');
        }
    }

    public function hapusSatuan()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->refModel->getSatuanId($id);
        if (isset($data->id_satuan)) {
            $remove = $this->refModel->deleteSatuan($id);
            if ($remove) {
                return \json_encode($remove);
            } else {
                throw new ErrorException('Remove Gagal');
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan.');
        }
    }

    // jenis Belanja
    public function jenisBl()
    {
        $data['title'] = 'Jenis Belanja';
        echo view('referensi/jenisbl', $data);
    }

    public function getJenisBlId()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->refModel->getJenisBlId($id);
        if (isset($data->id_ref_jenis_belanja)) {
            return \json_encode($data);
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    public function getJenisBl()
    {
        $data = $this->refModel->getJenisBl();
        $ajax = [];
        $no = 1;
        foreach ($data as $t) {
            $id = $t->id_ref_jenis_belanja;
            $opsi = '<div class="dropdown text-right">
                        <button type="button" class="btn btn-outline-primary btn-circle btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-list"></i>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="#" id="btnEdit" data-id="' . \encrypt_url($id)  . '"><i class="material-icons">edit</i>Edit</a>
                            </li>
                            <li>
                                <a href="#" id="btnHapus" data-id="' . \encrypt_url($id) . '"><i class="material-icons">delete</i>Hapus</a>
                            </li>
                        </ul>
                    </div>';
            $row = array(
                'no' => $no++,
                'jenis' => $t->jenis_belanja,
                'objek' => $t->objek_belanja,
                'refakun' => $t->is_ref_akun,
                'opsi' => $opsi,
            );
            $ajax[] = $row;
        }
        $output = array(
            'data' => $ajax,
        );
        return json_encode($output);
    }

    public function tambahJenisBl()
    {
        if ($_POST) {
            $params = array(
                'jenis_belanja' => $this->request->getPost('jenis'),
                'objek_belanja' => $this->request->getPost('objek'),
                'is_ref_akun' => $this->request->getPost('is_ref'),
            );
            $insert = $this->refModel->addJenisBl($params);
            if ($insert) {
                return \json_encode($insert);
            } else {
                throw new ErrorException('Insert Gagal');
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan.');
        }
    }

    public function editJenisBl()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->refModel->getJenisBlId($id);
        if (isset($data->id_ref_jenis_belanja)) {
            $params = array(
                'jenis_belanja' => $this->request->getPost('x_jenis'),
                'objek_belanja' => $this->request->getPost('x_objek'),
                'is_ref_akun' => $this->request->getPost('x_is_ref'),
            );
            $update = $this->refModel->updateJenisBl($id, $params);
            if ($update) {
                return \json_encode($update);
            } else {
                throw new ErrorException('Update Gagal');
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan.');
        }
    }

    public function hapusJenisBl()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->refModel->getJenisBlId($id);
        if (isset($data->id_ref_jenis_belanja)) {
            $remove = $this->refModel->deleteJenisBl($id);
            if ($remove) {
                return \json_encode($remove);
            } else {
                throw new ErrorException('Remove Gagal');
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan.');
        }
    }
}
