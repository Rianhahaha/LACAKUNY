<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Simproka extends Migration
{
    public function up()
    {
        $this->forge->addField("id_tblsimproka  serial NOT NULL,
        kode character(500),
        uraian character(500),
        satuan character(500),
        pic character(500),
        capaian_volume character(500),
        progres character(500),
        capaian_rill character(500),
        satuan_rill character(500),
        status character(500),
        penjelasan character(500),
        kendala character(500),
        keterangan_kendala character(500),
        tindak_lanjut character(500),
        tahun integer,
        lokasi character(500),
        sistem integer,
        detail character(100),
        volume_target character(500),
        tanggal character(100),
        status_validasi character(100),
        pengedit character(100),
        PRIMARY KEY (id_tblsimproka)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('simproka');
    }

    public function down()
    {
        $this->forge->dropTable('simproka');
    }
}
