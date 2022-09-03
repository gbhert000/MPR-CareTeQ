<?php

namespace App\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait GetLastCode
{
    public function getLastCode($table,$selectItem){
        $getLastCode_temp = DB::table($table)->select($selectItem)
        ->orderBy($selectItem, 'desc')->first();
    
        return $getLastCode_temp;
       }
    public function getHospitalNHFR($requestName){
        $getNHFR=DB::table('u_hishospitals')->select('NHFR','hospitalCode')->where('hospitalName',$requestName)->first();
    
        return $getNHFR;
    }

    public function uploadImage($img,$fullname,$MPID){

        $img_name=uniqid().'.txt';
        $folderPath = "uploads/";
        $file = $folderPath . $img_name;
        $uploadStorage=Storage::disk('my_files')->put($file,$img);
        if($uploadStorage){
                    // dd("asd");
                    // $checkImage=DB::table("u_hisimages")->where("patientCode",$MPID)->first();
                    $uploadDatabase=DB::table('u_hisimages')->updateorInsert(
                        ["patientCode"=>$MPID],   
                        ['imageName'=>$img_name,'patientCode'=>$MPID,'patientName'=>$fullname]
                    );
                    // if(is_null($checkImage)){
                    //     $uploadDatabase=DB::table('u_hisimages')->insert(
                           
                    //         ['imageName'=>$img_name,'patientCode'=>$MPID,'patientName'=>$fullname]
                    //     );
                    // }else{
                    //     $uploadDatabase=DB::table('u_hisimages')->where("patientCode",$MPID)->update(
                    //             ['imageName'=>$img_name,'patientCode'=>$MPID,'patientName'=>$fullname]
                    //         );
                    // }

                    if($uploadDatabase){
                        $addAuditTrail = DB::table('u_hisimages_audit_trail')->insert([
                            'imageName'=>$img_name,
                            'patientCode'=>$MPID,
                            'patientName'=>$fullname, 
                            'updatedBy'=>Auth::user()->userName]);
                    }
        }
        return;

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
    public function getIDTypes($idd)
    {
        $idtypes = DB::table('id_types')
                    ->select("id_typeformat")
                    ->where("name", $idd)
                    ->get();
        return $idtypes;
    }

}



?>