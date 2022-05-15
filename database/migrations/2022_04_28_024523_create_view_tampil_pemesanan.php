<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE OR REPLACE VIEW tampil_pemesanan AS 
                SELECT detail_pesan.kd_brg AS kd_brg, 
                    detail_pesan.no_pesan AS no_pesan, 
                    barang.nm_brg AS nm_brg, 
                    detail_pesan.qty_pesan AS qty_pesan, 
                    detail_pesan.subtotal AS sub_total 
                FROM barang 
                JOIN detail_pesan ON detail_pesan.kd_brg = barang.kd_brg ;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
