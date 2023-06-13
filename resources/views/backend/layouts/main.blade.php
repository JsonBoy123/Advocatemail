@include('backend.partials.header')
 <div class="main-content">

<!-- responsive header -->
<div class="panel-body">
    @yield('content')
    <div class="bottombar"> 
        <span>© 2019. All Rights Reserved.</span>
    </div>
    <!-- bottombar -->
</div>
</div>
@include('backend.partials.footer')