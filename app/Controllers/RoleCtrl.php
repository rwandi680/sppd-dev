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
		$no = 1;
		foreach ($data as $t) {
			$id = $t->id_role;
			$opsi = '<div class="dropdown text-center">
                        <button class="btn btn-pill btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="mdi mdi-view-list"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item" id="btnEdit" data-id="' . \encrypt_url($id)  . '"><i class="mdi mdi-pencil"></i> Edit</a>
                            <a href="#" class="dropdown-item" id="btnHapus" data-id="' . \encrypt_url($id) . '"><i class="mdi mdi-delete"></i> Hapus</a>
                        </div>
                    </div>';
			$row = array(
				'id' => $id,
				'role' => $t->role,
				'ket' => $t->ket,
				'opsi' => $opsi,
			);
			$ajax[] = $row;
		}
		$output = array(
			'data' => $ajax,
		);
		return json_encode($output);
	}

	public function tambahRole()
	{
		if ($_POST) {
			$params = array(
				'role' => $this->request->getPost('role'),
				'ket' => $this->request->getPost('ket'),

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

	public function editRole()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data  = $this->aturModel->getRoleId($id);
		if (isset($data->id_role)) {
			$params = array(
				'role' => $this->request->getPost('x_role'),
				'ket' => $this->request->getPost('x_ket'),
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

	public function hapusRole()
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
