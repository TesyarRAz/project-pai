<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\LaporanStok;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LapStokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $periode = $request->get('periode');
        if ($periode == 'All') {
            $bb = LaporanStok::All();
            $akun = Akun::All();
            $pdf = Pdf::loadview('laporan.print', ['laporan' => $bb, 'akun' => $akun])->setPaper('A4', 'landscape');
            return $pdf->stream();
        } else if ($periode == 'periode') {
            $tglawal = $request->get('tglawal');
            $tglakhir = $request->get('tglakhir');
            $akun = Akun::All();
            $bb = DB::table('barang')
                ->whereBetween('tgl_jurnal', [$tglawal, $tglakhir])
                ->orderby('tgl_jurnal', 'ASC')
                ->get();
            $pdf = PDF::loadview('laporan.print', ['laporan' => $bb, 'akun' => $akun])->setPaper('A4', 'landscape');
            return $pdf->stream();
        }

        $data = LaporanStok::All();
        return view('laporan.stok', ['data' => $data]);
    }
}
