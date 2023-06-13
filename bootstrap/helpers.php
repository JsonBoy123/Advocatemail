<?php
use App\Models\Customer;
use App\Models\User;
use App\Models\CaseMast;
use App\Models\CourtMastHeader;
use App\Models\Todo;
use App\Models\CatgMast;
use App\Models\City;
use Carbon\Carbon;
use App\Models\AcademicCalendarMast;
use App\Models\PackageModule;
use App\Models\UserPackage;
use App\Models\UserQualification;


const GENDER = [
	'M'  => 'Male',
	'F'  => 'Female',
	'O'  => 'Other'	
];

const SUBJECT_LIST = [
	'1'  => 'Legal Assistance',
	'2'  => 'Other'	
];

if (!function_exists('file_upload')) {
    function file_upload($file,$folder,$data = [],$fieldName=null){      
        if(!empty($data) !=0){
            if($data->$fieldName != null){
               Storage::delete('public/'.$data->$fieldName);
            }
        }
        $name =  time().'_'.$file->getClientOriginalName();
        $file->storeAs('public/'.$folder, $name);
        $path = $folder.'/'.$name;
        return $path;
    }
}

if (!function_exists('getFullAddress')) {
    function getFullAddress($data){      
        return $data->addr1 .', '. ($data->addr2 !=null ? ($data->addr2 .', ') : '') . $data->city->city_name.', '.$data->state->state_name.', '.'India'.', '.$data->pin_code;
        // return $path;
    }
}



if(!function_exists('website_check')){
    function website_check(){
        return User::where('id',Auth::user()->id)->first();        
    }     
}

?>