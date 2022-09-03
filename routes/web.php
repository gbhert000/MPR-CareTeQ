<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
// */
// if(Auth::check()){
// //     Route::get('/', function () {
// //         return view('home');
// //     });
// // }else{
// //     Route::get('/', function () {
// //         return view('auth.login');
// //     });
// // }

                               



Route::get('/', [App\Http\Controllers\HomeController::class, 'check']);
Auth::routes(['verify' => true]);

// Route::get('/patients', [App\Http\Controllers\PatientController::class, 'index']);
Route::get('patients', function () {
    return view('patients');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(["verified"]);


Route::get('/report', [App\Http\Controllers\ReportController::class, 'index'])->name('report');

// ADDRESS

Route::get('/provinces', [App\Http\Livewire\UHispatients::class, 'provinces']);
Route::get('/municipalities', [App\Http\Livewire\UHispatients::class, 'municipalities']);
Route::get('/brgys', [App\Http\Livewire\UHispatients::class, 'barangays']);
Route::get('/postal', [App\Http\Livewire\UHispatients::class, 'postal']);


Route::get('/provincesUpdate', [App\Http\Livewire\UHispatients::class, 'provinces']);
Route::get('/municipalitiesUpdate', [App\Http\Livewire\UHispatients::class, 'municipalities']);
Route::get('/brgysUpdate', [App\Http\Livewire\UHispatients::class, 'barangays']);
Route::get('/postalUpdate', [App\Http\Livewire\UHispatients::class, 'postal']);

Route::get('/provincesFather', [App\Http\Livewire\UHispatients::class, 'provinces']);
Route::get('/municipalitiesFather', [App\Http\Livewire\UHispatients::class, 'municipalities']);
Route::get('/brgysFather', [App\Http\Livewire\UHispatients::class, 'barangays']);
Route::get('/postalFather', [App\Http\Livewire\UHispatients::class, 'postal']);

Route::get('/provincesMother', [App\Http\Livewire\UHispatients::class, 'provinces']);
Route::get('/municipalitiesMother', [App\Http\Livewire\UHispatients::class, 'municipalities']);
Route::get('/brgysMother', [App\Http\Livewire\UHispatients::class, 'barangays']);
Route::get('/postalMother', [App\Http\Livewire\UHispatients::class, 'postal']);

Route::get('/provincesSpouse', [App\Http\Livewire\UHispatients::class, 'provinces']);
Route::get('/municipalitiesSpouse', [App\Http\Livewire\UHispatients::class, 'municipalities']);
Route::get('/brgysSpouse', [App\Http\Livewire\UHispatients::class, 'barangays']);
Route::get('/postalSpouse', [App\Http\Livewire\UHispatients::class, 'postal']);


Route::get('/getCountry', [App\Http\Livewire\UHispatients::class, 'getAllCountries']);
Route::get('/municipalitiesSpouse', [App\Http\Livewire\UHispatients::class, 'municipalities']);
Route::get('/brgysSpouse', [App\Http\Livewire\UHispatients::class, 'barangays']);
Route::get('/postalSpouse', [App\Http\Livewire\UHispatients::class, 'postal']);


Route::get('/home/{id}', [App\Http\Livewire\UHispatients::class, 'getBackground']);
Route::get('/createVisit/{id}', [App\Http\Livewire\CreateVisit::class, 'getPatientInfo']);
Route::get('/icd10/{id}', [App\Http\Controllers\HomeController::class, 'getICDCODE']);

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return  "all cleared ...";

});
Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
// Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::get('myPDF/{MPL}', [App\Http\Controllers\ReportController::class, 'generatePDF']);
Route::get('/register', [CustomAuthController::class, 'registration'])->name('register');
Route::get('/masterpatientrecord/{MPL}', [App\Http\Controllers\ReportController::class, 'index']);
Route::get('/masterpatientrecord/{MPL}', [App\Http\Controllers\ReportController::class, 'index']);
Route::get('/validate-email', [CustomAuthController::class, 'validateuseremail']);
Route::get('/getIDTypes/{id}', [App\Http\Livewire\UHispatients::class, 'getIDTypes']);

Route::get('/viewVisit/{id}', [App\Http\Livewire\CreateVisit::class, 'viewVisit']);



Route::post('/add', [App\Http\Livewire\UHispatients::class, 'savePatient'])->name('registerPatient');
Route::post('/update', [App\Http\Livewire\UHispatients::class, 'update'])->name('updatePatient');
Route::post('/dischargePatient/{id}', [App\Http\Livewire\CreateVisit::class, 'dischargePatient']);


Route::post('/show_teams', [App\Http\Livewire\UHispatients::class, 'checkPatient']);

// Route::get('webcam', [App\Http\Controllers\WebcamController::class, 'index']);
Route::post('home/image/{id}', [App\Http\Controllers\WebcamController::class, 'store']);
Route::post('createVisit', [App\Http\Livewire\CreateVisit::class, 'store']);
Route::post('home/image', [App\Http\Controllers\WebcamController::class, 'store']);







// Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 

// Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 

