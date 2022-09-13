<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\BaseModel;

class SimprokaModel extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->BaseModel = new BaseModel();

        // $this->db = \Config\Database::connect('DBdev', true);
    }

    public function dataEdit($params, $data)
    {
        $params['kode'] = dot_array_search('0.kode', $data);

        if (dot_array_search('0.detail', $data) == 'KRO') {
            $query = $this->BaseModel->getAll('simproka', $params);
        } else if (dot_array_search('0.detail', $data) == 'RO') {
            $query = $this->BaseModel->getAll('ro', $params);
        } else if (dot_array_search('0.detail', $data) == 'KOMPONEN') {
            $query = $this->BaseModel->getAll('komponen', $params);
        } else if (dot_array_search('0.detail', $data) == 'SUBKOMPONEN') {
            $query = $this->BaseModel->getAll('subkomponen', $params);
        }
        $dataEdit['data'] = $query->getResultArray();
        return $dataEdit;
    }

    public function dataDelete($params, $data)
    {
        $paramsKRO          = $params;
        $paramsRO           = $params;
        $paramsKomponen     = $params;
        $paramsSubkomponen  = $params;

        //delete data KRO beserta turunannya
        if (dot_array_search('0.detail', $data) == 'KRO') {
            $paramsKRO['kode'] = dot_array_search('0.kode', $data);
            $paramsRO['kro'] = dot_array_search('0.kode', $data);
            $queryRO = $this->BaseModel->getAll('ro', $paramsRO);
            $dataRO = $queryRO->getResultArray();

            foreach ($dataRO as $dr => $value) {
                $paramsKomponen = $params;
                $paramsKomponen['ro'] = $value['kode'];
                $queryKomponen = $this->BaseModel->getAll('komponen', $paramsKomponen);
                $dataKomponen = $queryKomponen->getResultArray();

                foreach ($dataKomponen as $DK => $valueDK) {
                    $paramsSubkomponen = $params;
                    $paramsSubkomponen['komponen'] = $valueDK['kode'];
                    $this->BaseModel->deleteAll('subkomponen', $paramsSubkomponen);
                    $paramsSubkomponen = $params;
                    $paramsSubkomponen['detail'] = 'SUBKOMPONEN';
                    $paramsSubkomponen['indikator'] = $valueDK['kode'];
                    $this->BaseModel->deleteAll('sistem_simproka', $paramsSubkomponen);
                }
                $this->BaseModel->deleteAll('komponen', $paramsKomponen);
                $paramsKomponen = $params;
                $paramsKomponen['detail'] = 'KOMPONEN';
                $paramsKomponen['indikator'] = $value['kode'];
                $this->BaseModel->deleteAll('sistem_simproka', $paramsKomponen);
            }
            $this->BaseModel->deleteAll('ro', $paramsRO);
            $paramsRO = $params;
            $paramsRO['detail'] = 'RO';
            $paramsRO['indikator'] = dot_array_search('0.kode', $data);
            $this->BaseModel->deleteAll('sistem_simproka', $paramsRO);
            $this->BaseModel->deleteAll('simproka', $paramsKRO);
            $paramsKRO = $params;
            $paramsKRO['detail'] = 'KRO';
            $paramsKRO['indikator'] = dot_array_search('0.kode', $data);
            $this->BaseModel->deleteAll('sistem_simproka', $paramsKRO);

            //delete data RO beserta turunannya
        } else if (dot_array_search('0.detail', $data) == 'RO') {
            $paramsRO['kode'] = dot_array_search('0.kode', $data);
            $paramsKomponen['ro'] = dot_array_search('0.kode', $data);
            $queryKomponen = $this->BaseModel->getAll('komponen', $paramsKomponen);
            $dataKomponen = $queryKomponen->getResultArray();

            foreach ($dataKomponen as $DK => $valueDK) {
                $paramsSubkomponen = $params;
                $paramsSubkomponen['komponen'] = $valueDK['kode'];
                $this->BaseModel->deleteAll('subkomponen', $paramsSubkomponen);
                $paramsSubkomponen = $params;
                $paramsSubkomponen['detail'] = 'SUBKOMPONEN';
                $paramsSubkomponen['indikator'] = $valueDK['kode'];
                $this->BaseModel->deleteAll('sistem_simproka', $paramsSubkomponen);
            }
            $this->BaseModel->deleteAll('komponen', $paramsKomponen);
            $paramsKomponen = $params;
            $paramsKomponen['detail'] = 'KOMPONEN';
            $paramsKomponen['indikator'] = dot_array_search('0.kode', $data);
            $this->BaseModel->deleteAll('sistem_simproka', $paramsKomponen);
            $this->BaseModel->deleteAll('ro', $paramsRO);
            $paramsRO = $params;
            $paramsRO['detail'] = 'RO';
            $paramsRO['indikator'] = dot_array_search('0.kode', $data);
            $this->BaseModel->deleteAll('sistem_simproka', $paramsRO);

            //delete data KOMPONEN beserta turunannya
        } else if (dot_array_search('0.detail', $data) == 'KOMPONEN') {
            $paramsKomponen['kode'] = dot_array_search('0.kode', $data);
            $paramsSubkomponen['komponen'] = dot_array_search('0.kode', $data);

            $this->BaseModel->deleteAll('subkomponen', $paramsSubkomponen);
            $this->BaseModel->deleteAll('komponen', $paramsKomponen);
            $paramsSubkomponen = $params;
            $paramsSubkomponen['detail'] = 'SUBKOMPONEN';
            $paramsSubkomponen['indikator'] = dot_array_search('0.kode', $data);
            $this->BaseModel->deleteAll('sistem_simproka', $paramsSubkomponen);
            $paramsKomponen = $params;
            $paramsKomponen['detail'] = 'KOMPONEN';
            $paramsKomponen['indikator'] = dot_array_search('0.kode', $data);
            $this->BaseModel->deleteAll('sistem_simproka', $paramsKomponen);

            //delete data SUBKOMPONEN beserta turunannya
        } else {
            $paramsSubkomponen['kode'] = dot_array_search('0.kode', $data);
            $this->BaseModel->deleteAll('subkomponen', $paramsSubkomponen);
            $paramsSubkomponen = $params;
            $paramsSubkomponen['detail'] = 'SUBKOMPONEN';
            $paramsSubkomponen['indikator'] = dot_array_search('0.kode', $data);
            $this->BaseModel->deleteAll('sistem_simproka', $paramsSubkomponen);
        }

        return $data;
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
}
