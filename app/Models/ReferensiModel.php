<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ReferensiModel extends Model
{

    protected $db;
    protected $urusan;
    protected $bidang;
    protected $program;
    protected $keg;
    protected $subkeg;
    protected $satuan;
    protected $jenisbl;
    protected $akun;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
        $this->urusan = $this->db->table('tbl_ref_urusan');
        $this->bidang = $this->db->table('tbl_ref_bidang_urusan');
        $this->program = $this->db->table('tbl_ref_program');
        $this->keg = $this->db->table('tbl_ref_kegiatan');
        $this->subkeg = $this->db->table('tbl_ref_sub_kegiatan');
        $this->satuan = $this->db->table('tbl_satuan');
        $this->jenisbl = $this->db->table('tbl_ref_jenis_belanja');
        $this->akun = $this->db->table('tbl_ref_akun');
    }

    public function getUrusan()
    {
        return $this->urusan->get()->getResult();
    }

    public function getBidang()
    {
        $this->bidang->select(
            [
                'tbl_ref_urusan.nama_urusan',
                'tbl_ref_bidang_urusan.id_bidang_urusan',
                'tbl_ref_bidang_urusan.kode_bidang_urusan',
                'tbl_ref_bidang_urusan.nama_bidang_urusan'
            ]
        )
            ->join('tbl_ref_urusan', 'tbl_ref_urusan.id_urusan = tbl_ref_bidang_urusan.id_urusan');
        return $this->bidang->get()->getResult();
    }

    public function getBidangSkpd($id)
    {
        $this->bidang->select(
            [
                'id_bidang_urusan',
                'kode_bidang_urusan',
                'nama_bidang_urusan'
            ]
        )
            ->where('id_bidang_urusan', $id);
        return $this->bidang->get()->getRow();
    }

    public function getProgram()
    {
        $this->program->select(
            [
                'tbl_ref_urusan.nama_urusan',
                'tbl_ref_bidang_urusan.nama_bidang_urusan',
                'tbl_ref_program.nama_program',
            ]
        )
            ->join('tbl_ref_urusan', 'tbl_ref_urusan.id_urusan = tbl_ref_program.id_urusan')
            ->join('tbl_ref_bidang_urusan', 'tbl_ref_bidang_urusan.id_bidang_urusan = tbl_ref_program.id_bidang_urusan');
        return $this->program->get()->getResult();
    }

    public function getKegiatan()
    {
        $this->keg->select(
            [
                'tbl_ref_urusan.nama_urusan',
                'tbl_ref_bidang_urusan.nama_bidang_urusan',
                'tbl_ref_program.nama_program',
                'tbl_ref_kegiatan.nama_kegiatan',
            ]
        )
            ->join('tbl_ref_urusan', 'tbl_ref_urusan.id_urusan = tbl_ref_kegiatan.id_urusan')
            ->join('tbl_ref_bidang_urusan', 'tbl_ref_bidang_urusan.id_bidang_urusan = tbl_ref_kegiatan.id_bidang_urusan')
            ->join('tbl_ref_program', 'tbl_ref_program.id_program = tbl_ref_kegiatan.id_program');
        return $this->keg->get()->getResult();
    }

    public function getSubKegiatanId($id)
    {
        $this->subkeg->select(
            [
                'tbl_ref_urusan.nama_urusan',
                'tbl_ref_bidang_urusan.nama_bidang_urusan',
                'tbl_ref_program.nama_program',
                'tbl_ref_kegiatan.nama_kegiatan',
                'tbl_ref_sub_kegiatan.nama_sub_kegiatan',
                'tbl_ref_sub_kegiatan.is_umum',
            ]
        )
            ->join('tbl_ref_urusan', 'tbl_ref_urusan.id_urusan = tbl_ref_sub_kegiatan.id_urusan')
            ->join('tbl_ref_bidang_urusan', 'tbl_ref_bidang_urusan.id_bidang_urusan = tbl_ref_sub_kegiatan.id_bidang_urusan')
            ->join('tbl_ref_program', 'tbl_ref_program.id_program = tbl_ref_sub_kegiatan.id_program')
            ->join('tbl_ref_kegiatan', 'tbl_ref_kegiatan.id_kegiatan = tbl_ref_sub_kegiatan.id_kegiatan')
            ->where('tbl_ref_sub_kegiatan.id_sub_kegiatan', $id);
        return $this->subkeg->get()->getRow();
    }

    public function getSubKegiatan()
    {
        $this->subkeg->select(
            [
                'tbl_ref_urusan.nama_urusan',
                'tbl_ref_bidang_urusan.nama_bidang_urusan',
                'tbl_ref_program.nama_program',
                'tbl_ref_kegiatan.nama_kegiatan',
                'tbl_ref_sub_kegiatan.nama_sub_kegiatan',
            ]
        )
            ->join('tbl_ref_urusan', 'tbl_ref_urusan.id_urusan = tbl_ref_sub_kegiatan.id_urusan')
            ->join('tbl_ref_bidang_urusan', 'tbl_ref_bidang_urusan.id_bidang_urusan = tbl_ref_sub_kegiatan.id_bidang_urusan')
            ->join('tbl_ref_program', 'tbl_ref_program.id_program = tbl_ref_sub_kegiatan.id_program')
            ->join('tbl_ref_kegiatan', 'tbl_ref_kegiatan.id_kegiatan = tbl_ref_sub_kegiatan.id_program');
        return $this->subkeg->get()->getResult();
    }

    public function getUsulanSubKegList($idBidang1 = \null, $idBidang2 = \null, $idBidang3 = \null, $idBidang4 = \null, $idBidang5 = \null)
    {
        if ($idBidang2 != \null) {
            $in = $idBidang1 . ',' . $idBidang2;
            // } elseif ($idBidang3 != \null) {
            //     $in = [$idBidang1, $idBidang2, $idBidang3];
            // } else {
        } else {
            $in = $idBidang1;
        }

        $query = $this->db->query("SELECT
        tbl_ref_urusan.nama_urusan,
            tbl_ref_bidang_urusan.nama_bidang_urusan,
            tbl_ref_program.nama_program,
            tbl_ref_kegiatan.nama_kegiatan,
            tbl_ref_sub_kegiatan.id_sub_kegiatan, 
            tbl_ref_sub_kegiatan.nama_sub_kegiatan 
        FROM
            tbl_ref_sub_kegiatan
            JOIN tbl_ref_urusan ON tbl_ref_urusan.id_urusan = tbl_ref_sub_kegiatan.id_urusan
            LEFT JOIN tbl_ref_bidang_urusan ON tbl_ref_bidang_urusan.id_bidang_urusan = tbl_ref_sub_kegiatan.id_bidang_urusan
            LEFT JOIN tbl_ref_program ON tbl_ref_program.id_program = tbl_ref_sub_kegiatan.id_program
            LEFT JOIN tbl_ref_kegiatan ON tbl_ref_kegiatan.id_kegiatan = tbl_ref_sub_kegiatan.id_kegiatan 
        WHERE tbl_ref_sub_kegiatan.is_umum = 1

        UNION
        
        SELECT
            tbl_ref_urusan.nama_urusan,
            tbl_ref_bidang_urusan.nama_bidang_urusan,
            tbl_ref_program.nama_program,
            tbl_ref_kegiatan.nama_kegiatan,
            tbl_ref_sub_kegiatan.id_sub_kegiatan, 
            tbl_ref_sub_kegiatan.nama_sub_kegiatan 
        FROM
            tbl_ref_sub_kegiatan
            JOIN tbl_ref_urusan ON tbl_ref_urusan.id_urusan = tbl_ref_sub_kegiatan.id_urusan
            LEFT JOIN tbl_ref_bidang_urusan ON tbl_ref_bidang_urusan.id_bidang_urusan = tbl_ref_sub_kegiatan.id_bidang_urusan
            LEFT JOIN tbl_ref_program ON tbl_ref_program.id_program = tbl_ref_sub_kegiatan.id_program
            LEFT JOIN tbl_ref_kegiatan ON tbl_ref_kegiatan.id_kegiatan = tbl_ref_sub_kegiatan.id_kegiatan 
        WHERE
        tbl_ref_sub_kegiatan.id_bidang_urusan IN ($in)
        ");
        return $query->getResult();
    }

    // Rekening Akun
    public function getAkunId($id)
    {
        return $this->akun->where('id_ref_akun', $id)->get()->getRow();
    }

    public function getAkun()
    {
        return $this->akun->get()->getResult();
    }

    public function getRefAkunBl($isRefAkun)
    {
        if ($isRefAkun != \false) {
            $this->akun->where($isRefAkun, 1);
            $this->akun->where("CHAR_LENGTH(`kode_akun`)", 17);
            return $this->akun->get()->getResult();
        } else {
            return \null;
        }
    }

    public function getRefAkunBlKode($kodeAkun)
    {
        if ($kodeAkun != \false) {
            $this->akun->where('kode_akun', $kodeAkun);
            $this->akun->where("CHAR_LENGTH(`kode_akun`)", 17);
            return $this->akun->get()->getRow();
        } else {
            return \null;
        }
    }

    //satuan
    public function getSatuanId($id)
    {
        return $this->satuan->where('id_satuan', $id)->get()->getRow();
    }

    public function getSatuan()
    {
        return $this->satuan->get()->getResult();
    }

    public function addSatuan($params)
    {
        return $this->satuan->insert($params);
    }

    public function updateSatuan($id, $params)
    {
        $this->satuan->where('id_satuan', $id);
        return $this->satuan->update($params);
    }

    public function deleteSatuan($id)
    {
        $this->satuan->where('id_satuan', $id);
        return $this->satuan->delete();
    }

    // Jenis Belanja
    public function getJenisBlId($id)
    {
        return $this->jenisbl->where('id_ref_jenis_belanja', $id)->get()->getRow();
    }

    public function getJenisBl()
    {
        return $this->jenisbl->get()->getResult();
    }

    public function addJenisBl($params)
    {
        return $this->jenisbl->insert($params);
    }

    public function updateJenisBl($id, $params)
    {
        $this->jenisbl->where('id_ref_jenis_belanja', $id);
        return $this->jenisbl->update($params);
    }

    public function deleteJenisBl($id)
    {
        $this->jenisbl->where('id_ref_jenis_belanja', $id);
        return $this->jenisbl->delete();
    }
}
