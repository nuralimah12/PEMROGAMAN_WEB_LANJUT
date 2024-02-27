<?php  
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
 
class PageController extends Controller 
{       public function index() { 
         return 'Salamat Datang'; 
 	} 
        public function about() { 
        return 'Nama : Nur Alimah, NIM:2141762004'; 
        }    
        
        public function articles($id) { 
                return 'Halaman Artikel dengan Id'.$id; 
        }        
        

} 


