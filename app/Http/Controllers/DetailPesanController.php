<?php

namespace App\Http\Controllers;

use App\Models\DetailPesan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DetailPesanController extends Controller
{
    public function store(Request $request)
    {
        //Simpan ke table pemesanan
        Pemesanan::create([
            'no_pesan' => $request->no_pesan,
            'tgl_pesan' => $request->tgl_pesan,
            'total' => $request->total,
            'kd_supp' => $request->kd_supp,
            'no_akun' => $request->no_akun,
        ]);

        //SIMPAN DATA KE TABEL DETAIL
        $kd_brg = $request->kd_brg;
        $qty = $request->qty_pesan;
        $sub_total = $request->sub_total;

        foreach ($kd_brg as $key => $no) {
            $input['no_pesan'] = $request->no_pesan;
            $input['kd_brg'] = $no;
            $input['qty_pesan'] = $qty[$key];
            $input['subtotal'] = $sub_total[$key];

            DetailPesan::insert($input);
        }

        alert('Pesan', 'Data berhasil ditambahkan', 'success');

        return to_route('pemesanan.index');
    }

    public function destroy($detail)
    {
        $decrypted = Crypt::decryptString($detail);

        DetailPesan::where('no_pesan', $decrypted)->delete();
        Pemesanan::where('no_pesan', $decrypted)->delete();

        alert('Pesan', 'Berhasil hapus data', 'success');

        return back();
    }
}
