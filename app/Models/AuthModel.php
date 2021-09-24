<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $db;
    protected $user;
    protected $log;
    protected $tahun;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
        $this->user = $this->db->table('tbl_user');
        $this->log = $this->db->table('tbl_user_log');
        $this->tahun = $this->db->table('tbl_tahun');
    }

    public function getTahun()
    {
        return $this->tahun->where('sts_tahun', '1')->get()->getResult();
    }

    public function getUsername($user)
    {
        return $this->user->where('nama_user', $user)->get()->getRow();
    }

    public function addLog($params)
    {
        return $this->log->insert($params);
    }
}
