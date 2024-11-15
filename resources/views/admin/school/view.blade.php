@include('header')

@include('topheader')
@include('sidebar')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>School Information</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('access')}}">Home</a></li>
          <li class="breadcrumb-item">School</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{ asset('storage/' . ($schoolInfo->school_logo ?? 'default-profile-image.jpg')) }}" alt="Profile" class="rounded-circle">
              <h2>{{$schoolInfo->school_name}}</h2>
              <h3>{{$schoolInfo->school_motto}}</h3>
              
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

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

               

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title">School Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">School Namr</div>
                    <div class="col-lg-9 col-md-8">{{$schoolInfo->school_name}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">School Motto</div>
                    <div class="col-lg-9 col-md-8">{{$schoolInfo->school_motto}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">School Phone</div>
                    <div class="col-lg-9 col-md-8">{{$schoolInfo->school_phone}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">School Email</div>
                    <div class="col-lg-9 col-md-8">{{$schoolInfo->school_email}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">School Address</div>
                    <div class="col-lg-9 col-md-8">{{$schoolInfo->school_address}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">School Owner</div>
                    <div class="col-lg-9 col-md-8">{{$schoolInfo->firstname}} {{$schoolInfo->lastname}} </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">School Owner Email</div>
                    <div class="col-lg-9 col-md-8">{{$schoolInfo->email}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <!-- Profile Edit Form -->
                    <form method="post" action="{{route('update_school_account')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">School Logo</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="school_logo" type="file" class="form-control" id="fullName" required />
                            </div>
                        </div>
                
                        <div class="row mb-3">
                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Schol Name</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="school_name" type="text" class="form-control" id="fullName" placeholder="Kevin Anderson" required />
                            </div>
                        </div>
                
                        <div class="row mb-3">
                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">School Motto</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="school_motto" type="text" class="form-control" id="fullName" placeholder="Kevin Anderson" required />
                            </div>
                        </div>
                
                        <div class="row mb-3">
                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">School Address</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="school_address" type="address" class="form-control" id="Phone" placeholder="" required />
                            </div>
                        </div>
                
                        <div class="row mb-3">
                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">School Phone Number</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="school_phone" type="phone" class="form-control" id="Email" placeholder="k.anderson@example.com" required />
                            </div>
                        </div>
                
                        <div class="row mb-3">
                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">School Email</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="school_email" type="email" class="form-control" id="Email" placeholder="k.anderson@example.com" required />
                            </div>
                        </div>
                
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                    <!-- End Profile Edit Form -->
                </div>
                
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
@include('footer')