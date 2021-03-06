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
        CREATE OR REPLACE VIEW temp_jual AS 
                SELECT temp_penjualan.kd_brg AS kd_brg,
                        concat(barang.nm_brg, " ", barang.harga) AS nm_brg,
                        temp_penjualan.qty_jual AS qty_jual, 
                        barang.harga * temp_penjualan.qty_jual AS sub_total 
                FROM temp_penjualan
                JOIN barang ON temp_penjualan.kd_brg = barang.kd_brg ;
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
