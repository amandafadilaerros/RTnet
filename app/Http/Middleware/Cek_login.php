<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        // cek sudah login atau belum. jika belum kembali ke halaman login
        if (!Auth::check()) {
            return redirect('/');
        }

        // simpan data user pada variabel $user
        $user = Auth::user();
        // dd($user);
        $level = DB::table('levels')->where('nama_level', $roles)->first();
        // dd($level);

        // jika user memiliki level sesuai pada kolom pada lanjutan request
        if ($user->id_level == $level->id_level) {
            return $next($request);
        }

        // jika tidak memiliki akses maka kembalikan ke halaman login
        return redirect('/')->with('error', 'Maaf anda tidak memiliki akses');
    }
}