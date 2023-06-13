<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use App\Models\User_City_View;
use App\Models\User_State_View;
use App\Models\UserProd;
use App\Models\WebsiteSummaryView;
use App\Models\UserQualification;
use App\Models\UserSpecialization;
use App\Models\UserCourt;
use App\Models\MessageTalk;
use App\Models\Booking;
use Auth;
use App\Models\Contact;
use DB;
class GuestController extends Controller
{

    public function index()
    {
     $users = User::select('name','ref_url','last_name','status','created_at')->where('id', Auth::user()->id)->first();
     $userprod = UserProd::where('user_id',Auth::user()->id)->get();
     $websummary = WebsiteSummaryView::where('user_id',Auth::user()->id)->get();
     $specialization = UserSpecialization::where('user_id',Auth::user()->id)->first();
     if(empty($specialization)){$speciality = 'Pending';}else{$speciality = 'Completed';}
     $qualification = UserQualification::where('user_id',Auth::user()->id)->first();
     if(empty($qualification)){$quality = 'Pending';}else{$quality = 'Completed';}
     $practicecourt = UserCourt::where('user_id',Auth::user()->id)->first();
     if(empty($practicecourt)){$practice = 'Pending';}else{$practice = 'Completed';}
     return view('backend.guest.home',compact('users','userprod','websummary','speciality','quality','practice'));
 }

 public function profile()
 {
    $user = User::find(Auth::user()->id);

    return view('backend.guest.profile',compact('user'));
}

public function profile_edit()
{
    $states  = State::orderBy('state_name')->cursor();
    $user = User::find(Auth::user()->id);
    return view('backend.guest.edit',compact('user','states'));
}

public function update(Request $request,$id)
{
 $user = User::find($id);
 $user->name = $request->input('name');
 $user->mobile = $request->input('mobile');
 $user->licence_no = $request->input('licence_no');
 $user->gender = $request->input('gender');
 $user->dob = $request->input('dob');
 $user->aadhar_card = $request->input('aadhar_card');
 $user->pan_card = $request->input('pan_card');
 $user->addr1 = $request->input('addr1');
 $user->addr2 = $request->input('addr2');
 $user->country_code = $request->input('country_code');
 $user->state_code = $request->input('state_code');
 $user->city_code = $request->input('city_code');
 $user->zip_code = $request->input('zip_code');
 $user->detl_profile = $request->input('detl_profile');
 $user->update();
 return redirect()->route('g_profile')->with('success','Profile Updated Successfully.');
}

public function appointment(){
    $id = Auth::user()->id;
    $user = User::with('city')->with('state')->where('id',$id)->first();
    $bookings = Booking::select('bookings.*','users.name','slots.slot')->join('users','users.id','bookings.user_id')->join('slots','slots.id','bookings.plan_id')->where('client_id',Auth::user()->id)->get();
    return view("backend.guest.guest-appointment",compact('user','bookings'));
}

public function unread(){
  $noti = MessageTalk::where('recv_id',Auth::user()->id)->where('status',0)->get();
  $unread = count($noti);
  return  $unread;
}

public function g_message(){
 $id = Auth::user()->id;
 $user = User::with('city')->with('state')->where('id',$id)->first();
 $messages = MessageTalk::select('msg_talks.*','users.name')->join('users','users.id','=','msg_talks.sender_id')->where('recv_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
 $unread = $this->unread();          
 return view('backend.guest.inbox', compact('user','unread','messages'));
}
public function create(Request $request){
    $id = Auth::user()->id;
    $user = User::with('city')->with('state')->where('id',$id)->first();
    $lawyer_id =  $request->id;
    $lawyer_details = User::find($lawyer_id);

    $unread = $this->unread();
    return view('backend.guest.compose',compact('unread','lawyer_details','user'));
}
public function store(Request $request){
    $data = $request->validate([
        'subject'   => 'required|string|max:50',
        'message'   => 'required|string|max:255',
        'sender_id' => 'required',
        'recv_id'   => 'required',
        'status'    => 'required'  
    ]);

    MessageTalk::create($data);

    return redirect()->route('g_message_sent');
}
public function show($id){
    $message = MessageTalk::select('msg_talks.*','users.name',
        'users.photo')->join('users','users.id','=','msg_talks.sender_id')->find($id);

    MessageTalk::where('id',$id)->update(['status'=>1]);

    $unread = $this->unread();
    return view('backend.guest.message',compact('unread','message'));
}
public function g_message_reply(Request $request){
    $data = $request->validate([
        'sender_id' => 'required',
        'recv_id'   => 'required',
        'parent_id' => 'required',
        'subject'   => 'required',
        'message'   => 'required',
        'status'    => 'required'
    ]);
    MessageTalk::create($data);
    return redirect()->back()->with('success','message sent');
}


public function g_message_sent(){

    $messages = MessageTalk::select('msg_talks.*','users.name')->join('users','users.id','=','msg_talks.recv_id')->where('sender_id',Auth::user()->id)->orderBy('id', 'DESC')->get();

    $unread = $this->unread();
    return view('backend.guest.sent', compact('unread','messages'));
}

public function g_message_delete(Request $request)
{
    $id = $request->id;
    MessageTalk::whereIn('id',explode(",",$id))->delete();
    return response()->json(['status'=>true,'message'=>"Message permanently deleted successfully"]);
}

public function g_password(){
    $id = Auth::user()->id;
    $user = User::with('city')->with('state')->where('id',$id)->first();
    return view("backend.guest.guest-password",compact('user'));
}

public function changePassword(Request $request){
    $request->validate([
        'new_password' => 'min:8|required_with:confirm_password|same:confirm_password',
        'confirm_password' => 'min:8'
    ]);

    $user = User::find(auth()->user()->id);

    if(Hash::check($request->old_password, $user->password)) {
        $user->password = bcrypt($request->new_password);
        $user->pwd = Crypt::encrypt($request->new_password);
        $user->save();

        $status = 'Password Updated!';
        return redirect()->back()->with('success',$status);
    } else {
        $class = 'alert alert-danger';
        $status = 'Old password incorrect!';
        return redirect()->back()->with('warning',$status);
    }
}

}    
