<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Satker extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nomenklatur'   => 'Unit Eselon 1',
                'uraian'        => 'DITJEN PENDIDIKAN TINGGI, RISET, DAN TEKNOLOGI'
            ],
            [
                'nomenklatur'   => 'Satker',
                'uraian'        => 'UNIVERSITAS NEGERI YOGYAKARTA (677509)'
            ],
            [
                'nomenklatur'   => 'Kepala Satker',
                'uraian'        => 'Prof. Dr. Sumaryanto, M.Kes'
            ],
            [
                'nomenklatur'   => 'NIK Kepala Satker',
                'uraian'        => '3404100103650002'
            ],
            [
                'nomenklatur'   => 'NIP Kepala Satker',
                'uraian'        => '196503011990011001'
            ],
            [
                'nomenklatur'   => 'Alamat Kantor',
                'uraian'        => 'Jalan Colombo Nomor 1, Karangmalang, Yogyakarta'
            ],
            [
                'nomenklatur'   => 'Jabatan',
                'uraian'        => 'Rektor Universitas Negeri Yogyakarta'
            ]
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('satker')->insertBatch($data);
    }
}
