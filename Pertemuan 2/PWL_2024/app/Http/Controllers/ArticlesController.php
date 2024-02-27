<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function __invoke($id) { 
        return 'Halaman Artikel dengan Id'.$id; 
}        
}
