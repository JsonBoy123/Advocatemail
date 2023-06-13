<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Slots;
use App\Models\Plans;
use App\Models\Days;
use SweetAlert;

class AppointmentController extends Controller
{

    public function index()
    {
      $id = Auth::user()->id;
      $user = User::with('city')->with('state')->where('id',$id)->first();
      $days = Days::all();
      $plans = Plans::where('user_id',Auth::user()->id)->where('status',1)->get();
      // $plans = Plans::with('slots')->where('user_id',$user)->get();
      $slots = Slots::all();
      return view('backend.profile.appointment', compact('user','days','plans','slots'));
  }


  public function create()
  {  
    $id = Auth::user()->id;
    $user = User::with('city')->with('state')->where('id',$id)->first();
    $days = Days::all();
    $slots =Slots::all();
    $plans = Plans::with('slots')->where('user_id',Auth::user()->id)->get();
    // $plans = Plans::with('slots')->where('user_id',$user)->get();
    return view('backend.profile.create-appointment',compact('user','days','slots','plans'));
}


public function store(Request $request)
    { 
        $user_id = Auth::user()->id;

        $mon_slots_ids = $request->mon_slots_ids;
        $tue_slots_ids = $request->tue_slots_ids;
        $wed_slots_ids = $request->wed_slots_ids;
        $thu_slots_ids = $request->thu_slots_ids;
        $fri_slots_ids = $request->fri_slots_ids;
        $sat_slots_ids = $request->sat_slots_ids;
        $sun_slots_ids = $request->sun_slots_ids;

        $days_array=array (
            'mon_slots_ids'=>array(),
            'tue_slots_ids'=>array(),
            'wed_slots_ids'=>array(),
            'thu_slots_ids'=>array(),
            'fri_slots_ids'=>array(),
            'sat_slots_ids'=>array(),
            'sun_slots_ids'=>array()
        );

        $data = $request->all();

        $empty_array = array();

        foreach($days_array as $k=>$v){
            $empty_array[$k]=$v;
            foreach($data as $dk=>$dv){
                if($k = $dk){
                 $empty_array[$dk]=$dv;
                }
            }
        }


        $days_name = array();

        foreach($days_array as $day_key => $day_value){
            $days_name[] = $day_key;
        }
       

    if(count($data)!=0){
        foreach($days_name as $key_day => $value_day){

            if(count($empty_array[$value_day]) !=0){
                foreach($empty_array[$value_day] as $key_slot => $value_slot){
                    $objModel = new Plans();
                    $objModel->user_id = $user_id;
                    $objModel->day = $this->day_fetch($value_day);
                    $objModel->status = 1;
                    $objModel->slot = $value_slot;
                    $objModel->save();
                }
            }
        }
            return 'Appointment Schedule Submitted';
        }
      
        else{
            return "no";
        }
         Alert::toast('You\'ve Successfully Registered', 'success');

        
    }

public function day_fetch($day_name){
    switch ($day_name) {
        case 'mon_slots_ids':
        return 1;
        break;
        case 'tue_slots_ids':
        return 2;
        break;
        case 'wed_slots_ids':
        return 3;
        break;
        case 'thu_slots_ids':
        return 4;
        break;
        case 'fri_slots_ids':
        return 5;
        break;
        case 'sat_slots_ids':
        return 6;
        break;
        case 'sun_slots_ids':
        return 7;
        break;


        default:
                # code...
        break;
    }
}


public function show(Appointment $appointment)
{
        //
}


public function edit($id)
{
    $id = Auth::user()->id;
    $user = User::with('city')->with('state')->where('id',$id)->first();
    $days = Days::all();
    $slots =Slots::all();
    // $plans = Plans::where('status',1)->where('user_id',$user)->get();
    $plans = Plans::with('slots')->where('user_id',$user)->get();
    return view('backend.profile.edit-appointment',compact('user','plans','days','slots'));
}


// public function update(Request $request,  $appointment)
// {
//     $user_id = Auth::user()->id;
//     $mon_slots_ids = $request->mon_slots_ids;
//     $tue_slots_ids = $request->tue_slots_ids;
//     $wed_slots_ids = $request->wed_slots_ids;
//     $thu_slots_ids = $request->thu_slots_ids;
//     $fri_slots_ids = $request->fri_slots_ids;
//     $sat_slots_ids = $request->sat_slots_ids;
//     $sun_slots_ids = $request->sun_slots_ids;

//     $days_array=array (
//         'mon_slots_ids'=>array(),
//         'tue_slots_ids'=>array(),
//         'wed_slots_ids'=>array(),
//         'thu_slots_ids'=>array(),
//         'fri_slots_ids'=>array(),
//         'sat_slots_ids'=>array(),
//         'sun_slots_ids'=>array(),
//     );

//     $data = $request->all();
//     $empty_array = array();
//     foreach($days_array as $k=>$v){
//         $empty_array[$k]=$v;
//         foreach($data as $dk=>$dv){
//             if($k = $dk){
//              $empty_array[$dk]=$dv;
//          }
//      }
//  }

//  if(count($data) !=0){
//     foreach($empty_array as $key=>$val){
//        $day_id = $this->day_fetch($key);
//        Plans::where('day',$day_id)->where('user_id',$user_id)->update(array('status'=>0));
//        foreach($val as $dayk=>$dayv){
//         $get_plan = Plans::where('day',$day_id)->where('slot',$dayv)->where('user_id',$user_id)->first();  

//         if(!empty($get_plan)){
//             $var = false;
//             $plans = Plans::where('day',$day_id)->where('user_id',$user_id)->get();
//             foreach($plans as $plan){
//                 if($plan->slot == $dayv){
//                     $var = true;
//                 }
//             }
//             if($var){
//                 Plans::where('day',$day_id)->where('slot',$dayv)->where('user_id',$user_id)->update(array('status'=>1));
//             }

//         }else{
//          $objModel = new Plans();
//          $objModel->user_id = $user_id;
//          $objModel->day = $day_id;
//          $objModel->status = 1;
//          $objModel->slot = $dayv;
//          $objModel->save();
//      }
//  }
//  break;
// }
// return "Appointment Schedule Updated Successfully";
// }
// return "no";
// }


public function destroy(Appointment $appointment)
{
        //
}
}
