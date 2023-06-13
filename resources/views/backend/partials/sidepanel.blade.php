<li class="nav-item active">
    <a class="nav-link" href="{{route('dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    @role('super_admin')
    <li class="nav-item">
        <a href="{{route('user.index')}}" class="nav-link">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('category.index')}}" class="nav-link">
            <i class="fas fa-users"></i>
            <span>Category</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDomain"
        aria-expanded="true" aria-controls="collapseDomain">
        <i class="fas fa-fw fa-cog"></i>
        <span>Domain</span>
    </a>
    <div id="collapseDomain" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('domain.index')}}">Domain</a>
            <a class="collapse-item" href="{{route('domain.assgine')}}">Add Domain</a>

        </div>
    </div>
</li>
@endrole



@if(website_check()->domain_url != null)

<li class="nav-item">
    <a class="nav-link collapsed" href="#" Title="Manage Content/Pages On You Personal Website" data-toggle="collapse" data-target="#collapseOne"
    aria-expanded="true" aria-controls="collapseOne">
    <i class="fas fa-fw fa-cog"></i>
    <span>Website</span>
</a>
<div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('post.index')}}">List Website Pages</a>
        <a class="collapse-item" href="{{route('post.create')}}">Add Pages On Website</a>

    </div>
</div>
</li>
@else
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-fw fa-cog"></i>
        <span class="show_confirm">Website</span>
    </a>
</li>
@endif




@role('user')
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" Title="Generate/Edit Data Required for details Profile"data-toggle="collapse" data-target="#collapseThree"
    aria-expanded="true" aria-controls="collapseThree">
    <i class="fas fa-fw fa-cog"></i>
    <span>Profile</span>
</a>
<div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{url('profile')}}"Title="Click Here to Display Your Profile">My Profile</a>
        <a class="collapse-item" href="{{route('profile.edit')}}"Title="Click Here to Edit or To Complete The Missing Data In Your Profile">Edit Profile</a>
        <a class="collapse-item" href="{{route('specialization')}}"Title="Submit or Edit your Advocacy Area of Specialization of your detail profile">Specialization</a>
        <a class="collapse-item" href="{{route('practicing_court')}}"Title="Generate Practising court in various cities as part of your detail profile">Practicing Court</a>
        <a class="collapse-item" href="{{route('qualification')}}" Title="Submit all your qualification details as part of your Profile">Qualification</a>
    </div>
</div>
</li>

<li class="nav-item">
   <a class="nav-link collapsed" href="#" Title="Manage Your Appointment Schedules" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
   <i class="fas fa-fw fa-cog"></i>

   <span>Appoinment</span>
</a>

<div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{url('/appointment')}}" Title="Generate the available Time Slots that will be diplayed on Your Profiles for your customers to request for appointments">Manage Appointment"</a>
        <a class="collapse-item" href="{{url('/booking')}}" Title="Manage Appointments Requested by your existing / New customers seeking for legal solutions">Schedule Availability</a>
    </div>
</div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" Title="Services Provided By  AvocateMail.com" data-toggle="collapse" data-target="#collapseSix"
    aria-expanded="true" aria-controls="collapseSix">
    <i class="fas fa-fw fa-cog"></i>
    <span>Services</span>
</a>
<div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{url('/service_available')}}" title="List Of Service Available For You on AdvocateMail.com">Services Available</a>
        <a class="collapse-item" href="{{url('/subscribed-services')}}" title="List Of Service Subscribed By You"> Subscribed Services</a>

    </div>
</div>
</li>

<li class="nav-item">
   <a class="nav-link collapsed" href="#" Title="Refer This Service to Your Associate Advocates and Be Eligible As An Affliate Of Advocatemail.com" data-toggle="collapse" data-target="#collapseFive"
   aria-expanded="true" aria-controls="collapseFive">
   <i class="fas fa-fw fa-cog"></i>
   <span>Refer</span>
</a>


<div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('referral.create')}}" Title="Refer This Service To Other Advocates by submitting Their Emails and Mobile Number">Refer To Other Advocate</a>
        <a class="collapse-item" href="{{url('/referral')}}"Title="Preview List Of Refered Avocated That Have Subscribed As Your Refrence" >My Refered Advocates</a>
    </div>
</div>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{url('/review_status')}}" aria-expanded="true">
        <i class="fas fa-fw fa-cog"></i>
        <span>Reviews</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{url('/message')}}" Title=" Check & Respond To Messages Sent From your profiles By Your New/Xxisting Clients" aria-expanded="true">
        <i class="fas fa-fw fa-cog"></i>
        <span>Message Inbox</span>
    </a>
</li> 

<li class="nav-item">
    <a class="nav-link" href="{{url('/password_change')}}" aria-expanded="true">
        <i class="fas fa-fw fa-cog"></i>
        <span>Change Password</span>
    </a>
</li>
@endrole
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          event.preventDefault();
          swal({
              title: `This is Payed Module Beta released`,
              text: "For subscription contact website@advocatemail.com",
              icon: "success",
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>