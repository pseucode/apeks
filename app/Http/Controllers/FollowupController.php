<?php

namespace App\Http\Controllers;

use App\Models\Followup;
use App\Models\Kinerja;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;


class FollowupController extends Controller
{
    public function masukUpdate($id, Request $request){
        $this->validate($request, [
            'permasalahan' => 'required',
            'tgl_followups' => '',
            'pengerjaan' => 'required'
        ]);
        $pengaduans = Pengaduan::find($id);      
        $pengaduans->permasalahan = $request->permasalahan;
        $pengaduans->tgl_followups = Carbon::now();
        $pengaduans->pengerjaan = $request->pengerjaan;
        $pengaduans->status = 'Progres';
        $pengaduans->save();

        $tgl_begin2 = new DateTime(Carbon::now()->format('Y-m-d'));
        $tgl_end2 = New DateTime($pengaduans->updated_at->addDay(2)->format('Y-m-d'));

        if(Carbon::now()->format('Y-m-d') < $pengaduans->updated_at->addDay(2)->format('Y-m-d')){

            Kinerja::create([
                'poin_cek' => 5,
                'over_cek' => '0 Hari',
                'user_id'=> $pengaduans->user_id,
                'pengaduan_id' => $pengaduans->id,
            ]);

        }elseif(Carbon::now()->format('Y-m-d') >= $pengaduans->updated_at->addDay(2)->format('Y-m-d')){
            $jarak = $tgl_end2->diff($tgl_begin2);
            if($jarak->d == 0) {
                Kinerja::create([
                'poin_cek' => 5,
                'over_cek' => $jarak->d . ' Hari',
                'user_id'=> $pengaduans->user_id,
                'pengaduan_id' => $pengaduans->id
            ]);
            }elseif($jarak->d != 0){
            Kinerja::create([
                'poin_cek' => 2,
                'over_cek' => $jarak->d . ' Hari',
                'user_id'=> $pengaduans->user_id,
                'pengaduan_id' => $pengaduans->id
            ]);
            }
        }

        if($pengaduans) {
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


        $pengaduans = Pengaduan::find($id);
        $pengaduans->penyelesaian = $request->penyelesaian;
        $pengaduans->save();
         
        if($pengaduans) {
            Alert::success('Sukses', 'Data berhasil diUpdate');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Data gagal diUpdate');
            return redirect()->back();
        }
    }

    public function detailSelesai($id){
        $pengaduans = Pengaduan::find($id);
        return view('admin.detail', [
            'pengaduans' => $pengaduans,
        ]);
    }

    public function progres(){

        if(Auth::user()->level == 'admin'){

            $pengaduans = Pengaduan::where('status', 'Progres')->orWhere('status', 'Menunggu Konfirmasi Sarpas')->get();
    
            return view('admin.progres', [
                'pengaduans' => $pengaduans            
            ]);

        }elseif(Auth::user()->level == 'teknisi'){
            $pengaduans = Pengaduan::where('user_id', Auth::user()->id)->where('status', 'Progres')->orWhere('status', 'Menunggu Konfirmasi Sarpas')->get();
    
            return view('teknisi.progres', [
                'pengaduans' => $pengaduans,
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

        $pengaduans = Pengaduan::find($id);
        if(empty($pengaduans->penyelesaian)){
            Alert::error('Gagal', 'Harap isi penyelesaian perbaikan');
            return redirect()->back();
        }else{
            $tgl_begin2 = new DateTime(Carbon::now()->format('Y-m-d'));
            $tgl_end2 = New DateTime($pengaduans->updated_at->addDay(5)->format('Y-m-d'));
            if(Carbon::now()->format('Y-m-d') < $pengaduans->updated_at->addDay(5)->format('Y-m-d')){

                Kinerja::where('pengaduan_id', $id)->update([
                    'poin_selesai' => 5,
                    'over_selesai' => '0 Hari'
                ]);

            }elseif(Carbon::now()->format('Y-m-d') >= $pengaduans->updated_at->addDay(5)->format('Y-m-d')){
                $jarak = $tgl_end2->diff($tgl_begin2);
                if($jarak->d == 0) {
                    Kinerja::where('pengaduan_id', $id)->update([
                        'poin_selesai' => 5,
                        'over_selesai' => $jarak->d . ' Hari'
                    ]);
                }elseif($jarak->d != 0){
                    Kinerja::where('pengaduan_id', $id)->update([
                        'poin_selesai' => 2,
                        'over_selesai' => $jarak->d . ' Hari'
                    ]);
                }
            }

            if(!empty($request->penyelesaian)){
                Pengaduan::find($id)->update([
                    'penyelesaian' => $request->penyelesaian,
                    'tgl_followups' => Carbon::now()
                ]);
            }else {
                Pengaduan::find($id)->update([
                    'tgl_followups' => Carbon::now()
                ]);
            }

            $pengaduans->signature = $signature;
            $pengaduans->status = 'Menunggu Konfirmasi Sarpas';
            $pengaduans->catatan = 'Telah di Tindak Lanjuti';
            $pengaduans->save();

            Alert::success('Sukses', 'Laporan berhasil di update');
            return redirect()->back();
        }
    }

    
}
