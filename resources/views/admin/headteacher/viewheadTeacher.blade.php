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
              <h5 class="card-title">Head Teacher Form</h5>
                <!-- General Form Elements -->
              <form method="POST" enctype="multipart/form-data" action="{{ route('addHeadTeacher') }}">
                @csrf
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Teacher First Name</label>
                    <div class="col-sm-10">
                        <input name="teacher_firstname" placeholder="Teacher Name" required type="text" class="form-control" value="{{ old('teacher_firstname') }}">
                        @error('teacher_firstname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Teacher Last Name</label>
                    <div class="col-sm-10">
                        <input name="teacher_lastname" placeholder="Teacher Last name" required type="text" class="form-control" value="{{ old('teacher_lastname') }}">
                        @error('teacher_lastname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div> 

                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Teacher Email</label>
                    <div class="col-sm-10">
                        <input name="teacher_email" placeholder="Teacher Email" required type="email" class="form-control" value="{{ old('teacher_email') }}">
                        @error('teacher_email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
              
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Teacher Number</label>
                    <div class="col-sm-10">
                        <input name="teacher_phone" placeholder="Teacher Phone" required type="text" class="form-control" value="{{ old('teacher_phone') }}">
                        @error('teacher_phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

               

                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Teacher Image</label>
                    <div class="col-sm-10">
                        <input name="teacher_image" placeholder="Teacher image" class="form-control" type="file" id="formFile">
                        @error('teacher_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Select Class</label>
                    <div class="col-sm-10">
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
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input name="teacher_password" placeholder="Teacher Password" required type="password" class="form-control">
                        @error('teacher_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPasswordConfirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input name="teacher_password_confirmation" placeholder="Confirm Password" required type="password" class="form-control">
                        @error('teacher_password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Submit Button</label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit Form</button>
                    </div>
                </div>
              </form>


            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Class Teacher</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Teacher Image</th>
                        <th scope="col">Teacher Name</th>
                      
                        <th scope="col">Teacher Phone</th>
                        <th scope="col">Teacher Email</th>
                     
                        <th scope="col">Teacher Class</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  
                  @foreach ($check_teache_info as $index => $item)
                  <tr>
                      <th scope="row">{{ $index + 1 }}</th>
                      <td>
                        <img src="{{ asset('storage/' . ($item->profile_image ?? 'default-profile-image.jpg')) }}" alt="Profile" class="rounded-circle" width="50" height="50">
                    </td>
                      <td>{{ $item->name }} {{ $item->lastname }}</td>
                 
                      <td>{{ $item->phone }}</td>
                      <td>{{ $item->email }}</td>
                     
                      <td>
                          @if (isset($teacher_class[$index])) 
                              {{ $teacher_class[$index]->class_name }}  <!-- Access the class name by index -->
                          @else
                              N/A
                          @endif
                      </td>
                      <td>
                        <a class="btn btn-primary" href="{{ route('editTeacher', ['id' => $item->id]) }}">Edit</a>
                        <a class="btn btn-danger" href="{{ route('deleteTeacher', ['id' => $item->id]) }}">Delete</a>
                    </td>
                  </tr>
              @endforeach
              
                </tbody>
            </table>
            
              <!-- End Default Table Example -->
            </div>

        </div>

      </div>
    </section>

 @include('footer')