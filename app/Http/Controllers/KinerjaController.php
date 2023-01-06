<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Pengaduan;
use \App\Models\Kinerja;
use Illuminate\Support\Facades\DB;

class KinerjaController extends Controller
{
    public function index(){
        $users = User::join('pengaduans', 'users.id', '=', 'pengaduans.user_id')
        ->select('name', 'user_id', 'rating', DB::raw('COUNT(pengaduans.id) as jmlKasus'))
        ->groupBy('name')
        ->groupBy('user_id')
        ->groupBy('rating')
        ->get();

        return view('kinerja.index', [
            'users' => $users
        ]);
    }

    public function detail($id){
        $users = User::find($id);
        $totalKasus = Kinerja::where('user_id', $id)->whereHas('pengaduan', function($query) {
            $query->where('status', 'Selesai');
        })->count();
        // $kinerja = Kinerja::where('user_id', $id)->whereHas('pengaduan', function($query) {
        //     $query->where('status', 'Selesai');
        // })->sum(DB::raw('poin_cek + poin_selesai'));
        // $rataKinerja = $kinerja / $totalKasus;
        // dd($rataKinerja);
        $kinerjaBaik = Kinerja::where('user_id', $id)->whereHas('pengaduan', function($query) {
            $query->where('status', 'Selesai');
        })->select('pengaduan_id',   DB::raw('sum(poin_cek + poin_selesai) as jmlBaik'))->groupBy('pengaduan_id')->having('jmlBaik', '=', '10')->count(); // where setiap laporan poin_cek + poin_selesai = 10 
        $kinerjaSedang = Kinerja::where('user_id', $id)->whereHas('pengaduan', function($query) {
            $query->where('status', 'Selesai');
        })->select('pengaduan_id',   DB::raw('sum(poin_cek + poin_selesai) as jmlBaik'))->groupBy('pengaduan_id')->having('jmlBaik', '=', '7')->count(); // OUTPUT = 7
        $kinerjaBuruk = Kinerja::where('user_id', $id)->whereHas('pengaduan', function($query) {
            $query->where('status', 'Selesai');
        })->select('pengaduan_id',   DB::raw('sum(poin_cek + poin_selesai) as jmlBaik'))->groupBy('pengaduan_id')->having('jmlBaik', '=', '4')->count(); // OUTPUT = 4

        if($kinerjaBaik || $kinerjaSedang || $kinerjaBuruk > 0){
            $rataKinerja = ((10 * $kinerjaBaik) + (7 * $kinerjaSedang) + (4 *$kinerjaBuruk)) / ($kinerjaBaik+$kinerjaSedang+$kinerjaBuruk);
            User::where('id', $id)->update([
                'rating' => $rataKinerja
            ]);
        }

        return view('kinerja.detail', [
            'users' => $users,
            'totalKasus' => $totalKasus,
            'kinerjaBaik' => $kinerjaBaik,
            'kinerjaSedang' => $kinerjaSedang,
            'kinerjaBuruk' => $kinerjaBuruk
        ]);

    }
}