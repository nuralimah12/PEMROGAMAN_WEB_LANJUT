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
   $user = UserModel::firstOrNew(
    [
            'username' => 'manager33',
            'nama'=> 'Manager Tiga Tiga',
            'password'=> Hash::make('12345'),
            'level_id'=> 2
            /*'username' => 'manager',
            'nama'=> 'Manager',*/
    ],
    );
    $user->save();
    return view('user', ['data' => $user]);
    }
}
