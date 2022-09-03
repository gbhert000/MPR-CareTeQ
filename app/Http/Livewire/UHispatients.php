<?php

namespace App\Http\Livewire;

use DateTime;
use Carbon\Carbon;
use App\Models\Country;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Components\GetLastCode;
use App\Components\FlashMessages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Faker\Provider\sv_SE\Municipality;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\U_hispatient as u_hispatient;
use Illuminate\Console\View\Components\Alert;

class UHispatients extends Component
{
    use FlashMessages;
    use GetLastCode;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $sortColumnName = 'CODE';
    public $sortDirection = 'desc';
    public $perPage = 10;

    public  $U_FIRSTNAME, 
            $U_LASTNAME, 
            $U_MIDDLENAME, 
            $sex, 
            $birthdate, 
            $civil,
            $extensionName, 
            $U_COUNTRY1,
            $selected_country,
            $brgy1,
            $municipality1,
            $updatesex,
            $U_BIRTHPLACE,
            $U_NATIONALITY,
            $U_BIRTHDATE,
            $placeOfBirth,
            $nationality,
            $religion,
            $occupation,
            $U_CIVILSTATUS,
            $postal,
            $U_1STCONTACT,
            $U_2NDCONTACT,
            $U_3RDCONTACT,
            $U_4THCONTACT,
            $U_1STCONTACTTYPE,
            $U_2NDCONTACTTYPE,
            $U_3RDCONTACTTYPE,
            $U_4THCONTACTTYPE,
            $relationMem,
            $providerName,
            $insMemType,
            $contactType1,
            $contactType2,
            $contactType3,
            $counting,
            $contactType4,
            $contacts;
    public $countCountry;
            // public $cities=[];
            // public $city;
    
    public $U_RELIGION, $U_OCCUPATION,$U_GENDER,$province1,$brgy,$country1,$houseNo, $street,$municipality,$province,$country;
    
    public $CODE;

    protected function rules()
    {
        return [
            'U_FIRSTNAME' => 'required|string|min:3',
            'U_LASTNAME' => 'required|string|min:6',
            'U_MIDDLENAME' => 'required|string|min:6',
            
        ];
    }

    
    public function sameAddress($CODE, Request $request){
        $this->updateMode = true; 
        $post1 = U_hispatient::where('CODE','=',$CODE)->get();
        // dd($post->U_LASTNAME);
        foreach($post1 as $data1){
            $value1 = $data1;
        }
        $this->fathersCountry=$value1['U_COUNTRY'];
    }

    public function getPatientCode($CODE){

        $getCode=DB::table('u_hispatients')->select('CODE')
                        ->where('CODE','=', $CODE)
        ->first();

       
        // dd($getCode->CODE);
        $CODE=$getCode;
        return $CODE;
        // return $CODE;
    }

