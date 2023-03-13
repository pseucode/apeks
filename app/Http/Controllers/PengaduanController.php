<?php

namespace App\Http\Controllers;

use App\Models\Pelapor;
use App\Models\Pengaduan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PengaduanController extends Controller
{

    public function dashboard(){
        $masuk = Pengaduan::where('status', 'Baru')->count();
        $progres = Pengaduan::where('status', 'Progres')->count();
        $selesai = Pengaduan::where('status', 'Selesai')->count();
        $totalUser = User::count();
        $year = Carbon::now()->format('Y');
        $totalLaporanByYear = Pengaduan::whereYear('created_at', $year)->count();
        $rating = User::where('id', Auth::user()->id)->get();

        return view('layouts.dashboard', [
            'masuk' => $masuk,
            'progres' => $progres,
            'selesai' => $selesai,
            'totalUser' => $totalUser,
            'totalLaporanByYear' => $totalLaporanByYear,
            'rating' => $rating
        ]);
    }

    public function masuk(){

        if(Auth::user()->level == 'admin'){
            $pengaduans = Pengaduan::where('status', 'Baru')->orWhere('status', 'Sudah diTeruskan')->orderBy('status', 'ASC')->orderBy('tgl_aduan', 'DESC')->get();
            $users = User::all();

            return view('admin.masuk', [
                'pengaduans' => $pengaduans,
                'users' => $users
            ]);
        }elseif(Auth::user()->level == 'teknisi'){
            $pengaduans = Pengaduan::where('user_id', Auth::user()->id)->whereNotNull('catatan')->where('status', 'Sudah diTeruskan')->orderBy('tgl_aduan', 'DESC')->get();

            return view('teknisi.masuk', [
                'pengaduans' => $pengaduans,
            ]);
        }
        
    }

    public function tambah(Request $request){
        $this->validate($request, [
            'nip' => 'required',
            'barang' => 'required',
            'lokasi' => 'required',
            'tgl_aduan' => '',
            'isi_aduan' => 'required',
            'pelapor_id' => ''
        ]);

        $split = explode(" - ", $request->nip);
        $pelapor_id = Pelapor::select('id')->where('nip', $split[0])->first();
        $pengaduans = Pengaduan::create([
            'nip' => $split[0],
            'barang' => $request->barang,
            'lokasi' => $request->lokasi,
            'tgl_aduan' => Carbon::now(),
            'isi_aduan' => $request->isi_aduan,
            'status' => 'Baru',
            'pelapor_id' => $pelapor_id->id
        ]);
        Pelapor::where('nip', $split[0])->update(['no_telp' => $request->no_telp]);

        if($pengaduans){
            Alert::success('Sukses Tambah', 'Data berhasil ditambahkan');
            // alihkan halaman ke halaman pegawai
            return redirect()->back();
        }else {
            Alert::error('Gagal Tambah', 'Data Gagal ditambahkan');
            // alihkan halaman ke halaman pegawai
            return redirect()->back();
        }
    }

    public function forward($id, Request $request){
        $this->validate($request, [
            'catatan' => '',
            'user_id' => ''
        ]);
        $attr = $request->all();

        if($attr){
            $peng = Pengaduan::find($id);
            $peng->status = 'Sudah diTeruskan';
            $peng->user_id = $attr['user_id'];
            $peng->catatan = $attr['catatan'];
            $peng->save();

            Alert::success('Sukses', 'Data berhasil diTeruskan');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Data gagal diTeruskan');
            return redirect()->back();
        }
        
    }

    public function detail($id){
        $pengaduans = Pengaduan::find($id);
        return view('teknisi.detail', [
            'pengaduans' => $pengaduans,
        ]);
    }

    public function selesai(){

        if(Auth::user()->level == 'admin'){
            $pengaduans = Pengaduan::get();
            return view('admin.selesai', [
                'pengaduans' => $pengaduans,
            ]);
        }elseif(Auth::user()->level == 'teknisi'){
            $pengaduans = Pengaduan::where('user_id', Auth::user()->id)->where('status', 'Selesai')->get();

            return view('teknisi.selesai', [
                'pengaduans' => $pengaduans,
            ]);
        }
    }

    public function konfirmasiSelesai($id, Request $request){
        $messages = [
            'required' => 'Field Penyelesaian & TTD Pelapor harus terisi',
        ];
        $this->validate($request, [
            'status' => '',
            'penyelesaian' => 'required'
        ], $messages);

        $attr = $request->all();
        $attr['status'] = 'Selesai';

        if($attr){
            $peng = Pengaduan::find($id);
            $peng->status = $attr['status'];
            $peng->save();

            Alert::success('Sukses', 'Laporan Selesai');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Laporan Gagal');
            return redirect()->back();
        }
    }

    public function hapus($id){
        Pengaduan::find($id)->delete();
        Alert::success('Sukses Hapus', 'Data berhasil dihapus');
        return redirect()->back();
    }

}
