<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users = User::where('role_id','3')->orderBy('created_at','desc')->cursor();
        return view('backend.user.index',compact('users'));   
    }
    public function create(){
        $states  = State::orderBy('state_name')->cursor();
        return view('backend.user.create',compact('states'));   
        
    }
    public function store(Request $request){
        
        $data = $request->validate([
    		'name' 		    => 'required',
    		'mobile' 		=> 'required',
    		'email' 		=> 'required',
    		'password' 		=> 'required|min:5',
    		'licence_no' 	=> 'nullable',
    		'gender' 	    => 'required',
    		'dob' 		    => 'nullable',
    		'aadhar_card' 	=> 'nullable',
    		'pan_card' 		=> 'nullable',
    		'addr1' 	    => 'required',
    		'addr2' 	    => 'nullable',
    		'country_code' 	=> 'required',
    		'state_code' 	=> 'required|not_in:"0"',
    		'city_code' 	=> 'required',
    		'zip_code' 		=> 'nullable',
    		'detl_profile' 	=> 'nullable'
    	]);
    	
    	$data['password'] = Hash::make($request->password);
    	$data['role_id'] = '3';
    	$data['status']  = 'A';
        $user_id = User::latest()->first()->id + 1;
        
        if($request->hasFile('photo')){
            $data['photo'] = file_upload($request->photo,$user_id.'/image');
        }
        $user = User::create($data);
        $user->attachRole('3');
        return redirect()->route('user.index')->with('success','User created Successfully');
    }
    
    public function edit($id){
        $user  = User::find($id);
        $states  = State::orderBy('state_name')->cursor();
        return view('backend.user.edit',compact('states','user'));   
        
    }
    public function update(Request $request,$id){
         $data = $request->validate([
    		'name' 		    => 'required',
    		'mobile' 		=> 'required',
    		'email' 		=> 'required',
    		'licence_no' 	=> 'nullable',
    		'gender' 	    => 'required',
    		'dob' 		    => 'nullable',
    		'aadhar_card' 	=> 'nullable',
    		'pan_card' 		=> 'nullable',
    		'addr1' 	    => 'required',
    		'addr2' 	    => 'nullable',
    		'country_code' 	=> 'required',
    		'state_code' 	=> 'required|not_in:"0"',
    		'city_code' 	=> 'required',
    		'zip_code' 		=> 'nullable',
    		'detl_profile' 	=> 'nullable'
    	]);
    	
       
        $user = User::find($id);
        if($request->hasFile('photo')){
            $data['photo'] = file_upload($request->photo,$id.'/image',$user,'photo');
        }
        $user->update($data);
        return redirect()->route('user.index')->with('success','User updated Successfully');
        
    }
    public function delete($id){
       User::find($id)->delete();
       return redirect()->back()->with('success','User deleted Successfully');
    }
    public function userApproval($id){
    	$user = User::find($id);
    	if($user->status == 'P'){
    		$status = 'A';
    		$message = 'User Approved Successfully';
    	}else{
    		$status = 'P';
    		$message = 'User UnApproved Successfully';
    	}
    	$user->update(['status' => $status]);
    	return [
    		'status' => 'success',
    		'message' => $message
    	];

    }
}
