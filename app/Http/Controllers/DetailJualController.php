<?php

namespace App\Http\Controllers;

use App\Models\DetailJual;
use App\Models\Jurnal;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DetailJualController extends Controller
{
    public function store(Request $request)
    {
        //Simpan ke table pemesanan
        Penjualan::create([
            'no_jual' => $request->no_jual,
            'tgl_jual' => $request->tgl_jual,
            'total' => $request->total,
            'no_akun' => $request->no_akun,
            'nama_pembeli' => $request->nama_pembeli,
        ]);

        //SIMPAN DATA KE TABEL DETAIL
        $kd_brg = $request->kd_brg;
        $qty = $request->qty_jual;
        $sub_total = $request->sub_total;

        foreach ($kd_brg as $key => $no) {
            $input['no_jual'] = $request->no_jual;
            $input['kd_brg'] = $no;
            $input['qty_jual'] = $qty[$key];
            $input['subtotal'] = $sub_total[$key];

            DetailJual::insert($input);
        }

        //SIMPAN ke table jurnal bagian debet
        $jurnaldebet = new Jurnal;
        $jurnaldebet->no_jurnal = $request->no_jurnal;
        // $jurnaldebet->keterangan = 'Utang Dagang ';
        $jurnaldebet->tgl_jurnal = $request->tgl_jual;
        $jurnaldebet->no_akun = $request->no_akun;
        $jurnaldebet->debet = $request->total;
        $jurnaldebet->kredit = '0';
        $jurnaldebet->save();

        //SIMPAN ke table jurnal bagian kredit
        $jurnalkredit = new Jurnal;
        $jurnalkredit->no_jurnal = $request->no_jurnal;
        // $jurnalkredit->keterangan = 'Kas';
        $jurnalkredit->tgl_jurnal = $request->tgl_jual;
        $jurnalkredit->no_akun = $request->no_pembelian;
        $jurnalkredit->debet = '0';
        $jurnalkredit->kredit = $request->total;
        $jurnalkredit->save();

        alert('Pesan', 'Data berhasil ditambahkan', 'success');

        return to_route('pemesanan.index');
    }
}
