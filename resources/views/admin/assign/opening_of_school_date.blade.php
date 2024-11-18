@include('header')

@include('topheader')
@include('sidebar')
  <main id="main" class="main">

    <div class="pagetitle">
   
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('access')}}">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Add Term</li>
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
              <h5 class="card-title">Add School Opening Form</h5>
                <!-- General Form Elements -->
                <form method="POST" enctype="multipart/form-data" action="{{ route('uploadSchoolOpen') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputTerm" class="col-sm-2 col-form-label">Number</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="inputTerm" name="number" aria-label="Select Term">
                                @for ($i = 1; $i <= 200; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Submit</label>
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
                        <th scope="col">Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($SchoolOpening as $index => $teacherClass)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $teacherClass['number'] }}</td>
                            <td>
                                <form action="{{ route('delete.schoolopening', ['id' => $teacherClass['id']]) }}" method="POST" style="display:inline;">
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