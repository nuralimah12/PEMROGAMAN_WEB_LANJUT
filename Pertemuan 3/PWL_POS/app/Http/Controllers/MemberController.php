<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Monolog\Level;

class MemberController extends Controller
{
    public function index(){
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home','User']
        ];

        $page = (object) [
            'title' => 'Daftar User yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';
      

        return view('user.index',['breadcrumb' => $breadcrumb, 'page' => $page,  'activeMenu' => $activeMenu]);
    } 

    public function edit(string $id) {
        $user = UserModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list'  => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit user'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('member.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }
    public function update(Request $request, string $id) {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama'     => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
            'password' => 'nullable|min:5',          // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password
            
        ]);

        return redirect('/')->with('success', 'Data user berhasil diubah');
    }
}
