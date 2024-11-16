@include('header')

@include('topheader')
@include('sidebar')
  <main id="main" class="main">

    <div class="pagetitle">
   
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('access')}}">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Add Teacher</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Teacher Form</h5>
                <!-- General Form Elements -->
              <form method="POST" enctype="multipart/form-data" action="{{ route('addclassHeadTeacher') }}">
                @csrf
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Class Teacher Full Name</label>
                    <div class="col-sm-10">
                        <input name="headteacher_fullname" placeholder="HEAD Teacher Full Name" required type="text" class="form-control" value="{{ old('teacher_fullname') }}">
                        
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Select Class</label>
                    <div class="col-sm-10">
                        <select name="class_id" class="form-select" aria-label="Default select example">
                            <option selected>Select Class</option>
                            @foreach ($classes as $item)
                                <option value="{{ $item->id }}" {{ old('class_id') == $item->id ? 'selected' : '' }}>{{ $item->class_name }}</option>
                            @endforeach
                        </select>
                     
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
                        <th scope="col">Teacher Name</th>
                        <th scope="col">Teacher Class</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teacherheadClasses as $index => $teacherClass)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $teacherClass['headteacher_fullname'] }}</td>
                            <td>{{ $teacherClass['class_name'] }}</td>
                            <td>
                                <form action="{{ route('delete.headteacher', ['id' => $teacherClass['id']]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
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