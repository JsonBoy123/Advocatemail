<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Domain;
use Session;
use Auth;
use App\Models\User;
use App\Models\UserQualification;
use App\Models\User_State_View;
use App\Models\User_City_View;
use App\Models\UserCourt;
use App\Models\CatgMast;
use App\Models\CourtMast;
use App\Models\City;
use App\Models\Booking;
use App\Models\Slots;
use App\Models\State;
use App\Models\Status;
use App\Models\Posts;
use App\Models\Review;
use App\Models\Rating;
use App\Models\Customer;
use App\Models\QualMast;
use App\Models\Contact;
use App\Helpers\Helpers;
use Carbon\Carbon;
use DB;
class FrontendController extends Controller
{
    public function __construct(){
      $court_id = 0;
      $speciality_code = 0;
      $this->query = Helpers::lawyerDetails($court_id,$speciality_code);
      $this->middleware('verify.template');
    }

    public function index(){
         $states = User_State_View::select(DB::raw('tot_user as state_count, user_state_view.state_name,user_state_view.state_code'))->orderBy('state_name')->get();
         
        return view('welcome',compact('states'));
    }

    public function getCityCount($state_code)
    { 
      \DB::statement("SET SQL_MODE=''");   
       $cities = User_City_View::select(DB::raw('tot_user as city_count,user_city_view.city_name,user_city_view.city_code'))->where('state_code',$state_code)->orderBy('city_name')->get();
      
      return response()->json($cities);
    }

    public function directory_show($state_name,$state_code,$city_code =null){
        if($city_code != null){
            $users = User::where('city_code',$city_code)->get();
            $page_name = 'search';
            $city_name = City::firstWhere('city_code',$city_code)->city_name;
            return view('pages.index',compact('page_name','users','city_name'));

        }else{
            $cities=  City::whereHas('users', function($q){
                $q->where('status','A');
            })->with(['users' => function($q){
                $q->where('status','A');
            }])->where('state_code',$state_code)->orderBy('city_name')->get();
            $s_name = State::firstWhere('state_code',$state_code)->state_name;
            $page_name = 'directory_show';
            return view('pages.index',compact('page_name','cities','s_name','state_name'));

        }
    }

    public function lawfirmsprofileShow($id){
      $customer = Customer::all();
      $courts = UserCourt::with('court_catg')->where('user_id',$id)->get();
      $reviews = Review::with('customers')->with('rates')->where('user_id',$id)->where('review_status','A')->paginate(5);

      $rating = Rating::all();
      
      $slots =Slots::all();
      $qualification = UserQualification::all();
      $date = array();
      $curr_date = Carbon::now()->addDays('-1');
      $day = array();
      $toDate = Carbon::now()->addDays('-1');

      for($i=0 ; $i<=6;$i++){
       $day[] = $toDate->addDays('+1')->format('D');
       $date[] = $curr_date->addDays('+1')->format('d-m-Y');
      }

      $days = array_combine($day, $date); //date to days wise indexing 
      // return $days;
      $user = User::find($id);
    if(!empty($user)){

      if($user->user_catg_id == '1'){
        $userData = $this->query->where('id',$id)->first();  
      }   
      else{
        $userData = Helpers::lawcompanyDetails()->where('id',$id)->first();
      }

      return view('template.pages.lawfirmsProfile', compact('customer','courts','userData','slots','reviews','rating','days','qualification'));
    }else{
       return view('error_pages.error_hide_page');
    }
    
  }

  public function writeReview(Request $request){
   
      $status = Status::all();
      $status_id = $status[3]->status_id;
      
      $user_id = $request->user_id;
      $guest_id = $request->guest_id;

      $review_text = $request->review_text;
      
      $review_status = $status_id;
      $review_date = date('Y-m-d');
      $review_rate = $request->review_rate;

      if ($review_rate != null) {
        $user_rate =  array('user_id'=>$user_id, 'guest_id'=>$guest_id,'rating'=>$review_rate,'rating_date'=>$review_date);

        DB::table('user_rating')->insert($user_rate);
      }

      if ($review_text != null) {
       $reviewData = array('user_id'=>$user_id, 'guest_id'=>$guest_id,'review_text'=>$review_text,'review_status'=>$review_status,'review_date'=>$review_date,'review_rate'=>$review_rate);

       DB::table('user_reviews')->insert($reviewData);
      }

       return "Your review is submitted for moderation";
  }

