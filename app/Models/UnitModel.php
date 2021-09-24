<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UnitModel extends Model
{

    protected $db;
    protected $skpd;
    protected $kadis;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
        $this->skpd = $this->db->table('tbl_skpd');
        $this->kadis = $this->db->table('tbl_kepala_skpd');
    }

    public function getUnitId($id)
    {
        return $this->skpd->where('id_skpd', $id)->get()->getRow();
    }

    public function getUnit()
    {
        $this->skpd->orderBy('kode_skpd');
        return $this->skpd->get()->getResult();
    }

    public function addUnit($params)
    {
        return $this->skpd->insert($params);
    }

    public function updateUnit($id, $params)
    {
        $this->skpd->where('id_skpd', $id);
        return $this->skpd->update($params);
    }

    public function deleteUnit($id)
    {
        $this->skpd->where('id_skpd', $id);
        return $this->skpd->delete();
    }

    public function getSubUnit($id)
    {
        return $this->skpd->where('id_unit', $id)->get()->getResult();
    }

    public function getProfilId($idSkpd)
    {
        $this->skpd->select(
            [
                'tbl_skpd.id_skpd',
                'tbl_skpd.kode_skpd',
                'tbl_skpd.nama_skpd',
                'tbl_skpd.alamat_skpd',
                'tbl_skpd.kota_skpd',
                'tbl_skpd.id_bidang_urusan_1',
                'tbl_kepala_skpd.nama_kepala',
                'tbl_kepala_skpd.nip_kepala',
                'tbl_kepala_skpd.jabatan_kepala',
            ]
        )
            ->where('tbl_skpd.id_skpd', $idSkpd)
            ->join('tbl_kepala_skpd', 'tbl_kepala_skpd.id_skpd = tbl_skpd.id_skpd', 'LEFT');
        return $this->skpd->get()->getRow();
    }

    public function getKadisId($id)
    {
        return $this->kadis->where('id_kepala_skpd', $id)->get()->getRow();
    }

    public function getKadisSkpdId($id)
    {
        return $this->kadis->where('id_skpd', $id)->get()->getRow();
    }

    public function getKadis()
    {
        $this->kadis->select(
            [
                'tbl_skpd.skpd',
                'tbl_kepala_skpd.id_kepala_skpd',
                'tbl_kepala_skpd.nama_kepala',
                'tbl_kepala_skpd.nip'
            ]
        )
            ->join('tbl_skpd', 'tbl_skpd.id_skpd = tbl_kepala_skpd.id_skpd', 'left');
        return $this->kadis->get()->getResult();
    }

    public function addKadis($params)
    {
        return $this->kadis->insert($params);
    }

    public function updateKadis($id, $params)
    {
        $this->kadis->where('id_kepala_skpd', $id);
        return $this->kadis->update($params);
    }

    public function deleteKadis($id)
    {
        $this->kadis->where('id_kepala_skpd', $id);
        return $this->kadis->delete();
    }
}
