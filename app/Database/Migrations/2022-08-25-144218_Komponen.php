<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Komponen extends Migration
{
    public function up()
    {
        $this->forge->addField("id_komponen serial NOT NULL,
        ro character(500),
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
        detail character(500),
        volume_target character(500),
        tanggal character(100),
        status_validasi character(500),
        pengedit character(500),
        PRIMARY KEY (id_komponen)");

        // $this->forge->addKey('id', true);
        $this->forge->createTable('komponen');
    }

    public function down()
    {
        $this->forge->dropTable('komponen');
    }
}