    public function savePatient(Request $request){
        
        // $getLastCode_temp = DB::table('u_hispatients')->select('CODE')
        //                 ->orderBy('CODE', 'desc')->first();

        // GET LAST MASTER PATIENT RECORD
        $getLastCodeTemp=$this->getLastCode('u_hispatients','CODE');
        $getLastPatientCode=$getLastCodeTemp->CODE;
        $getLastCode = explode('-',$getLastPatientCode);
        $concat_code = (int) ($getLastCode[0].$getLastCode[1].$getLastCode[2]) + 1;
        $new_code = strtoupper(join('-',[substr($concat_code,0,4), substr($concat_code,4,4), substr($concat_code,8,4)]));

        // dd($new_code);
        
        $address=join(' ',[$request->houseNo, $request->street,$request->brgy,$request->municipality,$request->province, $request->country ]);
        
        $fullName=strtoupper(join(' ',[$request->U_LASTNAME.',',$request->U_FIRSTNAME,$request->U_MIDDLENAME,$request->extensionName ]));
        
        $birthdateParsed=Carbon::createFromFormat('m-d-Y',$request->U_BIRTHDATE)->format("Y-m-d");
        $selectRecord=u_hispatient::where(['U_FIRSTNAME'=>strtoupper($request->U_FIRSTNAME), 'U_LASTNAME'=>strtoupper($request->U_LASTNAME), 'U_BIRTHDATE'=>$birthdateParsed])->first();
        // if()

    //    dd($selectRecord);

        // dd($hospitalNHFR);

        
        // CONTACT ARRAY
        $contactArray=[
            
                [ 'contactType'=>strtoupper($request->contactType1),'contactNumber'=>strtoupper($request->contact1),'contactNote'=>$request->noteContact1,'contactName'=>$fullName,  'CODE'=>$new_code],
                ['contactType'=>strtoupper($request->contactType2),'contactNumber'=>strtoupper($request->contact2),'contactNote'=>$request->noteContact2,'contactName'=>$fullName,'CODE'=>$new_code],
                ['contactType'=>strtoupper($request->contactType3),'contactNumber'=>strtoupper($request->contact3),'contactNote'=>$request->noteContact3,'contactName'=>$fullName,'CODE'=>$new_code],
                ['contactType'=>strtoupper($request->contactType4),'contactNumber'=>strtoupper($request->contact4),'contactNote'=>$request->noteContact4,'contactName'=>$fullName,'CODE'=>$new_code],
        ];
        // END CONTACT ARRAY
        
        //COUNT FILLED OUT CONTACT FIELD
        $contactcounter=0; 
        for($xx=0;$xx<count($contactArray);$xx++){
            if($contactArray[$xx]['contactNumber']!=null){
                $contactcounter++;
            } 
        }
        $getContactCount=$contactcounter;

        for($ee=0; $ee<$getContactCount;$ee++){
            $insertContactArray[]=[
                // for()
                $contactArray[$ee],
            ];
        }
        // dd($insertContactArray);
        // END COUNTING OF FILLED OUT CONTACT FILLED
        $newPatient=false;

        // START EMAIL ARRAY
        $emailArray=[
            ['emailType'=>strtoupper($request->emailType1),'emailAddress'=>$request->email1,'emailOwner'=>$fullName,'emailNote'=>$request->noteEmail1,  'CODE'=>$new_code],
            ['emailType'=>strtoupper($request->emailType2),'emailAddress'=>$request->email2,'emailOwner'=>$fullName,'emailNote'=>$request->noteEmail2,  'CODE'=>$new_code],
            ['emailType'=>strtoupper($request->emailType3),'emailAddress'=>$request->email3,'emailOwner'=>$fullName,'emailNote'=>$request->noteEmail3,  'CODE'=>$new_code],
            ['emailType'=>strtoupper($request->emailType4),'emailAddress'=>$request->email4,'emailOwner'=>$fullName,'emailNote'=>$request->noteEmail4,  'CODE'=>$new_code],
        ];
        // END EMAIL ARRAY
        $emailcounter=0; 
        for($yy=0;$yy<count($emailArray);$yy++){
            if($emailArray[$yy]['emailAddress']!=null){
                $emailcounter++;
            } 
        }
        $getEmailCount=$emailcounter;

        for($ee=0; $ee<$getEmailCount;$ee++){
            $insertEmailArray[]=[
                // for()
                $emailArray[$ee],
            ];
        }
        // switch($getEmailCount){
        //     case 0:
        //         break;
        //     case 1:
        //         $insertEmailArray=[
                    
        //         ]
        // }
        // dd($insertEmailArray);
        $patientInfoArray=[
                'CODE'=>$new_code,
                'NAME'=>$fullName,
                'U_FIRSTNAME'=>strtoupper($request->U_FIRSTNAME),
                'U_LASTNAME'=>strtoupper($request->U_LASTNAME),
                'U_MIDDLENAME'=>strtoupper($request->U_MIDDLENAME),
                'U_EXTNAME' =>strtoupper($request->extensionName),
                'U_CIVILSTATUS' =>strtoupper($request->U_CIVILSTATUS),
                'U_BIRTHDATE'=>Carbon::createFromFormat('m-d-Y',$request->U_BIRTHDATE)->format("Y-m-d"),
                'U_AGE'=>strtoupper($request->age),
                'U_GENDER'=>strtoupper($request->sex),
                'U_BIRTHPLACE'=>strtoupper($request->placeOfBirth),
                'U_COUNTRY'=>strtoupper($request->country),
                'U_NATIONALITY'=>strtoupper($request->nationality),
                'U_RELIGION'=>strtoupper($request->religion),
                'U_OCCUPATION'=>strtoupper($request->occupation),
                'U_ADDRESS' =>strtoupper($address),
                'idType'=>$request->idType,
                'idNumber'=>$request->idNumber,
                
        ];
        // dd($request->nationality);
        // GET NATIONALITY
        $getCountNationality=$this->getNumberofUsed('u_nationalities','used','Nationality',$request->nationality);

        // GET COUNTRY
        $getCountCountry=$this->getNumberofUsed('countries','used','country',$request->country);

        //GET HOSPITAL NHFR
        $hospitalNHFR=$this->getHospitalNHFR(Auth::user()->COMPANY);

        // GET LAST HOSPITAL ID
        // $getLastIDTemp=$this->getLastCode('u_hospitalids','idSeries');
        // $getLastHospitalID=$getLastIDTemp->idSeries;
        // $newID = str_pad((int)($getLastHospitalID) + 1, (int)strlen($getLastHospitalID), '0', STR_PAD_LEFT); // 000010
        // dd($newID);

        // HOSPITAL PATIENT ID INPUT
        

        
        if(!$selectRecord){
            // dd($selectRecord);

            // 11:40 AM changed
            // $getPatientContact=$this->getContacts($fullName,$new_code,$getContactCount, $contactArray);
            // // dd($getPatientContact);
            
            // if($getPatientContact==""){
            //     $contactCounter=0;
            //     $insertCount=$getContactCount;

            // }else{
            //     $query3=DB::table('u_hiscontacts')->insert($getPatientContact);
            //     $insertCount=$getContactCount;
            // }
            
            $patientInfoArray2=[
                'U_STREET' =>strtoupper($request->street),
                
                'U_BARANGAY'=>strtoupper($request->brgy),
                'U_COUNTRY'=>strtoupper($request->country1),
                'U_CITY'=>strtoupper($request->municipality),
                'U_PROVINCE'=>strtoupper($request->province),
                // 'U_COUNTRY'=>strtoupper($request->country),
                'U_ZIP'=>strtoupper($request->postal),
                'U_HOUSENO' =>strtoupper($request->houseNo)
            ];
            // dd($patientInfoArray);

            $patientInfoArray3=[
                    'U_ACTIVE'=>1,
                    'U_VISITCOUNT'=>1,
                    'countContacts'=>$getContactCount,
                    'countEmail'=>$getEmailCount,
                    'LASTUPDATEDBY'=>Auth::user()->userName,
                    'U_REGBY'=>Auth::user()->userName,
                    'CREATEDBY'=>Auth::user()->userName,
                    'COMPANY'=>Auth::user()->COMPANY,
                    // DATES
                    'DATECREATED'=>DATE('Y-m-d H:i:s'),
                    'U_REGDATE'=>DATE('Y-m-d'),
                    'U_REGTIME'=>DATE('H:i:s'),
                    'LASTUPDATED'=>date('Y-m-d H:i:s')
            ];
            $newID=$request->hpidRegister;
            $patientHpid=[
                'CODE'=>$new_code,
                        'NAME'=>$fullName,
                        'U_FIRSTNAME'=>strtoupper($request->U_FIRSTNAME),
                        'U_LASTNAME'=>strtoupper($request->U_LASTNAME),
                        'U_MIDDLENAME'=>strtoupper($request->U_MIDDLENAME),
                        'U_EXTNAME' =>strtoupper($request->extensionName),
                        'HOSPITALCODE'=>$hospitalNHFR->hospitalCode,
                        'HOSPITALID'=>join('-',[$hospitalNHFR->NHFR,$newID]),
                        'NHFR'=>$hospitalNHFR->NHFR,
                        'idSeries'=>$newID,
                        'EDITEDBY'=>Auth::user()->userName,
                        'note'=>"Registration"
            ];

            if($request->nationality!=""){
                $getCountNationality=$getCountNationality->used+1;
                
            }
            if($request->country!=""){
                $getCountCountry=$getCountCountry->used+1;
            }
            
                // dd($getCount);
        
            $query = DB::table('u_hispatients')->insert([

                $patientInfoArray+
                $patientInfoArray2+
                $patientInfoArray3
                
            ]);
            
            if($query){
                for($ee=0; $ee<$getEmailCount;$ee++){
                    DB::table('u_hisemails')->insert([
                        $emailArray[$ee]
                ]);
                }
                for($ee=0; $ee<$getContactCount;$ee++){
                    DB::table('u_hiscontacts')->insert([
                        $contactArray[$ee]
                ]);
                }
                
                $updateUsedCountRegister=DB::table('u_nationalities')->where('Nationality','=',$request->nationality)->update([
                    'used'=>$getCountNationality
                ]  
                );
                $updateUsedCountryRegister=DB::table('countries')->where('country','=',$request->country)->update([
                    'used'=>$getCountCountry
                ]  
                );
                if($request->hiddenImageRegister!=""){
                    $uploadSaveImageRegister=$this->uploadImage($request->hiddenImageRegister, $fullName,$new_code);
                }
                if($request->hpidRegister!=""){
                    
                    $insertHospitalID=DB::table('u_hospitalids')->insert($patientHpid);
                    $insertHospitalProfile=DB::table('u_patientHospitalProfile')->insert($patientHpid);
                }
                else{
                    $insertHospitalProfile=DB::table('u_patientHospitalProfile')->insert($patientHpid);
                }
            }

            $insertNewPatient=DB::table('u_patientprofiles')->insert([
                    $patientInfoArray +
                    $patientInfoArray2
            ]);
            
            

            if($query){
                    return redirect('/home');
                    }else{
                        return back()->with('Fail','something went wrong');
                    }
            $newPatient=true;
        }else{

            // self::message('danger', 'Patient Already Exist.');
            Session::flash('message', 'Patient Already Exist!'); 
            Session::flash('alert-class', 'alert-danger'); 

        }
       
    }

