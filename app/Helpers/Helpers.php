<?php 
namespace App\Helpers;

use Auth;
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
class Helpers 
{
	public static function deletedClients(){
		$id = Auth::user()->id;
		$client_datas  = Customer::onlyTrashed()->where('user_id',$id)->get();
		$client_ids = array();

		foreach($client_datas as $client_data){
			$client_ids[] = $client_data->cust_id;
		}
		return $client_ids;
	}

	// if(!function_exists('user_clients')){
	//   function user_clients($status = 'A'){
	//       $client_ids = Helpers::deletedClients();       
	//       $clients = Customer::where('user_id',Auth::user()->id)
	//         ->whereNotIn('cust_id',$client_ids)
	//         ->where('status_id', $status);             
	//       return $clients;
	//   }
	// }
	public static function user_clients($status = 'A'){
	      $client_ids = Helpers::deletedClients();       
	      $clients = Customer::where('user_id',Auth::user()->id)
	        ->whereNotIn('cust_id',$client_ids)
	        ->where('status_id', $status)->get();             
	      return $clients;
	  }
	
	public static function bytesToHuman($bytes)
	{
	  $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

		for ($i = 0; $bytes > 1024; $i++) {
			$bytes /= 1024;
		}

		return round($bytes, 2) ;
	}


  public static function userqual($id)
	{
		// $id = Auth::user()->id;
		 return $userQual = UserQualification::where('user_id',$id)->pluck('qual_desc')->first();  
	}





	public static  function lawyerDetails($court_id , $speciality_code, $city_code = null){
		  return $query = User::with(['reviews'=>function ($query) {
			$query->where('review_status','A');
		}])->with('city', 'state','slots')			        
		->whereIn('status',['A','D'])
		->where('user_catg_id',1)
		->whereNull('parent_id');

		if($court_id !=null){
			$courts_code = CourtMastHeader::select('court_code')->where('court_type',$court_id)->where('city_code',$city_code)->get();
		}

		if($court_id != 0 && $speciality_code !=0){
			
			$result = $query->with(['specialities'=>function($query) use($speciality_code){
				$query->with('specialization_catgs')->where('user_specialization.catg_code',$speciality_code);
			}])->with(['user_courts'=>function($query) use($courts_code){
				$query->with('court_catg')->whereIn('user_courts.court_code',$courts_code->toArray());
			}]);
		}
		else if ($court_id !=0) {
			$result = $query->with(['specialities'=>function($query){
				$query->with('specialization_catgs');
			}])->with(['user_courts'=>function($query) use($courts_code){
				$query->with('court_catg')->whereIn('user_courts.court_code',$courts_code->toArray());
			}]);
		}
		else if($speciality_code !=0){
			$result = $query->with(['specialities'=>function($query) use($speciality_code){
				$query->with('specialization_catgs')->where('user_specialization.catg_code',$speciality_code);
			}])->with('user_courts.court_catg');
		}
		else{
			$result = $query->with(['specialities'=>function($query){
				$query->with('specialization_catgs');
			}])->with(['user_courts'=>function($query){
				$query->with('court_catg');
			}]);
		}


		return $result;
	}
	
	public static function lawcompanyDetails($court_id = null,$city_code = null){
		$query = User::with(['reviews'=>function ($query) {
			$query->where('review_status','A');
		}])
		->with('city', 'state')			        
		->where('status','A')
		->where('user_catg_id',3);

		if($court_id !=null){
			$courts_code = CourtMastHeader::select('court_code')->where('court_type',$court_id)->where('city_code',$city_code)->get();
		}	        

		if($court_id == null){
			$result = $query->with(['user_courts'=>function($query){
				$query->with('court_catg');
			}]);
		}else{
			$result = $query->with(['user_courts'=>function($query) use($courts_code){
				$query->with('court_catg')->whereIn('user_courts.court_code',$courts_code->toArray());
			}]);
		}

		return $result;
	}
	public static function lawschools(){
		$query = User::with(['reviews'=>function ($query) {
			$query->where('review_status','A');
		}])->with('city', 'state')
		->where('user_catg_id',4)
		->where('status','A');
		return $query;
	}


