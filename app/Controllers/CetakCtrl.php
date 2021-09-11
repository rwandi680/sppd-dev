<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CetakModel;
use App\Models\AturModel;
use App\Models\UsulanModel;
use App\Models\ReferensiModel;
use App\Models\RincianModel;
use App\Models\UnitModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class CetakCtrl extends BaseController
{

    protected $usulanModel;
    protected $refModel;
    protected $cetakModel;
    protected $unitModel;
    protected $aturModel;
    protected $pdf;
    protected $rinciModel;

    public function __construct()
    {
        $db = \db_connect();
        $this->usulanModel = new UsulanModel($db);
        $this->refModel = new ReferensiModel($db);
        $this->cetakModel = new CetakModel($db);
        $this->unitModel = new UnitModel($db);
        $this->aturModel = new AturModel($db);
        $this->rinciModel = new RincianModel($db);
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', TRUE);
        $this->pdf = new \Dompdf\Dompdf($options);
    }

    public function suratUsulan($id = false)
    {
        if ($id != false) {
            $id = \decrypt_url($id);
            $data['usulan'] = $this->usulanModel->getUsulanId($id);
            if (isset($data['usulan']->id_usulan)) {
                $data['skpd'] = $this->unitModel->getProfilId($data['usulan']->id_skpd);
                $data['bidang'] = $this->refModel->getBidangSkpd($data['skpd']->id_bidang_urusan_1);
                $data['tahap'] = $this->aturModel->getTahapId($data['usulan']->id_tahapan_usulan);
                $data['subkeg'] = $this->cetakModel->getUsulanSubKeg($data['usulan']->id_usulan);


                // $filename = 'Surat Permohonan Pergeseran ';
                // $this->pdf->loadHtml(view('cetak/skpd_surat_usulan', $data));
                // $this->pdf->setPaper('A4', 'portrait');
                // $this->pdf->render();
                // $this->pdf->stream($filename, array("Attachment" => false));

                // debug view
                return \view('cetak/skpd_surat_usulan', $data);
            } else {
                throw new PageNotFoundException("Halaman tidak ditemukan");
            }
        } else {
            throw new PageNotFoundException("Halaman tidak ditemukan");
        }
    }

    public function lampiranUsulan($id = \false)
    {
        if ($id != false) {
            $id = \decrypt_url($id);
            $data['usulan'] = $this->usulanModel->getUsulanId($id);
            if (isset($data['usulan']->id_usulan)) {
                $data['skpd'] = $this->unitModel->getProfilId($data['usulan']->id_skpd);
                $data['tahap'] = $this->aturModel->getTahapanId($data['usulan']->id_tahapan_usulan);
                $data['subkeg'] = $this->usulanModel->getSubKeg($data['usulan']->id_usulan);


                // $filename = 'Lampiran Surat Permohonan Pergeseran ';
                // $this->pdf->loadHtml(view('cetak/surat_usulan', $data));
                // $this->pdf->setPaper('A4', 'portrait');
                // $this->pdf->render();
                // $this->pdf->stream($filename, array("Attachment" => false));

                // debug view
                return \view('cetak/lampiran_usulan', $data);
            } else {
                throw new PageNotFoundException("Halaman tidak ditemukan");
            }
        } else {
            throw new PageNotFoundException("Halaman tidak ditemukan");
        }
    }

    public function rekomendasi($id = \false)
    {
        if ($id != false) {
            $id = \decrypt_url($id);
            $data['usulan'] = $this->usulanModel->getUsulanId($id);
            if (isset($data['usulan']->id_usulan)) {
                // $data['skpd'] = $this->unitModel->getProfilId($data['usulan']->id_skpd);
                // $data['bidang'] = $this->refModel->getBidangSkpd($data['skpd']->id_bidang_urusan_1);
                // $data['tahap'] = $this->aturModel->getTahapId($data['usulan']->id_tahapan_usulan);
                // $data['subkeg'] = $this->cetakModel->getUsulanSubKeg($data['usulan']->id_usulan);

                $data['tapd'] = $this->unitModel->getProfilTapd();
                // $filename = 'Surat Permohonan Pergeseran ';
                // $this->pdf->loadHtml(view('cetak/skpd_surat_usulan', $data));
                // $this->pdf->setPaper('A4', 'portrait');
                // $this->pdf->render();
                // $this->pdf->stream($filename, array("Attachment" => false));

                // debug view
                return \view('cetak/tapd_rekomendasi', $data);
            } else {
                throw new PageNotFoundException("Halaman tidak ditemukan");
            }
        } else {
            throw new PageNotFoundException("Halaman tidak ditemukan");
        }
    }

    public function subKegRinci($idUsulan, $idSubKeg)
    {
        $idSubKeg = \decrypt_url($idSubKeg);
        $idUsulan = \decrypt_url($idUsulan);
        $data['subKeg'] = $this->usulanModel->getSubKegId($idSubKeg);
        if (isset($data['subKeg']->id_usulan_sub_kegiatan)) {
            $thn = $data['subKeg']->tahun;
            $idSkpd = $data['subKeg']->id_skpd;
            $idSubUnit = $data['subKeg']->id_sub_unit;
            $idRefSubKeg = $data['subKeg']->id_sub_kegiatan;
            $data['usulan'] = $this->usulanModel->getUsulanId($idUsulan);

            $data['profil'] = $this->unitModel->getProfilId($idSkpd);

            $data['subUnit'] = $this->unitModel->getUnitId($idSubUnit);
            $data['kadis'] = $this->unitModel->getKadisSkpdId($idSkpd);


            $getBidang = $this->refModel->getBidangSkpd($data['profil']->id_bidang_urusan_1);
            $getRefSubKeg = $this->refModel->getSubKegiatanId($idRefSubKeg);

            if ($getRefSubKeg->is_umum == 1) {
                $data['refUrusan'] = $getBidang->kode_bidang_urusan . \substr($getBidang->nama_bidang_urusan, 4);
                $data['refBidang'] = $getBidang->kode_bidang_urusan . \substr($getBidang->nama_bidang_urusan, 4);
                $data['refProgram'] = $getBidang->kode_bidang_urusan . \substr($getRefSubKeg->nama_program, 4);
                $data['refKegiatan'] = $getBidang->kode_bidang_urusan . \substr($getRefSubKeg->nama_kegiatan, 4);
                $data['refSubKeg'] = $getBidang->kode_bidang_urusan . \substr($getRefSubKeg->nama_sub_kegiatan, 4);
            } else {
                $data['refUrusan'] = $getBidang->nama_urusan;
                $data['refBidang'] = $getBidang->nama_bidang_urusan;
                $data['refProgram'] = $getRefSubKeg->nama_program;
                $data['refKegiatan'] = $getRefSubKeg->nama_kegiatan;
                $data['refSubKeg'] = $getRefSubKeg->nama_sub_kegiatan;
            }

            $rinciParams = array(
                'tahun' => $thn,
                'id_skpd' => $idSkpd,
                'id_usulan' => $idUsulan,
                'id_sub_unit' => $idSubUnit,
                'id_usulan_sub_kegiatan' => $idSubKeg,
            );
            $data['pagu'] = $this->rinciModel->getPaguRincian($rinciParams);
            $data['akun'] = $this->cetakModel->detilRincian($thn, $idUsulan, $idSkpd, $idSubUnit, $idSubKeg);
            return \view('cetak/usulan_subkeg_rinci', $data);
        } else {
            throw new PageNotFoundException("Halaman tidak ditemukan");
        }
    }

    public function subKegRinciRubah($idUsulan, $idSubKeg)
    {
        $idSubKeg = \decrypt_url($idSubKeg);
        $idUsulan = \decrypt_url($idUsulan);
        $data['subKeg'] = $this->usulanModel->getSubKegId($idSubKeg);
        if (isset($data['subKeg']->id_usulan_sub_kegiatan)) {
            $thn = $data['subKeg']->tahun;
            $idSkpd = $data['subKeg']->id_skpd;
            $idSubUnit = $data['subKeg']->id_sub_unit;
            $idRefSubKeg = $data['subKeg']->id_sub_kegiatan;
            $data['usulan'] = $this->usulanModel->getUsulanId($idUsulan);

            $data['profil'] = $this->unitModel->getProfilId($idSkpd);

            $data['subUnit'] = $this->unitModel->getUnitId($idSubUnit);
            $data['kadis'] = $this->unitModel->getKadisSkpdId($idSkpd);


            $getBidang = $this->refModel->getBidangSkpd($data['profil']->id_bidang_urusan_1);
            $getRefSubKeg = $this->refModel->getSubKegiatanId($idRefSubKeg);

            if ($getRefSubKeg->is_umum == 1) {
                $data['refUrusan'] = $getBidang->kode_bidang_urusan . \substr($getBidang->nama_bidang_urusan, 4);
                $data['refBidang'] = $getBidang->kode_bidang_urusan . \substr($getBidang->nama_bidang_urusan, 4);
                $data['refProgram'] = $getBidang->kode_bidang_urusan . \substr($getRefSubKeg->nama_program, 4);
                $data['refKegiatan'] = $getBidang->kode_bidang_urusan . \substr($getRefSubKeg->nama_kegiatan, 4);
                $data['refSubKeg'] = $getBidang->kode_bidang_urusan . \substr($getRefSubKeg->nama_sub_kegiatan, 4);
            } else {
                $data['refUrusan'] = $getBidang->nama_urusan;
                $data['refBidang'] = $getBidang->nama_bidang_urusan;
                $data['refProgram'] = $getRefSubKeg->nama_program;
                $data['refKegiatan'] = $getRefSubKeg->nama_kegiatan;
                $data['refSubKeg'] = $getRefSubKeg->nama_sub_kegiatan;
            }

            $rinciParams = array(
                'tahun' => $thn,
                'id_skpd' => $idSkpd,
                'id_usulan' => $idUsulan,
                'id_sub_unit' => $idSubUnit,
                'id_usulan_sub_kegiatan' => $idSubKeg,
            );
            $data['pagu'] = $this->rinciModel->getPaguRincian($rinciParams);
            $data['akun'] = $this->cetakModel->detilRincianRubah($thn, $idUsulan, $idSkpd, $idSubUnit, $idSubKeg, $idRefSubKeg);
            return \view('cetak/usulan_subkeg_rinci_rubah', $data);
        } else {
            throw new PageNotFoundException("Halaman tidak ditemukan");
        }
    }

    // public function cobaRka()
    // {
    //     // $this->rinciModel->cobaRka2();
    //     $params = array(
    //         'tbl_usulan_rincian_belanja.tahun' => 2021,
    //         'id_skpd' => 1,
    //         'id_usulan' => 3,
    //         'id_usulan_sub_kegiatan' => 12,
    //         'id_sub_unit' => 1,
    //     );
    //     $data['rka'] = $this->rinciModel->getAkun2($params);
    //     \var_dump($data['rka']);
    //     // echo \view('cetak/detil_rincian', $data);
    // }
}
