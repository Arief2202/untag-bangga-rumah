<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tombolController extends Controller
{
    public function store(Request $request)
    {
        $kamars= User::where("kamar_id", "=", $request->kamar_id)->first();
        $kamars->state_lampu = $request->state_lampu;
        $kamars->save();
    }
}
