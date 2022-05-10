<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'id_setting' => '1',
            'no_akun' => '501',
            'nama_transaksi' => 'Retur',
        ]);

        Setting::create([
            'id_setting' => '2',
            'no_akun' => '500',
            'nama_transaksi' => 'Pembelian',
        ]);
        
        Setting::create([
            'id_setting' => '3',
            'no_akun' => '101',
            'nama_transaksi' => 'Kas',
        ]);
    }
}
