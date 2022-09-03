<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Components\GetLastCode;
use PDO;

class CreateVisit extends Component
{
    use GetLastCode;
    public $code;
    
    // public function render()
    // {   
    //     // $getPatientRecord = DB::table('u_hispatients')->where('CODE',$this->code);
    //     return view('livewire.create-visit');
    // }]

    public function viewVisit($code){
        // dd($code);
        $getVisits=DB::table('u_hisvisits')->where(['U_PATIENTID'=>$code, 'DOCSTATUS'=>'Active'])->first();
        // dd($getVisits);
        return response()->json([
            'visits'=>$getVisits,
            // 'icd10codes'=>$post9,
        ]);

    }

    public function store(Request $request){
        // dd($request->mpi);
        // dd();
        // dd(Carbon::createFromFormat('d/m/Y',$request->dateArrival));
        // dd(Carbon::parse($request->dateArrival)->format("Y-m-d"));

        $checkVisit=DB::table('u_hisvisits')->where([
                'U_PATIENTID'=>$request->mpi,'DOCSTATUS'=>"Active",'COMPANY'=>Auth::user()->COMPANY,
            ])->first();

        // if($request->hospCode!=Auth::user()->COMPANY){
        //     $newHospitalIdget=DB::table('u_hospitalids');
        // }

        $getLastVisitCode=$this->getLastCode('u_hisvisits','visitID');
        // dd($getLastVisitCode);
        // dd(Carbon::now('Y'));
        // $getNewseries = (int)($getLastVisitCode->visitID)+1;
        $newVCode = str_pad((int)($getLastVisitCode->visitID)+1, strlen($getLastVisitCode->visitID), '0', STR_PAD_LEFT); // 000010
        // $explodeVisitID=explode('-',$request->visitID);
        // dd($newVCode);
        $hospitalNHFRVisit=$this->getHospitalNHFR(Auth::user()->COMPANY);
        $finalDiagnosis=$request->icdCode;
            $finalNotes=$request->FinalDiagnosis;
        if(is_null($finalDiagnosis)||is_null($finalNotes)){
            $visitStatus="Active";
        }else{
            $visitStatus="Discharged";
        }

       
        
        if($checkVisit){
           
            $msg = 'Pending Visit Exists.';
       
        }else{

            if(is_null($request->dateDischarged)){
                $createVisitRecord=DB::table('u_hisvisits')->updateOrInsert(
                    ['U_PATIENTID'=>$request->mpi,'DOCSTATUS'=>"Active"],
                    
                    [
                        'COMPANY'=>Auth::user()->COMPANY,
                        'DOCNO'=>join('-',[Carbon::now()->year,$newVCode]),
                        'U_PATIENTID'=>$request->mpi,
                        'U_PATIENTNAME'=>$request->nameVisit,
                        'VISITTYPE'=>$request->selectVisit,
                        'MRN'=>$request->hpidVisit,
                        'CHIEFCOMPLAINT'=>$request->chiefComplaint,
                        'LASTUPDATEDBY'=>Auth::user()->name,
                        'U_ASSISTEDBY'=>Auth::user()->name,   
                        'U_STARTDATE'=>Carbon::parse($request->dateArrival)->format("Y-m-d"),
                        // 'U_ENDDATE'=>Carbon::parse($request->dateArrival)->format("Y-m-d"),
                        'CREATEDBY'=>Auth::user()->name,
                        'yearVisit'=>Carbon::now()->year,
                        'visitID'=>$newVCode,
        
                        // 'yearVisit'=>Carbon::parse($request->dateArrival)->format("Y-m-d"),
                    // 'U'        hpidVisit,
                            // visitID,
                    ]);
            }
            // dd($request->chiefComplaint);
            
            

           
            $createVisitRecord1=DB::table('u_hisops')->updateOrInsert(
                ['U_PATIENTID'=>$request->mpi,'DOCSTATUS'=>"Active"],
                
                [
                    'DOCNO'=>join('-',[Carbon::now()->year,$newVCode]),
                    'U_PATIENTID'=>$request->mpi,
                    // 'MRN'=>$request->hpidVisit,
                    'U_PATIENTNAME'=>$request->nameVisit,
                    'VISITTYPE'=>$request->selectVisit,
                    'CREATEDBY'=>Auth::user()->name,
                    'LASTUPDATEDBY'=>Auth::user()->name,
                    'U_ASSISTEDBY'=>Auth::user()->name,
                    'U_STARTDATE'=>Carbon::parse($request->dateArrival)->format("Y-m-d"),
                    'DOCSTATUS'=>$visitStatus,
                // 'U'        hpidVisit,
                        // visitID,
                ]);
                $createVisitRecordTrail=DB::table('u_hisvisits_audit_trail')->Insert(
                    [
                        
                    'COMPANY'=>Auth::user()->COMPANY,
                    'DOCNO'=>join('-',[Carbon::now()->year,$newVCode]),
                    'U_PATIENTID'=>$request->mpi,
                    'U_PATIENTNAME'=>$request->nameVisit,
                    'VISITTYPE'=>$request->selectVisit,
                    'LASTUPDATEDBY'=>Auth::user()->name,
                        
                    'U_STARTDATE'=>Carbon::parse($request->dateArrival)->format("Y-m-d"),
                    'CREATEDBY'=>Auth::user()->name,
                    'yearVisit'=>Carbon::now()->year,
                    'visitID'=>$newVCode,
                    'DOCSTATUS'=>$visitStatus,
        
                        // 'yearVisit'=>Carbon::parse($request->dateArrival)->format("Y-m-d"),
                    // 'U'        hpidVisit,
                            // visitID,
                    ]);


            $msg = 'Visit Successfully Created';

        }
        if($createVisitRecord){
            $getCodeHospcode=DB::table('u_hospitalids')->where(['CODE'=>$request->mpi, 'HOSPITALCODE'=>Auth::user()->companyCode])->first();
            // dd($hospitalNHFRVisit);
            // dd($getCodeHospcode->HOSPITALID);
            if($request->mrnUpdate!=""){
                $hospitalIDget=join('-',[$hospitalNHFRVisit->NHFR,$request->hpidVisit]);
                $idSeriesGet=$request->hpidVisit;
                $nhfrGet=$hospitalNHFRVisit->NHFR;
                DB::table('u_hospitalids')->insert([
                    'CODE'=>$request->mpi,
                    'NAME'=>$request->nameVisit,
                    'HOSPITALCODE'=>$hospitalNHFRVisit->hospitalCode,
                    'HOSPITALNAME'=>Auth::user()->COMPANY,
                    'HOSPITALID'=>$hospitalIDget,
                    'NHFR'=>$nhfrGet,
                    'idSeries'=>$idSeriesGet,
                    'EDITEDBY'=>Auth::user()->userName,
                    'note'=>"Create Visit",
                ]);

            }
            else{
                DB::table('u_hospitalids')->insert([
                    'CODE'=>$request->mpi,
                    'NAME'=>$request->nameVisit,
                    'HOSPITALCODE'=>$hospitalNHFRVisit->hospitalCode,
                    'HOSPITALNAME'=>Auth::user()->COMPANY,
                    
                    'EDITEDBY'=>Auth::user()->userName,
                    'note'=>"Create Visit",
                ]);
            }
           
                
                
        }
        // dd($msg);
        
        if(($msg=="Visit Successfully Created")&&$request->hpidVisit!=null){
            // dd($request->hpidVisit);
            

                // dd($insertHospitalIDgetVisit);
            //    
    
        }
        return response()->json(['success' => true,
            'msg' => $msg,
        ]);
       
        
    }
    public function dischargePatient($visitID, Request $request){
        // dd($visitID);
        $dischargePatient =DB::table('u_hisvisits')->where('DOCNO',$visitID)
                ->update(
                    [
                        'U_ICDCODE'=>$request->icdCodeUpdate,
                        'U_ICDDESC'=>$request->icdDescUpdate,
                        'U_ENDDATE'=>Carbon::parse($request->dateDischargedUpdatel)->format("Y-m-d"),
                        'U_DISCHARGEDBY'=>Auth::user()->userName,
                        'NOTES'=>$request->FinalDiagnosisUpdate,
                        'DOCSTATUS'=>'Discharged',
                        

                    ]
                    );

        if($request->mrnUpdate!=""){
            DB::table('u_hospitalids')->update(
                ['CODE'=>$request->mpiUpdate, 'HOSPITALCODE'=>Auth::user()->companyCode],
                []
            );
        }
        
        return response()->json(['success' => true,
            'msg' => "Patient Successfully Discharged",
        ]);

    }
}
