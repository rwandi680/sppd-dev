<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AturModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use ErrorException;

class MenuCtrl extends BaseController
{
	protected $aturModel;

	public function __construct()
	{
		$db = \db_connect();
		$this->aturModel = new AturModel($db);
	}

	public function menu()
	{
		$data['title'] = 'Menu Setting';
		echo view('atur/menu', $data);
	}

	public function getMenuId()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data  = $this->aturModel->getMenuId($id);
		if (isset($data->id_menu)) {
			return \json_encode($data);
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function getMenu()
	{
		$data = $this->aturModel->getMenu();
		$ajax = [];
		$no = 1;
		foreach ($data as $t) {
			$id = $t->id_menu;

			if ($t->sub_menu == 'TRUE') {
				$toSub = '<a href="' . \site_url('atur/subMenu/' . \encrypt_url($id)) . '" class="btn btn-outline-primary">Sub Menu</a>';
			} else {
				$toSub = 'FALSE';
			}

			$opsi = '<div class="dropdown text-center">
                        <button type="button" class="btn btn-pill btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="mdi mdi-format-list-bulleted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item" id="btnEdit" data-id="' . \encrypt_url($id)  . '"><i class="mdi mdi-pencil"></i> Edit</a>
                      		<a href="#" class="dropdown-item" id="btnHapus" data-id="' . \encrypt_url($id) . '"><i class="mdi mdi-delete"></i> Hapus</a>
                        
                        </div>
                    </div>';
			$row = array(
				'no' => $no++,
				'menu' => $t->menu,
				'sub' => $toSub,
				'icon' => '<i class="' . $t->icon . '"></i> &nbsp; ' . $t->icon,
				'link' => $t->link,
				'order' => $t->menu_order,
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

	public function tambahMenu()
	{
		if ($_POST) {
			$params = array(
				'menu' => $this->request->getPost('menu'),
				'sub_menu' => $this->request->getPost('sub_menu'),
				'icon' => $this->request->getPost('icon'),
				'link' => $this->request->getPost('link'),
				'menu_order' => $this->request->getPost('order'),
				'ket' => $this->request->getPost('ket'),
			);
			$insert = $this->aturModel->addMenu($params);
			if ($insert) {
				return \json_encode($insert);
			} else {
				throw new ErrorException("Insert Gagal");
			}
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function editMenu()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data  = $this->aturModel->getMenuId($id);
		if (isset($data->id_menu)) {
			$params = array(
				'menu' => $this->request->getPost('x_menu'),
				'sub_menu' => $this->request->getPost('x_sub_menu'),
				'icon' => $this->request->getPost('x_icon'),
				'link' => $this->request->getPost('x_link'),
				'menu_order' => $this->request->getPost('x_order'),
				'ket' => $this->request->getPost('x_ket'),
			);
			$update = $this->aturModel->updateMenu($id, $params);
			if ($update) {
				return \json_encode($update);
			} else {
				throw new ErrorException("Update Gagal");
			}
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function hapusMenu()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data  = $this->aturModel->getMenuId($id);
		if (isset($data->id_menu)) {
			$remove =  $this->aturModel->deleteMenu($id);
			if ($remove) {
				return \json_encode($remove);
			} else {
				throw new ErrorException("remove Gagal");
			}
		} else {
			throw new PageNotFoundException("Halaman tidak ditemukan");
		}
	}

	public function subMenu($idMenu)
	{
		$idMenu = \decrypt_url($idMenu);
		$data['menu'] = $this->aturModel->getMenuId($idMenu);
		if (isset($data['menu']->id_menu)) {
			$data['title'] = 'Sub Menu';
			echo \view('atur/sub_menu', $data);
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function getSubMenuId()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data  = $this->aturModel->getSubMenuId($id);
		if (isset($data->id_sub_menu)) {
			return \json_encode($data);
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function getSubMenu($idMenu)
	{
		$data = $this->aturModel->getSubMenu($idMenu);
		$ajax = [];
		$no = 1;
		foreach ($data as $t) {
			$id = $t->id_sub_menu;
			$opsi = '<div class="dropdown text-center">
                        <button type="button" class="btn btn-outline-primary btn-pill btn-sm" data-toggle="dropdown">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item" id="btnEdit" data-id="' . \encrypt_url($id)  . '"><i class="mdi mdi-pencil"></i> Edit</a>
							<a href="#" class="dropdown-item" id="btnHapus" data-id="' . \encrypt_url($id) . '"><i class="mdi mdi-delete"></i> Hapus</a>
                        </div>
                    </div>';
			$row = array(
				'no' => $no++,
				'menu' => $t->menu,
				'sub' => $t->sub_menu,
				'link' => $t->link,
				'order' => $t->sub_order,
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

	public function tambahSubMenu()
	{
		if ($_POST) {
			$params = array(
				'id_menu' => $this->request->getPost('menu'),
				'sub_menu' => $this->request->getPost('sub_menu'),
				'link' => $this->request->getPost('link'),
				'sub_order' => $this->request->getPost('order'),
				'ket' => $this->request->getPost('ket'),
			);
			$insert = $this->aturModel->addSubMenu($params);
			if ($insert) {
				return \json_encode($insert);
			} else {
				throw new ErrorException("Insert Gagal");
			}
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function editSubMenu()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data  = $this->aturModel->getMenuId($id);
		if (isset($data->id_menu)) {
			$params = array(
				'menu' => $this->request->getPost('x_menu'),
				'sub_menu' => $this->request->getPost('x_sub_menu'),
				'icon' => $this->request->getPost('x_icon'),
				'link' => $this->request->getPost('x_link'),
				'menu_order' => $this->request->getPost('x_order'),
				'ket' => $this->request->getPost('x_ket'),
			);
			$update = $this->aturModel->updateMenu($id, $params);
			if ($update) {
				return \json_encode($update);
			} else {
				throw new ErrorException("Update Gagal");
			}
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function hapusSubMenu()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data  = $this->aturModel->getMenuId($id);
		if (isset($data->id_menu)) {
			$remove =  $this->aturModel->deleteMenu($id);
			if ($remove) {
				return \json_encode($remove);
			} else {
				throw new ErrorException("remove Gagal");
			}
		} else {
			throw new PageNotFoundException("Halaman tidak ditemukan");
		}
	}

	public function menuAkses()
	{
		$data['title'] = 'Menu Akses';
		$data['role'] = $this->aturModel->getRole();
		echo \view('atur/menu_akses', $data);
	}

	public function getMenuAkses($idRole)
	{
		$data = $this->aturModel->getMenuAkses($idRole);
		$ajax = [];
		$no = 1;
		foreach ($data as $t) {
			$hapus = '';
			$row = array(
				'no' => $no++,
				'menu' => $t->menu,
				'sub' => $t->sub_menu,
				'link' => $t->link,
				'ket' => $t->ket,
				'opsi' => '',
			);
			$ajax[] = $row;
		}
		$output = array(
			'data' => $ajax,
		);
		return json_encode($output);
	}
}
