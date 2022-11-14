<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function tambah(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'level' => 'required',
            'password' => 'required',
        ]);

        $attr = $request->all();
        $attr['password'] = Hash::make($request->password);
        $users = User::create($attr);

        if($users){
            Alert::success('Sukses Tambah', 'Data berhasil ditambahkan');
            // alihkan halaman ke halaman pegawai
            return redirect()->back();
        }else {
            Alert::error('Gagal Tambah', 'Data Gagal ditambahkan');
            // alihkan halaman ke halaman pegawai
            return redirect()->back();
        }
    }

    public function hapus($id){
        User::find($id)->delete();
        Alert::success('Sukses Hapus', 'Data berhasil dihapus');
        return redirect()->back();
    }

    public function reset($id){
        User::find($id)->update([
            'password' => Hash::make('12345678')
        ]);
        Alert::success('Sukses Reset', 'Password berhasil di reset');
        return redirect()->back();
    }

    public function changePassword(Request $request){
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        // #Match The Old Password
        // if(!Hash::check($request->old_password, auth()->user()->password)){
        //     return back()->with("error", "Old Password Doesn't match!");
        // }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
