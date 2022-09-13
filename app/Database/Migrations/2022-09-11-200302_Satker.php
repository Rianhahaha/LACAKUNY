<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Satker extends Migration
{
    public function up()
    {
        $this->forge->addField("id_satker serial NOT NULL,
        nomenklatur character(100) NOT NULL,
        uraian character(100) NOT NULL,
        PRIMARY KEY (id_satker)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('satker');
    }

    public function down()
    {
        $this->forge->dropTable('satker');
    }
}
