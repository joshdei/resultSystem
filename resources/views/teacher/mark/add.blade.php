@include('header')
@include('topheader')
@include('sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('access') }}">Home</a></li>
                <li class="breadcrumb-item">Marks</li>
                <li class="breadcrumb-item active">View Marks</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Marks for the Teacher</h5>

                        <!-- Marks Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>First Test Marks</th>
                                    <th>Second Test Marks</th>
                                    <th>Exam Marks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('header')
                                @include('topheader')
                                @include('sidebar')
                                
                                <main id="main" class="main">
                                
                                    <div class="pagetitle">
                                        <nav>
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ route('access') }}">Home</a></li>
                                                <li class="breadcrumb-item">Marks</li>
                                                <li class="breadcrumb-item active">View Marks</li>
                                            </ol>
                                        </nav>
                                    </div><!-- End Page Title -->
                                
                                    <section class="section">
                                        <div class="row">
                                            <div class="col-lg-12">
                                
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Marks for the Teacher</h5>
                                
                                                        <!-- Marks Table -->
                                                        <form method="POST" action="{{ route('updateMarks') }}">
                                                            @csrf
                                                            @foreach ($marks as $mark)
                                                                <tr>
                                                                    <td>
                                                                        <div class="col-sm-10">
                                                                            <input name="first_test_marks[{{ $mark->id }}]" 
                                                                                   id="first_test_marks_{{ $mark->id }}" 
                                                                                   class="form-control" 
                                                                                   type="number" 
                                                                                   placeholder="{{ $mark->first_test_marks }}" 
                                                                                   max="{{ $mark->first_test_marks }}">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-sm-10">
                                                                            <input name="second_test_marks[{{ $mark->id }}]" 
                                                                                   id="second_test_marks_{{ $mark->id }}" 
                                                                                   class="form-control" 
                                                                                   type="number" 
                                                                                   placeholder="{{ $mark->second_test_marks }}" 
                                                                                   max="{{ $mark->second_test_marks }}">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-sm-10">
                                                                            <input name="exam_marks[{{ $mark->id }}]" 
                                                                                   id="exam_marks_{{ $mark->id }}" 
                                                                                   class="form-control" 
                                                                                   type="number" 
                                                                                   placeholder="{{ $mark->exam_marks }}" 
                                                                                   max="{{ $mark->exam_marks }}">
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <a href="" class="btn btn-info">Upload Student  Marks</a>
                                                                        
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                
                                                            <!-- Submit Button -->
                                                            <div class="row mb-3">
                                                                <div class="col-sm-10 offset-sm-2">
                                                                    <button type="submit" class="btn btn-primary">Upload Student  Marks</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>
                                    </section>
                                
                                @include('footer')
                                
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>

@include('footer')
