<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Foto extends Migration
{
    public function up()
    {
        $this->forge->addField("id_ft serial NOT NULL,
        foto character(500) NOT NULL,
        iku character(500) NOT NULL,
        id_pengguna integer NOT NULL,
        tahun integer NOT NULL,
        lokasi character(50) NOT NULL,
        sistem integer NOT NULL,
        PRIMARY KEY (id_ft)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('foto');
    }

    public function down()
    {
        $this->forge->dropTable('foto');
    }
}
