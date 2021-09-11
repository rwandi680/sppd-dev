<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReferensiModel;
use App\Models\RincianModel;
use App\Models\UsulanModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions\PageNotFoundException;
use ErrorException;

class UploadCtrl extends BaseController
{

    use ResponseTrait;

    protected $usulanModel;
    protected $refModel;
    protected $rinciModel;
    protected $file;

    public function __construct()
    {
        $db = \db_connect();
        $this->usulanModel = new UsulanModel($db);
        $this->refModel = new ReferensiModel($db);
        $this->rinciModel = new RincianModel($db);
        $this->file = new \CodeIgniter\Files\File(\true);
    }

    // SKPD upload Surat Usulan 
    public function uploadSurat()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->usulanModel->getUsulanId($id);
        if (isset($data->id_usulan)) {
            $input = $this->validate([
                'file_surat' => [
                    'uploaded[file_surat]',
                    'ext_in[file_surat,pdf,jpg,jpeg]',
                    'mime_in[file_surat,application/pdf,image/jpg,image/jpeg]',
                    'max_size[file_surat,20480]',
                ]
            ]);
            if (!$input) {
                throw new ErrorException('File Extention or Size not allowed');
            } else {
                $fileSurat = $this->request->getFile('file_surat');
                $fileSurat->move('public/uploads/suratusulan', $fileSurat->getRandomName());
                $params = [
                    'file_surat_usulan' => 'public/uploads/suratusulan/' . $fileSurat->getName(),
                ];
                $update = $this->usulanModel->updateUsulan($id, $params);
                if ($update) {
                    return \json_encode($update);
                } else {
                    throw new ErrorException('Update Surat Usulan Gagal');
                }
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    public function hapusSurat()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->usulanModel->getUsulanId($id);
        if (isset($data->id_usulan)) {
            $fileSurat = $data->file_surat_usulan;
            if (\is_file($fileSurat)) {
                \unlink($fileSurat);
            } else {
                throw new ErrorException("File tidak ditemukan");
            }

            $params = [
                'file_surat_usulan' => \null
            ];
            $update = $this->usulanModel->updateUsulan($id, $params);
            if ($update) {
                return \json_encode($update);
            } else {
                throw new ErrorException('Update Surat Usulan Gagal');
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    // SKPD upload Surat Usulan 
    public function uploadLampiran()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->usulanModel->getUsulanId($id);
        if (isset($data->id_usulan)) {
            $input = $this->validate([
                'file_lampiran' => [
                    'uploaded[file_lampiran]',
                    'ext_in[file_lampiran,pdf,jpg,jpeg,zip,rar,doc,docx,xls,xlsx]',
                    'mime_in[file_lampiran,application/pdf,image/jpg,image/jpeg,application/zip,application/x-rar-compressed,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                    'max_size[file_lampiran,20480]',
                ]
            ]);
            if (!$input) {
                throw new ErrorException('File Extention or Size not allowed');
            } else {
                $fileLampiran = $this->request->getFile('file_lampiran');
                $fileLampiran->move('public/uploads/lampiran', $fileLampiran->getRandomName());
                $params = [
                    'file_lampiran' => 'public/uploads/lampiran/' . $fileLampiran->getName(),
                ];
                $update = $this->usulanModel->updateUsulan($id, $params);
                if ($update) {
                    return \json_encode($update);
                } else {
                    throw new ErrorException('Update Surat Usulan Gagal');
                }
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    public function hapusLampiran()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->usulanModel->getUsulanId($id);
        if (isset($data->id_usulan)) {
            $fileLampiran = $data->file_lampiran;
            if (\is_file($fileLampiran)) {
                \unlink($fileLampiran);
            } else {
                throw new ErrorException("File tidak ditemukan");
            }

            $params = [
                'file_lampiran' => \null
            ];
            $update = $this->usulanModel->updateUsulan($id, $params);
            if ($update) {
                return \json_encode($update);
            } else {
                throw new ErrorException('Update Lampiran Usulan Gagal');
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    // SKPD upload Surat Usulan 
    public function uploadPendukung()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->usulanModel->getUsulanId($id);
        if (isset($data->id_usulan)) {
            $input = $this->validate([
                'file_pendukung' => [
                    'uploaded[file_pendukung]',
                    'ext_in[file_pendukung,pdf,jpg,jpeg,zip,rar,doc,docx,xls,xlsx]',
                    'mime_in[file_pendukung,application/pdf,image/jpg,image/jpeg,application/zip,application/x-rar-compressed,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                    'max_size[file_pendukung,20480]',
                ]
            ]);
            if (!$input) {
                throw new ErrorException('File Extention or Size not allowed');
            } else {
                $filePendukung = $this->request->getFile('file_pendukung');
                $filePendukung->move('public/uploads/pendukung', $filePendukung->getRandomName());
                $params = [
                    'file_pendukung' => 'public/uploads/pendukung/' . $filePendukung->getName(),
                ];
                $update = $this->usulanModel->updateUsulan($id, $params);
                if ($update) {
                    return \json_encode($update);
                } else {
                    throw new ErrorException('Update Surat Usulan Gagal');
                }
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    public function hapusPendukung()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->usulanModel->getUsulanId($id);
        if (isset($data->id_usulan)) {
            $filePendukung = $data->file_pendukung;
            if (\is_file($filePendukung)) {
                \unlink($filePendukung);
            } else {
                throw new ErrorException("File tidak ditemukan");
            }
            $params = [
                'file_pendukung' => \null
            ];
            $update = $this->usulanModel->updateUsulan($id, $params);
            if ($update) {
                return \json_encode($update);
            } else {
                throw new ErrorException('Update Surat Usulan Gagal');
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    // TAPD Upload Rekomendasi 
    public function uploadRekomendasi()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->usulanModel->getTapdRekomUsulanId($id);
        if (isset($data->id_usulan)) {
            $input = $this->validate([
                'file_rekomendasi' => [
                    'uploaded[file_rekomendasi]',
                    'ext_in[file_rekomendasi,pdf,jpg,jpeg,zip,rar]',
                    'mime_in[file_rekomendasi,application/pdf,image/jpg,image/jpeg,application/zip,application/x-rar-compressed]',
                    'max_size[file_rekomendasi,20480]',
                ]
            ]);
            if (!$input) {
                throw new ErrorException('File Extention or Size not allowed');
            } else {
                $fileRekom = $this->request->getFile('file_rekomendasi');
                $fileRekom->move('public/uploads/rekomendasi', $fileRekom->getRandomName());
                $params = [
                    'file_rekomendasi' => 'public/uploads/rekomendasi/' . $fileRekom->getName(),
                ];
                $update = $this->usulanModel->updateTapdRekom($id, $params);
                if ($update) {
                    return \json_encode($update);
                } else {
                    throw new ErrorException('Update File Rekomendasi Gagal');
                }
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    public function hapusRekomendasi()
    {
        $id = \decrypt_url($this->request->getPost('id'));
        $data = $this->usulanModel->getTapdRekomUsulanId($id);
        if (isset($data->id_usulan)) {
            $fileRekom = $data->file_rekomendasi;
            if (\is_file($fileRekom)) {
                \unlink($fileRekom);
            } else {
                throw new ErrorException("File tidak ditemukan");
            }
            $params = [
                'file_rekomendasi' => \null
            ];
            $update = $this->usulanModel->updateTapdRekom($id, $params);
            if ($update) {
                return \json_encode($update);
            } else {
                throw new ErrorException('Update File Rekomendasi Gagal');
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }

    public function excelRincianMurniAsli()
    {
        $idSubKeg = \decrypt_url($this->request->getPost('id'));
        $dataSub = $this->usulanModel->getSubKegId($idSubKeg);
        if (isset($dataSub->id_usulan_sub_kegiatan)) {
            if (!$this->validate([
                'rincianmurni' => [
                    'rules' => 'uploaded[rincianmurni]|ext_in[rincianmurni,xlsx',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'ext_in' => 'File Extention Harus Berupa Excel'
                    ]

                ]
            ])) {
                throw new ErrorException("File Extention Harus Berupa Excel");
            }
            $file = $this->request->getFile('rincianmurni');
            $uploadPath = 'excel/';
            $fileName = $this->file->getRandomName() . '.' . $file->guessExtension();
            $move = $file->store($uploadPath, $fileName);
            if (!$move) {
                throw new ErrorException('Gagal');
            }
            $path = $uploadPath . $fileName;
            $filePath = \WRITEPATH . 'uploads/' . $path;
            // $data = \file_get_contents($filePath);
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($filePath);
            $data = $spreadsheet->getSheetByName('rincian')->toArray(null, true, \false, true);

            // foreach ($data as $key => $row) {
            //     //skip index 1 karena title excel
            //     if ($key == 1) {
            //         continue;
            //     }

            //     \var_dump($row);
            // }


            // echo $data['volume2'];


            $arrParams = array();
            $subTeksArr = array();
            $ketTeksArr = array();
            foreach ($data as $key => $row) {
                if ($key == 1) {
                    continue;
                }
                $getAkun = $this->refModel->getRefAkunBlKode($row['A']);
                if (isset($getAkun->id_ref_akun)) {
                    $idRefAkun = $getAkun->id_ref_akun;
                    $idAkun = $getAkun->id_akun;
                    $kodeAkun = $getAkun->kode_akun;
                    $namaAkun = $getAkun->nama_akun;
                } else {
                    throw new ErrorException('Data Akun tidak ditemukan');
                }

                $kelompokPaket = $row['C'];
                $keterangan = $row['D'];
                $namaKomponen = $row['E'];
                if (empty($namaKomponen) || $namaKomponen == \null || $namaKomponen < 0) {
                    throw new ErrorException('Nama Komponen Error');
                }
                $spekKomponen = $row['F'];
                $satuan = $row['G'];
                if (empty($satuan) || $satuan == \null || $satuan < 0) {
                    throw new ErrorException('Satuan Error');
                }
                $hargaSatuan = $row['H'];
                if (empty($hargaSatuan) || $hargaSatuan == \null || $hargaSatuan < 0) {
                    throw new ErrorException('Harga Satuan Error');
                }
                $vol_1 = $row['J'];
                $sat_1 = $row['K'];
                if (empty($vol_1) || empty($sat_1)) {
                    throw new ErrorException('Volume satuan 1 error');
                } else {
                    $koef1 = $vol_1;
                }
                $vol_2 = $row['L'];
                $sat_2 = $row['M'];
                if (empty($vol_2) && empty($sat_2)) {
                    $vol2 = \null;
                    $koef2 = 1;
                } elseif (!empty($vol_2) && empty($sat_2)) {
                    throw new ErrorException('Satuan 2 error');
                } elseif (empty($vol_2) && !empty($sat_2)) {
                    throw new ErrorException('Volume 2 error');
                } else {
                    $vol2 = $vol_2;
                    $koef2 = $vol_2;
                }
                $vol_3 = $row['N'];
                $sat_3 = $row['O'];
                if (empty($vol_3) && empty($sat_3)) {
                    $vol3 = \null;
                    $koef3 = 1;
                } elseif (!empty($vol_3) && empty($sat_3)) {
                    throw new ErrorException('Satuan 2 error');
                } elseif (empty($vol_3) && !empty($sat_3)) {
                    throw new ErrorException('Volume 2 error');
                } else {
                    $vol3 = $vol_3;
                    $koef3 = $vol_3;
                }
                $vol_4 = $row['P'];
                $sat_4 = $row['Q'];
                if (empty($vol_4) && empty($sat_4)) {
                    $vol4 = \null;
                    $koef4 = 1;
                } elseif (!empty($vol_4) && empty($sat_4)) {
                    throw new ErrorException('Satuan 2 error');
                } elseif (empty($vol_4) && !empty($sat_4)) {
                    throw new ErrorException('Volume 2 error');
                } else {
                    $vol4 = $vol_4;
                    $koef4 = $vol_4;
                }
                $koefisien = $koef1 * $koef2 * $koef3 * $koef4;
                $pajak = $row['I'];
                if ($pajak == 1) {
                    $isPajak = 1;
                    $dpp = $koefisien * $hargaSatuan;
                    $ppn = $dpp * (10 / 100);
                    $pajak = 10;
                    $subtotal = $dpp + $ppn;
                    $rincian = \ceil($subtotal);
                } else {
                    $isPajak = 0;
                    $pajak = 0;
                    $subtotal = $hargaSatuan * $koefisien;
                    $rincian = \ceil($subtotal);
                }

                $arrParams[] = array(
                    'tahun' => $dataSub->tahun,
                    'id_skpd' => $dataSub->id_skpd,
                    'id_usulan' => $dataSub->id_usulan,
                    'id_bl_sub_kegiatan' => $dataSub->id_bl_sub_kegiatan,
                    'id_usulan_sub_kegiatan' => $dataSub->id_usulan_sub_kegiatan,
                    'id_unit' => $dataSub->id_unit,
                    'kode_skpd' => $dataSub->kode_skpd,
                    'nama_skpd' => $dataSub->nama_skpd,
                    'id_urusan' => $dataSub->id_urusan,
                    'kode_urusan' => $dataSub->kode_urusan,
                    'nama_urusan' => $dataSub->nama_urusan,
                    'id_bidang_urusan' => $dataSub->id_bidang_urusan,
                    'kode_bidang_urusan' => $dataSub->kode_bidang_urusan,
                    'nama_bidang_urusan' => $dataSub->nama_bidang_urusan,
                    'id_sub_skpd' => $dataSub->id_sub_skpd,
                    'kode_sub_skpd' => $dataSub->kode_sub_skpd,
                    'nama_sub_skpd' => $dataSub->nama_sub_skpd,
                    'id_program' => $dataSub->id_program,
                    'kode_program' => $dataSub->kode_program,
                    'nama_program' => $dataSub->nama_program,
                    'id_giat' => $dataSub->id_giat,
                    'kode_giat' => $dataSub->kode_giat,
                    'nama_giat' => $dataSub->nama_giat,
                    'id_sub_giat' => $dataSub->id_sub_giat,
                    'kode_sub_giat' => $dataSub->kode_sub_giat,
                    'nama_sub_giat' => $dataSub->nama_sub_giat,
                    'id_ref_akun' => $idRefAkun,
                    'id_akun' => $idAkun,
                    'kode_akun' => $kodeAkun,
                    'nama_akun' => $namaAkun,
                    'jenis_bl' => \null,
                    'subs_bl_teks' => $kelompokPaket,
                    'nama_komponen' => $namaKomponen,
                    'spek_komponen' => $spekKomponen,
                    'satuan_komponen' => $satuan,
                    'harga_satuan_komponen' => $hargaSatuan,
                    'ket_bl_teks' => $keterangan,
                    'vol_1' => $vol_1,
                    'sat_1' => $sat_1,
                    'vol_2' => $vol2,
                    'sat_2' => $sat_2,
                    'vol_3' => $vol3,
                    'sat_3' => $sat_3,
                    'vol_4' => $vol4,
                    'sat_4' => $sat_4,
                    'is_pajak' => $isPajak,
                    'pajak' => $pajak,
                    'rincian' => $rincian,
                );

                $subTeksArr[] = array(
                    'tahun' => $dataSub->tahun,
                    'id_skpd' => $dataSub->id_skpd,
                    'id_usulan' => $dataSub->id_usulan,
                    'id_bl_sub_kegiatan' => $dataSub->id_bl_sub_kegiatan,
                    'id_usulan_sub_kegiatan' => $dataSub->id_usulan_sub_kegiatan,
                    'id_unit' => $dataSub->id_unit,
                    'kode_skpd' => $dataSub->kode_skpd,
                    'nama_skpd' => $dataSub->nama_skpd,
                    'id_urusan' => $dataSub->id_urusan,
                    'kode_urusan' => $dataSub->kode_urusan,
                    'nama_urusan' => $dataSub->nama_urusan,
                    'id_bidang_urusan' => $dataSub->id_bidang_urusan,
                    'kode_bidang_urusan' => $dataSub->kode_bidang_urusan,
                    'nama_bidang_urusan' => $dataSub->nama_bidang_urusan,
                    'id_sub_skpd' => $dataSub->id_sub_skpd,
                    'kode_sub_skpd' => $dataSub->kode_sub_skpd,
                    'nama_sub_skpd' => $dataSub->nama_sub_skpd,
                    'id_program' => $dataSub->id_program,
                    'kode_program' => $dataSub->kode_program,
                    'nama_program' => $dataSub->nama_program,
                    'id_giat' => $dataSub->id_giat,
                    'kode_giat' => $dataSub->kode_giat,
                    'nama_giat' => $dataSub->nama_giat,
                    'id_sub_giat' => $dataSub->id_sub_giat,
                    'kode_sub_giat' => $dataSub->kode_sub_giat,
                    'nama_sub_giat' => $dataSub->nama_sub_giat,
                    'subs_bl_kategori' => 2,
                    'subs_bl_teks' => $kelompokPaket
                );

                $ketTeksArr[] = array(
                    'tahun' => $dataSub->tahun,
                    'id_skpd' => $dataSub->id_skpd,
                    'id_usulan' => $dataSub->id_usulan,
                    'id_bl_sub_kegiatan' => $dataSub->id_bl_sub_kegiatan,
                    'id_usulan_sub_kegiatan' => $dataSub->id_usulan_sub_kegiatan,
                    'id_unit' => $dataSub->id_unit,
                    'kode_skpd' => $dataSub->kode_skpd,
                    'nama_skpd' => $dataSub->nama_skpd,
                    'id_urusan' => $dataSub->id_urusan,
                    'kode_urusan' => $dataSub->kode_urusan,
                    'nama_urusan' => $dataSub->nama_urusan,
                    'id_bidang_urusan' => $dataSub->id_bidang_urusan,
                    'kode_bidang_urusan' => $dataSub->kode_bidang_urusan,
                    'nama_bidang_urusan' => $dataSub->nama_bidang_urusan,
                    'id_sub_skpd' => $dataSub->id_sub_skpd,
                    'kode_sub_skpd' => $dataSub->kode_sub_skpd,
                    'nama_sub_skpd' => $dataSub->nama_sub_skpd,
                    'id_program' => $dataSub->id_program,
                    'kode_program' => $dataSub->kode_program,
                    'nama_program' => $dataSub->nama_program,
                    'id_giat' => $dataSub->id_giat,
                    'kode_giat' => $dataSub->kode_giat,
                    'nama_giat' => $dataSub->nama_giat,
                    'id_sub_giat' => $dataSub->id_sub_giat,
                    'kode_sub_giat' => $dataSub->kode_sub_giat,
                    'nama_sub_giat' => $dataSub->nama_sub_giat,
                    'ket_bl_teks' => $keterangan
                );
            }
            $subTeksParams = \array_unique($subTeksArr, SORT_REGULAR);
            $ketTeksArr = \array_unique($ketTeksArr, SORT_REGULAR);
            \var_dump($ketTeksArr);
            // $insertSubTeks = $this->teksModel->insertSubTeks($subTeksParams);
            // if (!$insertSubTeks) {
            //     throw new ErrorException('Insert Sub Teks Gagal');
            // }

            // $insertKetTeks = $this->teksModel->insertKetTeks($ketTeksParams);
            // if (!$insertKetTeks) {
            //     throw new ErrorException('Insert Ket Teks Gagal');
            // }

            // $insertMurni = $this->blModel->insertBlRinc($arrParams);
            // if (!$insertMurni) {
            //     throw new ErrorException('Insert Data Murni Gagal');
            // }
            // $insertRubah = $this->usulanModel->importRincian($arrParams);
            // if (!$insertRubah) {
            //     throw new ErrorException('Insert Data Perubahan Gagal');
            // }
            //     return \json_encode($insertRubah);
            // } else {
            // }
            if (\is_file($filePath)) {
                \unlink($filePath);
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan.');
        }
    }

    public function excelUploadRincianMurni()
    {
        $idSubKeg = \decrypt_url($this->request->getPost('id'));
        $dataSub = $this->usulanModel->getSubKegId($idSubKeg);
        if (isset($dataSub->id_usulan_sub_kegiatan)) {

            $validate = $this->validate([
                'rincian' => [
                    'rules' => 'uploaded[rincian]|ext_in[rincian,xlsx]|mime_in[rincian,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/zip]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'File Extention Harus Berupa Excel',
                        'ext_in' => 'File Extention Harus Berupa Excel'
                    ]
                ]
            ]);
            if (!$validate) {
                $messages = $this->validator->getError("rincian");
                return $this->fail($messages, 400);
            }

            $file = $this->request->getFile('rincian');
            $uploadPath = 'excel/';
            $fileName = $this->file->getRandomName() . '.' . $file->guessExtension();
            $move = $file->store($uploadPath, $fileName);
            if (!$move) {
                throw new ErrorException('Gagal');
            }
            $path = $uploadPath . $fileName;
            $filePath = \WRITEPATH . 'uploads/' . $path;

            // $data = \file_get_contents($filePath);
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($filePath);
            $data = $spreadsheet->getSheetByName('rincian')->toArray(null, true, \false, true);

            $arrParams = array();
            foreach ($data as $key => $row) {
                if ($key == 1) {
                    continue;
                }

                // get Akun
                $rowKodeAkun = $row['A'];
                $getAkun = $this->refModel->getRefAkunBlKode($rowKodeAkun);
                if (isset($getAkun->id_ref_akun)) {
                    $idRefAkun = $getAkun->id_ref_akun;
                } else {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Kode Akun tidak sesuai';
                    return $this->fail($messages, 400);
                }

                //membuat slug Sub teks
                $rowKelompokPaket = $row['C'];
                if (empty($rowKelompokPaket) || $rowKelompokPaket == '' || $rowKelompokPaket == \null) {
                    $kelompokPaketSlug = 'nosub';
                    $kelompokPaket = \null;
                } else {
                    $kelompokPaketSlug = preg_replace('/\s+/', '', $rowKelompokPaket);
                    $kelompokPaket = $rowKelompokPaket;
                }

                //membuat slug keterangan
                $rowKeterangan = $row['D'];
                if (empty($rowKeterangan) || $rowKeterangan == '' || $rowKeterangan == \null) {
                    $keteranganSlug = 'noket';
                    $keterangan = \null;
                } else {
                    $keterangan = $rowKeterangan;
                    $keteranganSlug = preg_replace('/\s+/', '', $rowKeterangan);
                }

                // Nama Komponen
                $rowNamaKomponen = $row['E'];
                $spekKomponen = $row['F'];
                if (empty($rowNamaKomponen) || $rowNamaKomponen == \null || $rowNamaKomponen < 0) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Nama Komponen Error';
                    return $this->fail($messages, 400);
                } else {
                    $namaKomponen = $rowNamaKomponen;
                }

                // Satuan
                $satuan = $row['G'];
                if (empty($satuan) || $satuan == \null || $satuan < 0) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Satuan Komponen Error';
                    return $this->fail($messages, 400);
                }
                $hargaSatuan = $row['H'];
                if (empty($hargaSatuan) || $hargaSatuan == \null || $hargaSatuan < 0) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Harga Satuan Error';
                    return $this->fail($messages, 400);
                }
                $vol_1 = $row['J'];
                $sat_1 = $row['K'];
                if (empty($vol_1) || empty($sat_1)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Volume 1 & Satuan 1 Error';
                    return $this->fail($messages, 400);
                } else {
                    $koef1 = $vol_1;
                }
                $vol_2 = $row['L'];
                $sat_2 = $row['M'];
                if (empty($vol_2) && empty($sat_2)) {
                    $vol2 = \null;
                    $koef2 = 1;
                } elseif (!empty($vol_2) && empty($sat_2)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Satuan 2 Error';
                    return $this->fail($messages, 400);
                } elseif (empty($vol_2) && !empty($sat_2)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Volume 2 Error';
                    return $this->fail($messages, 400);
                } else {
                    $vol2 = $vol_2;
                    $koef2 = $vol_2;
                }
                $vol_3 = $row['N'];
                $sat_3 = $row['O'];
                if (empty($vol_3) && empty($sat_3)) {
                    $vol3 = \null;
                    $koef3 = 1;
                } elseif (!empty($vol_3) && empty($sat_3)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Satuan 3 Error';
                    return $this->fail($messages, 400);
                } elseif (empty($vol_3) && !empty($sat_3)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Volume 3 Error';
                    return $this->fail($messages, 400);
                } else {
                    $vol3 = $vol_3;
                    $koef3 = $vol_3;
                }
                $vol_4 = $row['P'];
                $sat_4 = $row['Q'];
                if (empty($vol_4) && empty($sat_4)) {
                    $vol4 = \null;
                    $koef4 = 1;
                } elseif (!empty($vol_4) && empty($sat_4)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Satuan 4 Error';
                    return $this->fail($messages, 400);
                } elseif (empty($vol_4) && !empty($sat_4)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Volume 4 Error';
                    return $this->fail($messages, 400);
                } else {
                    $vol4 = $vol_4;
                    $koef4 = $vol_4;
                }
                $koefisien = $koef1 * $koef2 * $koef3 * $koef4;
                $pajak = $row['I'];
                if ($pajak == 10) {
                    $isPajak = 1;
                    $dpp = $koefisien * $hargaSatuan;
                    $ppn = $dpp * (10 / 100);
                    $pajak = 10;
                    $subtotal = $dpp + $ppn;
                    $rincian = \ceil($subtotal);
                } else {
                    $isPajak = 0;
                    $pajak = 0;
                    $subtotal = $hargaSatuan * $koefisien;
                    $rincian = \ceil($subtotal);
                }

                $arrParams[] = array(
                    'tahun' => $dataSub->tahun,
                    'id_skpd' => $dataSub->id_skpd,
                    'id_urusan' => $dataSub->id_urusan,
                    'id_bidang_urusan' => $dataSub->id_bidang_urusan,
                    'id_sub_unit' => $dataSub->id_sub_unit,
                    'id_program' => $dataSub->id_program,
                    'id_kegiatan' => $dataSub->id_kegiatan,
                    'id_sub_kegiatan' => $dataSub->id_sub_kegiatan,
                    'id_ref_akun' => $idRefAkun,
                    'jenis_bl' => \null,
                    'nama_paket_bl_slug' => $kelompokPaketSlug,
                    'nama_paket_bl' => $kelompokPaket,
                    'nama_komponen' => $namaKomponen,
                    'spek_komponen' => $spekKomponen,
                    'satuan_komponen' => $satuan,
                    'harga_satuan_komponen' => $hargaSatuan,
                    'nama_ket_bl_slug' => $keteranganSlug,
                    'nama_ket_bl' => $keterangan,
                    'vol_1' => $vol_1,
                    'sat_1' => $sat_1,
                    'vol_2' => $vol2,
                    'sat_2' => $sat_2,
                    'vol_3' => $vol3,
                    'sat_3' => $sat_3,
                    'vol_4' => $vol4,
                    'sat_4' => $sat_4,
                    'is_ppn' => $isPajak,
                    'nominal_ppn' => $pajak,
                    'nominal_rincian' => $rincian,
                );
            }
            // // insert rincian
            $import = $this->rinciModel->importRincianMurni($arrParams);
            if ($import) {
                if (\is_file($filePath)) {
                    \unlink($filePath);
                }
                return \json_encode($import);
            } else {
                if (\is_file($filePath)) {
                    \unlink($filePath);
                }
                $messages = 'Import Data gagal, silahkan coba lagi.';
                return $this->fail($messages, 400);
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan.');
        }
    }

    public function excelUploadRincian()
    {
        $idSubKeg = \decrypt_url($this->request->getPost('id'));
        $dataSub = $this->usulanModel->getSubKegId($idSubKeg);
        if (isset($dataSub->id_usulan_sub_kegiatan)) {

            $validate = $this->validate([
                'rincian' => [
                    'rules' => 'uploaded[rincian]|ext_in[rincian,xlsx]|mime_in[rincian,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/zip]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'File Extention Harus Berupa Excel',
                        'ext_in' => 'File Extention Harus Berupa Excel'
                    ]
                ]
            ]);
            if (!$validate) {
                $messages = $this->validator->getError("rincian");
                return $this->fail($messages, 400);
            }

            $file = $this->request->getFile('rincian');
            $uploadPath = 'excel/';
            $fileName = $this->file->getRandomName() . '.' . $file->guessExtension();
            $move = $file->store($uploadPath, $fileName);
            if (!$move) {
                throw new ErrorException('Gagal');
            }
            $path = $uploadPath . $fileName;
            $filePath = \WRITEPATH . 'uploads/' . $path;

            // $data = \file_get_contents($filePath);
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($filePath);
            $data = $spreadsheet->getSheetByName('rincian')->toArray(null, true, \false, true);

            $arrParams = array();
            foreach ($data as $key => $row) {
                if ($key == 1) {
                    continue;
                }

                // get Akun
                $rowKodeAkun = $row['A'];
                $getAkun = $this->refModel->getRefAkunBlKode($rowKodeAkun);
                if (isset($getAkun->id_ref_akun)) {
                    $idRefAkun = $getAkun->id_ref_akun;
                } else {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Kode Akun tidak sesuai';
                    return $this->fail($messages, 400);
                }

                //membuat slug Sub teks
                $rowKelompokPaket = $row['C'];
                if (empty($rowKelompokPaket) || $rowKelompokPaket == '' || $rowKelompokPaket == \null) {
                    $kelompokPaketSlug = 'nosub';
                    $kelompokPaket = \null;
                } else {
                    $kelompokPaketSlug = preg_replace('/\s+/', '', $rowKelompokPaket);
                    $kelompokPaket = $rowKelompokPaket;
                }

                //membuat slug keterangan
                $rowKeterangan = $row['D'];
                if (empty($rowKeterangan) || $rowKeterangan == '' || $rowKeterangan == \null) {
                    $keteranganSlug = 'noket';
                    $keterangan = \null;
                } else {
                    $keterangan = $rowKeterangan;
                    $keteranganSlug = preg_replace('/\s+/', '', $rowKeterangan);
                }

                // Nama Komponen
                $rowNamaKomponen = $row['E'];
                $spekKomponen = $row['F'];
                if (empty($rowNamaKomponen) || $rowNamaKomponen == \null || $rowNamaKomponen < 0) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Nama Komponen Error';
                    return $this->fail($messages, 400);
                } else {
                    $namaKomponen = $rowNamaKomponen;
                }

                // Satuan
                $satuan = $row['G'];
                if (empty($satuan) || $satuan == \null || $satuan < 0) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Satuan Komponen Error';
                    return $this->fail($messages, 400);
                }
                $hargaSatuan = $row['H'];
                if (empty($hargaSatuan) || $hargaSatuan == \null || $hargaSatuan < 0) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Harga Satuan Error';
                    return $this->fail($messages, 400);
                }
                $vol_1 = $row['J'];
                $sat_1 = $row['K'];
                if (empty($vol_1) || empty($sat_1)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Volume 1 & Satuan 1 Error';
                    return $this->fail($messages, 400);
                } else {
                    $koef1 = $vol_1;
                }
                $vol_2 = $row['L'];
                $sat_2 = $row['M'];
                if (empty($vol_2) && empty($sat_2)) {
                    $vol2 = \null;
                    $koef2 = 1;
                } elseif (!empty($vol_2) && empty($sat_2)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Satuan 2 Error';
                    return $this->fail($messages, 400);
                } elseif (empty($vol_2) && !empty($sat_2)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Volume 2 Error';
                    return $this->fail($messages, 400);
                } else {
                    $vol2 = $vol_2;
                    $koef2 = $vol_2;
                }
                $vol_3 = $row['N'];
                $sat_3 = $row['O'];
                if (empty($vol_3) && empty($sat_3)) {
                    $vol3 = \null;
                    $koef3 = 1;
                } elseif (!empty($vol_3) && empty($sat_3)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Satuan 3 Error';
                    return $this->fail($messages, 400);
                } elseif (empty($vol_3) && !empty($sat_3)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Volume 3 Error';
                    return $this->fail($messages, 400);
                } else {
                    $vol3 = $vol_3;
                    $koef3 = $vol_3;
                }
                $vol_4 = $row['P'];
                $sat_4 = $row['Q'];
                if (empty($vol_4) && empty($sat_4)) {
                    $vol4 = \null;
                    $koef4 = 1;
                } elseif (!empty($vol_4) && empty($sat_4)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Satuan 4 Error';
                    return $this->fail($messages, 400);
                } elseif (empty($vol_4) && !empty($sat_4)) {
                    if (\is_file($filePath)) {
                        \unlink($filePath);
                    }
                    $messages = 'Volume 4 Error';
                    return $this->fail($messages, 400);
                } else {
                    $vol4 = $vol_4;
                    $koef4 = $vol_4;
                }
                $koefisien = $koef1 * $koef2 * $koef3 * $koef4;
                $pajak = $row['I'];
                if ($pajak == 10) {
                    $isPajak = 1;
                    $dpp = $koefisien * $hargaSatuan;
                    $ppn = $dpp * (10 / 100);
                    $pajak = 10;
                    $subtotal = $dpp + $ppn;
                    $rincian = \ceil($subtotal);
                } else {
                    $isPajak = 0;
                    $pajak = 0;
                    $subtotal = $hargaSatuan * $koefisien;
                    $rincian = \ceil($subtotal);
                }

                $arrParams[] = array(
                    'tahun' => $dataSub->tahun,
                    'id_skpd' => $dataSub->id_skpd,
                    'id_usulan' => $dataSub->id_usulan,
                    'id_usulan_sub_kegiatan' => $dataSub->id_usulan_sub_kegiatan,
                    'id_urusan' => $dataSub->id_urusan,
                    'id_bidang_urusan' => $dataSub->id_bidang_urusan,
                    'id_sub_unit' => $dataSub->id_sub_unit,
                    'id_program' => $dataSub->id_program,
                    'id_kegiatan' => $dataSub->id_kegiatan,
                    'id_sub_kegiatan' => $dataSub->id_sub_kegiatan,
                    'id_ref_akun' => $idRefAkun,
                    'jenis_bl' => \null,
                    'nama_paket_bl_slug' => $kelompokPaketSlug,
                    'nama_paket_bl' => $kelompokPaket,
                    'nama_komponen' => $namaKomponen,
                    'spek_komponen' => $spekKomponen,
                    'satuan_komponen' => $satuan,
                    'harga_satuan_komponen' => $hargaSatuan,
                    'nama_ket_bl_slug' => $keteranganSlug,
                    'nama_ket_bl' => $keterangan,
                    'vol_1' => $vol_1,
                    'sat_1' => $sat_1,
                    'vol_2' => $vol2,
                    'sat_2' => $sat_2,
                    'vol_3' => $vol3,
                    'sat_3' => $sat_3,
                    'vol_4' => $vol4,
                    'sat_4' => $sat_4,
                    'is_ppn' => $isPajak,
                    'nominal_ppn' => $pajak,
                    'nominal_rincian' => $rincian,
                );
            }
            // // insert rincian
            $import = $this->rinciModel->importRincian($arrParams);
            if ($import) {
                if (\is_file($filePath)) {
                    \unlink($filePath);
                }
                return \json_encode($import);
            } else {
                if (\is_file($filePath)) {
                    \unlink($filePath);
                }
                $messages = 'Import Data gagal, silahkan coba lagi.';
                return $this->fail($messages, 400);
            }
        } else {
            throw new PageNotFoundException('Halaman tidak ditemukan.');
        }
    }
}
