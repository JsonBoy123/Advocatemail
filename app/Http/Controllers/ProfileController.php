<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Crypt;
use App\Models\State;
use App\Models\Review;
use App\Models\ReviewBackup;
use App\Models\Specialization;
use App\Models\UserSpecialization;
use App\Models\UserQualification;
use App\Models\QualCatgMast;
use App\Models\QualMast;
use App\Models\CourtMast;
use App\Models\CourtTypeMast;
use App\Models\UserCourt;

class ProfileController extends Controller
{
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
        $user = User::find(Auth::user()->id);
        
        return view('backend.profile.index',compact('user'));
    }
    public function edit()
    {
    	$states  = State::orderBy('state_name')->cursor();
    	$user = User::find(Auth::user()->id);
        return view('backend.profile.edit',compact('user','states'));
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
       return redirect()->route('profile.index')->with('success','Profile Updated Successfully.');
    }
    public function specialization(){
        $user_specializations = UserSpecialization::with('speci')->where('user_id',Auth::user()->id)->get();
        $spec_id = collect($user_specializations)->pluck('spec_code');
        $specs = Specialization::all();
        return view('backend.profile.specialization',compact('specs','user_specializations'));
    }
    public function specialization_store(Request $request){
        $user  =User::find(Auth::user()->id);
        $user->specializations()->sync($request->specc_code);
        return $request->all();
    }
    
    public function practicing_court(){
		$states = State::where('country_code',102)->get();
		$courts = UserCourt::with('court_catg')->where('user_id',Auth::user()->id)->get();
		return view('backend.profile.practicing_court',compact('states','courts'));
	}

    public function practicing_court_store(Request $request){
		$user_id 	= Auth::user()->id;
		$court 		= $request->court;
		$user 		= User::find($user_id);
		$user->courts()->sync($court);    
		return 'Practicing courts updated successfully';
	}
    
    public function qualification(){
        $qual_catgs = QualCatgMast::orderBy('qual_catg_code')->get();
        $qualifications  = UserQualification::where('user_id',Auth::user()->id)->cursor();
        return view('backend.profile.qualification',compact('qualifications','qual_catgs'));  
    }

    public function qualification_store(Request $request){
      $data =   $request->validate([
            'qual_catg_code'    => 'required|not_in:0',
            'qual_code'         => 'required|not_in:0',
            'pass_year'         => 'required|digits:4|integer|min:1900|max:'.(date('Y')).'',
            'pass_perc'         => 'required|max:6|regex:/^\d{0,6}(\.\d{1,2})?$/',
            'pass_division'     => 'required|not_in:0' 
        ],
        [   
            'qual_catg_code.*'   => 'The selected course type is invalid.',
            'qual_code.required' => 'The selected course name is invalid.',
            'qual_code.not_in:0' => 'The course name field is required.',
            'pass_year.required' => 'The passing year field is required.',
            'pass_year.digits'   => 'The passing year must be 4 digits.',
            'pass_year.regex'    => 'The passing year format is invalid.',
            'pass_perc.required' => 'The passing percentage field is required.',
            'pass_perc.regex'    => 'The passing percentage format is invalid.',
            'pass_division.*'    => 'The selected passing division is invalid.'
        ]);

        $qual_catg = QualCatgMast::find($data['qual_catg_code']);
        $qual = QualMast::find($data['qual_code']);

        $data['qual_catg_desc'] = $qual_catg->qual_catg_desc;
        $data['qual_desc'] = $qual->qual_desc;

        $user_qual = UserQualification::where('qual_catg_code',$data['qual_catg_code'])->where('qual_code',$data['qual_code'])
                                  ->where('pass_year',$data['pass_year'])
                                  ->where('user_id',Auth::user()->id)
                                  ->get();

        $data['user_id'] = Auth::user()->id;    

        if(count($user_qual) ==0){
            UserQualification::create($data);           
            return redirect()->route('qualification')->with('success','Qualification updated successfully');
        }
        else{
            return redirect()->route('qualification')->with('warning','Already inserted');
        }
    }

    public function qualification_edit($id)
    {
        $user = User::find(Auth::user()->id);
        $qualification  = UserQualification::find($id);
        return view('backend.profile.qualification-edit',compact('user','qualification'));
    }

    public function qualification_update(Request $request,$id){
        // return $request;
      $data = $request->validate([
            'qual_catg_desc'    => 'required|not_in:0',
            'qual_desc'         => 'required|not_in:0',
            'pass_year'         => 'required|digits:4|integer|min:1900|max:'.(date('Y')).'',
            'pass_perc'         => 'required|max:6|regex:/^\d{0,6}(\.\d{1,2})?$/',
            'pass_division'     => 'required|not_in:0' 
        ]);
        UserQualification::find($id)->update($data);
        return redirect()->route('qualification')->with('success','Qualification updated successfully');
    }
    
    public function state_court($state_code){
        $courts = CourtMast::where('state_code',$state_code)->get();        
            
        $court_type = array();
        foreach ($courts as $court) {
            $court_type [] = $court->court_type;
        }
        $court_types = array();
            
        if(!empty($court_type)){
            $court_types =   CourtTypeMast::whereIn('court_type',$court_type)->get();
        }
            // return $court_types;
        return response()->json($court_types);
    }
    public function user_court_list($court_type,$state_code){
		$courts_code = UserCourt::select('court_code')->where('user_id', Auth::user()->id)->get();
		$mast_courts = CourtMast::whereNotIn('court_code', $courts_code->toArray())->where('court_type',$court_type)->where('state_code',$state_code)->get();

		return response()->json($mast_courts);
	}

    // Review
    public function review_status(){
        $id = Auth::user()->id; 
      $reviews = Review::with('customers')->where('user_id',$id)->get();
        return view("backend.profile.review_status",compact('reviews'));
    }

    public function changeStatus(Request $request){ 
        if($request->review_status == 'P'){ 
            Review::with('customers')->where('review_id',$request->review_id)->update(['review_status' => 'P']);
        }else{
         Review::with('customers')->where('review_id',$request->review_id)->update(['review_status' => 'A']);
        }
        return response()->json('Review Status change successfully');
   }

    
      public function review_delete($id){
         $reviews = Review::with('customers')->where('review_id',$id);
         $reviews->delete(); 
        return redirect('/review_status');
    }

    // Password-Change
    public function password_change()
    {
        $id = Auth::user()->id;
        $user = User::with('city')->with('state')->where('id',$id)->first();
        return view("backend.profile.password_change",compact('user'));
    }

    public function changePassword(Request $request)
    {
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
