<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Pengaduan;
use Illuminate\Support\Facades\DB;

class KinerjaController extends Controller
{
    public function index(){
        $users = User::join('pengaduans', 'users.id', '=', 'pengaduans.user_id')
        ->select('name', 'user_id', DB::raw('COUNT(pengaduans.id) as jmlKasus'))
        ->groupBy('name')
        ->groupBy('user_id')
        ->get();

        return view('kinerja.index', [
            'users' => $users
        ]);
    }

    public function detail($id){
        $users = User::find($id);

        return view('kinerja.detail', [
            'users' => $users
        ]);
    }
}