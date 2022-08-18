<?php

namespace App\Http\Controllers;

use App\Models\U_hispatient;
use Illuminate\Http\Request;


class PatientController extends Controller
{
    //
    public function index()
    {
        $users = U_hispatient::all();

        return view('patient', compact('users'));
    }
}
