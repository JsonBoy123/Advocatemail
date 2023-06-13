<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Template;

class DomainController extends Controller
{
    public function index(){
        $users  = User::where(['status' => 'A', 'role_id' => '3'])->whereNotNull('domain_url')->get();
    	return view('backend.domain.index',compact('users'));
    }
    public function assigne(){
    	$users  = User::where(['status' => 'A', 'role_id' => '3'])->whereNull('domain_url')->get();
    	$templates = Template::whereNotIn('template_id',['1'])->get();
    	return view('backend.domain.assigne',compact('users','templates'));
    }
    public function assigne_store(Request $request){
        // return $request->all();
       $data =  $request->validate([
           'user_id'            =>'required',
           'domain_name'        => 'required|unique:users,domain_name,'.$request->user_id,
           'site_name'          => 'required',
           'template_id'        => 'required|not_in:0',
           'sef_title'          => 'nullable|max:100',
           'sef_description'    => 'nullable|max:300',
           'sef_keyword'        => 'nullable|max:300',
           'sef_imagealt'       => 'nullable|max:200'
           
        ]);
        
        $data = [
           'domain_name'        => $request->domain_name,
           'domain_url'         => $request->domain_name.'.advocatemail.com',
           'site_name'          => $request->site_name,
           'template_id'        => $request->template_id,
           'sef_title'          => $request->sef_title,
           'sef_description'    => $request->sef_description,
           'sef_keyword'        => $request->sef_keyword,
           'sef_imagealt'       => $request->sef_imagealt
        ];
        if($request->hasFile('site_logo')){
            
            $data['site_logo'] = file_upload($request->site_logo,$request->user_id.'/image');
        }
        $user = User::find($request->user_id);
        $user->update($data);
        $user->attachPermission('1');
        // return $data;
        return redirect()->route('domain.index')->with('success','Domain Assigne successfully');
    }
    public function domainCheck(Request $request){
        
        $user = User::where('domain_name',$request->domain_name)->where('id','!=',$request->user_id)->first();
       
        if(!empty($user)){
            return 'false';
        }else{
            return 'true';
        }
    }
    
}
