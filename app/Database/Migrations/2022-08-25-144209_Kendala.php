<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kendala extends Migration
{
    public function up()
    {
        $this->forge->addField("id_kendala serial NOT NULL,
        kendala text,
        iku character(500) NOT NULL,
        id_pengguna integer NOT NULL,
        tahun integer NOT NULL,
        sistem integer NOT NULL,
        PRIMARY KEY (id_kendala)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('kendala');
    }

    public function down()
    {
        $this->forge->dropTable('kendala');
    }
}
