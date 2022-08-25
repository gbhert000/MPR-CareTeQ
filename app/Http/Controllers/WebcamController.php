<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
  
class WebcamController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        // return view('webcam');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $img = $request->image;
        // dd($request->image);
        // dd($img);
        $folderPath = "uploads/";
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        
        $file = $folderPath . $fileName;

        // $uploadStorage=$img->store('toPath', ['disk' => 'my_files']);
        // dd($file);
        $uploadStorage=Storage::disk('my_files')->put($file, $image_base64);

        $fullName=strtoupper(join('',[$request->lnameImage,',',$request->fnameImage, $request->mnameImage, $request->enameImage]));

        $uploadDatabase=DB::table('u_hisimages')->updateOrInsert(
            ['patientCode'=>$request->patientCode],
                ['imageName'=>$fileName,'patientCode'=>$request->patientCode,'patientName'=>$fullName]
        );
          if($uploadStorage&&$uploadDatabase){
            // dd(($selectRecord1));
            return response()->json(['success' => true,
                        'msg' => 'Uploaded Successfully',       
            ]);
        }
        else{
            return response()->json(['success' => false, 'msg' => 'Patient Successfully Registered.']);
        }
        // return view('home');
    }
}