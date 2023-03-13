<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kwh;

class KwhController extends Controller
{
    public function index() {
        $kwh = kwh::all();
        return view('kwh', compact(['kwh']));
    } 
}
