<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Jurnal;
use App\Models\Laporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
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
            $bb = Laporan::All();
            $akun = Akun::All();
            $pdf = Pdf::loadview('laporan.cetak', ['laporan' => $bb, 'akun' => $akun])->setPaper('A4', 'landscape');

            return $pdf->stream();
        } elseif ($periode == 'periode') {
            $tglawal = $request->get('tglawal');
            $tglakhir = $request->get('tglakhir');
            $akun = Akun::All();
            $bb = Jurnal::whereBetween('tgl_jurnal', [$tglawal, $tglakhir])
                ->orderby('tgl_jurnal', 'ASC')
                ->get();
            $pdf = Pdf::loadview('laporan.cetak', ['laporan' => $bb, 'akun' => $akun])->setPaper('A4', 'landscape');

            return $pdf->stream();
        }

        return view('laporan.index');
    }
}
