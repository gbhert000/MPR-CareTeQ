<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function validateuseremail(Request $request)
   {
    $user = User::where('email', $request->email)->first('email');
       if($user){
         $return =  false;

        }
        else{
         $return= true;
        }
        echo json_encode($return);
        exit;
   }
}
