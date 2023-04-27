<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Pelapor;
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
            'nip' => 'required',
            'barang' => 'required',
            'lokasi' => 'required',
            'tgl_aduan' => '',
            'isi_aduan' => 'required',
            'pelapor_id' => ''
        ]);

        $pelapor_id = Pelapor::where('nip', $request->nip)->first();
        if(!empty($pelapor_id)){
            $pengaduans = Pengaduan::create([
                'nip' => $request->nip,
                'barang' => $request->barang,
                'lokasi' => $request->lokasi,
                'tgl_aduan' => Carbon::now(),
                'isi_aduan' => $request->isi_aduan,
                'status' => 'Baru',
                'pelapor_id' => $pelapor_id->id
            ]);
            Pelapor::where('nip', $request->nip)->update(['no_telp' => $request->no_telp]);
            return response()->json(['msg' => 'Data created', 'data' => $pengaduans], 200);
        }
    }

    function forward($id, Request $request){
        $this->validate($request, [
            'catatan' => '',
            'user' => ''
        ]);
        $attr = $request->all();

        $pengaduans = Pengaduan::find($id);
        $pengaduans->status = 'Dalam Antrian';
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

    function cekLaporan(){
        $getLaporan = Pengaduan::orderBy('created_at', 'desc')->get();

        return response()->json(['msg' => 'Data retrieved', 'data' => $getLaporan], 200);        
    }
}
