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

        if ($periode == 'all')
        {
            $laporan = Jurnal::with('akun')
            ->orderBy('tgl_jurnal', 'ASC')
            ->get();

            return Pdf::loadview('laporan.cetak', compact('laporan'))
            ->setPaper('A4', 'landscape')
            ->stream();
        }
        else if ($periode == 'periode')
        {
            $tglawal = $request->get('tglawal');
            $tglakhir = $request->get('tglakhir');
            
            $laporan = Jurnal::with('akun')
            ->whereBetween('tgl_jurnal', [$tglawal, $tglakhir])
            ->orderBy('tgl_jurnal', 'ASC')
            ->get();

            return Pdf::loadview('laporan.cetak', compact('laporan'))
            ->setPaper('A4', 'landscape')
            ->stream();
        }

        return view('laporan.index');
    }
}
