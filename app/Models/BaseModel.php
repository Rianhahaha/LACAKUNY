<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
        // $this->db = \Config\Database::connect('DBdev', true);
    }

    //fungsi menambah data ke database
    public function insertAll($table, $data)
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        return $builder->insert($data);
    }

    //fungsi menambah data ke database
    public function insertUpdateAll($table, $data)
    {
        $builder = $this->db->table($table);
        $builder->set($data);
        // $builder->select('*');
        return $builder->insert($data);
    }

    //fungsi update data ke database
    public function updateAll($table, $params, $data)
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        return $builder->where($params)->update($data);
    }

    //fungsi menghapus data dari database
    public function deleteAll($table, $params)
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        return $builder->where($params)->delete();
    }

    //fungsi mengambil data dari database
    public function getAll($table, $params)
    {
        $builder = $this->db->table($table);
        $builder->select('*')->where($params);
        return $builder->get();
    }
    //fungsi mengambil data dari database
    public function getAllSort($table, $params, $sort)
    {
        $builder = $this->db->table($table);
        $builder->select('*')->where($params);
        $builder->orderBy($sort, 'ASC');
        return $builder->get();
    }

    public function countAll($table, $params)
    {
        $builder = $this->db->table($table);
        $builder->select('*')->where($params);
        return $builder->countAllResults();
    }
}
