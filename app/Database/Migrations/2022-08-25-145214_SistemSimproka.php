<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SistemSimproka extends Migration
{
    public function up()
    {
        $this->forge->addField("id_sistem serial NOT NULL,
        id_pengguna integer,
        kode character(100),
        detail character(100),
        sistem integer,
        tahun integer,
        indikator character(100),
        PRIMARY KEY (id_sistem)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('sistem_simproka');
    }

    public function down()
    {
        $this->forge->dropTable('sistem_simproka');
    }
}
