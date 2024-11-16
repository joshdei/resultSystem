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
              <h5 class="card-title">List of Student Mark</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>Student Name</th>
                        <th>First Test Marks</th>
                        <th>Second Test Marks</th>
                        <th>Exam Marks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <tbody>
                    @foreach ($studentMarks as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->student->firstname }} {{ $item->student->lastname }}</td>
                            <td>{{ $item->student_first_test_marks }}</td>
                            <td>{{ $item->student_second_test_marks }}</td>
                            <td>{{ $item->student_exam_marks }}</td>
                            <td>
                              <!-- Edit Button -->
                              <a href="{{ route('editStudentmark', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
              
                              <!-- Delete Button -->
                              <form action="{{ route('deleteStudentmark', $item->id) }}" method="POST" style="display: inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                              </form>
                          </td>
                        </tr>
                    @endforeach
                </tbody>
                
              </tbody>
              
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>

        
        </div>

     
      </div>
    </section>
@include('footer')