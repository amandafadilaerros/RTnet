<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\validator;

class AuthController extends Controller
{
    public function index()
    {

        //kita ambil data user lalu simpan pada variabel $user
        $user = Auth::user();

        //kondisi jika user nya ada
        if ($user) {

            if ($user->id_level == '1') {
                return redirect()->intended('RT');
            }
            if ($user->id_level == '2') {
                return redirect()->intended('Sekretaris');
            }
            if ($user->id_level == '3') {
                return redirect()->intended('Bendahara');
            }
            if ($user->id_level == '4') {
                return redirect()->intended('Penduduk');
            }
        }
        return view('login');
    }
    public function proses_login(Request $request)
    {
        // Validasi username & password wajib diisi
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Ambil data nomor KK dari input
        $no_kk = $request->input('username');

        // Buat hash dari nomor KK
        $password = Hash::make($no_kk);

        // Cari user berdasarkan nomor KK
        $user = User::where('username', $no_kk)->first();

        // Jika user ditemukan dan password cocok
        if ($user && Hash::check($no_kk, $user->password)) {
            // Login user
            Auth::login($user);

            // Redirect sesuai dengan level user
            if ($user->id_level == '1') {
                return redirect()->intended('RT');
            } elseif ($user->id_level == '2') {
                return redirect()->intended('Sekretaris');
            } elseif ($user->id_level == '3') {
                return redirect()->intended('Bendahara');
            } elseif ($user->id_level == '4') {
                return redirect()->intended('Penduduk');
            }
            // Jika tidak ada level user yang cocok, arahkan ke halaman '/'
            return redirect()->intended('/');
        }

        // Jika tidak ditemukan user dengan nomor KK yang sesuai, kembalikan ke halaman login dengan pesan error
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Pastikan nomor KK yang dimasukkan sudah benar']);
    }



    public function logout(Request $request)
    {
        //logout itu harus menghapus session nya
        $request->session()->flush();

        //jalankan juga fungsi logout pada auth
        Auth::logout();
        //kembali kan ke halaman login
        return Redirect('login');
    }

}
