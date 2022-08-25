<?php
namespace App\Http\Controllers;
use Hash;
use Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        $hospitals=DB::table('u_hishospitals')->get();
        return view('auth.registration', ['hospitals'=>$hospitals]);
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'userName' => 'required',
            'hospitalName' => 'required',
            // 'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data=[
            'name'=>$request->name,
            'userName'=>$request->userName,
            'COMPANY'=>$request->hospitalName,
            'email'=>$request->email,
            'password'=>$request->password,
        
        ];
        // dd($data);
        // $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::insert([
        'name' => $data['name'],
        'email' => $data['email'],
        'COMPANY' => $data['COMPANY'],
        'userName' => $data['userName'],
        // 'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
      ]);
    }    
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('home');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}