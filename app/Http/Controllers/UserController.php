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

    public function changePassword($id, Request $request){
        $this->validate($request, [
            'current-password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if((Hash::check($request->get('current-password'), Auth::user()->password))) {
            if(strcmp($request->get('current-password'), $request->get('password'))){
                if(strcmp($request->get('password'), $request->get('password_confirmation')) == 0){
                    $user = User::find($id);
                    $user->password = Hash::make($request->get('password'));
                    $user->update();
                    Alert::success('Success', 'Password successfully change');
                    return redirect()->back();
                }else{
                    // Current password and new password not match
                    Alert::error('Error', 'New password and confirm password not match');
                    return redirect()->back();
                }
            }else{
                // Current password and new password cannot same
                Alert::error('Error', 'Current password and new password cannot be same');
                return redirect()->back();
            }          
        }else{
            // Current password does not matches with the password.
            Alert::error('Error', 'Current password does not matches with the password.');
            return redirect()->back();
        }
    }
}
