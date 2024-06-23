<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HeaderController extends Controller
{
    public function showHeader()
    {
        
        // Contoh pengguna dengan status 0
    $user = UserModel::where('status', 0)->first();

    if ($user) {
        $notification = 'Validate User: ' . $user->name;
    } else {
        $notification = null;
    }

    return view('header', ['notification' => $notification]);
    }
}
