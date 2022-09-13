<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Pengguna extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_pengguna'   => 1230,
                'email'         => 'admin@gmail.com',
                'password'      => 'f865b53623b121fd34ee5426c792e5c33af8c227',
                'keterangan'    => 'ADMIN',
                'status'        => 'ADMIN',
                'tampilan'      => 'null'
            ],
            [
                'id_pengguna'   => 1234,
                'email'         => 'lpmpp@gmail.com',
                'password'      => 'e2559cf97b48ef4e84564817ca6dd3876e926eed',
                'keterangan'    => 'LPMPP',
                'status'        => 'PIC',
                'tampilan'      => 'LPMPP'
            ],
            [
                'id_pengguna'   => 1236,
                'email'         => 'bid1@gmail.com',
                'password'      => '6df5d428af931fa91d741bbda44b0a134e6514d4',
                'keterangan'    => 'BID.1',
                'status'        => 'PIC',
                'tampilan'      => 'BID AKADEMIK'
            ],
            [
                'id_pengguna'   => 1237,
                'email'         => 'lppm@gmail.com',
                'password'      => '1bde1e739675b9e7a84d0b7b45362acafefb1cfa',
                'keterangan'    => 'LPPM',
                'status'        => 'PIC',
                'tampilan'      => 'LPPM'
            ],
            [
                'id_pengguna'   => 1238,
                'email'         => 'spi@gmail.com',
                'password'      => 'e50423094537e26b9d2237647186464b45a51cd7',
                'keterangan'    => 'SPI',
                'status'        => 'PIC',
                'tampilan'      => 'null'
            ],
            [
                'id_pengguna'   => 1239,
                'email'         => 'bid2@gmail.com',
                'password'      => '6df5d428af931fa91d741bbda44b0a134e6514d4',
                'keterangan'    => 'BID.2',
                'status'        => 'PIC',
                'tampilan'      => 'KEUANGAN'
            ],
            [
                'id_pengguna'   => 1240,
                'email'         => 'bid4@gmail.com',
                'password'      => '6df5d428af931fa91d741bbda44b0a134e6514d4',
                'keterangan'    => 'BID.4',
                'status'        => 'PIC',
                'tampilan'      => 'BID PERENCANAAN DAN KERJASAMA'
            ],
            [
                'id_pengguna'   => 1241,
                'email'         => 'koor.lpmpp@gmail.com',
                'password'      => '98fd2065863f481d822b4d8b4749ce5108eef91b',
                'keterangan'    => 'KOOR LPMPP',
                'status'        => 'KOOR',
                'tampilan'      => 'null'
            ],
            [
                'id_pengguna'   => 1243,
                'email'         => 'koor.bid1@gmail.com',
                'password'      => '53e0ad80e8756e4c8b765c6688887f74e68b150d',
                'keterangan'    => 'KOOR BID.1',
                'status'        => 'KOOR',
                'tampilan'      => 'null'
            ],
            [
                'id_pengguna'   => 1244,
                'email'         => 'koor.lppm@gmail.com',
                'password'      => 'ebc60a7342dfbfdb134b39c0c7b643322fe6c339',
                'keterangan'    => 'KOOR LPPM',
                'status'        => 'KOOR',
                'tampilan'      => 'null'
            ],
            [
                'id_pengguna'   => 1245,
                'email'         => 'koor.spi@gmail.com',
                'password'      => '9b4ce08335c08cd024b86e2aa802ce0922ad134c',
                'keterangan'    => 'KOOR SPI',
                'status'        => 'KOOR',
                'tampilan'      => 'null'
            ],
            [
                'id_pengguna'   => 1246,
                'email'         => 'koor.bid2@gmail.com',
                'password'      => '53e0ad80e8756e4c8b765c6688887f74e68b150d',
                'keterangan'    => 'KOOR BID.2',
                'status'        => 'KOOR',
                'tampilan'      => 'null'
            ],
            [
                'id_pengguna'   => 1247,
                'email'         => 'koor.bid4@gmail.com',
                'password'      => '53e0ad80e8756e4c8b765c6688887f74e68b150d',
                'keterangan'    => 'KOOR BID.4',
                'status'        => 'KOOR',
                'tampilan'      => 'null'
            ],
            [
                'id_pengguna'   => 1250,
                'email'         => 'bid3@gmail.com',
                'password'      => '6df5d428af931fa91d741bbda44b0a134e6514d4',
                'keterangan'    => 'BID.3',
                'status'        => 'PIC',
                'tampilan'      => 'BID KEMAHASISWAAN DAN ALUMNI'
            ],
            [
                'id_pengguna'   => 1248,
                'email'         => 'koor.bid3@gmail.com',
                'password'      => '53e0ad80e8756e4c8b765c6688887f74e68b150d',
                'keterangan'    => 'KOOR BID.3',
                'status'        => 'KOOR',
                'tampilan'      => 'null'
            ],
            [
                'id_pengguna'   => 1301,
                'email'         => 'ulp@gmail.com',
                'password'      => 'a17d4d6780b54cf68865843ccdfb39dad8fa74dd',
                'keterangan'    => 'ULP',
                'status'        => 'PIC',
                'tampilan'      => 'ULP'
            ],
            [
                'id_pengguna'   => 1302,
                'email'         => 'rumahtangga@gmail.com',
                'password'      => '65688ce169b25a23e20e80167268e3b9699b2438',
                'keterangan'    => 'RUMAH TANGGA',
                'status'        => 'PIC',
                'tampilan'      => 'RUMAH TANGGA'
            ],
            [
                'id_pengguna'   => 1303,
                'email'         => 'admisi@gmail.com',
                'password'      => '4a9c99d1ea12141e83a1c63f1e815277f8cd8570',
                'keterangan'    => 'ADMISI',
                'status'        => 'PIC',
                'tampilan'      => 'ADMISI'
            ],
            [
                'id_pengguna'   => 1304,
                'email'         => 'ppg@gmail.com',
                'password'      => '7d4779f8c07fd46d36b3c5cb3e6dc06c2211eb94',
                'keterangan'    => 'PPG',
                'status'        => 'PIC',
                'tampilan'      => 'PPG'

            ],
            [
                'id_pengguna'   => 1305,
                'email'         => 'bmn@gmail.com',
                'password'      => '2bd6f7eecd3011a20afafbb684b4db3c594a24fb',
                'keterangan'    => 'BMN',
                'status'        => 'PIC',
                'tampilan'      => 'BMN'
            ]
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('pengguna')->insertBatch($data);
    }
}
