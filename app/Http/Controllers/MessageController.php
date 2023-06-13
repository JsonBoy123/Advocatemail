<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\User;
use App\Models\MessageTalk;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function unread(){
          $noti = MessageTalk::where('recv_id',Auth::user()->id)->where('status',0)->get();
          $unread = count($noti);
          return  $unread;
    }

    public function index(){
       $id = Auth::user()->id;
        $user = User::with('city')->with('state')->where('id',$id)->first();
        $messages = MessageTalk::select('msg_talks.*','users.name')->join('users','users.id','=','msg_talks.sender_id')->where('recv_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        $unread = $this->unread();          
        return view('message.inbox', compact('user','unread','messages'));
    }
    public function create(Request $request){
        $id = Auth::user()->id;
        $user = User::with('city')->with('state')->where('id',$id)->first();
        $lawyer_id =  $request->id;
        $lawyer_details = User::find($lawyer_id);

        $unread = $this->unread();
        return view('message.compose',compact('unread','lawyer_details','user'));
    }
    public function store(Request $request){
        $data = $request->validate([
            'subject'   => 'required|string|max:50',
            'message'   => 'required|string|max:255',
            'sender_id' => 'required',
            'recv_id'   => 'required',
            'status'    => 'required'  
        ]);

        MessageTalk::create($data);
        
        return redirect()->route('message.sent');
    }
    public function show($id){
        $message = MessageTalk::select('msg_talks.*','users.name',
            'users.photo')->join('users','users.id','=','msg_talks.sender_id')->find($id);
        
         MessageTalk::where('id',$id)->update(['status'=>1]);

         $unread = $this->unread();
        return view('message.message',compact('unread','message'));
    }
    public function reply(Request $request){
        $data = $request->validate([
            'sender_id' => 'required',
            'recv_id'   => 'required',
            'parent_id' => 'required',
            'subject'   => 'required',
            'message'   => 'required',
            'status'    => 'required'
        ]);
        MessageTalk::create($data);
        return redirect()->back()->with('success','message sent');
    }


    public function show_send(){
    
        $messages = MessageTalk::select('msg_talks.*','users.name')->join('users','users.id','=','msg_talks.recv_id')->where('sender_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
      
        $unread = $this->unread();
        return view('message.sent', compact('unread','messages'));
    }

    // public function delete(){
    //     $msgIds = Request()->msgIds;
      
    //     $msgIds =  explode(',',$msgIds);
     
    //     MessageTalk::whereIn('id',$msgIds)->delete();
    //     return "Message permanently deleted successfully";
    // }
    public function delete(Request $request)
    {
        $id = $request->id;
        MessageTalk::whereIn('id',explode(",",$id))->delete();
        return response()->json(['status'=>true,'message'=>"Message permanently deleted successfully"]);
    }
}