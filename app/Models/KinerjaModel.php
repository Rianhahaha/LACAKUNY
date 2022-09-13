<?php

namespace App\Models;

use CodeIgniter\Model;

class KinerjaModel extends Model
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

    public function countAll($table, $params)
    {
        $builder = $this->db->table($table);
        $builder->select('*')->where($params);
        return $builder->countAllResults();
    }

    public function getSP($table, $params)
    {
        $builder = $this->db->table($table);
        $builder->select('*')->where($params);
        $builder->orderBy('id_sistem', 'ASC');
        return $builder->get();
    }
    //fungsi join table untuk tampilan kinerja dari database
    public function getIKK($params)
    {
        $builder = $this->db->table('pengukuran');
        $builder->select('*');
        $builder->where('sistem_pengukuran', $params['sistem_pengukuran']);
        $builder->where('tahun_pengukuran', $params['tahun_pengukuran']);
        $builder->where('pengukuran.iku', $params['iku']);
        $builder->join('iku', 'pengukuran.sistem_pengukuran=iku.sistem AND pengukuran.tahun_pengukuran=iku.tahun AND pengukuran.iku=iku.iku', 'inner');
        $builder->where('iku.sistem', $params['sistem']);
        $builder->where('iku.tahun', $params['tahun']);
        $builder->where('iku.iku', $params['iku']);
        $builder->join('sasaran_kinerja as sk', 'sk.id_sk=iku.id_sk', 'inner');
        $builder->where('sk.sistem', $params['sistem']);
        $builder->where('sk.tahun', $params['tahun']);
        $builder->join('progres', 'progres.iku=pengukuran.iku AND progres.id_pengguna=pengukuran.id_pengguna', 'inner');
        $builder->where('progres.sistem', $params['sistem']);
        $builder->where('progres.tahun', $params['tahun']);
        $builder->where('progres.iku', $params['iku']);
        $builder->join('kendala', 'kendala.iku=pengukuran.iku AND kendala.id_pengguna=pengukuran.id_pengguna', 'inner');
        $builder->where('kendala.sistem', $params['sistem']);
        $builder->where('kendala.tahun', $params['tahun']);
        $builder->where('kendala.iku', $params['iku']);
        $builder->join('strategi', 'strategi.iku=pengukuran.iku AND strategi.id_pengguna=pengukuran.id_pengguna', 'inner');
        $builder->where('strategi.sistem', $params['sistem']);
        $builder->where('strategi.tahun', $params['tahun']);
        $builder->where('strategi.iku', $params['iku']);
        $builder->orderBy('id_ik', 'ASC');
        return $builder->get();
    }
    public function getAllIKK($params)
    {
        $builder = $this->db->table('pengukuran');
        $builder->select('*');
        $builder->where('sistem_pengukuran', $params['sistem_pengukuran']);
        $builder->where('tahun_pengukuran', $params['tahun_pengukuran']);
        $builder->join('iku', 'pengukuran.sistem_pengukuran=iku.sistem AND pengukuran.tahun_pengukuran=iku.tahun AND pengukuran.iku=iku.iku', 'inner');
        $builder->where('iku.sistem', $params['sistem']);
        $builder->where('iku.tahun', $params['tahun']);
        $builder->join('sasaran_kinerja as sk', 'sk.id_sk=iku.id_sk', 'inner');
        $builder->where('sk.sistem', $params['sistem']);
        $builder->where('sk.tahun', $params['tahun']);
        $builder->join('progres', 'progres.iku=pengukuran.iku AND progres.id_pengguna=pengukuran.id_pengguna', 'inner');
        $builder->where('progres.sistem', $params['sistem']);
        $builder->where('progres.tahun', $params['tahun']);
        $builder->join('kendala', 'kendala.iku=pengukuran.iku AND kendala.id_pengguna=pengukuran.id_pengguna', 'inner');
        $builder->where('kendala.sistem', $params['sistem']);
        $builder->where('kendala.tahun', $params['tahun']);
        $builder->join('strategi', 'strategi.iku=pengukuran.iku AND strategi.id_pengguna=pengukuran.id_pengguna', 'inner');
        $builder->where('strategi.sistem', $params['sistem']);
        $builder->where('strategi.tahun', $params['tahun']);
        $builder->orderBy('id_ik', 'ASC');
        return $builder->get();
    }
}
