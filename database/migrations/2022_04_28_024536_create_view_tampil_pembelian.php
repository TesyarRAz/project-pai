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
        CREATE OR REPLACE VIEW tampil_pembelian  AS 
                SELECT barang.kd_brg AS kd_brg,
                    detail_pembelian.no_beli AS no_beli,
                    barang.nm_brg AS nm_brg,
                    barang.harga AS harga,
                    detail_pembelian.qty_beli AS qty_beli 
                FROM barang 
                JOIN detail_pembelian ON barang.kd_brg = detail_pembelian.kd_brg;
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
