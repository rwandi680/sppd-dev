<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    // Role
    public function getRoleId($id)
    {
        return $this->role->where('id_role', $id)->get()->getRow();
    }

    public function getRole()
    {
        return $this->role->get()->getResult();
    }

    public function addRole($params)
    {
        return $this->role->insert($params);
    }

    public function updateRole($id, $params)
    {
        $this->role->where('id_role', $id);
        return $this->role->update($params);
    }

    public function deleteRole($id)
    {
        $this->role->where('id_role', $id);
        return $this->role->delete();
    }

    // User
    public function getUserId($id)
    {
        return $this->user->where('id_user', $id)->get()->getRow();
    }

    public function getUser()
    {
        $this->user->select(
            [
                'tbl_skpd.nama_skpd',
                'tbl_role.role',
                'tbl_user.id_user',
                'tbl_user.xusername',
                'tbl_user.nama_lengkap',
            ]
        )
            ->join('tbl_skpd', 'tbl_skpd.id_skpd = tbl_user.id_skpd', 'left')
            ->join('tbl_role', 'tbl_role.id_role = tbl_user.id_role', 'left');
        return $this->user->get()->getResult();
    }

    public function addUser($params)
    {
        return $this->user->insert($params);
    }

    public function updateUser($id, $params)
    {
        $this->user->where('id_user', $id);
        return $this->user->update($params);
    }

    public function deleteUser($id)
    {
        $this->user->where('id_user', $id);
        return $this->user->delete();
    }
}
