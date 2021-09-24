<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class AturModel extends Model
{
	protected $db;
	protected $tahun;
	protected $role;
	protected $menu;
	protected $submenu;
	protected $menuakses;
	protected $user;

	public function __construct(ConnectionInterface &$db)
	{
		$this->db = &$db;
		$this->tahun = $this->db->table('tbl_tahun');
		$this->role = $this->db->table('tbl_role');
		$this->menu = $this->db->table('tbl_menu');
		$this->submenu = $this->db->table('tbl_sub_menu');
		$this->menuakses = $this->db->table('tbl_menu_akses');
		$this->user = $this->db->table('tbl_user');
	}

	// Tahun
	public function getTahunId($thn)
	{
		return $this->tahun->where('tahun', $thn)->get()->getRow();
	}

	public function getTahun()
	{
		return $this->tahun->get()->getResult();
	}

	public function addTahun($params)
	{
		return $this->tahun->insert($params);
	}

	public function updateTahun($thn, $params)
	{
		$this->tahun->where('tahun', $thn);
		return $this->tahun->update($params);
	}

	public function deleteTahun($thn)
	{
		$this->tahun->where('tahun', $thn);
		return $this->tahun->delete();
	}



	//tahapan
	public function getTahapId($id)
	{
		return $this->tahap->where('id_tahapan', $id)->get()->getRow();
	}

	public function getTahap($thn)
	{
		$this->tahap->where('tahun', $thn);
		return $this->tahap->get()->getResult();
	}

	public function getTahapUsulan($thn)
	{
		$this->tahap->where('tahun', $thn)
			->where('sts_tahap', 1)
			->orderBy('id_tahapan', 'DESC');
		return $this->tahap->get()->getResult();
	}

	public function addTahap($params)
	{
		return $this->tahap->insert($params);
	}

	public function updateTahap($id, $params)
	{
		$this->tahap->where('id_tahapan', $id);
		return $this->tahap->update($params);
	}

	public function deleteTahap($id)
	{
		$this->tahap->where('id_tahapan', $id);
		return $this->tahap->delete();
	}

	//Menu
	public function getMenuId($id)
	{
		return $this->menu->where('id_menu', $id)->get()->getRow();
	}

	public function getMenu()
	{
		return $this->menu->get()->getResult();
	}

	public function addMenu($params)
	{
		return $this->menu->insert($params);
	}

	public function updateMenu($id, $params)
	{
		$this->menu->where('id_menu', $id);
		return $this->menu->update($params);
	}

	public function deleteMenu($id)
	{
		$this->menu->where('id_menu', $id);
		return $this->menu->delete();
	}

	//sub Menu
	public function getSubMenuId($id)
	{
		return $this->submenu->where('id_sub_menu', $id)->get()->getRow();
	}

	public function getSubMenu($id)
	{
		$this->submenu->select([
			'tbl_sub_menu.id_sub_menu',
			'tbl_menu.menu',
			'tbl_sub_menu.sub_menu',
			'tbl_sub_menu.link',
			'tbl_sub_menu.sub_order',
			'tbl_sub_menu.ket',
		])
			->join('tbl_menu', 'tbl_menu.id_menu = tbl_sub_menu.id_menu')
			->where('tbl_sub_menu.id_menu', $id);
		return $this->submenu->get()->getResult();
	}

	public function addSubMenu($params)
	{
		return $this->submenu->insert($params);
	}

	public function updateSubMenu($id, $params)
	{
		$this->submenu->where('id_menu', $id);
		return $this->submenu->update($params);
	}

	public function deleteSubMenu($id)
	{
		$this->submenu->where('id_menu', $id);
		return $this->submenu->delete();
	}

	public function getMenuAkses($idRole)
	{
		$this->menuakses->select([
			'tbl_menu.menu',
			'tbl_sub_menu.sub_menu',
			'tbl_sub_menu.link',
			'tbl_sub_menu.ket',
		])
			->join('tbl_menu', 'tbl_menu.id_menu = tbl_menu_akses.id_menu', 'left')
			->join('tbl_sub_menu', 'tbl_sub_menu.id_sub_menu = tbl_menu_akses.id_sub_menu', 'left')
			->where('tbl_menu_akses.id_role', $idRole);
		return $this->menuakses->get()->getResult();
	}


}
