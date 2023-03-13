<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use PDF;

class LaporanController extends Controller
{
    public function showLaporan(){
        $pengaduans = Pengaduan::all();

        return view('laporan.index', [
            'pengaduans' => $pengaduans
        ]);
    }
    
    public function cetakLaporanPDF(Request $request){
        $this->validate($request, [
            'startDate' => '',
            'endDate' => '',
        ]);

        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $pengaduans = Pengaduan::whereBetween('tgl_aduan',[$startDate,$endDate])->get();

        $pdf = PDF::loadview('laporan.laporan_pdf', compact('pengaduans'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
