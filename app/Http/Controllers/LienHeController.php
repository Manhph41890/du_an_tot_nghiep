<?php

namespace App\Http\Controllers;

use App\Models\lien_he;
use Illuminate\Http\Request;

class LienHeController extends Controller
{
    //
    public function showForm(){
        return view('client.lien_he');
    }

}
