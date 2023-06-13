@extends('backend.layouts.main')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Post
         <a href="{{route('post.index')}}" class="btn btn-sm btn-primary pull-right">Back</a>
         </h5>
    </div>
    <div class="card-body">

        <form action="{{route('post.update',$post->article_id)}}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('patch')
                <input type="hidden" name="role_id" value="" id="role">
            @csrf
            @role('admin|super_admin')
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="user_id">Select User</label>
                        <select name="user_id" class="form-control" required="required" id="user_id">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}" data-id="{{$user->role_id}}"  {{(old('user_id')  ?? $post->user_id) == $user->id ? 'selected="selected"' : ''}}>{{$user->name}}</option>
                            @endforeach
                        </select>
                         @error('user_id')
                            <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="col-md-6 form-group">
                        <label for="category">Catgory</label>
                         <select name="catg_id" class="form-control" id="catg">
                            <option value="">Select category</option>
                                                         
                        </select>
                        @error('catg_id')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    
                </div>        
            @endrole

            @role('user')
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
          
                 <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="category">Catgory</label>
                        <select name="catg_id" class="form-control">
                            <option value="">Select category</option>
                            @foreach(collect($categories)->where('catg_type',2) as $categorie)
                                <option value="{{$categorie->catg_id}}"  {{(old('catg_id')  ?? $post->catg_id) == $categorie->catg_id ? 'selected="selected"' : ''}} >{{$categorie->catg_name}}</option>
                            @endforeach
                        </select>
                        @error('catg_id')
                            <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            @endrole


            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Post Title" value="{{old('title') ?? $post->title}}" id="title">
                    @error('title')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="sefriendly">Sefriendly Url</label>
                    <input type="text" name="sefriendly" value="{{old('sefriendly') ?? $post->sefriendly}}" class="form-control" readonly="readonly" id="sefriendly" placeholder="Sefriendly Url">
                    @error('sefriendly')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="start_date">Start Date</label>
                    <input type="text" name="start_date" class="form-control datepicker" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="{{old('start_date') ?? date('Y-m-d',strtotime($post->start_date))}}" id="start_date">
                    @error('start_date')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- <div class="col-md-6 form-group">
                    <label for="end_date">End Date</label>
                    <input type="text" name="end_date" class="form-control datepicker" placeholder="yyyy-mm-dd" data-date-format='yyyy-mm-dd' value="{{old('end_date')}}" id="end_date">
                    @error('end_date')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}
                
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="image">Image for Post Size- 400px X 400 Px ( Lenght X Width )</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @error('image')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="attachment">Attachment <span class="text-muted">(PDF Accepted)</span></label>
                    <input type="file" name="attachment" class="form-control" accept="application/pdf">
                    @error('attachment')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>     
            <hr>                   
           {{--  <div class="row">
                <div class="col-md-6 form-group">
                    <label for="slider_image">Galler Image</label>
                    <select name="slider_image" class="form-control" id="slider_image">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>

                </div>                            
            </div> --}}
          {{--   <div class="row d-none" id="slider-div">
                <div class="col-md-6 mb-4 form-group" >
                    <label for="images">Galler Image <a href="javascript:void(0)" class="btn btn-success btn-sm" id="addMore" ><i class="fa fa-plus font-size-14"></i></a></label>
                    <input type="file" name="images[]" class="form-control" accept="image/*">
                </div>
            </div> --}}
           
             <div class="row">
                <div class="col-md-6 form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status">
                        <option value="1" {{(old('status') ?? $post->status) == '1' ? 'selected' : ''}}>Active</option>
                        <option value="0" {{(old('status') ?? $post->status) == '0' ? 'selected' : ''}}>Not Active</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="is_slider">Is Slider (Post show on the slider or not?)</label>
                    <select class="form-control" name="is_slider" id="is_slider">
                        <option value="0" {{(old('is_slider') ?? $post->is_slider) == '0' ? 'selected="selected' : ''}}>No</option>
                        <option value="1" {{(old('is_slider') ?? $post->is_slider) == '1' ? 'selected="selected' : ''}}>Yes</option>
                    </select>
                </div>
                <div class="col-md-6 form-group d-none" id="sliderImg" >
                    <label for="slider_image">Slider Image for Post Size- 1600px X 600 Px ( Lenght X Width )</label>
                    <input type="file" name="slider_image" class="form-control" accept="image/*">
                    @error('slider_image')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
             @role('super_admin|admin')
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="status">Meta title</label>
                    <input type="text" name="meta_title" class="form-control" placeholder="Post meta title" value="{{old('meta_title') ?? $post->meta_title}}" id="meta_title">
                    @error('meta_title')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="status">Meta description</label>
                    
                     <input type="text" name="meta_description" class="form-control" placeholder="Post Meta Description" value="{{old('meta_description') ?? $post->meta_description}}" id="meta_description">
                    @error('meta_description')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="status">Meta Keywords</label>
                   
                    <input type="text" name="meta_keywords" class="form-control" placeholder="Post meta keywords" value="{{old('meta_keywords') ?? $post->meta_keywords}}" id="meta_keywords">
                    @error('meta_keywords')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            @endrole


            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" name="body" rows="10" cols="20" placeholder="Enter Body Content" id="editor">{{old('body') ?? $post->body}}</textarea>
                    @error('body')
                        <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script >
    $(document).ready(function(){
        CKEDITOR.replace('editor');
        $('.datepicker').datepicker({
            'setDate': new Date()
        });

        $('#title').blur(function(e){
            var text = document.getElementById("title").value;
            str = text.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
            str = str.replace(/^\s+|\s+$/gm,'');
            str = str.replace(/\s+/g, '-')+'.html';   
            $("#sefriendly").val(str); 
        });

        $('#user_id').on('change',function(e){
            e.preventDefault();
            var role_id = $(this).find(':selected').data('id');
            fn_get_role_catgs(role_id);
            $('#role').val(role_id);
        });

        var role_id = "{{old('role_id') ?? $post->user->role_id}}";
        var catg_id = "{{old('catg_id') ?? $post->catg_id}}";
        if(role_id !=''){
            fn_get_role_catgs(role_id,catg_id);
        }

    

        $('#is_slider').on('change',function(e){
            e.preventDefault();
            var is_slider = $(this).val();
            sliderImage(is_slider);
        });

        var is_slider = "{{old('is_slider') ?? $post->is_slider}}";
        if(is_slider !=''){
             sliderImage(is_slider);
        }
        function sliderImage(is_slider){
            if(is_slider == '1'){
                $('#sliderImg').removeClass('d-none');
            }else{
                $('#sliderImg').addClass('d-none');
            }
        }

    });
</script>
@endsection