<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {

        return view('auth.login');
    }

    public function store(Request $request){

        $success = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($success)) {
            $user = UserModel::where('username',$success['username'])->first();
            if($user->status == 0){
                return back()->withErrors([
                    'error' => 'Akun Belum Divalidasi']);
            }
            $request->session()->regenerate();
 
            return redirect()->route('dashboard');
        }
 
        return back()->withErrors([
            'username' => 'Username/Password Salah',
            'password' => 'Username/Password Salah',
        ])->onlyInput('username');
    }

    public function logout(Request $request): RedirectResponse
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/login');

}

    public function register(){
        return view("register.register");
    }


    public function storeMember(Request $request): RedirectResponse //: RedirectResponse is return type
    {
        $newUser = $request->validate([
            'username' => ['required', 'unique:m_user,username'],
            'nama' => ['required'],
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
            'profil_img' => ['required', 'mimes:png,jpg,jpeg', 'max:1024'],
        ]);

        $newUser['level_id'] = 4;
        $newUser['status'] = 0;

        try {
          
            $profilImg = $newUser['profil_img'];
            $profilName = Str::random(10).$newUser['profil_img']->getClientOriginalName();
            $profilImg->storeAs('public/profil', $profilName);


            
             $newUser['profil_img'] = $profilName;
            
            UserModel::create($newUser);

            return redirect()->route('login')->with('success', 'Anda Berhasil Register');

        } catch (\Throwable $th) {

            return back()->withErrors([
                'error' => $th->getMessage(),
            ]);
        }
    }
}
