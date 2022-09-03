<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PDF;
use App\Models\User;
class ReportController extends Controller
{
    public function index(){
      
      
       
        return view('report');


      //  $array = json_decode(json_encode($PatientInfos), true);
    //  return view('Reports.masterpatientrecord',compact('PatientInfos'));
     // return view('report');
    //   $arrayData = array_map(function($item) {
    //     return (array)$item; 
    // }, $PatientInfos->toArray());
      
        
    //     $pdf = PDF::loadView('Reports.masterpatientrecord', $arrayData);
            
    //     return $pdf->download('test.pdf');

    }

    public function test( ){
    
      
     // dd($test);
        return view('Reports.test');
    }
    public function test2( $request){

        DB::statement('CREATE TEMPORARY TABLE test ( `Name` varchar(100) ,`Date1` varchar(100),`Date2` varchar(100))');
        DB::table('test')->insert(["Name" => $request]);
        $test = DB::table('test')->get();
        // dd( $request);

        
      return view('Reports.test2',compact('test'));
    }

    public function filter1( $request,$test23){

        DB::statement('CREATE TEMPORARY TABLE test ( `Name` varchar(100) ,`Date1` varchar(100),`Date2` varchar(100))');
        DB::table('test')->insert(["Name" => $request, "Date1" =>$test23, "Date2" =>"test"]);
        $test = DB::table('test')->get();
        // dd( $request);

        
      return view('Reports.test2',compact('test'));
    }
    public function getFile($patient){
      // dd($patient);
      foreach($patient as $data){
        $value = $data;
      }
     
      return $value->imageName;
    }
    public function filter2( ){

        
      return view('Reports.test2');
    }
   
    public function generatePDF($CODE)
    {
       // $users = User::get();

       $PatientContact = DB::table('u_hiscontacts')
       ->where ('CODE', $CODE)
       ->get();
    //   dd( $PatientContact);
       $PatientInfos = DB::table('v_mprform')
      
       ->where('MPI', $CODE)
       ->get();

       $PatientInfos2 = DB::table('v_mprform')
        
       ->where('MPI', $CODE)
       ->selectRaw('imageName')
       ->pluck('imageName');
      
    //    dd($PatientInfos2[0]);
       $result = str_replace(array('[', ']','"'), '', htmlspecialchars(json_encode($PatientInfos2), ENT_NOQUOTES));
  
     $path = public_path().'/myfiles/uploads/'.$result;
    $imageF=File::get(public_path('/myfiles/uploads/'.$PatientInfos2[0]));
        // dd($imageF);
     //   $pathimage ='C:\Users\ADMIN\Documents\Laravel\CareTeQ (2)\CareTeQ\storage\app\public\images\6305b6a9dbedb.png';
      $image = base64_encode(file_get_contents(   $path));
          //$imageName = $this->getFile($PatientInfos);
        
       // dd( $path);
      
        $data = [
            
            'PatientInfossss' => $PatientInfos,
            'Image'=>$image,
            'PatientContact' =>$PatientContact,
            'imageF'=>$imageF,

          ]; 
            
        // $pdf = PDF::loadView('myPDF', $data);
        // $pdf->setPaper('Letter', 'portrait'); 
        
        //   $pdf->setPaper()->set('isremoteblah',true);
    
        $pdf = PDF::setPaper('a4', 'portrait')->setOptions(['dpi' => 100, 'defaultFont' => 'cambria', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'isJavascriptEnabled' => true])->loadView('myPDF', $data)->setWarnings(false);
        // $pdf->output();
        // $dom_pdf = $pdf->getDomPDF();
        
        // $canvas =  $pdf ->get_canvas();
        // $canvas->page_text(0, 0, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
        
        return $pdf->download('MPIForm.pdf');
        // return view('Reports.masterpatientrecord',compact('PatientInfos','imageF'));//tapos paste mo to


   
    //     $pdf = PDF::loadView('myPDF', $data);
    //     $pdf->getDomPDF()->setHttpContext(
    //         stream_context_create([
    //             'ssl' => [
    //                 'allow_self_signed'=> TRUE,
    //                 'verify_peer' => FALSE,
    //                 'verify_peer_name' => FALSE,
    //             ]
    //         ])
    //     );
    
    //     return $pdf->download('Users.pdf');
    // }
}
}