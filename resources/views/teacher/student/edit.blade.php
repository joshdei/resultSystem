@include('header')
@include('topheader')
@include('sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('access') }}">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Edit Student</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Student</h5>
                        <!-- Edit Form -->
                        <form method="POST" enctype="multipart/form-data" action="{{ route('updateStudent', $student->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- First Name Input -->

                            <div class="row mb-3">
                                <label for="student_image" class="col-sm-2 col-form-label">Current Image: </label>
                                <div class="col-sm-10">
                                   
                                    @if($student->profile_image)
                                        <small>
                                            <img class="rounded-circle" src="{{ asset('storage/' . ($student->profile_image ?? 'default-profile-image.jpg')) }}" alt="Profile Image" style="width: 100px; height: 100px;">
                                            </small>

                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="student_firstname" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                    <input name="student_firstname" id="student_firstname" 
                                           placeholder="Student First Name" 
                                           value="{{ $student->firstname }}" 
                                           required type="text" class="form-control">
                                </div>
                            </div>

                            <!-- Last Name Input -->
                            <div class="row mb-3">
                                <label for="student_lastname" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input name="student_lastname" id="student_lastname" 
                                           placeholder="Student Last Name" 
                                           value="{{ $student->lastname }}" 
                                           required type="text" class="form-control">
                                </div>
                            </div>

                           
                           
                            <!-- Passport Image Input -->
                            <div class="row mb-3">
                                <label for="student_image" class="col-sm-2 col-form-label">Passport Image</label>
                                <div class="col-sm-10">
                                    <input name="student_image" id="student_image" class="form-control" type="file">
                                    
                                </div>
                            </div>

                            <!-- Select Class Dropdown -->
                            <div class="row mb-3">
                                <label for="student_class_details" class="col-sm-2 col-form-label">Select Class</label>
                                <div class="col-sm-10">
                                    <select name="student_class_details" id="student_class_details" class="form-select">
                                        <option selected disabled>Select Class</option>
                                        @foreach ($classDetails as $classDetail)
                                            <option value="{{ $classDetail['class_id'] }},{{ $classDetail['class_name'] }},{{ $classDetail['class_arm'] }}"
                                                @if ("{$classDetail['class_id']},{$classDetail['class_name']},{$classDetail['class_arm']}" == "{$student->class_id},{$student->class_name},{$student->class_arm}") selected @endif>
                                                {{ $classDetail['class_name'] }} - {{ $classDetail['class_arm'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Update Student</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

@include('footer')
