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

    public function cekLaporan(){
        $getLaporan = Pengaduan::select('pelapors.nama', 'isi_aduan', 'tgl_aduan', 'users.name', 'tgl_followups', 'status')
        ->join('pelapors', 'pelapors.nip', '=', 'pengaduans.nip')
        ->leftJoin('users', 'users.id', '=', 'pengaduans.user_id')->orderBy('pengaduans.created_at', 'desc')->get();

        return view('luar.index', [
            'getLaporan' => $getLaporan
        ]);
    }

    public function masuk(){

        if(Auth::user()->level == 'admin'){
            $pengaduans = Pengaduan::where('status', 'Baru')->orWhere('status', 'Dalam Antrian')->orderBy('status', 'ASC')->orderBy('created_at', 'DESC')->get();
            $users = User::all();

            return view('admin.masuk', [
                'pengaduans' => $pengaduans,
                'users' => $users
            ]);
        }elseif(Auth::user()->level == 'teknisi'){
            $pengaduans = Pengaduan::where('user_id', Auth::user()->id)->whereNotNull('catatan')->where('status', 'Dalam Antrian')->orderBy('tgl_aduan', 'DESC')->get();

            return view('teknisi.masuk', [
                'pengaduans' => $pengaduans
            ]);
        }
        
    }

    public function tambah(Request $request){
        $this->validate($request, [
            'nip' => 'required',
            'barang' => 'required',
            'no_telp' => 'required',
            'lokasi' => 'required',
            'tgl_aduan' => '',
            'isi_aduan' => 'required'
        ]);

        $split = explode(" - ", $request->nip);
        $insertData = Pelapor::where('nip', $split[0])->first();
        if(!empty($insertData)){
            $pengaduans = Pengaduan::create([
                'nip' => $split[0],
                'barang' => $request->barang,
                'lokasi' => $request->lokasi,
                'tgl_aduan' => Carbon::now(),
                'isi_aduan' => $request->isi_aduan,
                'status' => 'Baru'
            ]);
            Pelapor::where('nip', $split[0])->update(['no_telp' => $request->no_telp]);
        }else{
            Alert::error('Gagal', 'NIP tidak ada di data');
            return redirect()->back();
        }

        if($pengaduans){
            Alert::success('Sukses Tambah', 'Data berhasil ditambahkan');
            return redirect()->back();
        }else {
            Alert::error('Gagal Tambah', 'Data Gagal ditambahkan');
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
            $peng->status = 'Dalam Antrian';
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
