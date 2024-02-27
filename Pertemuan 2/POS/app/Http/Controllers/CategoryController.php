<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function food()
    {
        return view('category.food');
    }

    public function beauty()
    {
        return view('category.beauty');
    }

    public function homecare()
    {
        return view('category.homecare');
    }

    public function babykid()
    {
        return view('category.babykid');
    }
}

