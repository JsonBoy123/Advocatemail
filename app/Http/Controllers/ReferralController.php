<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Models\Referral;
use App\Models\State;
use App\Models\City;
use App\Mail\SendMail;


class ReferralController extends Controller
{
    public function index(){
    	$id = Auth::user()->id;
        $user = User::with('city')->with('state')->where('id',$id)->first();
        $referrals = Referral::with(['state','city'])->where('referral_code',$user->referal_code)->get();
        $referrals_count = $referrals->count();
    	return view('backend.profile.refer-index',compact('user','referrals','referrals_count'));
    }
    public function create(){
        $id = Auth::user()->id;
        $user = User::with('city')->with('state')->where('id',$id)->first();
    	$states = State::all();
        $citys = City::all();
    	return view('backend.profile.referral-create',compact('states','user','citys'));
    }
    public function store(Request $request){
        $id = Auth::user()->id;
        $city_code =  $request->city_code;

    	$data = $request->validate([
    		'name' => 'required|min:3|max:255',
    		'email' => ['required', 'string', 'email', 'max:255', 'unique:referrals,email'],
            'mobile' => 'required',
    		'state_code' => 'required|not_in:0',
    		'city_code' =>  'required|not_in:0',
    	]);

        $datas = new Referral;
        $datas->name = $data['name'];
        $datas->email = $data['email'];
        $datas->mobile = $data['mobile'];
        $datas->state_code = $data['state_code'];
        $datas->city_code = $data['city_code'];
    
        $resever = $request->email;

        $referal_code = Auth::user()->referal_code;
        $name = Auth::user()->name;
        $ref_url = Auth::user()->ref_url;

        \Mail::to($resever)->send(new SendMail($referal_code,$name,$ref_url));

        $datas->save();

    	return redirect()->route('referral.index')->with('success','Referral Mail Send Successfully');
    }
    public function edit($id){
        $id = Auth::user()->id;
        $user = User::with('city')->with('state')->where('id',$id)->first();
    	$states = State::all();
    	$referral  = Referral::find($id);
    	return view('backend.profile.referral-edit',compact('user','referral','states'));
    }
    public function update(Request $request,$id){
    	$data = $request->validate([
    		'name' => 'required|min:3|max:255',
    		'email' => ['required', 'string', 'email', 'max:255', 'unique:referrals,email'],
            'mobile' => 'required',
    		'state_code' => 'required|not_in:0',
    		'city_code' =>  'required|not_in:0',
    	]);

    	$data['referral_code'] = str_pad($request->city_code, (7 - strlen($request->city_code)) + strlen($request->city_code) , '0', STR_PAD_LEFT).$id;
    	
    	Referral::find($id)->update($data);
    	return redirect()->route('referral.index')->with('success','Referral User Updated Successfully');
    }
    public function delete($id)
	{
		Referral::findOrFail($id)->delete();
		return back()->with('warning','Referral User Deleted Successfully');
	}
}
