<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\BaseModel;
use CodeIgniter\I18n\Time;

class Login extends BaseController
{
    //konstraktor
    public function __construct()
    {
        $this->UsersModel = new UsersModel();
        $this->BaseModel = new BaseModel();
        // $tahun=$this->myTime->getMonth();
        // $triwulan=$this->triwulan;
    }
    public function index()
    {
        $tahun = $this->myTime->getMonth();
        $triwulan = $this->triwulan;
        dd($tahun);
        $data = [
            'tahun'     => $tahun,
            'triwulan'  => $triwulan
        ];
        return redirect()->to(base_url('login'))->withInput();
    }
    public function login()
    {
        $tahun = $this->myTime->getYear();
        $triwulan = $this->triwulan;
        // d($tahun);
        $data = [
            'tahun'     => $tahun,
            'triwulan'  => $triwulan
        ];
        if (session('id_pengguna')) {
            return redirect()->to(base_url('/beranda'));
        }
        return view('pages/login', $data);
    }
    public function process()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $tahun = $this->request->getPost('tahun');
        $triwulan = $this->triwulan;
        d($tahun);
        $query = $this->UsersModel->getEmail($username);
        $user = $query->getRow();
        d($username, $password, $query, $user);

        $input = $this->validate([
            'username' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Username harus diisi!'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[8]',
                'errors' => [
                    'required'      => 'Password harus diisi!',
                    'min_length'    => 'Password terlalu pendek!',
                    'max_length'    => 'Password terlalu panjang!'
                ]
            ]

        ]);

        if (!$input) {
            return  redirect()->to(base_url('/'))->withInput();
        }

        if (!$user) {
            return redirect()->to(base_url('/'));
        }
        // d(sha1($password)==$user->password);
        // if(password_verify($password,$user->password)){
        // $params =['id_pengguna'=>$user->id_pengguna];
        // session()->set($params);
        // return redirect()->to(base_url('/beranda'));
        d($password, sha1($password));
        if (sha1($password) == $user->password) {
            $params = [
                'id_pengguna'   => $user->id_pengguna,
                'ket_pengguna'  => $user->keterangan,
                'tahun'         => $tahun,
                'sistem'        => $triwulan,
                'detail'        => 'KRO',
                'data'          => [],
                'kode'        => '0'
            ];
            $prm = array('id_pengguna'   => $user->id_pengguna);
            $vl = array('online'   => 1);
            $this->BaseModel->updateAll('pengguna', $prm, $vl);
            session()->set($params);
            return redirect()->to(base_url('/beranda'))->withInput();
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function logout()
    {
        $prm = array('id_pengguna'   => session()->get('id_pengguna'));
        $vl = array('online'   => 0);
        $this->BaseModel->updateAll('pengguna', $prm, $vl);
        session()->remove('id_pengguna');
        session()->remove('ket_pengguna');
        session()->remove('tahun');
        session()->remove('sistem');
        session()->remove('detail');
        return redirect()->to(base_url('/'));
    }
}