    public function checkPatient(Request $request){
        // dd($request);
        $parseDate=Carbon::createFromFormat('m-d-Y',$request->bday)->format("Y-m-d");
        $selectRecord1=u_hispatient::where(['U_FIRSTNAME'=>$request->fname, 'U_LASTNAME'=>$request->lname, 'U_BIRTHDATE'=>$parseDate])->first();
        // var_dump($request->U_FIRSTNAME);
        if($selectRecord1){
            // dd(($selectRecord1));
            return response()->json(['success' => true,
                        'msg' => 'Patient Already Exist.',
                        'getRecord'=>$selectRecord1
            ]);
        }
        else{
            return response()->json(['success' => false, 'msg' => 'Patient Successfully Registered.']);
        }
                
    }

    public function getBackground($CODE){

        // dd($CODE);
        $post3 = U_hispatient::where('CODE','=',$CODE)->first();
        $post2 = DB::table('u_hiscontacts')->where(['CODE'=>$CODE])->get();
        $post4 = DB::table('u_hispatientshealthcare')->where(['patientCode'=>$CODE])->get();
        $post5 = DB::table('u_hisimages')->where(['patientCode'=>$CODE])->first();
        $post6 = DB::table('u_hospitalids')->where('CODE','=',$CODE)->groupBy('HOSPITALCODE')->get();
        // dd($post6);
        $post7 = DB::table('u_patienthospitalprofile')->where(['CODE'=>$CODE])->get();
        // dd($post6);
        $post8 = DB::table('u_hospitalids')->where(['CODE'=>$CODE, 'HOSPITALCODE'=>Auth::user()->companyCode])->first();
        // dd($post8);
        $post9 = DB::table('u_hisicd10s')->get();
        $post9 = DB::table('u_hisvisits')->where(['U_PATIENTID'=>$CODE,'DOCSTATUS'=>'Active'])->first();
        $post10 = DB::table('u_hisemails')->where(['CODE'=>$CODE])->get();
        $post11 = DB::table('u_patientprofiles')->where(['CODE'=>$CODE])->first();
        // dd($post8);
        // return Response::json([
        //     'mpr'=>$post3,
        //     'contacts'=>$post2,
        //     'hmos'=>$post4
        // ]);
        // dd($post4);
        return response()->json([
            'mpr'=>$post3,
            'contacts'=>$post2,
            'hmos'=>$post4,
            'img'=>$post5,
            'hospitalIDs'=>$post6,
            'hospitalProfiles'=>$post7,
            'hpidCurrent'=>$post8,
            'checkVisits'=>$post9,
            'emails'=>$post10,
            'medInfo'=>$post11,
            // 'icd10codes'=>$post9,
        ]);

    }
    public function update(Request $request)
    {
        // $currentTime=Carbon::now();
          
        $getCountry = $request->country;
        // $user = U_hispatient::where('CODE','=',$this->CODE)->get();
      
        // dd($CODE);
        $hospitalNHFRUpdate=$this->getHospitalNHFR(Auth::user()->COMPANY);

        // GET PATIENT'S FULLNAME
        $updatefullName=strtoupper(join(' ',[$request->U_LASTNAME.',',$request->U_FIRSTNAME,$request->U_MIDDLENAME,$request->extensionName ]));
       
        // GET PATIENT FULL ADDRESS
        $updateaddress=join(' ',[$request->houseNo, $request->street,$request->brgy,$request->municipality,$request->province, $request->country ]);
    
        // GET FATHER'S NAME + ADDRESS
        $updateFathersName=strtoupper(join(' ',[$request->fatherLastName.',',$request->fatherFirstName,$request->fatherMiddleName,$request->fatherExtName ]));
        $updateFathersAddress = strtoupper(join(' ',[$request->fatherHouseNo, ',',$request->fatherStreet,$request->fathersBrgy,$request->fathersMunicipality,$request->fathersProvince,$request->fathersCountry,$request->fathersPostal]));

        // GET MOTHER'S NAME + ADDRESS
        $updateMothersName=strtoupper(join(' ',[$request->motherLastName.',',$request->motherFirstName,$request->motherMiddleName,$request->motherExtName ]));
        $updateMothersAddress = strtoupper(join(' ',[$request->motherHouseNo, ',',$request->motherStreet,$request->mothersBrgy,$request->mothersMunicipality,$request->mothersProvince,$request->mothersCountry,$request->mothersPostal]));
        
        // GET SPOUSE NAME + ADDRESS
        $updateSpousesName=strtoupper(join(' ',[$request->spouseLastName.',',$request->spouseFirstName,$request->spouseMiddleName,$request->spouseExtName ]));
        $updateSpousesAddress = strtoupper(join(' ',[$request->spouseHouseNo, ',',$request->spouseStreet,$request->spousesBrgy,$request->spousesMunicipality,$request->spousesProvince,$request->spousesCountry,$request->spousesPostal ]));
        
        $get_code=$request->CODE;
       
        
        $contactArrayUpdate=[
            
            [ 'contactType'=>strtoupper($request->contactType1),'contactNumber'=>strtoupper($request->contact1),'contactNote'=>$request->noteContact1,'contactName'=>$updatefullName,  'CODE'=>$get_code],
            ['contactType'=>strtoupper($request->contactType2),'contactNumber'=>strtoupper($request->contact2),'contactNote'=>$request->noteContact2,'contactName'=>$updatefullName,'CODE'=>$get_code],
            ['contactType'=>strtoupper($request->contactType3),'contactNumber'=>strtoupper($request->contact3),'contactNote'=>$request->noteContact3,'contactName'=>$updatefullName,'CODE'=>$get_code],
            ['contactType'=>strtoupper($request->contactType4),'contactNumber'=>strtoupper($request->contact4),'contactNote'=>$request->noteContact4,'contactName'=>$updatefullName,'CODE'=>$get_code],
        ];
        // dd($contactArrayUpdate);
        $emailArrayUpdate=[
            ['emailType'=>strtoupper($request->emailType1),'emailNote'=>$request->noteEmail1,'emailAddress'=>$request->email1,'emailOwner'=>$updatefullName,  'CODE'=>$get_code],
            ['emailType'=>strtoupper($request->emailType2),'emailNote'=>$request->noteEmail2,'emailAddress'=>$request->email2,'emailOwner'=>$updatefullName,  'CODE'=>$get_code],
            ['emailType'=>strtoupper($request->emailType3),'emailNote'=>$request->noteEmail3,'emailAddress'=>$request->email3,'emailOwner'=>$updatefullName,  'CODE'=>$get_code],
            ['emailType'=>strtoupper($request->emailType4),'emailNote'=>$request->noteEmail4,'emailAddress'=>$request->email4,'emailOwner'=>$updatefullName,  'CODE'=>$get_code],
        ];

        $contactCounterUpdate=0;
        for($ll=0;$ll<count($$contactArrayUpdate);$ll){
            
        }
        
        $emailcounterUpdate=0; 
        for($uu=0;$uu<count($emailArrayUpdate);$uu++){
            if($emailArrayUpdate[$uu]['emailAddress']!=null){
                $emailcounterUpdate++;
            } 
        }
        $getEmailCountUpdate=$emailcounterUpdate;

        for($oo=0; $oo<$getEmailCountUpdate;$oo++){
            $insertEmailArrayUpdate[]=[
                // for()
                $emailArrayUpdate[$oo],
            ];
        }
        // dd($insertEmailArrayUpdate);
        $checkContactInfo=DB::table('u_hiscontacts')->where([
            'CODE'=>$request->hiddenCode,
        ])->get();

        // dd(count($checkContactInfo));
        // return var_dump($checkContactInfo); false;
        
        // $getPatientContactID=$checkContactInfo->contactID;

        $getUpdateContactID=[
            [$request->hideContact1],
            [$request->hideContact2],
            [$request->hideContact3],
            [$request->hideContact4]
        ];

        $getContactNumber=[
            $request->contact1,
            $request->contact2,
            $request->contact3,
            $request->contact4,
        ];

        $getHmos=[
            
        ];

        $getUpdateEmailID=[
            [$request->hiddenEmmailId1],
            [$request->hiddenEmmailId2],
            [$request->hiddenEmmailId3],
            [$request->hiddenEmmailId4]
        ];
        $countCheckContactInfo=count($checkContactInfo);
        // dd($countCheckContactInfo);

        $getContactCountUpdate=$request->countContactUpdate;
        // $getEmailCountUpdate=$request
        // dd($getContactCountUpdate,$countCheckContactInfo);
        $countContactsUpdate=count($checkContactInfo);
        $getPatientContactUpdate=$this->getContacts($updatefullName,$get_code,$countContactsUpdate, $contactArrayUpdate);
        $getPatientContactInsert=$this->getContacts($updatefullName,$get_code,$getContactCountUpdate, $contactArrayUpdate);
        
       
        $patientPersonalInfo=[
                'CODE'=>$request->hiddenCode,
                'NAME'=>$updatefullName,
                'U_FIRSTNAME'=>strtoupper($request->U_FIRSTNAME),
                'U_LASTNAME'=>strtoupper($request->U_LASTNAME),
                'U_MIDDLENAME'=>strtoupper($request->U_MIDDLENAME),
                'U_EXTNAME' =>strtoupper($request->extensionName),
                'U_CIVILSTATUS' =>strtoupper($request->U_CIVILSTATUS),
                'U_BIRTHDATE'=>Carbon::parse($request->U_BIRTHDATE)->format("Y-m-d"),
                // 'U_BIRTHDATE'=>($request->U_BIRTHDATE)->format("Y-m-d"),
                'U_AGE'=>strtoupper($request->age),
                
                'U_GENDER'=>strtoupper($request->updatesex),
                'U_BIRTHPLACE'=>strtoupper($request->U_BIRTHPLACE),
                'U_NATIONALITY'=>strtoupper($request->U_NATIONALITY),
                'U_RELIGION'=>strtoupper($request->U_RELIGION),
                'U_OCCUPATION'=>strtoupper($request->U_OCCUPATION),
                'U_ADDRESS' =>strtoupper($updateaddress),

                'U_HOUSENO' =>strtoupper($request->houseNo),
                'U_BARANGAY'=>strtoupper($request->brgy1),
                'U_CITY'=>strtoupper($request->municipality1),
                'U_PROVINCE'=>strtoupper($request->province),
                'U_COUNTRY'=>strtoupper($request->country),
                'U_ZIP'=>strtoupper($request->postal),
                'U_STREET'=>strtoupper($request->street),
                'countContacts'=>$countCheckContactInfo,
                'countEmail'=>$getEmailCountUpdate,
                'idType'=>$request->idType,
                'idNumber'=>$request->idNumber,
        ];

        $patientFatherInfo=[
            // FATHER
            'U_FATHERNAME'=>$updateFathersName,
            'U_FATHERSLASTNAME'=>strtoupper($request->fatherLastName),
            'U_FATHERSFIRSTNAME'=>strtoupper($request->fatherFirstName),
            'U_FATHERSMIDDLENAME'=>strtoupper($request->fatherMiddleName),
            'U_FATHERSEXTNAME'=>strtoupper($request->fatherExtName),
            'U_FATHERTELNO'=>strtoupper($request->fatherContactNo),
            'U_FATHERADDRESS'=>strtoupper($updateFathersAddress),
            'U_FATHERSTREET'=>strtoupper($request->fatherStreet),
            'U_FATHERBARANGAY'=>strtoupper($request->fathersBrgy),
            'U_FATHERCITY'=>strtoupper($request->fathersMunicipality),
            'U_FATHERPROVINCE'=>strtoupper($request->fathersProvince),
            'U_FATHERCOUNTRY'=>strtoupper($request->fathersCountry),
            'U_FATHERHOUSENO'=>strtoupper($request->fatherHouseNo),
            'U_FATHERZIP'=>strtoupper($request->fathersPostal)
        ];

        $patientMotherInfo=[
            // MOTHER
            'U_MOTHERNAME'=>$updateMothersName,
            'U_MOTHERSLASTNAME'=>strtoupper($request->motherLastName),
            'U_MOTHERSFIRSTNAME'=>strtoupper($request->motherFirstName),
            'U_MOTHERSMIDDLENAME'=>strtoupper($request->motherMiddleName),
            'U_MOTHERSEXTNAME'=>strtoupper($request->motherExtName),
            'U_MOTHERTELNO'=>strtoupper($request->motherContactNo),
            'U_MOTHERADDRESS'=>strtoupper($updateMothersAddress),
            'U_MOTHERSTREET'=>strtoupper($request->motherStreet),
            'U_MOTHERBARANGAY'=>strtoupper($request->mothersBrgy),
            'U_MOTHERCITY'=>strtoupper($request->mothersMunicipality),
            'U_MOTHERPROVINCE'=>strtoupper($request->mothersProvince),
            'U_MOTHERCOUNTRY'=>strtoupper($request->mothersCountry),
            'U_MOTHERHOUSENO'=>strtoupper($request->motherHouseNo),
            'U_MOTHERZIP'=>strtoupper($request->mothersPostal)
        ];

        $patientSpouseInfo=[
             // SPOUSE
             'U_SPOUSELASTNAME'=>strtoupper($request->spouseLastName),
             'U_SPOUSEFIRSTNAME'=>strtoupper($request->spouseFirstName),
             'U_SPOUSEMIDDLENAME'=>strtoupper($request->spouseMiddleName),
             'U_SPOUSEEXTNAME'=>strtoupper($request->spouseExtName),
             'U_SPOUSETELNO'=>strtoupper($request->spouseContactNo),
             'U_SPOUSEADDRESS'=>strtoupper($updateSpousesAddress),
             'U_SPOUSESTREET'=>strtoupper($request->spouseStreet),
             'U_SPOUSEBARANGAY'=>strtoupper($request->spousesBrgy),
             'U_SPOUSECITY'=>strtoupper($request->spousesMunicipality),
             'U_SPOUSEPROVINCE'=>strtoupper($request->spousesProvince),
             'U_SPOUSECOUNTRY'=>strtoupper($request->spousesCountry),
             'U_SPOUSEHOUSENO'=>strtoupper($request->spouseHouseNo),
             'U_SPOUSEZIP'=>strtoupper($request->spousesPostal),
             'LASTUPDATEDBY'=>Auth::user()->userName
        ];

        $updateTrail=[
                    'COMPANY'=>Auth::user()->COMPANY,
                    // DATES
                    'LASTUPDATED'=>date('Y-m-d H:i:s'),
                    'LASTUPDATEDBY'=>Auth::user()->userName,
                    'CREATEDBY'=>($request->createdBy),
                    'DATECREATED'=>strtoupper($request->createdDate)
        ];
        // dd($patientPersonalInfo);
        // UPDATE MASTER PATIENT RECORD
        $medicalInfo=[
                'U_HEIGHT_CM'=>$request->patientHeightcm,
                'U_HEIGHT_IN'=>$request->patientHeightin,
                'U_WEIGHT_KG'=>$request->patientWeightkg,
                'U_WEIGHT_LB'=>$request->patientWeightlb,
                'U_BMI'=>$request->patientBMI
        ];

    //    dd($medicalInfo);
        $user = U_hispatient::where('CODE','=',$request->hiddenCode)->update(

            // Personal Information 
            $patientPersonalInfo+
            $patientFatherInfo+
            $patientMotherInfo+
            $patientSpouseInfo+
            $updateTrail
    
        );

        $updatePatientProfile=DB::table('u_patientprofiles')->where('CODE','=',$request->hiddenCode)
            ->update(
                $patientPersonalInfo+$medicalInfo
            );
          
            if($request->hiddenImage!=""){
                 $img=$request->hiddenImage;
                $uploadSaveImage=$this->uploadImage($img, $updatefullName, $request->hiddenCode);
            
            }
            // dd($insertEmailArrayUpdate);
            // $pp=0;
            // // dd($insertEmailArrayUpdate);
            // foreach($insertEmailArrayUpdate as $arrayList){
            //     foreach($arrayList as $finalArray){
            //         foreach($finalArray as $sige){
            //             DB::table('u_hisemails')->updateorInsert(
            //                 ['emailID'=>$getUpdateEmailID[$pp],'CODE'=>$request->hiddenCode],
            //                 $finalArray->emailAddress
            //             );
            //         }
                    
            //     }
                
            //     $pp++;
            // }
            // dd($insertEmailArrayUpdate[0][0]);
            for($pp=0; $pp<$getEmailCountUpdate;$pp++){
                $checkifEmailExist = DB::table('u_hisemails')->where([
                    'emailID'=>$getUpdateEmailID[$pp],'CODE'=>$request->hiddenCode])->first();

                if($checkifEmailExist!=null){
                    DB::table('u_hisemails')->where([
                        'emailID'=>$getUpdateEmailID[$pp],'CODE'=>$request->hiddenCode])
                    ->update(
                        $insertEmailArrayUpdate[$pp][0]);
                }else{
                    DB::table('u_hisemails')->Insert(
                    $insertEmailArrayUpdate[$pp][0]);
                }
                
            }
            if($user){
                
                
                $auditUpdatePatient = DB::table('u_hispatients_audit_trail')->where('CODE','=',$request->hiddenCode)->insert([
                    $patientPersonalInfo+
                    $patientFatherInfo+
                    $patientMotherInfo+
                    $patientSpouseInfo+
                    $updateTrail
                ]);

                
 
            }
        
             // GET LAST HOSPITAL ID
        // $getLastIDTempUpdate=$this->getLastCode('u_hospitalids','idSeries');
        // $getLastHospitalIDUpdate=$getLastIDTempUpdate->idSeries;
        // $newIDupdate = str_pad((int)($getLastHospitalIDUpdate) + 1, (int)strlen($getLastHospitalIDUpdate), '0', STR_PAD_LEFT); // 000010
        $checkHospitalID = DB::table('u_hospitalids')->where(['CODE'=>$request->hiddenCode, 'HOSPITALCODE'=>Auth::user()->companyCode])->get();
        // dd($checkHospitalID);
        if(count($checkHospitalID)==0){
            // dd($checkHospitalID);
            $hospitalCode=Auth::user()->companyCode; //get company code of user
            $newHospitalID=join('-',[$hospitalNHFRUpdate->NHFR,$request->hpidUpdate]); //join nhfr of user/s current company and inputted mrn
            $newNHFR=$hospitalNHFRUpdate->NHFR;

            // $newIDSeries=$newIDupdate;
        // dd($newIDupdate);

         // ARRAY FOR PATIENT MEDICAL RECORD

         $mrnUpdate=[
            'CODE'=>$request->hiddenCode,
            'NAME'=>$updatefullName,
            'U_FIRSTNAME'=>strtoupper($request->U_FIRSTNAME),
            'U_LASTNAME'=>strtoupper($request->U_LASTNAME),
            'U_MIDDLENAME'=>strtoupper($request->U_MIDDLENAME),
            'U_EXTNAME' =>strtoupper($request->extensionName),
            'HOSPITALCODE'=>$hospitalCode,
            'HOSPITALNAME'=>Auth::user()->COMPANY,
            'HOSPITALID'=>$newHospitalID,
            'NHFR'=>$newNHFR,
            'idSeries'=>$request->hpidUpdate,
            'EDITEDBY'=>Auth::user()->userName,
            'note'=>"Update"
        ];
        // dd($mrnUpdate[]);
        // UPDATE OR INSERT MRN
            if($request->hpidUpdate!=null){
                $insertHospitalID = DB::table('u_hospitalids')->updateorInsert(
                    ['CODE'=>$request->hiddenCode, 'HOSPITALCODE'=>Auth::user()->companyCode],
                    ['CODE'=>$request->hiddenCode,
                    'NAME'=>$updatefullName,
                    'U_FIRSTNAME'=>strtoupper($request->U_FIRSTNAME),
                    'U_LASTNAME'=>strtoupper($request->U_LASTNAME),
                    'U_MIDDLENAME'=>strtoupper($request->U_MIDDLENAME),
                    'U_EXTNAME' =>strtoupper($request->extensionName),
                    'HOSPITALCODE'=>$hospitalCode,
                    'HOSPITALNAME'=>Auth::user()->COMPANY,
                    'HOSPITALID'=>$newHospitalID,
                    'NHFR'=>$newNHFR,
                    'idSeries'=>$request->hpidUpdate,
                    'EDITEDBY'=>Auth::user()->userName,
                    'note'=>"Update"]);
            }
            else{
                $insertHospitalID = DB::table('u_hospitalids')->updateorInsert(
                    ['CODE'=>$request->hiddenCode, 'HOSPITALCODE'=>Auth::user()->companyCode],
                    ['CODE'=>$request->hiddenCode,
                    'NAME'=>$updatefullName,
                    'U_FIRSTNAME'=>strtoupper($request->U_FIRSTNAME),
                    'U_LASTNAME'=>strtoupper($request->U_LASTNAME),
                    'U_MIDDLENAME'=>strtoupper($request->U_MIDDLENAME),
                    'U_EXTNAME' =>strtoupper($request->extensionName),
                    'HOSPITALCODE'=>$hospitalCode,
                    'HOSPITALNAME'=>Auth::user()->COMPANY,
                    // 'HOSPITALID'=>$newHospitalID,
                    'NHFR'=>$newNHFR,
                    'EDITEDBY'=>Auth::user()->userName,
                    'note'=>"Update"]);
            }
            // dd($mrnUpdate);
            // $insertHospitalID = DB::table('u_hospitalids')->insert([
            //             'CODE'=>$request->hiddenCode,
            //             'NAME'=>$updatefullName,
            //             'U_FIRSTNAME'=>strtoupper($request->U_FIRSTNAME),
            //             'U_LASTNAME'=>strtoupper($request->U_LASTNAME),
            //             'U_MIDDLENAME'=>strtoupper($request->U_MIDDLENAME),
            //             'U_EXTNAME' =>strtoupper($request->extensionName),
            //             'HOSPITALCODE'=>$hospitalCode,
            //             'HOSPITALID'=>$newHospitalID,
            //             'NHFR'=>$newNHFR,
            //             'idSeries'=>$newIDSeries,
            //             'EDITEDBY'=>Auth::user()->userName,
            //             'note'=>"Update"
            //     ]);   
        }
        // else{
        //     $hospitalCode=$hospitalNHFRUpdate->hospitalCode;
        //     $newHospitalID=$checkHospitalID->HOSPITALID;
        //     $newNHFR=$checkHospitalID->NHFR;
        //     $newIDSeries=$checkHospitalID->idSeries;
        // // dd($newIDupdate);

           
        // }
       
    //     $insertHospitalID = DB::table('u_hospitalids')->insert([
    //         'CODE'=>$request->hiddenCode,
    //         'NAME'=>$updatefullName,
    //         'U_FIRSTNAME'=>strtoupper($request->U_FIRSTNAME),
    //         'U_LASTNAME'=>strtoupper($request->U_LASTNAME),
    //         'U_MIDDLENAME'=>strtoupper($request->U_MIDDLENAME),
    //         'U_EXTNAME' =>strtoupper($request->extensionName),
    //         'HOSPITALCODE'=>$hospitalCode,
    //         'HOSPITALID'=>$newHospitalID,
    //         'NHFR'=>$newNHFR,
    //         'idSeries'=>$newIDSeries,
    //         'EDITEDBY'=>Auth::user()->userName,
    //         'note'=>"Update"
    // ]);



            // ADD CONTACT INFORMATION
        for($p=1; $p<=$getContactCountUpdate; $p++){
            $checkDBContact[$p-1]=DB::table('u_hiscontacts')->where('CODE',$request->hiddenCode)
                    ->where('contactID',$getUpdateContactID[$p-1])->first();
                    // dd($p);

            // dd(is_null($checkDBContact[$p-1]));

            if(is_null($checkDBContact[$p-1])){
                $insertPatientContact=DB::table('u_hiscontacts')
                                ->insert(
                                        // dd($getPatientContactUpdate)
                                        [$getPatientContactInsert[$p-1]]
                                        );
                        if($insertPatientContact){
                            // dd("asd");
                                $updateCountingContacts=DB::table('u_hispatients')
                                    ->where(['CODE'=>$request->hiddenCode])
                                    ->update(['countContacts'=>$p]);    
                            }
            }else{
                        // dd("asd");
                $updatePatientContact=DB::table('u_hiscontacts')
                    ->where('contactID',$getUpdateContactID[$p-1])
                    ->update(
                        // dd($getPatientContactUpdate)
                        [
                            'contactNumber'=>$getContactNumber[$p-1],
                        ]
                    );
                }
            }

        // END CONTACT INFORMATION



        // END UPDATE MASTER PATIENT RECORD

        // UPDATE PATIENTS CONTACT

       
        // END PATIENT'S CONTACT
        
        // ADD PATIENT HMO
        // $insertHmo1=DB::table('u_hispatientshealthcare')->insert([
            // dd($request->otherHmo);

            if($request->otherHmo==""){
                $getHMOName=[
                    ['hmoName'=>$request->providerName, 'patientName'=>join(' ',[$request->memberLname.',',$request->memberFname,$request->memberMname,$request->memberEname]),'hmoAccountID'=>$request->memberID, 'clientType'=>$request->relationMem,'memberType'=>$request->insMemType,
                    'memberLname'=>$request->memberLname,'memberFname'=>$request->memberFname,'memberEname'=>$request->memberEname,'memberMname'=>$request->memberMname,
                    'memberSex'=>$request->memberSex, 'memberBDay'=>$request->memberBDay,'patientCode'=>$request->CODE]
                ];
            }
            else{
                $getHMOName=[
                    ['hmoName'=>$request->otherHmo, 'patientName'=>join(' ',[$request->memberLname.',',$request->memberFname,$request->memberMname,$request->memberEname]),'hmoAccountID'=>$request->memberID, 'clientType'=>$request->relationMem,'memberType'=>$request->insMemType,
                    'memberLname'=>$request->memberLname,'memberFname'=>$request->memberFname,'memberEname'=>$request->memberEname,'memberMname'=>$request->memberMname,
                    'memberSex'=>$request->memberSex, 'memberBDay'=>$request->memberBDay,'patientCode'=>$request->hiddenCode]
                ];
            }
            // dd($getHMOName);
            if($getHMOName[0]['hmoName']!=null){
                $insertHMO=DB::table('u_hispatientshealthcare')->updateOrInsert(
                    ['hmoName'=>$request->providerName,'patientCode'=>$request->hiddenCode,'hmoAccountID'=>$request->memberID],

                $getHMOName[0]);
            }
            // dd($getHMOName);

            // if($getHMOName[0]['patientName']==)
            // $insertHMO=DB::table('u_hispatientshealthcare')->Insert(
        
            // $getHMOName);

           

        // ]);

        //END PATIENT HMO
        // $this->updateMode = false;

        if($user){
            return redirect('/home');
        }else{
            return back()->with('Fail','something went wrong');
        }
        session()->flash('message', 'Users Updated Successfully.');
        
        $this->resetInputFields();
    }
    

