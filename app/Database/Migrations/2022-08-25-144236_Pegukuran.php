<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pegukuran extends Migration
{
    public function up()
    {
        $this->forge->addField("indikator text   NOT NULL,
        target_pk character(100) NOT NULL,
        target_tw character(100) NOT NULL,
        capaian character(100) NOT NULL,
        presentase character(100) NOT NULL,
        pic character(500)   NOT NULL,
        komentar text  ,
        id_ik  serial NOT NULL,
        id_pengguna integer NOT NULL,
        iku character(100) NOT NULL,
        tahun_pengukuran integer NOT NULL,
        sistem_pengukuran integer NOT NULL,
        status character(100),
        PRIMARY KEY (id_ik)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('pengukuran');
    }

    public function down()
    {
        $this->forge->dropTable('pengukuran');
    }
}
