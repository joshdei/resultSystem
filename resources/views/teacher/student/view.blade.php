@include('header')

@include('topheader')
@include('sidebar')
  <main id="main" class="main">

    <div class="pagetitle">
      
     
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Student</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">UID</th>
                    <th scope="col">Image</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Class</th>
                    <th scope="col">Arm</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
               <tbody>
                @forelse ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->student_identication }}</td>
                    <td>
                      @if ($student->profile_image)
                          <img src="{{ asset('storage/' . $student->profile_image) }}" alt="Profile" width="50" height="50">
                      @else
                          N/A
                      @endif
                  </td>
                    <td>{{ $student->firstname }}</td>
                    <td>{{ $student->lastname }}</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ $student->class_name }}</td>
                    <td>{{ $student->class_arm }}</td>
                   
                    <td>
                        <a href="{{ route('editStudent', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('addStudentmarks', $student->id) }}" class="btn btn-warning btn-sm">Add Marks</a>
                        <a href="{{ route('singleStudentResult', $student->id) }}" class="btn btn-warning btn-sm">Result</a>
                        <form action="{{ route('deleteStudent', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No students found.</td>
                </tr>
            @endforelse
               </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>

        
        </div>

     
      </div>
    </section>
@include('footer')