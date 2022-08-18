<?php

namespace App\Http\Livewire;

use DateTime;
use Carbon\Carbon;
use App\Models\Country;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Faker\Provider\sv_SE\Municipality;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Models\U_hispatient as u_hispatient;
use Illuminate\Console\View\Components\Alert;
use App\Components\FlashMessages;

class UHispatients extends Component
{
    use FlashMessages;
    use WithPagination;

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
        
        $getLastCode_temp = DB::table('u_hispatients')->select('CODE')
                        ->orderBy('CODE', 'desc')->first();
            
        $getLastCode = explode('-',$getLastCode_temp->CODE);
        
        $concat_code = (int) ($getLastCode[0].$getLastCode[1].$getLastCode[2]) + 1;

        $new_code = strtoupper(join('-',[substr($concat_code,0,4), substr($concat_code,4,4), substr($concat_code,8,4)]));

        // dd($new_code);
        
        $address=join(' ',[$request->houseNo, $request->street,$request->brgy,$request->municipality,$request->province, $request->U_COUNTRY ]);
        
        $fullName=strtoupper(join(' ',[$request->U_LASTNAME, ',',$request->U_FIRSTNAME,$request->U_MIDDLENAME,$request->extensionName ]));

        $selectRecord=u_hispatient::where(['U_FIRSTNAME'=>$request->U_FIRSTNAME, 'U_LASTNAME'=>$request->U_LASTNAME, 'U_BIRTHDATE'=>$request->U_BIRTHDATE])->first();
        // if()
        $getContactCount=$request->countContact;
        
        $contactArray=[
            
                [ 'contactType'=>strtoupper($request->contactType1),'contactNumber'=>strtoupper($request->contact1),'contactName'=>$fullName,  'CODE'=>$new_code],
                ['contactType'=>strtoupper($request->contactType2),'contactNumber'=>strtoupper($request->contact2),'contactName'=>$fullName,'CODE'=>$new_code],
                ['contactType'=>strtoupper($request->contactType3),'contactNumber'=>strtoupper($request->contact3),'contactName'=>$fullName,'CODE'=>$new_code],
                ['contactType'=>strtoupper($request->contactType4),'contactNumber'=>strtoupper($request->contact4),'contactName'=>$fullName,'CODE'=>$new_code],
        ];
        
