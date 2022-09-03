<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function getICDCODE($icd10){

        $getICDdesc = DB::table('u_hisicd10s')->where('icd10Code',$icd10)->first();

        // dd($getICDdesc);
        return response()->json([
            'icdGet'=>$getICDdesc,
            
            // 'icd10codes'=>$post9,
        ]);

    }

    public function check(){
        if(Auth::user()){
            return view('home');
        }else{
            return view('auth.login');
        }
    }
}
