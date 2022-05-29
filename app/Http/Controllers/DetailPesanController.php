<?php

namespace App\Http\Controllers;

use App\Models\DetailPesan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DetailPesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemesanan $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Pemesanan $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemesanan $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemesanan $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemesanan $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemesanan $detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemesanan $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy($detail)
    {
        $decrypted = Crypt::decryptString($detail);

        DetailPesan::where('no_pesan', $decrypted)->delete();
        Pemesanan::where('no_pesan', $decrypted)->delete();

        alert('Pesan', 'Berhasil hapus data', 'success');

        return back();
    }
}
