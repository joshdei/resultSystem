@include('header')

@include('topheader')
@include('sidebar')
  <main id="main" class="main">

    <div class="pagetitle">
   
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('access')}}">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Head Teacher</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Student Form</h5>
                <!-- General Form Elements -->
                <form method="POST" enctype="multipart/form-data" action="{{ route('uploadStudent') }}">
                    @csrf
                
                    <!-- First Name Input -->
                    <div class="row mb-3">
                        <label for="student_firstname" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                            <input name="student_firstname" id="student_firstname" placeholder="Student First Name" required type="text" class="form-control">
                        </div>
                    </div>
                
                    <!-- Last Name Input -->
                    <div class="row mb-3">
                        <label for="student_lastname" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                            <input name="student_lastname" id="student_lastname" placeholder="Student Last Name" required type="text" class="form-control">
                        </div>
                    </div>
                
                
                
                
                
                    <!-- Passport Image Input -->
                    <div class="row mb-3">
                        <label for="student_image" class="col-sm-2 col-form-label">Passport Image</label>
                        <div class="col-sm-10">
                            <input name="student_image" id="student_image" class="form-control" type="file" placeholder="Student image" id="formFile">
                        </div>
                    </div>
                
                    <!-- Select Class Dropdown -->
                    <div class="row mb-3">
                        <label for="student_class_id" class="col-sm-2 col-form-label">Select Class</label>
                        <div class="col-sm-10">
                            <select name="student_class_details" id="student_class_details" class="form-select" aria-label="Select Class">
                                <option selected disabled>Select Class</option>
                                @forelse ($classDetails as $classDetail)
                                    <option value="{{ $classDetail['class_id'] }},{{ $classDetail['class_name'] }},{{ $classDetail['class_arm'] }}">
                                        {{ $classDetail['class_name'] }} - {{ $classDetail['class_arm'] }}
                                    </option>
                                @empty
                                    <option disabled>No class information available.</option>
                                @endforelse
                            </select>
                            
                        </div>
                        
                        
                    </div>

                    
                
                    <!-- Submit Button -->
                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Submit Form</button>
                        </div>
                    </div>
                </form>
                

            </div>
          </div>

     
      </div>
    </section>

 @include('footer')