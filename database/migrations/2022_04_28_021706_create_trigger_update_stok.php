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
        CREATE OR REPLACE TRIGGER update_stok after INSERT ON detail_pembelian
            FOR EACH ROW BEGIN
                UPDATE barang
                SET stok = stok + NEW.qty_beli
                WHERE kd_brg = NEW.kd_brg;
            END
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
