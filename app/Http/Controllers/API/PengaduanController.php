<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Carbon\Carbon;

class PengaduanController extends Controller
{
    function indexAdmin(){
        $pengaduans = Pengaduan::where('status', 'Baru')->orWhere('status', 'Sudah diTeruskan')->orderBy('status', 'ASC')->orderBy('tgl_aduan', 'DESC')->get();

        return response()->json(['msg' => 'Data retrieved', 'data' => $pengaduans], 200);
    }

    function indexTeknisi(){
        $pengaduans = Pengaduan::whereNotNull('catatan')->where('status', 'Sudah diTeruskan')->orderBy('tgl_aduan', 'DESC')->get();

        return response()->json(['msg' => 'Data retrieved', 'data' => $pengaduans], 200);
    }

    function tambah(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'jabatan' => '',
            'barang' => 'required',
            'no_telp' => 'required',
            'lokasi' => 'required',
            'tgl_aduan' => '',
            'isi_aduan' => 'required'
        ]);

        $attr = $request->all();
        $attr['status'] = 'Baru';
        $attr['tgl_aduan'] = Carbon::now();

        $Pengaduans = Pengaduan::create($attr);
        return response()->json(['msg' => 'Data created', 'data' => $Pengaduans], 200);
    }

    function forward($id, Request $request){
        $this->validate($request, [
            'catatan' => '',
            'user' => ''
        ]);
        $attr = $request->all();

        $pengaduans = Pengaduan::find($id);
        $pengaduans->status = 'Sudah diTeruskan';
        $pengaduans->user_id = $attr['user_id'];
        $pengaduans->catatan = $attr['catatan'];
        $pengaduans->save();

        return response()->json(['msg' => 'Data updated', 'data' => $pengaduans], 200);
    }

    function hapus($id){
        $Pengaduans = Pengaduan::findOrFail($id);
        $Pengaduans->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }
}