    public function provinces(Request $request){

        // return dd($request->all());
        $select = DB::table('provinces');
        $select = $select->select('province');
        $select = $select->where('country_name','=', $request->country);
        $select = $select->groupBy('province')->get();
        return $select;
    }

    public function municipalities(Request $request){

        // return var_dump($request->all());
        $select1 = DB::table('provinces');
        $select1= $select1->select('municipality');
        $select1 = $select1->where('province','=', $request->province);
        $select1 = $select1->groupBy('municipality')->get();
        return $select1;
    }

    public function barangays(Request $request){

        // return var_dump($request->all());
        $select1 = DB::table('provinces');
        $select1= $select1->select('barangay');
        $select1 = $select1->where('municipality','=', $request->municipality);
        $select1 = $select1->groupBy('barangay')->get();
        // dd($select1);
        return $select1;
    }
    public function postal(Request $request){

        // return var_dump($request->all());
        $select1 = DB::table('provinces');
        $select1= $select1->select('zip_Code');
        $select1 = $select1->where(['barangay'=> $request->brgy]);
        $select1 = $select1->groupBy('zip_Code')->get();
        return $select1;
    }



    // Update Route for Address
    public function resetInputFields(){
        $this->U_FIRSTNAME = '';
        $this->U_LASTNAME = '';
        $this->U_MIDDLENAME = '';
        $this->extensionName = '';
        $this->U_BIRTHDATE = '';
        $this->age = '';
        $this->U_CIVILSTATUS = '';
        $this->sex = '';
        $this->placeOfBirth = '';
        $this->nationality = '';
        $this->religion = '';

    }

    
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render(){
        
        $search = $this->search;
        
        $get_Country = DB::table('countries');
        $get_Country = $get_Country->select(
                    'country'
        );

        // HEALTH MAINTENANCE ORGANIZATION
        // if(!empty($this->country)) {
        //     $this->cities = DB::table('provinces')->where('country', $this->country)->get();
        // }
        // return view('livewire.dropdowns')
            
        $getProvider = DB::table('u_hispatienthmos')->select('U_INSNAME')->groupBy('U_INSNAME')->get();
        $getMemType = DB::table('u_hishealthinmemtypes')->select('NAME')->groupBy('NAME')->get();

        $getPatientSex = DB::table('u_hispatients')->select('U_GENDER')->groupBy('U_GENDER')->get();
        // $gender = DB::table('u_hissexes')->get();
        $nationalities = DB::table('u_nationalities')->select('Nationality')->orderBy('used','desc')->get();
        $get_Country=$get_Country->groupBy('country')->get();
        $get_genderList=DB::table('u_hissexes')->select('sex','sexCode')->get();
        $countries = DB::table('countries')->select('country')->orderBy('used','desc')->get();
        $religions=DB::table('u_religions')->select('ReligionName')->get();
        $marital=DB::table('u_maritalstatus')->select('MaritalStatus')->get();
        $visitType=DB::table('u_visittypes')->select('type')->get();
        $icd10get=DB::table('u_hisicd10s')->get();
        $idTypes=DB::table('id_types')->get();
        $contTypes=DB::table('contacttypes')->get();
        $emailTypes=DB::table('emailcontacttypes')->get();
        $getComps=DB::table('u_hishospitals')->get();
        $getProvs=DB::table('provinces')->select('province')->get();
        // dd($icd10get[0]);


         // GET LAST HOSPITAL ID
         $getLastVisitIDTemp=$this->getLastCode('u_hisvisits','DOCNO');
         $getLastVisitID=$getLastVisitIDTemp->DOCNO;
         $getLastTem = explode('-',$getLastVisitID);
         // dd($getLastID[1]);
        //  $incrementVisitID =(int)($getLastTem[1])+1;
         // dd($incrementID);
         $newVisitID = str_pad((int)($getLastTem[1]) + 1, strlen($getLastTem[1]), '0', STR_PAD_LEFT); // 000010
         $getProv=DB::table('provinces')->groupBy('province')->get();

        // return var_dump($newVisitID);

        // $getNumberofContacts=DB::table('nationalities')->select('Nationality')->get();
            
        //    var_dump($search);
        return view('livewire.u-hispatients',[ 'patients'=>u_hispatient::Where('U_FIRSTNAME', 'like', '%'.$search.'%')
                                    ->orWhere('U_LASTNAME','like','%'.$search.'%')
                                    ->orWhere('U_MIDDLENAME', 'like','%'.$search.'%')
                                    ->orWhere('U_FIRSTNAME', 'like','%'.$search.'%')
                                    ->orWhere('NAME', 'like','%'.$search.'%')
                                    ->orWhereRaw("CONCAT(U_FIRSTNAME, ' ', U_LASTNAME) LIKE?", '%'.$search.'%')
                                    ->orWhereRaw("CONCAT(U_FIRSTNAME, ' ',U_MIDDLENAME,' ', U_LASTNAME) LIKE?", '%'.$search.'%')
                                    ->orderBy($this->sortColumnName, $this->sortDirection)
                                    ->paginate($this->perPage),
                    'get_Country'=>$get_Country,
                    'gender'=>$getPatientSex,
                    'nationalities'=>$nationalities,
                    'insCode'=>$getProvider,
                    'memType'=>$getMemType,
                    'get_genderList'=>$get_genderList,
                    'countries'=>$countries,
                    'religions'=>$religions,
                    'maritals'=>$marital,
                    'visitType'=>$visitType,
                    'newVisitID'=>$newVisitID,
                    'icd10gets'=>$icd10get,
                    'idTypes'=>$idTypes,
                    'contTypes'=>$contTypes,
                    'emailTypes'=>$emailTypes,
                    'getComps'=>$getComps,
                    'getProvs'=>$getProvs,
                    // 'getProv'=>$getProv,
                    ]);
       
    }
    public function getContacts($fullName,$new_code,$getContactCount, $contactArray ){

        // dd($contactArray);
        switch($getContactCount){
            case 1:
                if($contactArray[0]['contactNumber']==""){
                    // dd($contactArray[0]);
                    $contacts="";
                    
                }else{
                    $contacts = [
                        ['contactType'=>strtoupper($contactArray[0]['contactType']),'contactNumber'=>strtoupper($contactArray[0]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                    ];
                    // dd($contacts);
                    
                }
                break;
            case 2:
                if($contactArray[1]['contactNumber']==""){
                    $contacts = [
                        ['contactType'=>strtoupper($contactArray[0]['contactType']),'contactNumber'=>strtoupper($contactArray[0]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                    ];
                    
                }else{
                    $contacts = [
                        ['contactType'=>strtoupper($contactArray[0]['contactType']),'contactNumber'=>strtoupper($contactArray[0]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                        ['contactType'=>strtoupper($contactArray[1]['contactType']),'contactNumber'=>strtoupper($contactArray[1]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                    ];
                }
                // $query3=DB::table('u_hiscontacts')->insert($contacts);
                break;
            case 3:
                if($contactArray[2]['contactNumber']==""){
                    $contacts = [
                        ['contactType'=>strtoupper($contactArray[0]['contactType']),'contactNumber'=>strtoupper($contactArray[0]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                        ['contactType'=>strtoupper($contactArray[1]['contactType']),'contactNumber'=>strtoupper($contactArray[1]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                    ];
                    
                }else{
                    $contacts = [
                        
                        ['contactType'=>strtoupper($contactArray[0]['contactType']),'contactNumber'=>strtoupper($contactArray[0]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                        ['contactType'=>strtoupper($contactArray[1]['contactType']),'contactNumber'=>strtoupper($contactArray[1]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                        ['contactType'=>strtoupper($contactArray[2]['contactType']),'contactNumber'=>strtoupper($contactArray[2]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],

                    ];
                }
                // $query3=DB::table('u_hiscontacts')->insert($contacts);
                break;
            case 4:
                if($contactArray[3]['contactNumber']==""){
                    $contacts = [
                        
                        ['contactType'=>strtoupper($contactArray[0]['contactType']),'contactNumber'=>strtoupper($contactArray[0]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                        ['contactType'=>strtoupper($contactArray[1]['contactType']),'contactNumber'=>strtoupper($contactArray[1]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                        ['contactType'=>strtoupper($contactArray[2]['contactType']),'contactNumber'=>strtoupper($contactArray[2]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],

                    ];
                    
                }else{
                    $contacts=[
                        ['contactType'=>strtoupper($contactArray[0]['contactType']),'contactNumber'=>strtoupper($contactArray[0]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                        ['contactType'=>strtoupper($contactArray[1]['contactType']),'contactNumber'=>strtoupper($contactArray[1]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                        ['contactType'=>strtoupper($contactArray[2]['contactType']),'contactNumber'=>strtoupper($contactArray[2]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],
                        ['contactType'=>strtoupper($contactArray[3]['contactType']),'contactNumber'=>strtoupper($contactArray[3]['contactNumber']),'contactName'=>$fullName,'CODE'=>$new_code],

                    ];
                }
                // $query3=DB::table('u_hiscontacts')->insert($contacts);
                break;
            default:
                $contacts="";
            
            // $query3=DB::table('u_hiscontacts')->insert($contacts);
            
        }
        // dd($contacts);
        return $contacts;
    }

   public function getHMO(){

   }
   public function getNumberofUsed($dbName,$dbColumnNameSelect, $dbColumnNameGet,$dbRequest){
    $usedCount=DB::table($dbName)->select($dbColumnNameSelect)->where($dbColumnNameGet,'=',$dbRequest)->first();
    // dd($nationalityGet);
    return $usedCount;
   }

   

   


}

