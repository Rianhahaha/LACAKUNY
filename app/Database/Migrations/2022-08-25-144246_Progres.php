<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Progres extends Migration
{
    public function up()
    {
        $this->forge->addField("id_progres  serial NOT NULL,
        progres text,
        tahun integer NOT NULL,
        iku character(500)   NOT NULL,
        id_pengguna integer NOT NULL,
        sistem integer NOT NULL,
        deskripsi character(500),
        PRIMARY KEY (id_progres)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('progres');
    }

    public function down()
    {
        $this->forge->dropTable('progres');
    }
}
