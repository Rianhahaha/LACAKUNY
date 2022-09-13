<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SistemPengguna extends Migration
{
    public function up()
    {
        $this->forge->addField("id_sistem serial NOT NULL,
        id_pengguna integer,
        iku character(500),
        sistem integer,
        tahun integer,
        PRIMARY KEY (id_sistem)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('sistem_pengguna');
    }

    public function down()
    {
        $this->forge->dropTable('sistem_pengguna');
    }
}
