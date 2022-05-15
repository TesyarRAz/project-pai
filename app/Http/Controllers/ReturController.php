<?php

namespace App\Http\Controllers;

use App\Models\Beli;
use App\Models\DetailRetur;
use App\Models\Jurnal;
use App\Models\Pembelian;
use App\Models\Pemesanan;
use App\Models\Retur;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembelian = Pembelian::All();

        return view('retur.index', ['pembelian' => $pembelian]);
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
        if (Retur::where('no_retur', $request->no_retur)->exists()) {
            alert('Pesan ', 'Retur sudah dilakukan', 'warning');
            
            return to_route('retur.index');
        } else {
            //SIMPAN DATA KE TABEL DETAIL RETUR
            $kdbrg  = $request->kd_brg;
            $qtyretur = $request->jml_retur;
            $harga   = $request->harga;
            $total = 0;
            foreach ($kdbrg as $key => $no) {
                $input['no_retur']   = $request->no_retur;
                $input['kd_brg']    = $kdbrg[$key];
                $input['qty_retur']  = $qtyretur[$key];
                $input['sub_retur']  = $harga[$key] * $qtyretur[$key];

                DetailRetur::insert($input);
                $total = $harga[$key] * $qtyretur[$key];
            }
            //Simpan ke table retur
            $retur = new Retur;
            $retur->no_retur = $request->no_retur;
            $retur->tgl_retur = $request->tgl;
            $retur->total_retur = $total;
            $retur->save();
            //SIMPAN ke table jurnal bagian debet
            $jurnaldebet = new Jurnal;
            $jurnaldebet->no_jurnal = $request->no_jurnal;
            // $jurnaldebet->keterangan = 'Kas';
            $jurnaldebet->tgl_jurnal = $request->tgl;
            $jurnaldebet->no_akun = $request->kas;
            $jurnaldebet->debet = $total;
            $jurnaldebet->kredit = '0';
            $jurnaldebet->save();

            //SIMPAN ke table jurnal bagian kredit
            $jurnalkredit = new Jurnal;
            $jurnalkredit->no_jurnal = $request->no_jurnal;
            // $jurnalkredit->keterangan = 'Retur Pembelian';
            $jurnalkredit->tgl_jurnal = $request->tgl;
            $jurnalkredit->no_akun = $request->retur;
            $jurnalkredit->debet = '0';
            $jurnalkredit->kredit = $total;
            $jurnalkredit->save();
            
            alert('Pesan ', 'Data berhasil disimpan', 'success');

            return redirect('/retur');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Retur  $retur
     * @return \Illuminate\Http\Response
     */
    public function show(Retur $retur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Retur  $retur
     * @return \Illuminate\Http\Response
     */
    public function edit($retur)
    {
        $AWAL = 'RTR';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = Retur::max('no_retur');
        $no = 1;
        $format = sprintf("%03s", abs((int)$noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        //No otomatis untuk jurnal
        $AWALJurnal = 'JRU';
        $bulanRomawij = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhirj = Jurnal::max('no_jurnal');
        $noj = 1;
        $formatj = sprintf("%03s", abs((int)$noUrutAkhirj + 1)) . '/' . $AWALJurnal . '/' . $bulanRomawij[date('n')] . '/' . date('Y');

        $decrypted = Crypt::decryptString($retur);
        $detail      = DB::table('tampil_pembelian')->where('no_beli', $decrypted)->get();
        $pemesanan   = Pemesanan::where('no_pesan', $decrypted)->get();
        $akunkas      = Setting::where('nama_transaksi', 'Kas')->get();
        $akunretur    = Setting::where('nama_transaksi', 'Retur')->get();

        return view('retur.beli', ['beli' => $detail, 'format' => $format, 'no_pesan' => $decrypted, 'pemesanan' => $pemesanan, 'formatj' => $formatj, 'kas' => $akunkas, 'retur' => $akunretur]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Retur  $retur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retur $retur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retur  $retur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retur $retur)
    {
        //
    }
}
