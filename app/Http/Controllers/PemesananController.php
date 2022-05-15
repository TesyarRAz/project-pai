<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Barang;
use App\Models\Pemesanan;
use App\Models\PemesananTemp;
use App\Models\Supplier;
use App\Models\TempPesan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akun = Akun::All();
        $barang = Barang::All();
        $supplier = Supplier::All();
        $temp_pesan = TempPesan::All();

        //No otomatis untuk transaksi pemesanan
        $AWAL = 'TRX';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = Pemesanan::max('no_pesan');

        $formatnya = sprintf("%03s", abs((int)$noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');

        return view(
            'pemesanan.index',
            [
                'barang' => $barang,
                'akun' => $akun,
                'supplier' => $supplier,
                'temp_pemesanan' => $temp_pesan,
                'formatnya' => $formatnya
            ]
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validasi jika barang sudah ada paada tabel temporari maka QTY akan di edit
        if (PemesananTemp::where('kd_brg', $request->brg)->exists()) {
            alert('barang sudah ada.. QTY akan terupdate');
            PemesananTemp::where('kd_brg', $request->brg)
                ->update(['qty_pesan' => $request->qty]);
            return to_route('pemesanan.index');
        } else {
            PemesananTemp::create([
                'qty_pesan' => $request->qty,
                'kd_brg' => $request->brg
            ]);
            return to_route('pemesanan.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(PemesananTemp $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(PemesananTemp $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemesananTemp $pemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemesananTemp $pemesanan)
    {
        $pemesanan->delete();
        
        alert('Pesan', 'Data berhasil dihapus', 'success');

        return to_route('pemesanan.index');
    }
}
