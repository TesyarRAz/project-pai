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
        CREATE OR REPLACE VIEW tampil_penjualan AS 
                SELECT detail_jual.kd_brg AS kd_brg, 
                    detail_jual.no_jual AS no_jual, 
                    barang.nm_brg AS nm_brg, 
                    detail_jual.qty_jual AS qty_jual, 
                    detail_jual.subtotal AS sub_total 
                FROM barang 
                JOIN detail_jual ON detail_jual.kd_brg = barang.kd_brg ;
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
