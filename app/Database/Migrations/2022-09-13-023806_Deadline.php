<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Deadline extends Migration
{
    public function up()
    {
        $this->forge->addField("id_deadline  serial NOT NULL,
        kegiatan character(100),
        indikator json,
        tanggal character(100),
       
        PRIMARY KEY (id_deadline)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('deadline');
    }

    public function down()
    {
        $this->forge->dropTable('deadline');
    }
}
