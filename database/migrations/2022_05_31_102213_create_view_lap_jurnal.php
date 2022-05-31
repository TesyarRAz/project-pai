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
        CREATE OR REPLACE VIEW lap_jurnal AS 
            SELECT akun.nm_akun AS nm_akun, 
                jurnal.tgl_jurnal AS tgl, 
                sum(jurnal.debet) AS debet, 
                sum(jurnal.kredit) AS kredit 
            FROM akun 
            JOIN jurnal ON akun.no_akun = jurnal.no_akun
            GROUP BY jurnal.no_jurnal
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
