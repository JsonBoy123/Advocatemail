@extends('backend.layouts.main')
@section('content')
<style>
.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}
.box.box-solid {
    border-top: 0;
}
.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}
.box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
}
.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}
.box-header>.box-tools {
    position: absolute;
    right: 10px;
    top: 5px;
}
.box.box-primary {
    border-top: 3px solid #224abe;
}
.no-padding {
    padding: 0 !important;
}
.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;
}
.box .nav-stacked>li {
    border-bottom: 1px solid #f4f4f4;
    margin: 0;
}
.box .nav-stacked>li {
    padding: 20px 0px !important;
}
.nav-stacked>li.active>a, .nav-stacked>li.active>a:hover {
    background: transparent;
    color: #444;
    border-top: 0;
    border-left-color: #3c8dbc;
}
</style>
 <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked" style="display:block;">
                <li class="{{Request()->segment(1) == 'message' ? 'active' : ''}}"><a href="{{route('message.index')}}"><i class="fa fa-inbox"></i> Inbox
                	@if($unread != 0)
                  	<span class="label label-primary pull-right">{{$unread}}</span></a></li>
                  	@endif
                <li class="{{Request()->segment(1) == 'sent_messages' ? 'active' : ''}}"><a href="{{route('message.sent')}}"><i class="fa fa-envelope"></i> Sent</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
	@yield('inbox-body')
@endsection