<?php

namespace App\Http\Controllers;

use App\Models\lien_he;
use Illuminate\Http\Request;

class LienHeController extends Controller
{
    // đường dẫn vào form liên hệ
    public function create(){
        return view('client.lien_he');
    }
    
}
