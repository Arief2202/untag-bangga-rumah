<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekamarRequest;
use App\Http\Requests\UpdatekamarRequest;
use App\Models\kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(){        
        if(isset(Auth::user()->name)){
            $kamar1 = kamar::where('kamar_id', '=', '1')->get()->last();
            $kamar2 = kamar::where('kamar_id', '=', '2')->get()->last();
            
            $tegangan = (float) $kamar1->tegangan > (float) $kamar2->tegangan ? (float) $kamar1->tegangan : (float) $kamar2->tegangan;
            $arus = (float) $kamar1->arus + (float) $kamar2->arus;
            $daya = (float) $kamar1->daya + (float) $kamar2->daya;
            return view('dashboard', [
                "tegangan" => $tegangan,
                "arus" => $arus,
                "daya" => $daya,
            ]);
        }
        else{
            return view('login');
        }
    }
    
    public function read($id)
    {
        $kamar = kamar::where('kamar_id', '=', $id)->get()->last();
        return view('kamar', [
            "id" => $id,
            "kamar" => $kamar,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('create');

    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorekamarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isset($request->state_lampu)){
            $request->state_lampu = kamar::where("kamar_id", "=", $request->kamar_id)->get()->last()->state_lampu;
        }
        if(!isset($request->state_listrik)){
            $request->state_listrik = kamar::where("kamar_id", "=", $request->kamar_id)->get()->last()->state_listrik;
        }
        kamar::create([
            'kamar_id' => $request->kamar_id,
            'state_lampu' => $request->state_lampu,
            'state_listrik' => $request->state_listrik,
            'tegangan' => $request->tegangan,
            'arus' => $request->arus,
            'daya' => $request->daya,
            'kwh' => $request->kwh,
        ]);
        return redirect ('/');
    }
    
    public function createAPI(Request $request)
    {
        $request = $request->validate([
            "kamar_id" => "required",
            "state_lampu" => "required",
            "state_listrik" => "required",
            "tegangan" => "required",
            "arus" => "required",
            "daya" => "required",
            "kwh" => "required",
       ]);
        kamar::create($request);
        return redirect ('/');
        //
    }
    
    public function readAPI_ID($id)
    {
        $kamars = kamar::where('kamar_id', '=', $id)->get();
        $kamarLast = $kamars->last();
        $kamarLast->tegangan = (float)$kamarLast->tegangan;
        $kamarLast->arus = (float)$kamarLast->arus;
        $kamarLast->daya = (float)$kamarLast->daya;
        return response()->json(
            [
                'success' => true,
                'count' => $kamars->count(),
                'last' => $kamarLast,
                'data' => $kamars,
                'pesan' => ''
            ],
            200
        )->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
    public function readAPI_ID_aksi($id, $aksi)
    {
        $kamars = kamar::where('kamar_id', '=', $id)->get();
        $kamarLast = $kamars->last();
        $kamarLast->tegangan = (float)$kamarLast->tegangan;
        $kamarLast->arus = (float)$kamarLast->arus;
        $kamarLast->daya = (float)$kamarLast->daya;
        if($aksi == "lampu") return $kamarLast->state_lampu;
        if($aksi == "listrik") return $kamarLast->state_listrik;
        // return response()->json(
        //     [
        //         'success' => true,
        //         'count' => $kamars->count(),
        //         'last' => $kamarLast,
        //         'data' => $kamars,
        //         'pesan' => ''
        //     ],
        //     200
        // )->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }

    public function readAPI()
    {
        $kamar1 = kamar::where('kamar_id', '=', '1')->get()->last();
        $kamar2 = kamar::where('kamar_id', '=', '2')->get()->last();
        
        $tegangan = (float) $kamar1->tegangan > (float) $kamar2->tegangan ? (float) $kamar1->tegangan : (float) $kamar2->tegangan;
        $arus = (float) $kamar1->arus + (float) $kamar2->arus;
        $daya = (float) $kamar1->daya + (float) $kamar2->daya;
        return response()->json(
            [
                'success' => true,
                'tegangan' => strval($tegangan),
                'arus' => strval($arus),
                'daya' => strval($daya),
                'kamar1' => $kamar1,
                'kamar2' => $kamar2,
                'pesan' => ''
            ],
            200
        )->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }

    public function changeState($id, $str){        
        $kamar = kamar::where('kamar_id', '=', $id)->get()->last();
        if($str == 'lampu'){
            $kamar->state_lampu = $kamar->state_lampu == 1 ? 0 : 1; 
        }
        else if($str == 'listrik'){
            $kamar->state_listrik = $kamar->state_listrik == 1 ? 0 : 1; 
        }
        $kamar->save();
        return redirect('http://rumah.sks-pens.site/kamar/'.$id);
        // return response()->json(
        //     [
        //         'success' => true,
        //         'data' => kamar::where('kamar_id', '=', $id)->get()->last(),
        //         'pesan' => ''
        //     ],
        //     200
        // )->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
    
}