   public function search($city_name =null,$id1=null){
    // return 'bnnfnf';
     $citys = City::where('city_name',$city_name)->first();
     $searchfield = 'lawyer';
     $specialities = CatgMast::all();
     $courts = CourtMast::all();
     $states = State::all();
     $slots = Slots::all();
     $qualification = UserQualification::all();
     $lawyers = User::all();
     $gender = null;
     $name = '';
     $catg_code = null;
     $city_name = '0';
     $state_code = '0';
     $court_code = '0';
     $content = Helpers::search_content();

     $id = City::where('city_name',$city_name)->pluck('city_name');

     $cityzip = User::select(DB::Raw("CONCAT(city_name, '-',zip_code)"))->first();

     $name = str_replace('-','',$id);

      $date = array();
      $curr_date = Carbon::now()->addDays('-1');
      $day = array();
      $toDate = Carbon::now()->addDays('-1');

      for($i=0 ; $i<=6;$i++){
       $day[] = $toDate->addDays('+1')->format('D');
       $date[] = $curr_date->addDays('+1')->format('d-m-Y');
      }

      $days = array_combine($day, $date); //date to days wise indexing 
      // return $days;

      if(request()->all() != null){
        $searchfield = request()->searchfield !=null ? request()->searchfield : 'lawyer';
        $name = request()->user_name;
        $gender = request()->gender !='all' ? request()->gender : null;
        $court_code = request()->court_id;
      }

    if($searchfield =='lawyer'){
      if($id !=null){
          if($id !=null && $id1 !=null) {
            $catg_code = Helpers::catg_by_name($id);
            $city = Helpers::city_by_name($id1);
            if($catg_code ==null || empty($city)){
              return view('error_pages.error_hide_page');
            }
            $city_name = !empty($city) ? $city->city_name : '0';
            $state_code = !empty($city) ? $city->state_code : '0';
            $city_name = !empty($city) ? $city->city_name : '';
            $content = Helpers::search_content('specialization',$city_name,'',$catg_code);
          
            $lawyers = Helpers::lawyerDetails($court_id=0, $catg_code)->whereIn('id',spec_users_ids($catg_code))->where('users.city_name',$city_name);

          }else{

            $catg_code = Helpers::catg_by_name($id);  

            if($catg_code !=null){  
              $content = Helpers::search_content('specialization','','',$catg_code);
              $lawyers = Helpers::lawyerDetails($court_id=0, $catg_code)->whereIn('id',spec_users_ids($catg_code)); 


            }else{
               
               $city_name = !empty($citys) ? $citys->city_name : '0';
               $state_code = !empty($citys) ? $citys->state_code : '0';
               $city_name = !empty($citys) ? $citys->city_name : '';
                
               $content = Helpers::search_content('city',$city_name,Helpers::court_name_by_city($city_name));

               $lawyers = $this->query->where('users.city_name',$city_name);
                if(empty($citys)){
                return view('error_pages.error_hide_page');
              }              
            }


        }
      }else{
        $lawyers = $this->query;
      }

   
      if(request()->all() != null){

        if($name !=null){
          $lawyers =  $lawyers->where('name', 'like', '%' . request()->user_name . '%');
        }
        if($court_code !='0' && $court_code !=''){
            $lawyers = $lawyers->whereIn('id',court_usefrs_ids($city_name,$court_code));
        }
        if($gender !=null){
          $lawyers = $lawyers->where('gender',$gender);
        }     
      }
    }else{
        $lawyers = Helpers::lawcompanyDetails();
        $city = city_by_name($id);
        $city_name = !empty($city) ? $city->city_name : '0';
        $state_code = !empty($city) ? $city->state_code : '0';
        if($court_code !='0' && $court_code !=''){  
           $lawyers = Helpers::lawcompanyDetails($court_code,$city_name)->whereIn('id',court_users_ids($city_name,$court_code));
        }


        if($name != ''){
            $lawyers = $lawyers->where('name', 'LIKE', '%' .$name. '%');
        }
    } 

       $lawyers =  $lawyers->where('status','A')->simplePaginate(5);
      // return $lawyers;
      return view('template.pages.search',
        compact('searchfield','specialities','qualification','courts','states','lawyers','days','slots','name','catg_code','city_name','state_code','court_code','gender','content','cityzip')
      );

  }

