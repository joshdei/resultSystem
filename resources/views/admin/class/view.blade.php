@include('header')

@include('topheader')
@include('sidebar')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>General Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">General</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Add Class</h5>
    
                  <form method="post" action="{{ route('add_class') }}" enctype="multipart/form-data">
                    @csrf
                
                    <div class="row mb-3">
                        <label for="className" class="col-md-4 col-lg-3 col-form-label">Class Name</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="class_name" type="text" class="form-control" id="className" placeholder="Enter class name" required />
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Class Arm</label>
                        <div class="col-md-8 col-lg-9">
                            <div class="d-flex flex-wrap">
                                @foreach(range('A', 'Z') as $letter)
                                    <div class="form-check me-2 mb-2">
                                        <input class="form-check-input" type="checkbox" name="class_arm[]" value="{{ $letter }}" id="class_arm_{{ $letter }}">
                                        <label class="form-check-label" for="class_arm_{{ $letter }}">{{ $letter }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                
                    <div class="row mb-3">
                        <label for="classSize" class="col-md-4 col-lg-3 col-form-label">Class Size</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="class_size" type="text" class="form-control" id="classSize" placeholder="Enter class size" required />
                        </div>
                    </div>
                
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
                
                </div>
              </div>
    

              
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Class Table</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Class Name</th>
                        <th scope="col">Class Arm</th>
                        <th scope="col">Class Size</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $index => $class)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $class->class_name }}</td>
                        <td>{{ implode(', ', $class->class_arm) }}</td> <!-- Convert array to a comma-separated string -->
                        <td>{{ $class->class_size }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('editClass', ['id' => $class->id]) }}">Edit</a>
                            <a class="btn btn-danger" href="{{ route('deleteClass', ['id' => $class->id]) }}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
              <!-- End Default Table Example -->
            </div>
          </div>

         
        </div>

    
      </div>
    </section>
@include('footer')