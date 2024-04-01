<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
      public function index(UserDataTable $dataTable){
        return $dataTable->render('user.index');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        UserModel::create([
            'level_id' => $request->levelId,
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password,
           // 'kategori_nama' => $request->namaKategori,
        ]);
        return redirect('/user');
    }

}
