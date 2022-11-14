<?php

namespace App\View\Composers;

use App\Models\Pengaduan;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class BadgeComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        if(Auth::user()){
            if(Auth::user()->level == 'admin'){
                $masuk = Pengaduan::where('status', 'Baru')->count();
                $progres = Pengaduan::where('status', 'Progres')->orWhere('status', 'Menunggu Konfirmasi Sarpas')->count();
                $selesai = Pengaduan::where('status', 'Selesai')->count();
                $view->with('masuk',$masuk);
                $view->with('progres',$progres);
                $view->with('selesai', $selesai);
            }elseif(Auth::user()->level == 'teknisi'){
                $masuk = Pengaduan::where('status', 'Sudah diTeruskan')->whereHas('user', function($query) {
                    $query->where('id', Auth::user()->id);
                })->count();
                $progres = Pengaduan::where('status', 'Progres')->whereHas('user', function($query) {
                    $query->where('id', Auth::user()->id);
                })->count();
                $selesai = Pengaduan::where('status', 'Selesai')->whereHas('user', function($query) {
                    $query->where('id', Auth::user()->id);
                })->count();
                $view->with('masuk',$masuk);
                $view->with('progres',$progres);
                $view->with('selesai', $selesai);
            }
        }
    }
}