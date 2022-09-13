<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SasaranKinerja extends Migration
{
    public function up()
    {
        $this->forge->addField("sk character(500) NOT NULL,
        id_sk  serial NOT NULL ,
        tahun integer NOT NULL,
        kode_sk character(500),
        sistem integer,
        PRIMARY KEY (id_sk)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('sasaran_kinerja');
    }

    public function down()
    {
        $this->forge->dropTable('sasaran_kinerja');
    }
}
