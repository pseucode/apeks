<?php

namespace App\Http\Controllers;

use App\Models\Kinerja;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanController extends Controller
{
    public function showLaporan(){
        $pengaduans = Pengaduan::all();
        $teknisis = User::select('id', 'name')->where('level', '=', 'teknisi')->get();

        return view('laporan.index', [
            'pengaduans' => $pengaduans,
            'teknisis' => $teknisis
        ]);
    }
    
    public function cetakLaporanPDF(Request $request){
        $this->validate($request, [
            'startDate' => 'required',
            'endDate' => 'required',
            'pilihan' => 'required'
        ]);

        $startDate = $request->startDate;
        $endDate = $request->endDate; 
        $pilihan = $request->pilihan;

        $teknisis = User::where('level', 'teknisi')->get();

        foreach($teknisis as $teknisi){
            if($pilihan == 'all'){
                $pengaduans = Pengaduan::select('pelapors.nama as pelapor', 'barang', 'lokasi', 'isi_aduan', 'tgl_aduan', 'status')->join('pelapors', 'pelapors.nip', 'pengaduans.nip')->whereBetween('tgl_aduan',[$startDate,$endDate])->get();
    
                $pdf = PDF::loadview('laporan.allKasus', compact('pengaduans'))->setPaper('a4', 'landscape');
                return $pdf->stream();
            }elseif($pilihan == $teknisi->id){
                $querys = Kinerja::join('pengaduans', 'pengaduans.id', '=', 'kinerjas.pengaduan_id')
                        ->join('pelapors', 'pelapors.nip', '=', 'pengaduans.nip')
                        ->join('users', 'users.id', '=', 'kinerjas.user_id')
                        ->select('pelapors.nama as pelapor','pengaduans.isi_aduan', 'pengaduans.tgl_aduan', 'pengaduans.status','poin_cek', 'poin_selesai', 'over_cek', 'over_selesai', 'users.name as teknisi', DB::raw('SUM(poin_cek + poin_selesai) as jmlPoin'))->where('kinerjas.user_id', $teknisi->id)->whereBetween('tgl_aduan',[$startDate,$endDate])->where('pengaduans.status', 'Selesai')->groupBy('pelapor', 'pengaduans.isi_aduan', 'pengaduans.tgl_aduan', 'pengaduans.status', 'poin_cek', 'poin_selesai', 'over_cek', 'over_selesai', 'teknisi')->get();                
                
                $pdf = PDF::loadview('laporan.poinKasus', compact('querys'))->setPaper('a4', 'landscape');
                return $pdf->stream();
            }
        }

    }
}
