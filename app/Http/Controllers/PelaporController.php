<?php

namespace App\Http\Controllers;

use App\Imports\PelaporImport;
use Illuminate\Http\Request;
use App\Models\Pelapor;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class PelaporController extends Controller
{
    public function index(){
			$pelapors = Pelapor::get();
        return view('pelapor.index', [
					'pelapors' => $pelapors
				]);
    }

		public function tambah(Request $request){
			$this->validate($request, [
				'nip' => 'required',
				'nama' => 'required', 
				'jabatan' => 'required', 
				'jns_kelamin' => 'required',
				'no_telp' => 'required'
			]);

			$attr = $request->all();
			$pelapor = Pelapor::create($attr);
			if($pelapor){
				Alert::success('Sukses Tambah', 'Data berhasil ditambahkan');
				// alihkan halaman ke halaman pegawai
				return redirect()->back();
			}else{
				Alert::error('Gagal Tambah', 'Data Gagal ditambahkan');
				// alihkan halaman ke halaman pegawai
				return redirect()->back();
			}
		}

		public function edit(Request $request, $id){
			$this->validate($request, [
				'nip' => 'required',
				'nama' => 'required', 
				'jabatan' => 'required', 
				'jns_kelamin' => 'required',
				'no_telp' => 'required'
			]);

			$pelapor = Pelapor::find($id);
			$pelapor->nip = $request->nip;
			$pelapor->nama = $request->nama;
			$pelapor->jabatan = $request->jabatan;
			$pelapor->jns_kelamin = $request->jns_kelamin;
			$pelapor->no_telp = $request->no_telp;
			$pelapor->save();
			
			if($pelapor){
				Alert::success('Sukses Edit', 'Data berhasil Diupdate');
				// alihkan halaman ke halaman pegawai
				return redirect()->back();
			}else{
				Alert::error('Gagal Edit', 'Data Gagal Diupdate');
				// alihkan halaman ke halaman pegawai
				return redirect()->back();
			}

		}

    public function importExcel(Request $request){
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_pelapor',$nama_file);
 
		// import data
		Excel::import(new PelaporImport, public_path('/file_pelapor/'.$nama_file));

		// alihkan halaman kembali
		return redirect()->back();
    }

		public function hapus($id){
			Pelapor::find($id)->delete();
			Alert::success('Sukses Hapus', 'Data berhasil dihapus');
			return redirect()->back();

		}

		public function autocompleteNIP(Request $request)
    {
			$query = $request->get('term','');
			$data = DB::table('pelapors')
									->where('nip','LIKE','%'.$query.'%')
									->get();
			$results = [];
			foreach($data as $row) {
					$results[] = ['id' => $row->id, 'value' => $row->nip. ' - ' .$row->nama];
			}
			return response()->json($results);
    }
}
