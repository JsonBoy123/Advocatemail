<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
use App\Models\Booking;
use App\Models\Slots;
use App\Notifications\BookingNotifications;
use Illuminate\Notifications\Notification;
use App\Notifications\Notifications;
class BookingController extends Controller
{
     public function book_an_appointment(Request $request){
      // return $request;
     // die; 
      $b_date = date('Y-m-d', strtotime($request->b_date));

      $booking = Booking::where('plan_id',$request->plan_id)
                        ->where('user_id',$request->user_id)
                        ->where('b_date',$b_date)
                        ->where('client_id',$request->client_id)->get();
      if(count($booking)!=0){ 
            return redirect()->back()->with('warning','You have already booked appointment.');
      }
      else{
          $data = [
            'plan_id' => $request->plan_id,
            'b_date' => $b_date,
            'user_id' =>  $request->user_id,
            'client_id' =>  $request->client_id,
            'client_status' =>  1,
            'user_status' =>  0
          ];

          if(Auth::user()->id != $request->user_id){

            $user = User::find($request->user_id);
            // return $data;
             $booking =  Booking::create($data);
            if($user->on_database  == '1' && $user->status == 'D'){
              $sendData = [
                'id' => $booking->id,
                'title' => $user->name.' Appointment Booking.',
                'url' => 'user_appointment',
                'message' => 'On search some one want to contact to '.$user->name
              ];

              $admins = User::whereRoleIs('admin')->get();

              foreach ($admins as $admin) {
                $admin->notify(new BookingNotifications($sendData));
              }
              // Notification::send($admins, new BookingNotifications($sendData));
            }

            return redirect()->back()->with('success','Your booking has been send to lawyer confirmation');
          }
          else{
            return redirect()->back()->with('warning',"Your booking has been failed because you can't booked your own profile");
          }
      
      }

    }

    public function index(){

     $unbookings =  Booking::with('users.city','users.state')->where('user_id',Auth::user()->id)
                ->where('client_status',1)
                ->where('user_status',0)
                // ->whereDate('b_date',date('Y-m-d'))
                ->get();
                
      $skip_unbookings =  Booking::with('users.city','users.state')->where('user_id',Auth::user()->id)
                ->where('client_status',1)
                ->where('user_status',0)
                ->whereDate('b_date','<>',date('Y-m-d'))
                ->get();
                // return $unbookings;

      $booked =  Booking::with('users.city','users.state')->where('user_id',Auth::user()->id)
                ->where('client_status',1)
                ->where('user_status',1)
                ->get(); 

      $cancelled =  Booking::with('users.city','users.state')->where('user_id',Auth::user()->id)
                ->where('client_status',0)
                ->where('user_status',0)
                ->get();

      $apply_bookings = Booking::select('bookings.*','users.name','slots.slot')->join('users','users.id','bookings.user_id')->join('slots','slots.id','bookings.plan_id')->where('client_id',Auth::user()->id)->get();
    
    	$slots = Slots::all();

      // return $unbookings;

    	return view('booking.show',compact('unbookings','slots','booked', 'cancelled','apply_bookings','skip_unbookings'));
    } 

    public function bookingUpdate($id){
    	$booking = Booking::find($id);

    	$same_bookings = Booking::where('b_date',$booking->b_date)
    							->where('plan_id',$booking->plan_id)
    							->where('user_id',$booking->user_id)
    							->where('id', '!=', $id)
    							->get();
    	$booking_id = array();
    	foreach($same_bookings as $same_booking){
    		$booking_id[] = $same_booking->id;
    	}

    	Booking::where('id',$id)->update(['user_status'=>1]);
    	Booking::whereIn('id',$booking_id)->update(['client_status'=>0]);
    	return redirect()->back()->with('success','Appointment accepted successfully');

    }
    public function bookingCancelled(Request $request, $id){
      $booking = Booking::find($id);
      $booking->update(['user_status'=>0,'client_status'=>0,'reason' => $request->reason]);

      $client_id =  User::find($booking->client_id);
      $sendData = [
          'id' => $booking->id,
          'title' =>'Your booking appointment cancelled on date '.$booking->b_date,
          'url' => 'booking',
          'message' => 'Booking cancelled reason:- '.str_limit($request->reason)
        ];

      $client_id->notify(new Notifications($sendData));

      return redirect()->back()->with('success','Appointment cancelled successfully');
    }

    public function appointment_show(){
        $bookings = Booking::select('bookings.*','users.firstname','slots.slot')->join('users','users.id','bookings.user_id')->join('slots','slots.id','bookings.plan_id')->where('client_id',Auth::user()->id)->get();
        return view('customer.dashboard.appointment',compact('bookings'));
    }
}
