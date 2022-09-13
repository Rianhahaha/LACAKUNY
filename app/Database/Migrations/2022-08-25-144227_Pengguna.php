<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengguna extends Migration
{
    public function up()
    {
        $this->forge->addField("id_pengguna integer NOT NULL ,
        email character(200) NOT NULL,
        password character(40) NOT NULL,
        keterangan character(400) NOT NULL,
        tampilan character(100),
        keyword character(100),
        id_tblpengguna  serial NOT NULL,
        status character(100),
        online integer DEFAULT 0,
        PRIMARY KEY (id_tblpengguna)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('pengguna');
    }

    public function down()
    {
        $this->forge->dropTable('pengguna');
    }
}