	public static function valid_email($email) {
		return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
	}
	
	public static function isIfscCodeValid($ifsc_code){
		return (!preg_match("/^[A-Za-z]{4}0[A-Z0-9]{6}$/", $ifsc_code)) ? FALSE : TRUE;
	}
	public static function cases($del_client){
		$query = CaseMast::with('casetype','client')                 
		->whereNotIn('cust_id',$del_client);

		return $query;
	}	
	public static function user_all_todos(){
		$query = Todo::with(['created_user' => function($query){
			$query->select('id','name');
		},'todos_comments'])->with(['assigned_user' => function($query){
			$query->select('id','name');
		}])->with(['relate_to_case'=>function($query){
			$query->select('case_id','case_title');
		}]);
		return $query;
	}

	public static function filter_student($students, $status){
		return collect($students)->filter(function($e) use($status){
			return $e['status'] == $status;
		});
	}
    public static function get_all_users($id){ //parent_id_null
    	$user = User::find($id);
    	$users = User::where('parent_id',$id)->orderBy('name', 'asc');
    	if($user->user_catg_id == '4'){
    		$users = $users->where('user_catg_id','6');
    	}
    	else if($user->user_catg_id == '3' || $user->user_catg_id == '2'){
    		$users = $users->where('user_catg_id','2');

    	}else{
    		$users = $users->where('user_catg_id','5');
    	}
    	return $users;
    } 

    public static function user_package_check(){
    	$moduleShow = false;
    	$package_id = User::where('user_package_id');
    	$beforeDate = '';
    	$packageModules = array();
    	if($package_id != '' ){
    		$today = date('Y-m-d');
    		$package_end = User::where('package_end');
    		$beforeDate = date('Y-m-d', strtotime(User::find('package_end').'-16 days'));
    		$end_date = date('Y-m-d',strtotime(User::find('package_end')));
	        // $pak_id = UserPackage::where('id',$package_id)->pluck('package_id');
    		$packageModules = PackageModule::where('package_id')->pluck('module_id')->toArray();
    		if(strtotime($today) <= strtotime($end_date)){
    			$moduleShow = true;
    		}
    	}

    	return ['moduleShow' => $moduleShow, 'beforeDate' => $beforeDate, 'packageModules' => $packageModules];
    }

    public static function date_diff($package_end){

    	$package_end = new Carbon($package_end);
    	$now = Carbon::now();

    	$difference = ($package_end->diff($now)->days <= 0)
    	? 'Today'
    	: $package_end->diffForHumans($now);

    	$str_arr =array();
    	if($difference != 'Today'){
    		$str_arr = explode(" ",$difference);
    	}   

    	return ['difference' => $difference, 'str_arr' => $str_arr];

    }
    public static function package_end_date($package){
    	$start_date = Carbon::now();
    	if($package->duration_type == 'day'){
    		$end_date = $start_date->addDays($package->duration);
    	}elseif($package->duration_type == 'month'){
    		$end_date = $start_date->addMonths($package->duration);

    	}elseif($package->duration_type == 'year'){
    		$end_date = $start_date->addYears($package->duration);
    	}
    	return $end_date->format('Y-m-d');
    }
    public static function student_fetch(){

    }
    public static function academic_dates($month,$year,$weekendDays = ['Sunday']){

    	$calendarData = AcademicCalendarMast::whereYear('date_from',$year)
    	->whereMonth('date_from',$month)
    	->whereYear('date_upto',$year)
    	->whereMonth('date_upto',$month)
    	->where('user_id', Auth::user()->id)
    	->get();

    	$academic_dates = array();
    	foreach ($calendarData as $key => $value) {
    		for($date = $value->date_from->copy() ; $date->lte($value->date_upto); $date->addDay()){
    			if(!in_array($date->dayName, $weekendDays)){
    				$symbol = 'H';
    				if($value->is_exam == '1'){
    					$symbol = 'E';
    				}
    				$academic_dates[$date->format('Y-m-d')]= $symbol;
    			}
    		}
    	}
    	return $academic_dates;
    }

