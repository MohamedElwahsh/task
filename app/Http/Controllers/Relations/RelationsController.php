<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;

use App\Models\Hospital;
use App\Models\Phone;
use App\Models\User;
use App\Models\Doctor;

use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation()
    {
        $user = User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(3);
//        return $user -> phone -> code ;
        return response()->json($user);
    }

    public function hasOneRelationReverse()
    {
        $phone = Phone::with(['user' => function ($qq) {
            $qq->select('id', 'name');
        }])->find(1);

        // make some hidden attribute visible
        $phone->makeVisible(['user_id']);
//        $phone -> makeHidden(['code']);
//        return $phone -> user -> name; // user her is the relation exist in Phone Model
        //get all data in table user + phone related to some user
        return $phone;
    }

    public function getUserHasPhone(){
        $user = User::whereHas('phone') -> get();

        return $user;
    }
    public function getUserNotHasPhone(){
        $user = User::whereDoesntHave('phone') -> get();

        return $user;
    }
    ############################ One To Many Relationship ##################

    public function getHospitalDoctors()
    {
        $hospital = Hospital::find(1);
        // return $hospital -> doctors; //  return hospital doctors 
        // return Hospital::with('doctors') -> find(1);// return hospital and doctors

        $doctor = Doctor::find(2);

        return $doctor -> hospital -> name ; // return the name of hspital in where doctor works

    }
    public function getAllHospitals()
    {
        $hospitals = Hospital::get(); // we can use select before get method and determine which column we need
        return view('doctors.hospitals' , compact('hospitals'));
    }

    public function deleteHospital($id)
    {
        $hospital = Hospital::find($id);
        if(!$hospital)
          return abort('404');

          $hospital -> doctors() -> delete();
          $hospital -> delete();
          return view('doctors.hospitals');
    }

    public function getAllDoctors($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);

        $doctors = $hospital -> doctors ;
        
        return redirct () -> back();
       
    }
    public function deleteDoctor($id)
    {
        Doctor::select('all') -> where('id' , $id) -> delete();
        return redirect() -> back();
    }

    public function hospitalsHasDoctors()
    {
       return Hospital::whereHas('doctors') -> get();
    }    
    public function hospitalsNotHasDoctors()
    {
        return Hospital::whereDoesntHave('doctors') -> get();
    }    
    public function hospitalsHasMaleDoctors()
    {
        $hospitals = Hospital::with('doctors') -> whereHas('doctors' , function($q){
                               $q -> where('gender' , '=' , 'male') ;
                            }) -> get();
        return $hospitals;
    }    


}
