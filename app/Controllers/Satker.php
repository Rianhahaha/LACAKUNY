<?php

namespace App\Controllers;

use App\Models\SatkerModel;

class Satker extends BaseController
{
    public function __construct()
    {
        $this->SatkerModel = new SatkerModel();
        $this->session = session();
        $this->id_pengguna = $this->session->get('id_pengguna');
        $this->ket_pengguna = $this->session->get('ket_pengguna');
    }

    public function index()
    {
        $query = $this->SatkerModel->getBuilder();
        $data = [
            'satker'        => $query->getResultArray(),
            'id_pengguna'   => $this->id_pengguna,
            'ket_pengguna'  => $this->ket_pengguna
        ];
        return view('pages/info_satker', $data);
    }

    public function edit()
    {
        $data[] = $this->request->getPost();
        d($data, $this->request);
        $i = 1;
        foreach ($data as $dt) {
            foreach ($dt as $d => $value) {
                $this->SatkerModel->edit($i, $value);
                $i++;
                d($i, $d, $value);
            }
        }
        d($i, $data);
        return redirect()->to(base_url('/satker'))->withInput();
    }
}