  public function booking(){
        $id = Auth::user()->id;
        $user = User::with('city')->with('state')->where('id',$id)->first();
        $unbookings =  Booking::select('bookings.*','users.name','users.mobile','users.city_code','users.state_code','users.country_code','state_mast.state_name','city_mast.city_name')
        ->join('users','users.id','=','bookings.client_id')
        ->join('state_mast','state_mast.state_code','users.state_code')
        ->join('city_mast','city_mast.city_code','users.city_code')
        ->where('user_id',Auth::user()->id)
        ->where('client_status',1)
        ->where('user_status',0)
        ->get();

        // $unbookings =  Booking::with('users.city','users.state')->where('user_id',Auth::user()->id)
        // ->where('client_status',1)
        // ->where('user_status',0)
        // ->get();

        $skip_unbookings =  Booking::select('bookings.*','users.name','users.mobile','users.city_code','users.state_code','users.country_code','state_mast.state_name','city_mast.city_name')
        ->join('users','users.id','=','bookings.client_id')
        ->join('state_mast','state_mast.state_code','users.state_code')
        ->join('city_mast','city_mast.city_code','users.city_code')
        ->where('user_id',Auth::user()->id)
        ->where('client_status',1)
        ->where('user_status',0)
        ->whereDate('b_date','<>',date('Y-m-d'))
        ->get();

        $booked =  Booking::select('bookings.*','users.name','users.mobile','users.city_code','users.state_code','users.country_code','state_mast.state_name','city_mast.city_name')
        ->join('users','users.id','=','bookings.client_id')
        ->join('state_mast','state_mast.state_code','users.state_code')
        ->join('city_mast','city_mast.city_code','users.city_code')
        ->where('user_id',Auth::user()->id)
        ->where('client_status',1)
        ->where('user_status',1)
        ->get(); 

        $cancelled =  Booking::select('bookings.*','users.name','users.mobile','users.city_code','users.state_code','users.country_code','state_mast.state_name','city_mast.city_name')
        ->join('users','users.id','=','bookings.client_id')
        ->join('state_mast','state_mast.state_code','users.state_code')
        ->join('city_mast','city_mast.city_code','users.city_code')
        ->where('user_id',Auth::user()->id)
        ->where('client_status',0)
        ->where('user_status',0)
        ->get();

        $apply_bookings = Booking::select('bookings.*','users.name','slots.slot')->join('users','users.id','bookings.user_id')->join('slots','slots.id','bookings.plan_id')->where('client_id',Auth::user()->id)->get();

        $slots = Slots::all();
        return view('backend.profile.booking',compact('user','unbookings','slots','booked', 'cancelled','apply_bookings','skip_unbookings'));
    }
  
    public function profile_show($id){
        $page_name = 'profile_show';
        $user = User::find($id);
        return view('pages.index',compact('page_name','user'));
    }

    public function get_cities($id){
        $cities = City::where('state_code',$id)->orderBy('city_name')->get();
        return $cities;
    }
    public function get_qual($id){
        return QualMast::where('qual_catg_code',$id)->get();
    } 
    public function get_role_catgs($id){
        if($id == '3'){
            $catg_type = 2;
        }else{
            $catg_type = 1;
        }
        return  CatgMast::select('catg_id','catg_name')->where(['is_post' => '1', 'catg_type' => $catg_type])->orderBy('catg_order')->get();
    }

   
    public function post_show($catg_id,$url){
        $posts = Posts::where(['catg_id' => session('catg_id'),'status' => '1','user_id'=>session('user_id')])->get();
        $post = Posts::firstWhere(['sefriendly' => $url]);
        $page_name = $catg_id;
        return view('pages.post_detail',compact('post','posts','page_name'));
    }

    public function page_show($page_name){
        $posts = Posts::where(['catg_id' => session('catg_id'),'status' => '1','user_id'=>session('user_id')])->get();
        $page = collect(Session::get('catgs'))->firstWhere('catg_url',$page_name);
        
        return view('pages.index',compact('posts','page_name','page'));
    }
    public function contactStore(Request $request){
        
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'mobile'    => 'required|min:10|max:10',
            'subject_id'   => 'required|not_in:0',
            'message'   => 'required',
            'captcha'   => 'required|captcha',
        ],
        [
            'captcha.captcha'=>'Invalid captcha code.'
        ]);

        $data = [
            'name' => $request->name,
            'user_id' => session('user_id'),
            'email' => $request->email,
            'mobile' => $request->mobile,
            'subject' => $request->subject_id,
            'message' => $request->message,
        ];
        Contact::create($data);
        return redirect()->back()->with(['success'=>'Thank You! For Contact Us. We Will Contact You Soon...']);
    }
    public function refreshCaptcha() {  
        return captcha_img('flat');
    }
}
