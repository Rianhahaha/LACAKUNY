<?php

namespace App\Controllers;
use App\Models\BaseModel;
class Pages extends BaseController
{
    public function __construct()
    {
        $this->BaseModel= new BaseModel();
        $this->session=session();
        $this->id_pengguna=$this->session->get('id_pengguna');
        $this->ket_pengguna=$this->session->get('ket_pengguna');
    }
    public function index()
    {
        $data = [
            'title' => 'Aplikasi Mirror Spasikita',
            'ket_pengguna'  => $this->ket_pengguna
        ];
        return view('pages/beranda', $data);
    }
    public function simproka()
    {
        $data = [
            'title' => 'Aplikasi Mirror Spasikita',
            'ket_pengguna'  => $this->ket_pengguna
        ];
        return view('pages/simproka', $data);
    }
    public function pengguna()
    {
        $params=array('online'   =>1);
        $query=$this->BaseModel->getAll('pengguna', $params);
        $d=[];
        foreach ($query->getResultArray() as $row) {
            $d[]= $row['keterangan'];
        }
        $data = [
            'pengguna'=>$d,
            'title' => 'Aplikasi Mirror Spasikita',
            'ket_pengguna'  => $this->ket_pengguna
        ];
        d($data);
        return view('pages/pengguna', $data);
    }
    public function kinerja()
    {
        $data = [
            'title' => 'Aplikasi Mirror Spasikita',
            'ket_pengguna'  => $this->ket_pengguna
        ];
        return view('pages/kinerja', $data);
    }
    public function login()
    {
        $data = [
            'title' => 'Aplikasi Mirror Spasikita',
            'ket_pengguna'  => $this->ket_pengguna
        ];
        return view('pages/login', $data);
    }
    public function pohonKinerja()
    {
        $data = [
            'title' => 'Aplikasi Mirror Spasikita',
            'ket_pengguna'  => $this->ket_pengguna
        ];
        return view('pages/pohonKinerja', $data);
    }
}
