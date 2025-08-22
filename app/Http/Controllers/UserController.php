<?php

namespace App\Http\Controllers;

// Import Model User (tabel users)
use App\Models\User;

// Import Request untuk ambil data form
use Illuminate\Http\Request;

// Import Rule validasi (misalnya unik)
use Illuminate\Validation\Rule;

// Import Auth untuk login/logout
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

   // -------------------------
   // FUNGSI LOGIN USER
   // -------------------------
   public function login(Request $request){
       // Validasi input form login
       $incomingFields = $request->validate([
           'loginname' => 'required',       // loginname wajib diisi
           'loginpassword' => 'required',   // loginpassword wajib diisi
       ]);

       // Coba login dengan Auth (cek email & password)
       if (Auth::attempt([
           'email' => $incomingFields['loginname'],      // cocokkan loginname dengan kolom email
           'password' => $incomingFields['loginpassword'] // cocokkan loginpassword dengan kolom password
       ])) {
           // Jika berhasil login, buat ulang session (keamanan)
           $request->session()->regenerate();

           // Arahkan ke halaman utama
           return redirect('/');
       }

       // Jika gagal login, kembalikan dengan error
       return back()->withErrors([
           'loginname' => 'Email atau password salah.',
       ])->withInput(); // tetap isi form terakhir user
   }

   // -------------------------
   // FUNGSI LOGOUT USER
   // -------------------------
   public function logout(){
       // Hapus session login
       Auth::logout();

       // Arahkan kembali ke halaman utama
       return redirect('/');
   }


   // -------------------------
   // FUNGSI REGISTER USER BARU
   // -------------------------
   public function register(Request $request){
       // Validasi input register
       $incomingFields = $request->validate([
           'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')], // name unik & panjang 3-10
           'email' => ['required', 'email', Rule::unique('users', 'email')],         // email valid & unik
           'password' => ['required', 'min:8', 'max:100']                            // password 8-100 karakter
       ]);

       // Enkripsi password sebelum disimpan
       $incomingFields['password'] = bcrypt($incomingFields['password']);

       // Simpan user baru ke database
       $user = User::create($incomingFields);

       // Langsung login otomatis setelah register
       Auth::login($user);

       // Arahkan ke halaman utama
       return redirect('/');
   }
}
