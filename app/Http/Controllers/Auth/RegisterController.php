<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Referral;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Mail;
use Illuminate\Support\Str;
use App\Mail\VerifyMail;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('verify.template');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
           'name' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
           'mobile' => ['required', 'string'],
           'gender' => ['required', 'string'],
           'dob' => ['required'],
           'country_code' => ['required'],
           'state_code' => ['required'],
           'city_code' => ['required'],
           'zip_code' => ['required', 'string'],
           'password' => ['required', 'string', 'min:8', 'confirmed'],
           'captcha'  => ['required','captcha']

       ],
       [
        'captcha.captcha'=>'Invalid captcha code.'
    ]);
    }


    public function register(Request $request)
    {
        // return $request;
        if ($request->referal_code != 'https://advocatemail.com/register') {
            // return $ref = Referral::where('email',$request->email)->get();
            $ref = Referral::where('email',$request->email)->update(['status' => 1]);
        }
        $country_data = Country::where('country_code',$request->country_code)->first();
        $country_name = $country_data->country_name;

        $state_data = State::where('state_code',$request->state_code)->first();
        $state_name = $state_data->state_name;

        $city_data = City::where('city_code',$request->city_code)->first();
        $city_name = $city_data->city_name;

        $string = str_shuffle('12ABCDJIKJGTIRO41581425123GJAIKOUJWUHENBJFJSUHAFRJE3456FASDFSD56456FA4SD5F4S57890');
        
        $code =  $request->country_code.''.$request->state_code.''.$request->city_code;


        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all(),$country_name,$state_name,$city_name)));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $this->registered($request, $user)?: redirect('/login')->with('success','We sent activation link, Check your email and click on the link to verify your email');

    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data,$country_name,$state_name,$city_name)
    {   
        
        $user =  User::create([
            'name' => $data['name'],
            'mid_name' => $data['mid_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'country_code' => $data['country_code'],
            'country_name' => $country_name,
            'state_code' => $data['state_code'],
            'state_name' => $state_name,
            'city_code' => $data['city_code'],
            'city_name' => $city_name,
            'zip_code' => $data['zip_code'],
            'profession' => $data['profession'],
            'password' => Hash::make($data['password']),
            'remember_token'=> Str::random(40),
            'role_id'=> $data['user_category'],
            'signup_ip' => request()->ip(),
            
        ]);
        $user->attachRole('3');
        Mail::to($user->email)->send(new VerifyMail($user));
        return $user;
    }
}
