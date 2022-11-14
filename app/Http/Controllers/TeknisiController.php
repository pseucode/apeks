<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class TeknisiController extends Controller
{
    public function index(){
        $teknisis = Teknisi::all();

        return view('teknisi.index', [
            'teknisis' => $teknisis,
        ]);
    }

    public function tambah(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $attr = $request->all();
        $attr['password'] = Hash::make($request->password);
        $teknisis = Teknisi::create($attr);

        if($teknisis){
            Alert::success('Sukses Tambah', 'Data berhasil ditambahkan');
            // alihkan halaman ke halaman pegawai
            return redirect()->back();
        }else {
            Alert::error('Gagal Tambah', 'Data Gagal ditambahkan');
            // alihkan halaman ke halaman pegawai
            return redirect()->back();
        }
    }
}
