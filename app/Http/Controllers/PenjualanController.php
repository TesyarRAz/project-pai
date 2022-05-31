<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Barang;
use App\Models\DetailJual;
use App\Models\Jual;
use App\Models\Jurnal;
use App\Models\Penjualan;
use App\Models\PenjualanTemp;
use App\Models\TempJual;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::all();

        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $akun = Akun::all();
        $barang = Barang::all();
        $temp_penjualan = TempJual::all();

        //No otomatis untuk transaksi pemesanan
        $AWAL = 'PJL';
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhir = Penjualan::max('no_jual');

        $AWALJurnal = 'JRU';
        $bulanRomawij = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $noUrutAkhirj = Jurnal::max('no_jurnal');
        $formatj = sprintf("%03s", abs((int)$noUrutAkhirj + 1)) . '/' . $AWALJurnal . '/' . $bulanRomawij[date('n')] . '/' . date('Y');

        $formatnya = sprintf("%03s", abs((int)$noUrutAkhir + 1)) . '/' . $AWAL . '/' . $bulanRomawi[date('n')] . '/' . date('Y');

        return view(
            'penjualan.create',
            [
                'barang' => $barang,
                'akun' => $akun,
                'formatnya' => $formatnya,
                'temp_penjualan' => $temp_penjualan,
                'formatj' => $formatj,
            ]
        );
    }

    public function store(Request $request)
    {
        if (Barang::where('kd_brg', $request->brg)->value('stok') < $request->qty) {
            alert('Stok tidak mencukupi');

            return to_route('penjualan.create');
        } elseif (PenjualanTemp::where('kd_brg', $request->brg)->exists()) {
            alert('barang sudah ada.. QTY akan terupdate');
            PenjualanTemp::where('kd_brg', $request->brg)
                ->update(['qty_jual' => $request->qty]);

            return to_route('penjualan.create');
        } else {
            PenjualanTemp::create([
                'qty_jual' => $request->qty,
                'kd_brg' => $request->brg
            ]);
            return to_route('penjualan.create');
        }
    }

    public function pdf($penjualan)
    {
        $decrypted = Crypt::decryptString($penjualan);

        $detail      = Jual::where('no_jual', $decrypted)->get();
        $penjualan   = Penjualan::where('no_jual', $decrypted)->get();
        
        $pdf = Pdf::loadView('laporan.invoice', [
            'detail' => $detail, 
            'order' => $penjualan, 
            'noorder' => $decrypted,
        ]);

        return $pdf->stream();
    }

    public function destroy(PenjualanTemp $penjualan)
    {
        $penjualan->delete();
        
        alert('Pesan', 'Data berhasil dihapus', 'success');

        return to_route('penjualan.create');
    }
}
