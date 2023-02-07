<?php

namespace App\Http\Controllers;

use App\Models\Followup;
use App\Models\Kinerja;
use App\Models\Pengaduan;
use \App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FollowupController extends Controller
{
    public function masukUpdate($id, Request $request){
        $pengaduans = Pengaduan::find($id);
        $this->validate($request, [
            'permasalahan' => '',
            'tgl_followups' => '',
            'pengerjaan' => '',
            'status' => ''
        ]);
        $attr = $request->all();
        $attr['user_id'] = $pengaduans->user_id;
        $attr['pengaduan_id'] = $pengaduans->id;
        $attr['tgl_followups'] = Carbon::now();
    
        $followups = Followup::create($attr);

        $tgl_begin2 = new DateTime(Carbon::now()->format('Y-m-d'));
        $tgl_end2 = New DateTime($pengaduans->updated_at->addDay(2)->format('Y-m-d'));

        if(Carbon::now()->format('Y-m-d') < $pengaduans->updated_at->addDay(2)->format('Y-m-d')){

            Kinerja::create([
                'poin_cek' => 5,
                'over_cek' => '0 Hari',
                'user_id'=> $pengaduans->user_id,
                'pengaduan_id' => $pengaduans->id,
                'followup_id' => $followups->id
            ]);

        }elseif(Carbon::now()->format('Y-m-d') >= $pengaduans->updated_at->addDay(2)->format('Y-m-d')){
            $jarak = $tgl_end2->diff($tgl_begin2);
            if($jarak->d == 0) {
                Kinerja::create([
                'poin_cek' => 5,
                'over_cek' => $jarak->d . ' Hari',
                'user_id'=> $pengaduans->user_id,
                'pengaduan_id' => $pengaduans->id,
                'followup_id' => $followups->id
            ]);
            }elseif($jarak->d != 0){
            Kinerja::create([
                'poin_cek' => 2,
                'over_cek' => $jarak->d . ' Hari',
                'user_id'=> $pengaduans->user_id,
                'pengaduan_id' => $pengaduans->id,
                'followup_id' => $followups->id
            ]);
            }
        }

        $pengaduans->status = 'Progres';
        $pengaduans->save();

        if($followups) {
        Alert::success('Sukses', 'Data berhasil diUpdate');
        return redirect()->back();
        }else{
            Alert::error('Gagal', 'Data gagal diUpdate');
            return redirect()->back();
        }
    }

    public function progresUpdate($id, Request $request){
        $this->validate($request, [
            'penyelesaian' => ''
        ]);


        $followups = Followup::find($id);
        $followups->penyelesaian = $request->penyelesaian;
        $followups->save();
         
        if($followups) {
            Alert::success('Sukses', 'Data berhasil diUpdate');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Data gagal diUpdate');
            return redirect()->back();
        }
    }

    public function detailSelesai($id){
        $followups = Followup::find($id);
        return view('admin.detail', [
            'followups' => $followups,
        ]);
    }

    public function progres(){

        if(Auth::user()->level == 'admin'){

            $followups = Followup::whereHas('pengaduan', function($query) {
                $query->where('status', 'Progres')->orWhere('status', 'Menunggu Konfirmasi Sarpas');
            })->get();
    
            return view('admin.progres', [
                'followups' => $followups            
            ]);

        }elseif(Auth::user()->level == 'teknisi'){
            $followups = Followup::where('user_id', Auth::user()->id)->whereHas('pengaduan', function ($query) {
                $query->where('status', 'Progres')->orWhere('status', 'Menunggu Konfirmasi Sarpas');
            })->get();
    
            return view('teknisi.progres', [
                'followups' => $followups,
            ]);
        }
    }

    public function uploadSignature($id, Request $request)
    {
        $this->validate($request, [
            'signature64' => '',
        ]);
        $folderPath = public_path('signatures/');
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $signature = uniqid() . '.'.$image_type;       
        $image_base64 = base64_decode($image_parts[1]);   
        $file = $folderPath . $signature;
        file_put_contents($file, $image_base64);

        $followups = Followup::find($id);
        if(empty($followups->penyelesaian)){
            Alert::error('Gagal', 'Harap isi penyelesaian perbaikan');
            return redirect()->back();
        }else{
            $tgl_begin2 = new DateTime(Carbon::now()->format('Y-m-d'));
            $tgl_end2 = New DateTime($followups->updated_at->addDay(5)->format('Y-m-d'));

            if(Carbon::now()->format('Y-m-d') < $followups->updated_at->addDay(5)->format('Y-m-d')){
                Kinerja::where('followup_id', $id)->update([
                    'poin_selesai' => 5,
                    'over_selesai' => '0 Hari'
                ]);

            }elseif(Carbon::now()->format('Y-m-d') >= $followups->updated_at->addDay(5)->format('Y-m-d')){
                $jarak = $tgl_end2->diff($tgl_begin2);
                if($jarak->d == 0) {
                    Kinerja::where('followup_id', $id)->update([
                        'poin_selesai' => 5,
                        'over_selesai' => $jarak->d . ' Hari'
                    ]);
                }elseif($jarak->d != 0){
                    Kinerja::where('followup_id', $id)->update([
                        'poin_selesai' => 2,
                        'over_selesai' => $jarak->d . ' Hari'
                    ]);
                }
            }

            if(!empty($request->penyelesaian)){
                Followup::find($id)->update([
                    'penyelesaian' => $request->penyelesaian,
                    'tgl_followups' => Carbon::now()
                ]);
            }else {
                Followup::find($id)->update([
                    'tgl_followups' => Carbon::now()
                ]);
            }

            $followups->pengaduan->signature = $signature;
            $followups->pengaduan->status = 'Menunggu Konfirmasi Sarpas';
            $followups->pengaduan->catatan = 'Telah di Tindak Lanjuti';
            $followups->pengaduan->save();

            Alert::success('Sukses', 'Laporan berhasil di update');
            return redirect()->back();
        }
    }

    
}
