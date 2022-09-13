<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Strategi extends Migration
{
    public function up()
    {
        $this->forge->addField("id_strategi  serial NOT NULL,
        strategi text,
        iku character(500) NOT NULL,
        id_pengguna integer NOT NULL,
        tahun integer NOT NULL,
        sistem integer NOT NULL,
        PRIMARY KEY (id_strategi)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('strategi');
    }

    public function down()
    {
        $this->forge->dropTable('strategi');
    }
}
