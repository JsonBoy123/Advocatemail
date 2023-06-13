<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_City_View;
use App\Models\User_State_View;
use App\Models\UserProd;
use App\Models\WebsiteSummaryView;
use App\Models\UserQualification;
use App\Models\UserSpecialization;
use App\Models\UserCourt;
use Auth;
use App\Models\Contact;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function ment()
    {
        return "khcxj,vjdf";
    }
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = User::all();
         $users = User::select('name','ref_url','last_name','status','created_at')->where('id', Auth::user()->id)->first();
        // return $user->attachPermission('1');
        $userprod = UserProd::where('user_id',Auth::user()->id)->get();
        $websummary = WebsiteSummaryView::where('user_id',Auth::user()->id)->get();
        $specialization = UserSpecialization::where('user_id',Auth::user()->id)->first();
        if(empty($specialization)){$speciality = 'Pending';}else{$speciality = 'Completed';}
        $qualification = UserQualification::where('user_id',Auth::user()->id)->first();
        if(empty($qualification)){$quality = 'Pending';}else{$quality = 'Completed';}
        $practicecourt = UserCourt::where('user_id',Auth::user()->id)->first();
        if(empty($practicecourt)){$practice = 'Pending';}else{$practice = 'Completed';}
        return view('backend.home',compact('users','userprod','websummary','speciality','quality','practice'));
    }

    public function uploadImage(Request $request)
    {
        // dd($request->photo);
        $data = [];
        $id = Auth::user()->id;
        $user = User::find($id);
        if($request->hasfile('photo')) {
            $file = $request->file('photo');
            $filename = $id.'/image/'.time().'-'.$file->getClientOriginalName();
            $file->move('storage/app/public/'.$id.'/image',$filename);
            
        }
        // return $filename;
        DB::table('users')->where('id', $id)->update(['photo' => $filename]);
        
        return redirect()->back()->with('success','Image Update Succesfully.');
        
    }

    public function contactList(){
        $contacts  = Contact::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get(); 
        return view('backend.contact.index',compact('contacts'));
        
    }

    public function getCityListDropDown(Request $request)
    {    

      $data['cities'] = City::where("state_code",$request->state_code)->orderBy('city_name','ASC')->get();

      $data['cityCode'] = auth()->user()->city_code;

         // return  $data['cityCode'];
      return response()->json($data);

    }
}
