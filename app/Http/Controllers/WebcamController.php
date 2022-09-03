<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        // $img=str_replace('data:image/png;base64,', '', $img);


        // for txt file
        $img=str_replace(' ', '+', $img);
        // $img_name=uniqid().'.txt';
        // $folderPath = "uploads/";
        // $file = $folderPath . $img_name;
        // $uploadStorage=Storage::disk('my_files')->put($file,$img);

        // dd($request->imagebase64);
        // dd($img);
               
        // $image_parts = explode(";base64,", $img);
        // // dd($image_parts[0]);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        
        // $image_base64 = base64_decode($image_parts[1]);
        // $fileName = uniqid() . '.png';
        // // dd($fileName);
        
        // $uploadStorage=$img->store('toPath', ['disk' => 'my_files']);
        // dd($file);
        // $uploadStorage=Storage::disk('my_files')->put($file,$img);
        // \File::put(storage_path(). '/' . $imageName, base64_decode($image));

        // $fullName=strtoupper(join('',[$request->lnameImage.',',$request->fnameImage, $request->mnameImage, $request->enameImage]));
        // dd($fullName);

        // $uploadDatabase=DB::table('u_hisimages')->updateOrInsert(
        //     ['patientCode'=>$request->patientCode],
        //         ['imageName'=>$img_name,'patientCode'=>$request->patientCode,'patientName'=>$fullName]
        // );
        // dd($img);

        //   if($uploadStorage){
            // dd(($selectRecord1));
            return response()->json(['success' => true,
                        'msg' => 'Uploaded Successfully', 
                        'img'=>$img      
            ]);
        // }
        // else{
        //     return response()->json(['success' => false, 'msg' => 'Patient Successfully Registered.']);
        // }
       
    }
}