    public static function month_dates($monthStart,$monthEnd,$weekendDays = ['Sunday']){
    	$monthDates = array();
    	for($date =$monthStart; $date->lte($monthEnd) ; $date->addDay() ){
    		$weekend = 0;
    		if(in_array($date->dayName, $weekendDays)){
    			$weekend = 1;
    		}
    		$monthDates[$date->format('Y-m-d')] = [
    			'day' =>  intval($date->format('d')),
    			'weekend' => $weekend
    		];
    	}	
    	return $monthDates;
    }

    public static function date_convert($date){
    	$year = date('Y',strtotime($date));
    }

    public static function city_by_name($id)
  	{
    $name = str_replace('-','',$id);
    $city = City::all()->filter(function($city) use($name){
      return strtolower(str_replace(' ','',trim($city->city_name))) == $name;
    })->first();
    return $city;
  	}

	public static function catg_by_name($id)
	{
	    $name = str_replace('-','',$id);
	    $catg =  CatgMast::all()->filter(function($catg) use($name){
	     return strtolower(str_replace('&','',str_replace(' ','',trim($catg->catg_desc)))) == $name;
	    })->first();
	    return !empty($catg) ? $catg->catg_code : null;

	}


 	public static function court_name_by_city($city_code)
  	{
	   $courts_types = CourtMastHeader::select('court_name')->where('city_code', $city_code)->orderBy('court_name')->get();
	   $court_name = '';
	   foreach ($courts_types as $key => $value) {
	     $court_name .= $value->court_name.', ';
	   }
	   return substr($court_name,0,strlen($court_name)-2);
	}

