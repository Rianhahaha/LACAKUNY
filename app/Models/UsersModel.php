<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    public function __construct()
    {
        $db = db_connect();
        $this->builder = $db->table('pengguna');
        // $this->builder->orderBy('id_tblpengguna', 'ASC');
        $this->builder->select('*');
    }
    public function getPIC()
    {
        $this->builder->where(['status' => 'PIC']);
        $query = $this->builder->get();
        foreach ($query->getResultArray() as $row => $value) {
            $result[] = [
                'tampilan'    => $value['tampilan'],
                'id_pengguna'   => $value['id_pengguna']
            ];
        }
        return $result;
    }
    public function getLastID()
    {
        $this->builder->orderBy('id_pengguna', 'ASC');
        $query = $this->builder->get();
        return $query->getLastRow()->id_pengguna;
    }
    public function getBuilder()
    {
        return $this->builder->get();
    }
    public function getUsers()
    {
        $this->session = session();
        $id = $this->session->get('id_pengguna');
        return $this->builder->getWhere(['id_pengguna' => $id]);
    }
    public function checkUsers($email, $pw)
    {
        $builder->having('email', $email);
        $builder->having('password', $pw);
    }

    public function getEmail($email)
    {
        return $this->builder->getWhere(['email' => $email]);
    }
}
