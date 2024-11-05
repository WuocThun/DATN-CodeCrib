<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function phongNgu() {
        return view('Demo.index');
    }
    public function loginNav() {
        return view('Demo.login_navbar');

    }
    public function nhaVeSinh() {
        
    }
    public function nhaBep() {
        
    }

}
