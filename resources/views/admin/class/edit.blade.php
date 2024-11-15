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
                  <h5 class="card-title">Edit Class</h5>
    
                  <form method="post" action="{{ route('update_class', ['id' => $class->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updates -->
                    
                    <div class="row mb-3">
                        <label for="className" class="col-md-4 col-lg-3 col-form-label">Class Name</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="class_name" type="text" class="form-control" id="className" 
                                   value="{{ $class->class_name }}" placeholder="Enter class name" required />
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Class Arm</label>
                        <div class="col-md-8 col-lg-9">
                            <div class="d-flex flex-wrap">
                                @foreach(range('A', 'Z') as $letter)
                                    <div class="form-check me-2 mb-2">
                                        <input class="form-check-input" type="checkbox" name="class_arm[]" 
                                               value="{{ $letter }}" id="class_arm_{{ $letter }}"
                                               {{ in_array($letter, $class->class_arm) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="class_arm_{{ $letter }}">{{ $letter }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="classSize" class="col-md-4 col-lg-3 col-form-label">Class Size</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="class_size" type="text" class="form-control" id="classSize" 
                                   value="{{ $class->class_size }}" placeholder="Enter class size" required />
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
                
                
                </div>
              </div>
    

   
         
        </div>

    
      </div>
    </section>
@include('footer')