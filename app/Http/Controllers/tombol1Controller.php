<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tombol1Controller extends Controller
{
    public function store(Request $request)
    {
        $kamars = User::where("kamar_id", "=", $request->kamar_id)->first();
        $kamars->state_listrik = $request->state_listrik;
        $kamars->save();
    }
}
