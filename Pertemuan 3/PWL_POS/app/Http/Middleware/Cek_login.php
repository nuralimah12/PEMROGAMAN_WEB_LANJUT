<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response; // Ganti dengan Illuminate\Http\Response

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  $roles
     * @return \Illuminate\Http\Response // Ganti dengan Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!Auth::check()) { // Perbaiki kurung kurawal dan tambahkan tanda "!"
            return redirect('login');
        }

        $user = Auth::user();

        if ($user->level_id == $roles) {
            return $next($request);
        }

        return redirect('login')->with('error', 'Maaf, Anda tidak memiliki akses'); // Perbaiki pesan error
    }
}
