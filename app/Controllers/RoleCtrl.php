<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AturModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use ErrorException;

class RoleCtrl extends BaseController
{
	protected $aturModel;

	public function __construct()
	{
		$db = \db_connect();
		$this->aturModel = new AturModel($db);
	}

	public function role()
	{
		$data['title'] = 'Role Setting';
		echo view('atur/role', $data);
	}

	public function getRoleId()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data = $this->aturModel->getRoleId($id);
		if (isset($data->id_role)) {
			return \json_encode($data);
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function getRole()
	{
		$data = $this->aturModel->getRole();
		$ajax = [];
		foreach ($data as $t) {
			$id = $t->id_role;
			$opsi = '<div class="dropdown text-center">
                        <button class="btn btn-sm btn-pill btn-outline-primary" data-toggle="dropdown">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item" id="btnEdit" data-id="' . \encrypt_url($id)  . '"><i class="mdi mdi-pencil"></i> Edit</a>
                            <a href="#" class="dropdown-item" id="btnHapus" data-id="' . \encrypt_url($id) . '"><i class="mdi mdi-delete"></i> Hapus</a>
                        </div>
                    </div>';
			$row = array(
				'id' => $id,
				'role' => $t->nama_role,
				'ket' => $t->ket_role,
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
			$params = array(
				'nama_role' => $this->request->getPost('role'),
				'ket_role' => $this->request->getPost('ket'),
			);
			$insert = $this->aturModel->addRole($params);
			if ($insert) {
				return \json_encode($insert);
			} else {
				throw new ErrorException("Insert Gagal", 1);
			}
		} else {
			throw new PageNotFoundException("Halaman tidak ditemukan");
		}
	}

	public function edit()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data  = $this->aturModel->getRoleId($id);
		if (isset($data->id_role)) {
			$params = array(
				'nama_role' => $this->request->getPost('x_role'),
				'ket_role' => $this->request->getPost('x_ket'),
			);
			$update = $this->aturModel->updateRole($id, $params);
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
		$data  = $this->aturModel->getRoleId($id);
		if (isset($data->id_role)) {
			$remove =  $this->aturModel->deleteRole($id);
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
