<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AturModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use ErrorException;

class TahunCtrl extends BaseController
{
	protected $aturModel;

	public function __construct()
	{
		$db = \db_connect();
		$this->aturModel = new AturModel($db);
	}

	public function tahun()
	{
		$data['title'] = 'Tahun';
		echo view('atur/tahun', $data);
	}

	public function getTahunId()
	{
		$thn = \decrypt_url($this->request->getPost('thn'));
		$data = $this->aturModel->getTahunId($thn);
		if (isset($data->tahun)) {
			return \json_encode($data);
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function getTahun()
	{
		$data = $this->aturModel->getTahun();
		$ajax = [];
		$no = 1;
		foreach ($data as $t) {
			$thn = $t->tahun;
			if ($t->sts_tahun == 1) {
				$sts = "Aktif";
				$btnSts = '<a href="#" class="dropdown-item" id="btnEditSts" data-id="' . \encrypt_url($thn)  . '" data-sts="0"><i class="mdi mdi-close"></i> Disable</a>';
			} else {
				$sts = "Disable";
				$btnSts = '<a href="#" class="dropdown-item" id="btnEditSts" data-id="' . \encrypt_url($thn)  . '" data-sts="1"><i class="mdi mdi-check"></i> Aktif</a>';
			}
			$opsi = '<div class="dropdown text-center">
                        <button class="btn btn-pill btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="mdi mdi-view-list"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            ' . $btnSts . '
                            <a href="#" class="dropdown-item" id="btnHapus" data-id="' . \encrypt_url($thn) . '"><i class="mdi mdi-delete"></i> Hapus</a>
                        </div>
                    </div>';
			$row = array(
				'no' => $no++,
				'tahun' => $thn,
				'sts' => $sts,
				'opsi' => $opsi,
			);
			$ajax[] = $row;
		}
		$output = array(
			'data' => $ajax,
		);
		return json_encode($output);
	}

	public function tambahTahun()
	{
		if ($_POST) {
			$params = array(
				'tahun' => $this->request->getPost('tahun'),
				'sts_tahun' => 1

			);
			$insert = $this->aturModel->addTahun($params);
			if ($insert) {
				return \json_encode($insert);
			} else {
				throw new ErrorException("Insert Gagal", 1);
			}
		} else {
			throw new PageNotFoundException("Halaman tidak ditemukan");
		}
	}

	public function editStsTahun()
	{
		$thn = \decrypt_url($this->request->getPost('thn'));
		$sts = $this->request->getPost('sts');
		$data = $this->aturModel->getTahunId($thn);
		if (isset($data->tahun)) {
			$params = array(
				'sts_tahun' => $sts
			);
			$update = $this->aturModel->updateTahun($thn, $params);
			if ($update) {
				return \json_encode($update);
			} else {
				throw new ErrorException('Update Gagal');
			}
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}

	public function hapusTahun()
	{
		$thn = \decrypt_url($this->request->getPost('thn'));
		$data = $this->aturModel->getTahunId($thn);
		if (isset($data->tahun)) {
			$delete = $this->aturModel->deleteTahun($thn);
			if ($delete) {
				return \json_encode($delete);
			} else {
				throw new ErrorException('Delete Gagal');
			}
		} else {
			throw new PageNotFoundException('Halaman tidak ditemukan');
		}
	}
}
