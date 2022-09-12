<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Carbon;

class exportpdfcontroller extends Controller
{
    public function getDate(Request $request){
        $LogoF = public_path().'/myfiles/uploads/logo.jpg';
          $imageLogo = base64_encode(file_get_contents( $LogoF));
        $sd = $request->startDate;
        $ed = $request->endDate;
        $byHospitals = 'ALL HOSPITALS';


        $pow = DB::table('u_hispatients')->count();
        $patientstotal = DB::table('u_hispatients')


        ->where('DATECREATED','>=', $sd)
        ->where('DATECREATED','<=', $ed)
        ->count();
            $PatientInfos2 = DB::table('u_hispatients')


            ->where('DATECREATED','>=', $sd)
            ->where('DATECREATED','<=', $ed)
            ->get();

            $data = [

                'PatientInfos2' => $PatientInfos2,
                'imageLogo' => $imageLogo,
                'sd' => $sd,
                'ed' =>$ed,
                'pow'=>$pow,
                'patientstotal'=>$patientstotal,
                'byHospitals' => $byHospitals,


              ];
            //   return view('livewire.exporttopdf',compact('patientstotal','pow','PatientInfos2','imageLogo','byHospitals','sd','ed'));

            $pdf = PDF::setPaper('a4', 'portrait')->setOptions(['dpi' => 100, 'defaultFont' => 'cambria', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'isJavascriptEnabled' => true])->loadView('livewire.exporttopdf', $data)->setWarnings(false);
            $pdf->output();
          $dom_pdf = $pdf->getDomPDF();

      $canvas = $dom_pdf ->get_canvas();
      $canvas->page_text(520, 815, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
            return $pdf->download('MasterPatientList.pdf');




    }

    public function getDateandhospital(Request $request){
        $LogoF = public_path().'/myfiles/uploads/logo.jpg';
        $imageLogo = base64_encode(file_get_contents( $LogoF));
      $sd = $request->startDate;
      $ed = $request->endDate;
      $byHospitals = $request->byHospitals;


      $pow = DB::table('u_hispatients') ->Where('COMPANY','=',$byHospitals)->count();
      $patientstotal = DB::table('u_hispatients')


      ->where('DATECREATED','>=', $sd)
      ->where('DATECREATED','<=', $ed)
      ->Where('COMPANY','=',$byHospitals)
      ->count();

          $PatientInfos2 = DB::table('u_hispatients')


          ->where('DATECREATED','>=', $sd)
          ->where('DATECREATED','<=', $ed)
          ->Where('COMPANY','=',$byHospitals)
          ->get();

          $data = [

              'PatientInfos2' => $PatientInfos2,
              'imageLogo' => $imageLogo,
              'sd' => $sd,
              'ed' =>$ed,
              'byHospitals' => $byHospitals,
              'pow'=>$pow,
              'patientstotal'=>$patientstotal,


            ];
            // return view('livewire.exporttopdf',compact('patientstotal','pow','PatientInfos2','imageLogo','byHospitals','sd','ed'));
          $pdf = PDF::setPaper('a4', 'portrait')->setOptions(['dpi' => 100, 'defaultFont' => 'cambria', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'isJavascriptEnabled' => true])->loadView('livewire.exporttopdf', $data)->setWarnings(false);
          $pdf->output();
          $dom_pdf = $pdf->getDomPDF();

      $canvas = $dom_pdf ->get_canvas();
      $canvas->page_text(520, 815, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
          return $pdf->download('MasterPatientList.pdf');

    }

    public function nofilters(){
        $LogoF = public_path().'/myfiles/uploads/logo.jpg';
        $imageLogo = base64_encode(file_get_contents( $LogoF));
        $oldest = DB::table('u_hispatients')->select('DATECREATED')->orderBy('DATECREATED')->first();
      $sd = $oldest;
      $ed = now();
      $byHospitals = 'All Hospitals';


      $pow = DB::table('u_hispatients')->count();
      $patientstotal = DB::table('u_hispatients')
      ->count();


          $PatientInfos2 = DB::table('u_hispatients') ->get();

          $data = [

              'PatientInfos2' => $PatientInfos2,
              'imageLogo' => $imageLogo,
              'sd' => $sd,
              'ed' =>$ed,
              'pow'=>$pow,
              'byHospitals'=>$byHospitals,
              'patientstotal'=>$patientstotal,
            ];
            // return view('livewire.exporttopdf',compact('patientstotal','pow','PatientInfos2','imageLogo','byHospitals','sd','ed'));
          $pdf = PDF::setPaper('a4', 'portrait')->setOptions(['dpi' => 100, 'defaultFont' => 'cambria', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'isJavascriptEnabled' => true])->loadView('livewire.exporttopdf', $data)->setWarnings(false);
          $pdf->output();
          $dom_pdf = $pdf->getDomPDF();

      $canvas = $dom_pdf ->get_canvas();
      $canvas->page_text(520, 815, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
          return $pdf->download('MasterPatientList.pdf');

    }
    public function getHospital(Request $request){
        $LogoF = public_path().'/myfiles/uploads/logo.jpg';
        $imageLogo = base64_encode(file_get_contents( $LogoF));
        $oldest = DB::table('u_hispatients')->select('DATECREATED')->orderBy('DATECREATED')->first();

        $byHospitals = $request->byHospitals;
        $sd = $oldest;
        $ed = now();

      $pow = DB::table('u_hispatients') ->Where('COMPANY','=',$byHospitals)->count();
      $patientstotal = DB::table('u_hispatients')



      ->Where('COMPANY','=',$byHospitals)
      ->count();

          $PatientInfos2 = DB::table('u_hispatients')



          ->Where('COMPANY','=',$byHospitals)
          ->get();

          $data = [

              'PatientInfos2' => $PatientInfos2,
              'imageLogo' => $imageLogo,
              'byHospitals' => $byHospitals,
              'pow'=>$pow,
              'patientstotal'=>$patientstotal,
              'sd'=>$sd,
              'ed'=>$ed,


            ];
            // return view('livewire.exporttopdf',compact('patientstotal','pow','PatientInfos2','imageLogo','byHospitals','sd','ed'));
          $pdf = PDF::setPaper('a4', 'portrait')->setOptions(['dpi' => 100, 'defaultFont' => 'cambria', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'isJavascriptEnabled' => true])->loadView('livewire.exporttopdf2', $data)->setWarnings(false);
          $pdf->output();
          $dom_pdf = $pdf->getDomPDF();

      $canvas = $dom_pdf ->get_canvas();
      $canvas->page_text(520, 815, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
          return $pdf->download('MasterPatientList.pdf');

    }
}
