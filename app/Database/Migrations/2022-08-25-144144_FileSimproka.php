<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FileSimproka extends Migration
{
    public function up()
    {
        $this->forge->addField("id_file serial NOT NULL,
        file character(500) NOT NULL,
        id_pengguna integer,
        tahun integer NOT NULL,
        lokasi character(500) NOT NULL,
        sistem integer NOT NULL,
        tanggal integer,
        kode character(100),
         PRIMARY KEY (id_file)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('file_simproka');
    }

    public function down()
    {
        $this->forge->dropTable('file_simproka');
    }
}