        $newPatient=false;

       
        if(!$selectRecord){
            
            $getPatientContact=$this->getContacts($fullName,$new_code,$getContactCount, $contactArray);
            // dd($getPatientContact);
            
            $query3=DB::table('u_hiscontacts')->insert($getPatientContact);
            
        
            $query = DB::table('u_hispatients')->insert([

                'CODE'=>$new_code,
                'NAME'=>$fullName,
                'U_FIRSTNAME'=>strtoupper($request->U_FIRSTNAME),
                'U_LASTNAME'=>strtoupper($request->U_LASTNAME),
                'U_MIDDLENAME'=>strtoupper($request->U_MIDDLENAME),
                'U_EXTNAME' =>strtoupper($request->extensionName),
                'U_CIVILSTATUS' =>strtoupper($request->U_CIVILSTATUS),
                'U_BIRTHDATE'=>($request->U_BIRTHDATE),
                'U_AGE'=>strtoupper($request->age),
                'U_GENDER'=>strtoupper($request->sex),
                'U_BIRTHPLACE'=>strtoupper($request->placeOfBirth),
                'U_NATIONALITY'=>strtoupper($request->nationality),
                'U_RELIGION'=>strtoupper($request->religion),
                'U_OCCUPATION'=>strtoupper($request->occupation),
                'U_ADDRESS' =>strtoupper($address),
                'U_STREET' =>strtoupper($request->street),
                'U_HOUSENO' =>strtoupper($request->houseNo),
                'U_BARANGAY'=>strtoupper($request->brgy),
                'U_CITY'=>strtoupper($request->municipality),
                'U_PROVINCE'=>strtoupper($request->province),
                'U_COUNTRY'=>strtoupper($request->country),
                'U_ZIP'=>strtoupper($request->postal),
                'U_STREET'=>strtoupper($request->street),
                // 'U_TELNO'=>strtoupper($request->U_TELNO),
                // 'U_1STCONTACT'=>strtoupper($request->U_1STCONTACT),
                // 'U_2NDCONTACT'=>strtoupper($request->U_2NDCONTACT),
                // 'U_3RDCONTACT'=>strtoupper($request->U_3RDCONTACT),
                // 'U_4THCONTACT'=>strtoupper($request->U_4THCONTACT),
                // 'U_1STCONTACTTYPE'=>strtoupper($request->U_1STCONTACTTYPE),
                // 'U_2NDCONTACTTYPE'=>strtoupper($request->U_2NDCONTACTTYPE),
                // 'U_3RDCONTACTTYPE'=>strtoupper($request->U_3RDCONTACTTYPE),
                // 'U_4THCONTACTTYPE'=>strtoupper($request->U_4THCONTACTTYPE),
                'U_ACTIVE'=>1,
                'U_VISITCOUNT'=>1,
                'countContacts'=>$getContactCount,
                // DATES
                'DATECREATED'=>DATE('Y-m-d H:i:s'),
                'LASTUPDATED'=>date('Y-m-d H:i:s')
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
        $selectRecord1=u_hispatient::where(['U_FIRSTNAME'=>$request->fname, 'U_LASTNAME'=>$request->lname, 'U_BIRTHDATE'=>$request->bday])->first();
        // var_dump($request->U_FIRSTNAME);
        if($selectRecord1){
            // dd(($selectRecord1));
            return response()->json(['success' => true,
                        'msg' => 'Patient Already Exist.',
                        'getRecord'=>$selectRecord1
            ]);
        }
        else{
            return response()->json(['success' => false, 'msg' => 'Welcome, nasdew player.']);
        }
        
        
    }

    public function getBackground($CODE){

        // dd($CODE);
        $post3 = U_hispatient::where('CODE','=',$CODE)->first();
        $post2 = DB::table('u_hiscontacts')->where(['CODE'=>$CODE])->get();
        // return Response::json([
        //     'as'=>$post1,
        // ]);
        return response()->json([
            'mpr'=>$post3,
            'contacts'=>$post2
        ]);
    }
    public function edit($CODE, Request $request){

        // dd($CODE);
        $this->updateMode = true; 
        $post = U_hispatient::where('CODE','=',$CODE)->get();
        // dd($post->U_LASTNAME);
        foreach($post as $data){
            $value = $data;
        }

        // format $this->fieldname=$value['columname']
        $lastname = $value['U_LASTNAME'];
        $firstname = $value['U_FIRSTNAME'];
        
        
        $this->CODE = $CODE;
        // $this->U_FIRSTNAME = $post->U_FIRSTNAME;
        $this->U_LASTNAME = $lastname;
        $this->U_FIRSTNAME = $firstname;
        $this->U_MIDDLENAME = $value['U_MIDDLENAME'];
        $this->CODE = $value['CODE'];
        $this->age = $value['U_AGE'];
        $this->U_CIVILSTATUS = $value['U_CIVILSTATUS'];
        $this->updatesex = $value['U_GENDER'];
        $this->country1 = $value['U_COUNTRY'];
        $this->municipality1 = $value['U_CITY'];
        $this->province1 = $value['U_PROVINCE'];
        $this->brgy = $value['U_BARANGAY'];
        $this->postal = $value['U_ZIP'];
        $this->street = $value['U_STREET'];
        $this->houseNo = $value['U_HOUSENO'];
        // $this->U_COUNTRY = $value['U_COUNTRY'];
        $this->U_BIRTHDATE = $value['U_BIRTHDATE'];
        // $this->age = $value['U_AGE'];
        // $this->selected_country = $value['U_COUNTRY'];

        // BACKGROUND INFORMATION
        $this->fatherLastName=$value['U_FATHERSLASTNAME'];
        $this->fatherFirstName=$value['U_FATHERSFIRSTNAME'];
        $this->fatherMiddleName=$value['U_FATHERSMIDDLENAME'];
        $this->fatherExtName=$value['U_FATHERSEXTNAME'];
        $this->motherLastName=$value['U_MOTHERSLASTNAME'];
        $this->motherFirstName=$value['U_MOTHERSFIRSTNAME'];
        $this->motherMiddleName=$value['U_MOTHERSMIDDLENAME'];
        $this->motherExtName=$value['U_MOTHERSEXTNAME'];
        $this->spouseLastName=$value['U_SPOUSELASTNAME'];
        $this->spouseFirstName=$value['U_SPOUSEFIRSTNAME'];
        $this->spouseMiddleName=$value['U_SPOUSEMIDDLENAME'];
        $this->spouseExtName=$value['U_SPOUSEEXTNAME'];

        $this->U_BIRTHPLACE = $value['U_BIRTHPLACE'];
        $this->U_NATIONALITY = $value['U_NATIONALITY'];
        $this->U_OCCUPATION = $value['U_OCCUPATION'];
        $this->U_RELIGION = $value['U_RELIGION'];
        $this->contactType1 = $value['U_1STCONTACTTYPE'];
        $this->U_1STCONTACT = $value['U_1STCONTACT'];
        $this->contactType2 = $value['U_2NDCONTACTTYPE'];
        $this->U_2NDCONTACT = $value['U_2NDCONTACT'];
        $this->contactType3 = $value['U_3RDCONTACTTYPE'];
        $this->U_3RDCONTACT = $value['U_3RDCONTACT'];
        $this->contactType4 = $value['U_4THCONTACTTYPE'];
        $this->U_4THCONTACT = $value['U_4THCONTACT'];
        // $this->U_LASTNAME = $firstname;
        $this->updateMode = true; 
        // return Response::json($post);
    }


    public function update(Request $request)
    {
        // $currentTime=Carbon::now();
        

        
        $getCountry = $request->country1;
        // $user = U_hispatient::where('CODE','=',$this->CODE)->get();
      
        // dd($CODE);

        // GET PATIENT'S FULLNAME
        $updatefullName=strtoupper(join(' ',[$request->U_LASTNAME, ',',$request->U_FIRSTNAME,$request->U_MIDDLENAME,$request->extensionName ]));
       
        // GET PATIENT FULL ADDRESS
        $updateaddress=join(' ',[$request->houseNo, $request->street,$request->brgy,$request->municipality,$request->province, $request->country ]);
    
        // GET FATHER'S NAME + ADDRESS
        $updateFathersName=strtoupper(join(' ',[$request->fatherLastName, ',',$request->fatherFirstName,$request->fatherMiddleName,$request->fatherExtName ]));
        $updateFathersAddress = strtoupper(join(' ',[$request->fatherHouseNo, ',',$request->fatherStreet,$request->fathersBrgy,$request->fathersMunicipality,$request->fathersProvince,$request->fathersCountry,$request->fathersPostal]));

        // GET MOTHER'S NAME + ADDRESS
        $updateMothersName=strtoupper(join(' ',[$request->motherLastName, ',',$request->motherFirstName,$request->motherMiddleName,$request->motherExtName ]));
        $updateMothersAddress = strtoupper(join(' ',[$request->motherHouseNo, ',',$request->motherStreet,$request->mothersBrgy,$request->mothersMunicipality,$request->mothersProvince,$request->mothersCountry,$request->mothersPostal]));
        
        // GET SPOUSE NAME + ADDRESS
        $updateSpousesName=strtoupper(join(' ',[$request->spouseLastName, ',',$request->spouseFirstName,$request->spouseMiddleName,$request->spouseExtName ]));
        $updateSpousesAddress = strtoupper(join(' ',[$request->spouseHouseNo, ',',$request->spouseStreet,$request->spousesBrgy,$request->spousesMunicipality,$request->spousesProvince,$request->spousesCountry,$request->spousesPostal ]));
        
        $get_code=$request->CODE;
       
        
        $contactArrayUpdate=[
            
            [ 'contactType'=>strtoupper($request->contactType1),'contactNumber'=>strtoupper($request->contact1),'contactName'=>$updatefullName,  'CODE'=>$get_code],
            ['contactType'=>strtoupper($request->contactType2),'contactNumber'=>strtoupper($request->contact2),'contactName'=>$updatefullName,'CODE'=>$get_code],
            ['contactType'=>strtoupper($request->contactType3),'contactNumber'=>strtoupper($request->contact3),'contactName'=>$updatefullName,'CODE'=>$get_code],
            ['contactType'=>strtoupper($request->contactType4),'contactNumber'=>strtoupper($request->contact4),'contactName'=>$updatefullName,'CODE'=>$get_code],
        ];
        

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
            [$request->contact1],
            [$request->contact2],
            [$request->contact3],
            [$request->contact4],
        ];
        // dd($request->hideContact1);

        $countCheckContactInfo=count($checkContactInfo);
        // dd($countCheckContactInfo);

        $getContactCountUpdate=$request->countContactUpdate;
        // dd($getContactCountUpdate,$countCheckContactInfo);
        $countContactsUpdate=count($checkContactInfo);
        $getPatientContactUpdate=$this->getContacts($updatefullName,$get_code,$countContactsUpdate, $contactArrayUpdate);
        $getPatientContactInsert=$this->getContacts($updatefullName,$get_code,$getContactCountUpdate, $contactArrayUpdate);
        // dd($getPatientContactInsert);
        // dd($getPatientContactInsert[0]);
        // dd($countContactsUpdate-$getContactCountUpdate);
        if($getContactCountUpdate>=$countCheckContactInfo){
            
                for($i=0; $i<4;$i++){
                     $checkDBContact[$i]=DB::table('u_hiscontacts')->where('CODE',$request->hiddenCode)
                                ->where('contactID',$getUpdateContactID[$i])->first();
                // }
                // dd($checkDBContact);                
                    if($checkDBContact[$i]==""){
                        // dd($checkDBContact[$i]);
                        $insertPatientContact=DB::table('u_hiscontacts')
                                ->insert(
                                        // dd($getPatientContactUpdate)
                                        [$getPatientContactInsert[$i-1]]
                                        );
                        if($insertPatientContact){
                            // dd("asd");
                                $updateCountingContacts=DB::table('u_hispatients')
                                    ->where(['CODE'=>$request->hiddenCode])
                                    ->update(['countContacts'=>$i]);    
                            }
                    }else{
                        // dd("asd");
                        $updatePatientContact=DB::table('u_hiscontacts')
                            ->where('contactID',$getUpdateContactID[$i])
                            ->update(
                                // dd($getPatientContactUpdate)
                                $getPatientContactUpdate[$i],
                            );
                    }
                        
                }        
            
        }
        
       
        // UPDATE MASTER PATIENT RECORD
        $user = U_hispatient::where('CODE','=',$request->hiddenCode)->update([

            // Personal Information 
            'NAME'=>$updatefullName,
            'U_FIRSTNAME'=>strtoupper($request->U_FIRSTNAME),
            'U_LASTNAME'=>strtoupper($request->U_LASTNAME),
            'U_MIDDLENAME'=>strtoupper($request->U_MIDDLENAME),
            'U_EXTNAME' =>strtoupper($request->extensionName),
            'U_CIVILSTATUS' =>strtoupper($request->U_CIVILSTATUS),
            'U_BIRTHDATE'=>($request->U_BIRTHDATE),
            'U_AGE'=>strtoupper($request->age),
            'U_FATHERNAME'=>$updateFathersName,
            'U_MOTHERNAME'=>$updateMothersName,
            'U_GENDER'=>strtoupper($request->updatesex),
            'U_BIRTHPLACE'=>strtoupper($request->U_BIRTHPLACE),
            'U_NATIONALITY'=>strtoupper($request->U_NATIONALITY),
            'U_RELIGION'=>strtoupper($request->U_RELIGION),
            'U_OCCUPATION'=>strtoupper($request->U_OCCUPATION),
            'U_ADDRESS' =>strtoupper($updateaddress),
            'U_STREET' =>strtoupper($request->street),
            'U_HOUSENO' =>strtoupper($request->houseNo),
            'U_BARANGAY'=>strtoupper($request->brgy1),
            'U_CITY'=>strtoupper($request->municipality1),
            'U_PROVINCE'=>strtoupper($request->province),
            'U_COUNTRY'=>strtoupper($request->country),
            'U_ZIP'=>strtoupper($request->postal),
            'U_STREET'=>strtoupper($request->street),

                // CONTACT INFORMATION
                // 'U_TELNO'=>strtoupper($this->U_TELNO),
            // 'U_1STCONTACT'=>strtoupper($request->U_1STCONTACT),
            // 'U_2NDCONTACT'=>strtoupper($request->U_2NDCONTACT),
            // 'U_3RDCONTACT'=>strtoupper($request->U_3RDCONTACT),
            // 'U_4THCONTACT'=>strtoupper($request->U_4THCONTACT),
            // 'U_1STCONTACTTYPE'=>strtoupper($request->contactType1),
            // 'U_2NDCONTACTTYPE'=>strtoupper($request->contactType2),
            // 'U_3RDCONTACTTYPE'=>strtoupper($request->contactType3),
            // 'U_4THCONTACTTYPE'=>strtoupper($request->contactType4),

            // BACKGROUND INFORMATION
            // FATHER
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
            'U_FATHERZIP'=>strtoupper($request->fathersPostal),

            // MOTHER
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
            'U_MOTHERZIP'=>strtoupper($request->mothersPostal),
            
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

                

                // 'U_COUNTRY' => strtoupper($this->country_selected),
        ]);
        // END UPDATE MASTER PATIENT RECORD

        // UPDATE PATIENTS CONTACT

       
        // END PATIENT'S CONTACT
        
        // ADD PATIENT HMO
        // $insertHmo1=DB::table('u_hispatientshealthcare')->insert([

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
        $select = $select->where('country','=', $request->country);
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
        $select1= $select1->select('brgy');
        $select1 = $select1->where('municipality','=', $request->municipality);
        $select1 = $select1->groupBy('brgy')->get();
        return $select1;
    }
    public function postal(Request $request){

        // return var_dump($request->all());
        $select1 = DB::table('provinces');
        $select1= $select1->select('zipCode');
        $select1 = $select1->where('brgy','=', $request->brgy);
        $select1 = $select1->groupBy('zipCode')->get();
        return $select1;
    }



    // Update Route for Address

   


    public function sortBy($columnName)
    {
        // dd('here');

        if($this->sortColumnName === $columnName){
            $this->sortDirection = $this->swapSortDirection();

        }else{
            $this->sortDirection = 'asc';
        }
        

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection(){
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';

    }

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
        $this->resetPage('bootstrap-5-custom');
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
        $nationalities = DB::table('nationalities')->select('Nationality')->get();
        $get_Country=$get_Country->groupBy('country')->get();
        $get_genderList=DB::table('u_hissexes')->select('sex','sexCode')->get();
        $countries = DB::table('countries')->select('country')->groupBy('country')->get();

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

    public function insertPatientContacts($fullName,$new_code,$getPatientContactUpdate, $contactArray){

        switch($getPatientContactUpdate){
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
    


}

