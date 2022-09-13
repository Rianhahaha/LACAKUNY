<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Iku extends Migration
{
    public function up()
    {
        $this->forge->addField("iku character(100) NOT NULL,
        id_sk integer,
        id_iku  serial NOT NULL,
        tahun integer NOT NULL,
        id_pengguna integer,
        kode_sk character(500),
        sistem integer,
        PRIMARY KEY (id_iku)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('iku');
    }

    public function down()
    {
        $this->forge->dropTable('iku');
    }
}
