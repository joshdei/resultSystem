@include('header')

@include('topheader')
@include('sidebar')
  <main id="main" class="main">

    <div class="pagetitle">
   
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('access')}}">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Add Marks</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Marks</h5>
               
              <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{ route('uploadMarks') }}">
                @csrf
                <div class="col-md-4">
                    <label for="firstTestMarks" class="form-label">1ST TEST MARKS</label>
                    <select id="firstTestMarks" name="first_test_marks" class="form-select">
                        <option selected disabled>Choose...</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            
                <div class="col-md-4">
                    <label for="secondTestMarks" class="form-label">2ND TEST MARKS</label>
                    <select id="secondTestMarks" name="second_test_marks" class="form-select">
                        <option selected disabled>Choose...</option>
                        @for ($i = 1; $i <= 20; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            
                <div class="col-md-4">
                    <label for="examMarks" class="form-label">EXAM MARKS</label>
                    <select id="examMarks" name="exam_marks" class="form-select">
                        <option selected disabled>Choose...</option>
                        @for ($i = 1; $i <= 70; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-4">
                   
                </div>
            
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <button type="submit" class="col-lg-12 btn btn-primary">Submit Form</button>
                    </div>
                </div>
            </form>
            

            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">MARKS</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">FIRST TEST MARKS</th>
                        <th scope="col">SECOND TEST MARK</th>
                        <th scope="col">EXAM MARKS</th>
                    </tr>
                </thead>

                <tbody>
                  
                
                 @foreach ($marks as $index =>  $item)
            <tr>
              <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $item->first_test_marks }}</td>
                <td>{{ $item->second_test_marks }}</td>
                <td>{{ $item->exam_marks }}</td>
                <td><a class="btn btn-danger" href="{{ route('deleteMarks', ['id' => $item->id]) }}">Delete</a>
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