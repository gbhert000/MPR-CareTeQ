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
      
      $patient_info = DB::table('u_hispatients')->where('CODE','=',$CODE)->get();
       //$users = User::get();
      $last_visit = DB::table('u_hisvisits')->where('U_PATIENTID','=',$CODE)->orderBy('DOCNO','DESC')->first();
      $start_visit = DB::table('u_hisvisits')->where('U_PATIENTID','=',$CODE)->orderBy('U_STARTDATE','ASC')->first();
      $patient_HMO = DB::table('v_patientshmo')->distinct()->where('Code','=',$CODE)->first();
      // dd($last_visit);
      $PatientContact = DB::table('u_hiscontacts')
       ->where ('CODE', $CODE)
       ->get();
      //dd( $PatientContact);
      $PatientInfos = DB::table('v_mprform')
      
       ->where('MPI', $CODE)
       ->get();

       $PatientInfos2 = DB::table('v_mprform')
        
       ->where('MPI', $CODE)
       ->selectRaw('imageName')
       ->pluck('imageName');
      
      //    dd($PatientInfos2[0]);
      // $result = str_replace(array('[', ']','"'), '', htmlspecialchars(json_encode($PatientInfos2), ENT_NOQUOTES));
  
      // $path = public_path().'/myfiles/uploads/'.$result;
      
      $imageF=File::get(public_path('/myfiles/uploads/'.$PatientInfos2[0]));
        // dd($imageF);
      //   $pathimage ='C:\Users\ADMIN\Documents\Laravel\CareTeQ (2)\CareTeQ\storage\app\public\images\6305b6a9dbedb.png';
      // $image = base64_encode(file_get_contents(   $path));
          //$imageName = $this->getFile($PatientInfos);

          $LogoF = public_path().'/myfiles/uploads/logo.jpg';
          $imageLogo = base64_encode(file_get_contents( $LogoF));
        
      foreach($patient_info as $datas){
          $value = $datas;
      }
      
        if(!$last_visit){
          
          $data = [
            
            'PatientInfos' => $PatientInfos,
            // 'Image'=>$image,
            'PatientContact' =>$PatientContact,
            'imageF'=>$imageF,
            'imageLogo'=>$imageLogo,
            'last_visit_info'=>$last_visit,
            'U_STARTDATE'=>null,
            'U_ENDDATE'=>null,
            'HOSPITALID'=>NULL,
            'COMPANY'=>null,
            'VISITTYPE'=>null,
            'CHIEFCOMPLAINT'=>null,
            'U_ICDCODE'=>null,
            'U_ICDDESC'=>null,
            'NOTES'=>null,
            'patient_info'=>$patient_info,
            'U_RESPONSIBLENAME'=>strtoupper($value->U_RESPONSIBLENAME),
            'U_RESPONSIBLEADDRESS'=>strtoupper($value->U_RESPONSIBLEADDRESS),
            'U_RESPONSIBLEEMPLOYER'=>strtoupper($value->U_RESPONSIBLEEMPLOYER),
            'U_RESPONSIBLETELNO'=>strtoupper($value->U_RESPONSIBLETELNO),
            'U_RESPONSIBLERELATIONSHIP'=>strtoupper($value->U_RESPONSIBLERELATIONSHIP),
            'U_RESPONSIBLESTREET'=>strtoupper($value->U_RESPONSIBLESTREET),
            'U_RESPONSIBLEBARANGAY'=>strtoupper($value->U_RESPONSIBLEBARANGAY),
            'U_RESPONSIBLECITY'=>strtoupper($value->U_RESPONSIBLECITY),
            'U_RESPONSIBLEZIP'=>$value->U_RESPONSIBLEZIP,
            'U_RESPONSIBLEPROVINCE'=>$value->U_RESPONSIBLEPROVINCE,
            'U_RESPONSIBLECOUNTRY'=>$value->U_RESPONSIBLECOUNTRY,
            'U_MOBILENO'=>$value->U_MOBILENO,
            'U_CONTACTNAME'=>$value->U_CONTACTNAME,
            'U_CONTACTADDRESS'=>$value->U_CONTACTADDRESS,
            'U_CONTACTTELNO'=>$value->U_CONTACTTELNO,
            'U_CONTACTRELATIONSHIP'=>$value->U_CONTACTRELATIONSHIP,
            'patient_HMO'=>$patient_HMO
            
            
          ]; 
        }else{
          if($last_visit->MRN==null){
            $mrn="";
          }
          else{
            $mrn=$last_visit->MRN;
          }
          $data = [
            
            'PatientInfos' => $PatientInfos,
            // 'Image'=>$image,
            'PatientContact' =>$PatientContact,
            'imageF'=>$imageF,
            'imageLogo'=>$imageLogo,
            'last_visit_info'=>$last_visit,
            'U_STARTDATE'=>$last_visit->U_STARTDATE,
            'U_ENDDATE'=>$last_visit->U_ENDDATE,
            'COMPANY'=>strtoupper($last_visit->COMPANY),
            'HOSPITALID'=>strtoupper($mrn),
            'VISITTYPE'=>strtoupper($last_visit->VISITTYPE),
            'CHIEFCOMPLAINT'=>strtoupper($last_visit->CHIEFCOMPLAINT),
            'U_ICDCODE'=>strtoupper($last_visit->U_ICDCODE),
            'U_ICDDESC'=>strtoupper($last_visit->U_ICDDESC),
            'NOTES'=>strtoupper($last_visit->NOTES),
            'patient_info'=>$patient_info,
            'U_RESPONSIBLENAME'=>strtoupper($value->U_RESPONSIBLENAME),
            'U_RESPONSIBLEADDRESS'=>strtoupper($value->U_RESPONSIBLEADDRESS),
            'U_RESPONSIBLEEMPLOYER'=>strtoupper($value->U_RESPONSIBLEEMPLOYER),
            'U_RESPONSIBLETELNO'=>strtoupper($value->U_RESPONSIBLETELNO),
            'U_RESPONSIBLERELATIONSHIP'=>strtoupper($value->U_RESPONSIBLERELATIONSHIP),
            'U_RESPONSIBLESTREET'=>strtoupper($value->U_RESPONSIBLESTREET),
            'U_RESPONSIBLEBARANGAY'=>strtoupper($value->U_RESPONSIBLEBARANGAY),
            'U_RESPONSIBLECITY'=>strtoupper($value->U_RESPONSIBLECITY),
            'U_RESPONSIBLEZIP'=>$value->U_RESPONSIBLEZIP,
            'U_RESPONSIBLEPROVINCE'=>$value->U_RESPONSIBLEPROVINCE,
            'U_RESPONSIBLECOUNTRY'=>$value->U_RESPONSIBLECOUNTRY,
            'U_MOBILENO'=>$value->U_MOBILENO,
            'U_SPOUSENAME'=>strtoupper($value->U_SPOUSENAME),
            'U_SPOUSEFIRSTNAME'=>strtoupper($value->U_SPOUSEFIRSTNAME),
            'U_SPOUSELASTNAME'=>strtoupper($value->U_SPOUSELASTNAME),
            'U_SPOUSEMIDDLENAME'=>strtoupper($value->U_SPOUSEMIDDLENAME),
            'U_SPOUSEEXTNAME'=>strtoupper($value->U_SPOUSEEXTNAME),
            'U_SPOUSEADDRESS'=>strtoupper($value->U_SPOUSEADDRESS),
            'U_SPOUSETELNO'=>strtoupper($value->U_SPOUSETELNO),
            'U_CONTACTNAME'=>$value->U_CONTACTNAME,
            'U_CONTACTADDRESS'=>$value->U_CONTACTADDRESS,
            'U_CONTACTTELNO'=>$value->U_CONTACTTELNO,
            'U_CONTACTRELATIONSHIP'=>$value->U_CONTACTRELATIONSHIP,
            'patient_HMO'=>$patient_HMO
          ]; 
        }
       
          // dd($data);
        // $pdf = PDF::loadView('myPDF', $data);
        // $pdf->setPaper('Letter', 'portrait'); 
        
        //   $pdf->setPaper()->set('isremoteblah',true);
    
        $pdf = PDF::setPaper('a4', 'portrait')->setOptions(['dpi' => 100, 'defaultFont' => 'cambria', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'isJavascriptEnabled' => true])->loadView('myPDF', $data)->setWarnings(false);
        // $pdf->output();
        // $dom_pdf = $pdf->getDomPDF();
        
        // $canvas =  $pdf ->get_canvas();
        // $canvas->page_text(0, 0, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        
        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(520, 815, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->download('MPR-'.$CODE.'.pdf');
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