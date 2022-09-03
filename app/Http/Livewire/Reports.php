<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\U_hispatient as u_hispatient;

use DateTime;
use PDF;
use Carbon\Carbon;
use App\Models\Country;

use Illuminate\Http\Request;
use Livewire\WithPagination;

use Faker\Provider\sv_SE\Municipality;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

use Illuminate\Console\View\Components\Alert;
use App\Components\FlashMessages;

// global $getArray;
class Reports extends Component
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
            $contacts,
            $endDate,
            $startDate,
            $HPI,
            $fullname,
            $noOfVisit,
            $hospIndex,
            $byHospitals;

  
            // public $cities=[];
            // public $city;
    
    public $U_RELIGION, $U_OCCUPATION,$U_GENDER,$province1,$brgy,$country1,$houseNo, $street,$municipality,$province,$country;
    
    public $CODE;

    public $patientArray;
    public $patientsArray;
    

    

    protected function rules()
    {
        return [
            'U_FIRSTNAME' => 'required|string|min:3',
            'U_LASTNAME' => 'required|string|min:6',
            'U_MIDDLENAME' => 'required|string|min:6',
            
        ];
    }

    public function HPI(){
        // $hospIndex=$this->HPI;
        $hospIndex="checked";
        return $hospIndex;
    }

    public function resetFilter(){
        $this->startDate="";
        $this->endDate="";
        $this->perPage=10;
        $this->HPI="";
        $this->fullname="";
        $this->noOfVisit="";
        $this->sortDirection="desc";
        $this->sortColumnName="CODE";
        $this->byHospitals = '';
    }


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
    public function getarray2(){
        $arr=$this->getArray;
        dd($arr);
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
        $this->byHospitals = '';

    }

    
    
    public function updatingSearch()
    {
        $this->resetPage('bootstrap-5-custom');
    }

    public function render(){
        

        $HPI=$this->HPI;
        $fullname=$this->fullname;
        $noOfVisit=$this->noOfVisit;
        $byHospitals=$this->byHospitals;
        if($this->endDate==""){
            $endDate=now();
        }else{
            $endDate =date($this->endDate);
        }
        
        $search = $this->search;

        

        $startDate =date($this->startDate);
        
        
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
        $countries = DB::table('countries')->select('country')->groupBy('country')->get();
        $idTypes=DB::table('id_types')->get();
        $contTypes=DB::table('contacttypes')->get();
        $emailTypes=DB::table('emailcontacttypes')->get();
        $getComps=DB::table('u_hishospitals')->get();


        $pow = DB::table('u_hispatients')->count();

        // GET OLDEST DATE ON TABLE
        $oldest = DB::table('u_hispatients')->select('DATECREATED')->orderBy('DATECREATED')->first();

        // $getNumberofContacts=DB::table('nationalities')->select('Nationality')->get();
        
        // $getArray=$this->getArray($countries);

        $patients1=DB::table('u_hispatients')->Where('NAME', 'like','%'.$search.'%')
        ->orWhereRaw("CONCAT(U_FIRSTNAME, ' ', U_LASTNAME) LIKE?", '%'.$search.'%')
        ->orWhereRaw("CONCAT(U_FIRSTNAME, ' ',U_MIDDLENAME,' ', U_LASTNAME) LIKE?", '%'.$search.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)->take($this->perPage)->get();

        $hospitals=DB::table('u_hishospitals')->get();
        $religions=DB::table('u_religions')->select('ReligionName')->get();
        $marital=DB::table('u_maritalstatus')->select('MaritalStatus')->get();

        
        // $patientArray=$countries;
        $this->patientsArray=$patients1;
        
        //    var_dump($search);
        if(($this->startDate=="")&&($this->endDate=="")){
            return view('livewire.reports',[ 'patients'=>u_hispatient::Where('NAME', 'like','%'.$search.'%')
                         ->orWhere('COMPANY','like','%'.$byHospitals.'%')
                            ->WhereRaw("CONCAT(U_FIRSTNAME, ' ', U_LASTNAME) LIKE?", '%'.$search.'%')
                            ->WhereRaw("CONCAT(U_FIRSTNAME, ' ',U_MIDDLENAME,' ', U_LASTNAME) LIKE?", '%'.$search.'%')
                           
                            ->orderBy($this->sortColumnName, $this->sortDirection)
                            ->paginate($this->perPage),
                    'get_Country'=>$get_Country,
                    'hospitals'=>$hospitals,
                    'gender'=>$getPatientSex,
                    'nationalities'=>$nationalities,
                    'insCode'=>$getProvider,
                    'memType'=>$getMemType,
                    'get_genderList'=>$get_genderList,
                    'countries'=>$countries,
                    'religions'=>$religions,
                    'maritals'=>$marital,
                    'pow'=>$pow,
                    'oldest'=>$oldest,
                    'idTypes'=>$idTypes,
                    'contTypes'=>$contTypes,
                    'emailTypes'=>$emailTypes,
                    'getComps'=>$getComps,
                    ]);
        }
        else if(($this->byHospitals!="")){
            return view('livewire.reports',[ 'patients'=>u_hispatient::Where('NAME', 'like','%'.$search.'%')
                                    ->Where('COMPANY','=',$byHospitals)
                                    // ->ORWhere('U_FIRSTNAME', 'like','%'.$search.'%')
                                    // ->ORWhere('U_LASTNAME', 'like','%'.$search.'%')
                                    // ->ORWhere('U_MIDDLENAME', 'like','%'.$search.'%')
                                    // ->orWhereRaw("CONCAT(U_FIRSTNAME, ' ', U_LASTNAME) LIKE?", '%'.$search.'%')
                                    // ->orWhereRaw("CONCAT(U_FIRSTNAME, ' ',U_MIDDLENAME,' ', U_LASTNAME) LIKE?", '%'.$search.'%')
                                    ->orderBy($this->sortColumnName, $this->sortDirection)
                                    ->paginate($this->perPage),
                                    'hospitals'=>$hospitals,
                    'get_Country'=>$get_Country,
                    'gender'=>$getPatientSex,
                    'nationalities'=>$nationalities,
                    'insCode'=>$getProvider,
                    'memType'=>$getMemType,
                    'get_genderList'=>$get_genderList,
                    'countries'=>$countries,
                    'religions'=>$religions,
                    'maritals'=>$marital,
                    'pow'=>$pow,
                    'oldest'=>$oldest,
                    'idTypes'=>$idTypes,
                    'contTypes'=>$contTypes,
                    'emailTypes'=>$emailTypes,
                    'getComps'=>$getComps,
                    
                    ]);
        }
        else{
             return view('livewire.reports',[ 'patients'=>u_hispatient::where('DATECREATED','>=', $startDate)
                                    ->where('DATECREATED','<=', $endDate)
                                    ->Where('NAME', 'like','%'.$search.'%')
                                    // ->Where('COMPANY','=',$byHospitals)
                                    // ->ORWhere('U_FIRSTNAME', 'like','%'.$search.'%')
                                    // ->ORWhere('U_LASTNAME', 'like','%'.$search.'%')
                                    // ->ORWhere('U_MIDDLENAME', 'like','%'.$search.'%')
                                    // ->orWhereRaw("CONCAT(U_FIRSTNAME, ' ', U_LASTNAME) LIKE?", '%'.$search.'%')
                                    // ->orWhereRaw("CONCAT(U_FIRSTNAME, ' ',U_MIDDLENAME,' ', U_LASTNAME) LIKE?", '%'.$search.'%')
                                    ->orderBy($this->sortColumnName, $this->sortDirection)
                                    ->paginate($this->perPage),
                                    'hospitals'=>$hospitals,
                    'get_Country'=>$get_Country,
                    'gender'=>$getPatientSex,
                    'nationalities'=>$nationalities,
                    'insCode'=>$getProvider,
                    'memType'=>$getMemType,
                    'get_genderList'=>$get_genderList,
                    'countries'=>$countries,
                    'religions'=>$religions,
                    'maritals'=>$marital,
                    'pow'=>$pow,
                    'oldest'=>$oldest,
                    'idTypes'=>$idTypes,
                    'contTypes'=>$contTypes,
                    'emailTypes'=>$emailTypes,
                    'getComps'=>$getComps,
                    ]);
        }

       
       
    }
    public function mount(){
        
    }
    public function getArray(){
        // dd($patientsArray);
        $data=[];
        $data=$this->patientsArray;
        // return $patientsArray;
        // dd($data);
        $pdf = PDF::loadView('/livewire.reportModal', $data);

        return $pdf->download('Testing.pdf');
    }

    
    
}
