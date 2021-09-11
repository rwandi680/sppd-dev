<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnitModel;
use App\Models\ReferensiModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use ErrorException;

class UnitCtrl extends BaseController
{
	protected $unitModel;
	protected $refModel;

	public function __construct()
	{
		$db = \db_connect();
		$this->unitModel = new UnitModel($db);
		$this->refModel = new ReferensiModel($db);
	}

	public function unit()
	{
		$data['title'] = 'Perangkat Daerah';
		$data['bidang'] = $this->refModel->getBidang();
		echo view('unit/skpd', $data);
	}

	public function getUnitId()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data = $this->unitModel->getUnitId($id);
		if (isset($data->id_skpd)) {
			return \json_encode($data);
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function getUnit()
	{
		$data = $this->unitModel->getUnit();
		$ajax = [];
		$tipe = array(
			'1' => 'Unit',
			'0' => 'Sub Unit',
		);
		foreach ($data as $t) {
			$id = $t->id_skpd;
			$opsi = '<div class="dropdown text-center">
                        <a href="#" class="btn btn-outline-primary btn-pill dropdown-toggle" data-toggle="dropdown">
                            <i class="mdi mdi-view-list"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item" id="btnEdit" data-id="' . \encrypt_url($id)  . '"><i class="mdi mdi-pencil"></i> Edit</a>
							<a href="#" class="dropdown-item" id="btnHapus" data-id="' . \encrypt_url($id) . '"><i class="mdi mdi-delete"></i> Hapus</a>
                        </div>
                    </div>';
			$row = array(
				'kode' => $t->kode_skpd,
				'skpd' => $t->nama_skpd,
				'tipe' => $tipe[$t->is_skpd],
				'opsi' => $opsi,
			);
			$ajax[] = $row;
		}
		$output = array(
			'data' => $ajax,
		);
		return json_encode($output);
	}

	public function tambahUnit()
	{
		if ($_POST) {
			$params = array(
				'kode_skpd' => $this->request->getPost('kode'),
				'nama_skpd' => $this->request->getPost('skpd'),
				'is_skpd' => $this->request->getPost('tipe')
			);
			$insert = $this->unitModel->addUnit($params);
			if ($insert) {
				return \json_encode($insert);
			} else {
				throw new ErrorException("Insert Gagal");
			}
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function editUnit()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data = $this->unitModel->getUnitId($id);
		if (isset($data->id_skpd)) {
			$params = array(
				'kode_skpd' => $this->request->getPost('x_kode'),
				'nama_skpd' => $this->request->getPost('x_skpd'),
				'is_skpd' => $this->request->getPost('x_tipe')
			);
			$update = $this->unitModel->updateUnit($id, $params);
			if ($update) {
				return \json_encode($update);
			} else {
				throw new ErrorException("Update Gagal");
			}
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function hapusUnit()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data = $this->unitModel->getUnitId($id);
		if (isset($data->id_skpd)) {
			$remove =  $this->unitModel->deleteUnit($id);
			if ($remove) {
				return \json_encode($remove);
			} else {
				throw new ErrorException("remove Gagal");
			}
		} else {
			throw new PageNotFoundException("Halaman tidak ditemukan");
		}
	}

	public function kepala()
	{
		$data['title'] = 'Kepala SKPD';
		$data['skpd'] = $this->unitModel->getUnit();
		echo view('unit/kepala', $data);
	}

	public function getKadisId()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data = $this->unitModel->getKadisId($id);
		if (isset($data->id_skpd)) {
			return \json_encode($data);
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function getKadis()
	{
		$data = $this->unitModel->getKadis();
		$ajax = [];
		$no = 1;
		foreach ($data as $t) {

			$id = $t->id_kepala_skpd;
			$opsi = '<div class="dropdown text-right">
                        <button type="button" class="btn btn-outline-primary btn-pill dropdown-toggle" data-toggle="dropdown">
                            <i class="mdi mdi-view-list"></i>
                        </button>
                        <div class="dropdown-menu pull-right">
                                <a href="#" class="dropdown-item" id="btnEdit" data-id="' . \encrypt_url($id)  . '"><i class="mdi mdi-pencil"></i>Edit</a>
                                <a href="#" class="dropdown-item" id="btnHapus" data-id="' . \encrypt_url($id) . '"><i class="mdi mdi-delete"></i> Hapus</a>
                        </div>
                    </div>';
			$row = array(
				'no' => $no++,
				'skpd' => $t->nama_skpd,
				'nama' => $t->nama_kepala,
				'nip' => $t->nip,
				'opsi' => $opsi,
			);
			$ajax[] = $row;
		}
		$output = array(
			'data' => $ajax,
		);
		return json_encode($output);
	}

	public function tambahKadis()
	{
		if ($_POST) {
			$params = array(
				'id_skpd' => $this->request->getPost('skpd'),
				'nama_kepala' => $this->request->getPost('nama'),
				'nip' => $this->request->getPost('nip'),
			);
			$insert = $this->unitModel->addKadis($params);
			if ($insert) {
				return \json_encode($insert);
			} else {
				throw new ErrorException("Insert Gagal");
			}
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function editKadis()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data = $this->unitModel->getKadisId($id);
		if (isset($data->id_kepala_skpd)) {
			$params = array(
				'id_skpd' => $this->request->getPost('x_skpd'),
				'nama_kepala' => $this->request->getPost('x_nama'),
				'nip' => $this->request->getPost('x_nip'),
			);
			$update = $this->unitModel->updateKadis($id, $params);
			if ($update) {
				return \json_encode($update);
			} else {
				throw new ErrorException("Update Gagal");
			}
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function hapusKadis()
	{
		$id = \decrypt_url($this->request->getPost('id'));
		$data = $this->unitModel->getKadisId($id);
		if (isset($data->id_kepala_skpd)) {
			$remove =  $this->unitModel->deleteKadis($id);
			if ($remove) {
				return \json_encode($remove);
			} else {
				throw new ErrorException("remove Gagal");
			}
		} else {
			throw new PageNotFoundException("Halaman tidak ditemukan");
		}
	}

	// Profil SKPD
	public function profil()
	{
		$idSkpd = \session('ses_skpd');
		$data['skpd'] = $this->unitModel->getUnitId($idSkpd);
		if (isset($data['skpd']->id_skpd)) {
			$data['title'] = 'Profil Perangkat Daerah';
			echo \view('unit/profil', $data);
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan.');
		}
	}

	public function getProfil()
	{
		$idSkpd = \session('ses_skpd');
		$data = $this->unitModel->getProfilId($idSkpd);
		if (isset($data->id_skpd)) {
			$jabatan = array(
				\null => '',
				'' => '',
				1 => 'Kepala SKPD',
				2 => 'Plt. Kepala'
			);
			$opsi = '<a href="#" id="btnEdit" data-id="' . \encrypt_url($data->id_skpd) . '" class="btn btn-pill btn-outline-primary">
            <i class="mdi mdi-pencil"></i> Edit
            </a>';
			$ajax[] = array(
				'kepala' => $data->nama_kepala,
				'nip' => $data->nip_kepala,
				'jabatan' => $jabatan[$data->jabatan_kepala],
				'alamat' => $data->alamat_skpd,
				'kota' => $data->kota_skpd,
				'opsi' => $opsi
			);
			$output = array(
				'data' => $ajax
			);
			return \json_encode($output);
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan.');
		}
	}

	public function getProfilId()
	{
		$idSkpd = \decrypt_url($this->request->getPost('id'));
		$data = $this->unitModel->getProfilId($idSkpd);
		if (isset($data->id_skpd)) {
			$ajax = array(
				'kepala' => $data->nama_kepala,
				'nip' => $data->nip_kepala,
				'jabatan' => $data->jabatan_kepala,
				'alamat' => $data->alamat_skpd,
				'kota' => $data->kota_skpd,
			);
			return \json_encode($ajax);
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan.');
		}
	}

	public function editProfil()
	{
		$idSkpd = \decrypt_url($this->request->getPost('id'));
		$data = $this->unitModel->getUnitId($idSkpd);
		if (isset($data->id_skpd)) {
			$skpdParams = array(
				'alamat_skpd' => $this->request->getPost('alamat'),
				'kota_skpd' => $this->request->getPost('kota'),
			);
			$updateSkpd = $this->unitModel->updateUnit($idSkpd, $skpdParams);
			if (!$updateSkpd) {
				throw new ErrorException('Update Skpd Gagal');
			}

			$getKadis = $this->unitModel->getKadisSkpdId($idSkpd);
			if (isset($getKadis->id_skpd)) {
				$kadisParams = array(
					'nama_kepala' => $this->request->getPost('nama_kepala'),
					'nip_kepala' => $this->request->getPost('nip'),
					'jabatan_kepala' => $this->request->getPost('jabatan')
				);
				$updateKadis = $this->unitModel->updateKadis($getKadis->id_kepala_skpd, $kadisParams);
				if ($updateKadis) {
					return \json_encode($updateKadis);
				} else {
					throw new ErrorException('Insert Kadis Gagal');
				}
			} else {
				$kadisParams = array(
					'id_skpd' => $idSkpd,
					'nama_kepala' => $this->request->getPost('nama_kepala'),
					'nip_kepala' => $this->request->getPost('nip'),
					'jabatan_kepala' => $this->request->getPost('jabatan')
				);
				$insertKadis = $this->unitModel->addKadis($kadisParams);
				if ($insertKadis) {
					return \json_encode($insertKadis);
				} else {
					throw new ErrorException('Insert Kadis Gagal');
				}
			}
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan.');
		}
	}
}
