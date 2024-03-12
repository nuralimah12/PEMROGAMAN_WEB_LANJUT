<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
    //$user = UserModel::find(1);
    //$user = UserModel::where('level_id',1)->first();
    //$user = UserModel::firstWhere('level_id',1);
    //$user = UserModel::findOrFail(1);
   // $user = UserModel::where('level_id', 2)->count();
   // dd($user); 
   $user = UserModel::create(
    [
            'username' => 'manager11',
            'nama'=> 'Manager11',
            'password'=> Hash::make('12345'),
            'level_id'=> 2,
            /*'username' => 'manager',
            'nama'=> 'Manager',*/
    ],
    );
    $user->username = 'manager12';

    $user->save();

    $user->wasChanged();
    $user->wasChanged('username');
    $user->wasChanged(['username','level_id']);
    $user->wasChanged('nama');
    dd($user->wasChanged(['nama','username']));
   // return view('user', ['data' => $user]);
    }
}
