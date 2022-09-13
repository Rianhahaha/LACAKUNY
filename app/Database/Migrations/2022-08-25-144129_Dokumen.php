<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dokumen extends Migration
{
    public function up()
    {
        $this->forge->addField("id_dk serial NOT NULL,
        dokumen character(500) NOT NULL,
        iku character(500) NOT NULL,
        id_pengguna integer NOT NULL,
        tahun integer NOT NULL,
        lokasi character(500) NOT NULL,
        sistem integer NOT NULL,
        PRIMARY KEY (id_dk)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('dokumen');
    }

    public function down()
    {
        $this->forge->dropTable('dokumen');
    }
}
