@include('header')

@include('topheader')
@include('sidebar')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('access')}}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            
              <img class="rounded-circle" src="{{ asset('storage/' . (Auth::user()->profile_image ?? 'default-profile-image.jpg')) }}" alt="Profile Image" style="width: 100px; height: 100px;">

              <h2>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h2>
              @if(Auth::user()->user_type == 1)
                    <h6>Owner</h6>
                
                @elseif (Auth::user()->user_type == 2)
                    <h6>Teacher</h6>
                
                @endif
                <h6>{{ Auth::user()->phone }}</h6>
                <h6>{{ Auth::user()->email }}</h6>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>
                @if(Auth::user()->user_type == 1)
              
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

           

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>
            @elseif (Auth::user()->user_type == 2)
                
            
            @endif
                

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Name of School</div>
                    <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Role</div>
                    <div class="col-lg-9 col-md-8">
                      @if(Auth::user()->user_type == 1)
                        <h6>Owner</h6>
                    
                    @elseif (Auth::user()->user_type == 2)
                        <h6>Teacher</h6>
                    
                    @endif</div>
                  </div>

                  

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{Auth::user()->phone}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{Auth::user()->email}}</div>
                  </div>

                </div>


                @if(Auth::user()->user_type == 1)
                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post" action="{{route('update_account')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="profile_image" type="file" class="form-control" id="fullName" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName" placeholder="Kevin Anderson">
                      </div>
                    </div>

                    <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="lastname" type="text" class="form-control" id="fullName" placeholder="Kevin Anderson">
                        </div>
                      </div>

                 

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" placeholder="(436) 486-3538 x29071">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" placeholder="k.anderson@example.com">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                
                <div class="tab-pane fade pt-3" id="profile-change-password">
                    <form method="POST" action="{{ route('changePassword') }}">
                      @csrf
                      <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="current_password" type="password" class="form-control" id="currentPassword" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="new_password" type="password" class="form-control" id="newPassword" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="renew_password" type="password" class="form-control" id="renewPassword" required>
                        </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                      </div>
                    </form><!-- End Change Password Form -->
                  </div>
                  
            
            @elseif (Auth::user()->user_type == 2)
                  
            
            @endif

              

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
@include('footer')