<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/patients', [App\Http\Controllers\PatientController::class, 'index']);
Route::get('patients', function () {
    return view('patients');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

Route::post('/add', [App\Http\Livewire\UHispatients::class, 'savePatient'])->name('registerPatient');
Route::post('/update', [App\Http\Livewire\UHispatients::class, 'update'])->name('updatePatient');


Route::post('/show_teams', [App\Http\Livewire\UHispatients::class, 'checkPatient']);

Route::get('webcam', [App\Http\Controllers\WebcamController::class, 'index']);
Route::post('webcam', [App\Http\Controllers\WebcamController::class, 'store'])->name('webcam.capture');
Route::get('/home/{id}', [App\Http\Livewire\UHispatients::class, 'getBackground']);

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return  "all cleared ...";

});

