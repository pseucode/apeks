<?php

namespace App\Http\Controllers;

use App\Models\Followup;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use PDF;

class FollowupController extends Controller
{
    public function masukUpdate($id, Request $request){
        $pengaduans = Pengaduan::find($id);
        $this->validate($request, [
            'permasalahan' => '',
            'penyelesaian' => '',
            'tgl_followups' => '',
            'pengerjaan' => '',
            'status' => ''
        ]);
        $attr = $request->all();
        $attr['user_id'] = $pengaduans->user_id;
        $attr['pengaduan_id'] = $pengaduans->id;
        $attr['tgl_followups'] = Carbon::now();
        $followups = Followup::create($attr);

        $peng = Pengaduan::find($id);
        $peng->status = 'Progres';
        $peng->save();

        if($followups) {
        Alert::success('Sukses', 'Data berhasil diUpdate');
        return redirect()->back();
        }else{
            Alert::success('Gagal', 'Data gagal diUpdate');
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

        $followups = Followup::find($id);
        $followups->pengaduan->signature = $signature;
        $followups->pengaduan->status = 'Menunggu Konfirmasi Sarpas';
        $followups->pengaduan->catatan = 'Telah di Tindak Lanjuti';
        $followups->pengaduan->save();

        Alert::success('Sukses', 'Laporan berhasil di update');
        return redirect()->back();
    }
}
