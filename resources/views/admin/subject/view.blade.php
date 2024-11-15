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
              <h5 class="card-title">Add Subject Form</h5>
                <!-- General Form Elements -->
                <form method="POST" enctype="multipart/form-data" action="{{ route('uploadSubject') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Subject Name</label>
                        <div class="col-sm-10">
                            <input name="subject_name" placeholder="Subject Name" required type="text" class="form-control" value="{{ old('subject_name') }}">
                            @error('subject_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Select Class</label>
                        <div class="col-sm-10">
                            <select name="subject_class_id" class="form-select" aria-label="Default select example">
                                <option selected>Select Class</option>
                                @foreach ($classes as $item)
                                    <option value="{{ $item->id }}" >{{ $item->class_name }}</option>
                                @endforeach
                            </select>
                            @error('subject_class')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <button type="submit" class=" col-lg-12 btn btn-primary">Submit Form</button>
                        </div>
                    </div>
                </form>
                

            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Subject</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Class</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  
                  @foreach ($subject as $index =>  $item)
            <tr>
              <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $item->subject_name }}</td>
                <td>{{ $item->class->class_name ?? 'N/A' }}</td>
                <td><a class="btn btn-danger" href="{{ route('deleteSubject', ['id' => $item->id]) }}">Delete</a>
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