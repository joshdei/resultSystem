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

              <img src="{{ asset('storage/' . ($teacherInfo->profile_image ?? 'default-profile-image.jpg')) }}" alt="Profile" class="rounded-circle">
              <h2>{{$teacherInfo->name}} {{$teacherInfo->lastname}}</h2>
              <h3>
                @if ($teacherInfo->user_type ==  2)
                  <h5>Teacher</h5>
                  @else
                  <h5>None</h5>
                @endif
              </h3>
              
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
                  
                  <h5 class="card-title">Teacher Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Teacher Name</div>
                    <div class="col-lg-9 col-md-8">{{$teacherInfo->name}} {{$teacherInfo->lastname}}</div>
                  </div>
 
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Teacher Phone</div>
                    <div class="col-lg-9 col-md-8">{{$teacherInfo->phone}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Teacher Email</div>
                    <div class="col-lg-9 col-md-8">{{$teacherInfo->email}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Teacher Class</div>
                    
                    @foreach ($teacher_class as $class)
                    <div class="col-lg-9 col-md-8">{{ $class->class_name }}</div>
                @endforeach
                
                  </div>

            
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <!-- Profile Edit Form -->
                    <form method="post" action="{{route('upload_teacher_account')}}" enctype="multipart/form-data">
                      @csrf
                      <input name="teacherId"  value="{{$teacherInfo->id}}" type="hidden"  required />
                      <div class="row mb-3">
                          <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Teacher Image</label>
                          <div class="col-md-8 col-lg-9">
                              <input name="teacher_image" type="file" class="form-control" id="profileImage" required />
                          </div>
                      </div>
                  
                      <div class="row mb-3">
                          <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First  Name</label>
                          <div class="col-md-8 col-lg-9">
                              <input name="name"  placeholder="{{$teacherInfo->name}}" type="text" class="form-control" id="fullName"  required />
                          </div>
                      </div>

                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="lastname" type="text" placeholder="{{$teacherInfo->lastname}}" class="form-control" id="fullName"  required />
                        </div>
                    </div>
                  
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Select Class</label>
                  <div class="col-sm-8 col-lg-9">
                      <select name="teacher_class_id" class="form-select" aria-label="Default select example">
                          <option selected>Select Class</option>
                          @foreach ($classes as $item)
                              <option value="{{ $item->id }}" {{ old('teacher_class_id') == $item->id ? 'selected' : '' }}>{{ $item->class_name }}</option>
                          @endforeach
                      </select>
                      @error('teacher_class_id')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
              </div>
                  
                      <div class="row mb-3">
                          <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                          <div class="col-md-8 col-lg-9">
                              <input placeholder="{{$teacherInfo->phone}}" name="teacher_phone" type="tel" class="form-control" id="phone" required />
                          </div>
                      </div>
                      
                  
                      <div class="row mb-3">
                          <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                          <div class="col-md-8 col-lg-9">
                              <input name="teacher_email" placeholder="{{$teacherInfo->email}}" type="email" class="form-control" id="email"  required />
                          </div>
                      </div>
                      <div class="row mb-3">
                        <label for="password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input 
                                name="password" 
                                type="password" 
                                class="form-control" 
                                id="password" 
                                placeholder="Enter new password" 
                                required 
                            />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="confirmPassword" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input 
                                name="password_confirmation" 
                                type="password" 
                                class="form-control" 
                                id="confirmPassword" 
                                placeholder="Confirm new password" 
                                required 
                            />
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