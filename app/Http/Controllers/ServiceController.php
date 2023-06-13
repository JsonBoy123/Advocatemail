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
use App\Models\Prod;
use Auth;
use App\Models\Contact;
use DB;
class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function service()
    {
        $prod = Prod::all();
        return view('backend.profile.service',compact('prod'));
    }

        public function services()
    {
        $user_id    = Auth::user()->id;
        $pods = UserProd::with('user_id')->where('user_id',Auth::user()->id)->get();
        return view('backend.profile.services',compact('pods','user_id'));
    }
}