  public static function search_content($condition = 'main',$city_name=null,$court_name=null,$catg_code = null){  
  if($condition =='main'){
    $content['title'] = 'Best Lawyers for Consulting | Top 10 Criminal Lawyers | Lawyers Association India';
    $content['description'] = 'Get best lawyers for consulting, whether you are finding criminal lawyers, family lawyers, corporate lawyers for free law advice, legal answer or any Law Association in India.';
    $content['keywords'] = 'lawyers association India, top 100 lawyers in India, top 10 criminal lawyers in India, top 50 lawyers in India, best lawyers for consulting, free Legal advice, legal advice, consult with best lawyer, legal help, legal issues, law questions, law advice, ask a lawyer, legal question, law answers, free law advice, legal answers, law advisers, free legal help';
    $content['content'] = '<h1 class="text-captialize mb-3">Consult Best Lawyer / Law Firms in India</h1>
      <p class="p-text">
          Seeing the demand of various Legal problems we allow you to hire the professional experts having good experience in Civil Law, Corporate Law, Start-up Solutions, Criminal Law, Consumer Law, Family Law and much more in all over India.
      <br><br>
      We help you to consult with the well experienced team of lawyers, researchers & experts carry daily research on all latest current & new law, judgments & Court decisions and allows to hire the best lawyers in India for District Courts, High Court & Supreme Court matters. Our services includes to provide the best legal advisor for legal consultancy services, taxation services, corporate legal services, recovery solutions, financial legal services, bad debt recovery solutions, back office operation services, data entry service, documentation services, passport related services, fiscal documentation etc.</p>';
    }elseif($condition == 'specialization'){
      $catg =  CatgMast::where('catg_code',$catg_code)->first();
      if(!empty($catg)){
        $catg_name = ucwords(str_replace('Law','',$catg->catg_desc));
        $description =  $city_name !=null ? str_replace('$city_name', 'in '.$city_name, $catg->description) : str_replace('$city_name','in India', $catg->description);
      }else{
        $catg_name = '';
        $description = '';
      }
     
      $city = $city_name !=null ? $city_name : 'India';
      $content['title'] = "".$catg_name."Lawyers/Advocate, Attorneys in ".$city." | Top 10 ".$catg_name."Lawyers in ".$city." | ".$catg_name."Legal Advisor - Adlaw";
      $content['description'] = "Find best ".$catg_name."Lawyers/Advocate, Attorneys in ".$city.". Get Legal consultation by top rated district court ".$catg_name."lawyers for your all type of legal matters.";
      $content['keywords'] = "".$catg_name."lawyers, ".$catg_name."lawyers in ".$city.", best ".$catg_name."lawyers in ".$city.", top ".$catg_name."lawyers, Indian".$catg_name."advocate, ".$catg_name."advocates in ".$city.", list of ".$catg_name."lawyers in ".$city.", list of ".$catg_name."advocate in ".$city.", district court ".$catg_name."lawyer, district court ".$catg_name."advocate, ".$catg_name."Legal Advisor in ".$city.", high court ".$catg_name."lawyer, high court ".$catg_name."advocate, female ".$catg_name."lawyer in ".$city."";
      $content['content'] = $description ; 

    }elseif($condition == 'city'){
      $content['title'] = "Lawyers/Advocate, Attorneys in ".$city_name." | Top 10 Lawyers in ".$city_name." |  ".$city_name." High Court Lawyer";
      $content['description'] = "Find best lawyers/ advocates, Attorneys in ".$city_name .". Get Legal consultation by ".$city_name ." top rated high court lawyers for your all type of legal matters";
      $content['keywords'] = "Lawyers in ".$city_name .", Advocate in ".$city_name .", Top 10 Lawyers in ".$city_name .", Top 100 Lawyers in ".$city_name .", Best Lawyers in ".$city_name .", ".$city_name ." lawyers for Consulting, Find best lawyers in ".$city_name .", ".$city_name ." lawyers, district court ".$city_name ." advocate, ".$city_name ." advocate number, ".$city_name ." high court lawyers, free legal advice ".$city_name ."";

      $content['content'] = "<h1 class='text-captialize mb-3'>Consult with Best Lawyers in ".$city_name ."</h1>
      <p class='p-text'>Adlaw helps you to consult with the best lawyers in ".$city_name ." for ".$court_name." matters. Our portal is based upon well read and well connected lawyers, who are there to cater your all legal needs. You can use filters to narrow your search and find the best lawyer or advocate in ".$city_name ." for your legal matter. Our aim is to deliver complete legal solutions to all legal requirements of our clients. We have a highly qualified and responsive team of attorneys involving of young as well as senior legal professionals who have attained specific expertise in their specific area of laws. Get top lawyers in ".$city_name ." for family dispute or divorce matters, property matter, employment or labor court matter, criminal matter, recovery or cheque bounce matters, taxation or corporate matters, or then again an attorney master in some other field of law.<br><br></p>
      <h2 class='text-captialize mb-3'>How to Hire Advocate in ".$city_name ."</h2>
      <p class='p-text'>It's critical to comprehend that a decent attorney doesn't guarantee that you'll win your case. Regardless, having a respectable attorney will give you the best opportunities for an ideal outcome and the comfort of realizing that you had the best representation. The initial stage in enrolling an Advocate is picking one in the practice zone that is related to your legal issue since this will ensure that the legal counselor is knowledgeable about dealing with cases like yours. There are several overall qualities that you should look for while picking an attorney in ".$city_name .". A better than average Advocate will have a sensible charge structure, which will empower you to understand in case you can bear the expense of the attorney's administrations and let you appreciate what you'll be getting for your money. Another significant factor to pass judgment on a decent Advocate is incredible correspondence since it's crucial that the attorney keeps awake with the most recent information about your case.<br><br></p>
      <p class='p-text'>Finally, it's basic to investigate the Advocate before getting that individual. You can often find online studies from past clients, and you can check whether the legal counselor has ever had tragic conduct with any of his past customers. Best Lawyers is dedicated to discovering how the people get legal Assist in India.</p>";
    }
      return $content;
  
	}


}
