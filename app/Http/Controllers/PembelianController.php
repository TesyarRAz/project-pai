<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Beli;
use App\Models\DetailPembelian;
use App\Models\Jurnal;
use App\Models\Pembelian;
use App\Models\Pemesanan;
use App\Models\Setting;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PembelianController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::whereDoesntHave('pembelian')->get();

        return view('pembelian.index', compact('pemesanan'));
    }

    public function store(Request $request)
    {
        if (Pembelian::where('no_pesan', $request->no_pesan)->exists()) {
            alert('Pesan ','Pembelian Telah dilakukan', 'warning');
            
            return redirect('pembelian');
        }else{
            //Simpan ke table pembelian
            $pembelian = new Pembelian;
            $pembelian->no_beli = $request->no_faktur;
            $pembelian->tgl_beli = $request->tgl;
            $pembelian->no_faktur = $request->no_faktur;
            $pembelian->total_beli = $request->total;
            $pembelian->no_pesan = $request->no_pesan;
            $pembelian->save();
            //SIMPAN DATA KE TABEL DETAIL PEMBELIAN
            $kdbrg  = $request->kd_brg;
            $qtybeli = $request->qty_beli;
            $subbeli = $request->sub_beli;
            foreach($kdbrg as $key => $no)
            {
                $input['no_beli']   = $request->no_faktur;
                $input['kd_brg']    = $kdbrg[$key];
                $input['qty_beli']  = $qtybeli[$key];
                $input['sub_beli']  = $subbeli[$key];
                DetailPembelian::insert($input);
            }
            //SIMPAN ke table jurnal bagian debet
            $jurnaldebet=new Jurnal;
            $jurnaldebet->no_jurnal = $request->no_jurnal;
            // $jurnaldebet->keterangan = 'Utang Dagang ';
            $jurnaldebet->tgl_jurnal = $request->tgl;
            $jurnaldebet->no_akun = $request->pembelian;
            $jurnaldebet->debet = $request->total;
            $jurnaldebet->kredit = '0';
            $jurnaldebet->save();
            
            //SIMPAN ke table jurnal bagian kredit
            $jurnalkredit=new Jurnal;
            $jurnalkredit->no_jurnal = $request->no_jurnal;
            // $jurnalkredit->keterangan = 'Kas';
            $jurnalkredit->tgl_jurnal = $request->tgl;
            $jurnalkredit->no_akun = $request->akun;
            $jurnalkredit->debet ='0';
            $jurnalkredit->kredit = $request->total;
            $jurnalkredit->save();

            alert('Pesan','Data berhasil disimpan', 'success');

            return to_route('pembelian.index');
        }
    }

    public function show($pembelian)
    {
        $AWAL = 'FKT';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = Pembelian::max('no_beli');
        $format = sprintf("%03s", abs((int)$noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');
        $AWALJurnal = 'JRU';
        $bulanRomawij = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhirj = Jurnal::max('no_jurnal');
        $formatj = sprintf("%03s", abs((int)$noUrutAkhirj + 1)) . '/' . $AWALJurnal . '/' . $bulanRomawij[date('n')] . '/' . date('Y');

        $decrypted = Crypt::decryptString($pembelian);
        $detail = Beli::where('no_pesan', $decrypted)->get();
        $pemesanan = Pemesanan::find($decrypted);

        $akun = Akun::all();

        return view('pembelian.beli', [
            'detail' => $detail,
            'format' => $format,
            'no_pesan' => $decrypted,
            'pemesanan' => $pemesanan,
            'formatj' => $formatj,
            'akun' => $akun,
        ]);
    }

    public function pdf($pembelian)
    {
        $decrypted = Crypt::decryptString($pembelian);

        $detail      = Beli::where('no_pesan', $decrypted)->get();
        $supplier    = Supplier::all();
        $pemesanan   = Pemesanan::where('no_pesan', $decrypted)->get();
        
        $pdf = Pdf::loadView('laporan.faktur', ['detail' => $detail, 'order' => $pemesanan, 'supp' => $supplier, 'noorder' => $decrypted]);

        return $pdf->stream();
    }
}
