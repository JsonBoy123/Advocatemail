<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Posts;
use App\Models\CatgMast;
use Auth;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(Auth::user()->hasRole('user')){
            $posts = Posts::where('user_id',Auth::user()->id)->orderBy('order_num')->cursor();
        }else{
            $posts = Posts::orderBy('order_num')->cursor();
        }
        
        $users = User::select('id','name')->where('role_id','!=','1')->cursor();

    
        return view('backend.posts.index',compact('posts','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users  = User::select('id','name','role_id')->orderBy('name')->cursor();
        
        $categories = CatgMast::where('is_post','1')->orderBy('catg_order')->get();

        return view('backend.posts.create',compact('users','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $data =  $this->validation($request);
        $post = Posts::latest()->firstWhere('user_id',$request->user_id);
        if(!empty($post)){
            $order_num = $post->order_num + 1;
        }else{
            $order_num = 1;
        }

        $data['order_num'] = $order_num;

        Posts::create($data);
        return redirect()->route('post.index')->with('success','Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Posts::find($id);
        return view('backend.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users  = User::select('id','name','role_id')->orderBy('name')->cursor();
        $post = Posts::find($id);

        $categories = CatgMast::where('is_post','1')->orderBy('catg_order')->get();
         
        return view('backend.posts.edit',compact('users','post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post =  Posts::find($id);
        $data = $this->validation($request,$post);
        $post->update($data);
        return redirect()->route('post.index')->with('success','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $post =  Posts::find($id);
        if($post->image_path != null){
           Storage::delete('public/'.$data->image);
        }
        if($post->attachment_path != null){
           Storage::delete('public/'.$data->attachment_path);
        }
        $post->delete();
         return redirect()->back()->with('success','Post Deleted Successfully');


    }
    public function validation($request, $posts =[]){
        $request->validate([
                'title'      => 'required|min:5|max:150',
                'start_date' => 'required',
                'body'       => 'required',
                'meta_title'  => 'nullable|min:4',
                'meta_description'=> 'nullable|min:4',
                'meta_keywords'   => 'nullable',
                'image'      => 'nullable',
                'user_id'      => 'required',

            ],
            [
                'start_date.required' => 'Date field is required.'
            ]
        );

        $data = [            
            'title'         => $request->title,
            'body'          => $request->body,
            'sefriendly'    => $request->sefriendly,
            'start_date'    => $request->start_date,
            'status'        => $request->status,
            'user_id'       => $request->user_id,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'catg_id'          => $request->catg_id,
            'is_slider'          => $request->is_slider,
            'times_read'    => '0',
        ];

        if($request->hasFile('image')){
            $data['image'] = $request->image->getClientOriginalName();
            $data['image_path'] = file_upload($request->image,$request->user_id.'/image',$posts,'image_path');
        }
        if($request->hasFile('attachment')){
            $data['attachment'] = $request->attachment->getClientOriginalName();
            $data['attachment_path'] = file_upload($request->attachment,$request->user_id.'/attachment',$posts,'attachment_path');
        }
        if($request->hasFile('slider_image')){
            $data['slider_image'] = file_upload($request->slider_image,$request->user_id.'/image',$posts,'slider_image');
        }
        
        

        return $data;
    }

    public function postFilter(Request $request){
        
        $posts = Posts::select('article_id','title','body','start_date','status');
        if($request->catg_type == '1'){
            $posts = $posts->where('user_id','1');
        }else{
            $posts = $posts->where('user_id',$request->user_id);
        }
        $posts = $posts->orderBy('order_num')->cursor();
        return view('backend.posts.table',compact('posts'));
    }

}
