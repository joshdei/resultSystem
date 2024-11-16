@include('header')
@include('topheader')
@include('sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('access') }}">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Edit Student</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Student Mark</h5>
                        <!-- Edit Form -->
                        <form method="POST" action="{{ route('updateStudentmark', $studentMark->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="first_test_marks" class="form-label">First Test Marks</label>
                                <input type="number" class="form-control" id="first_test_marks" name="student_first_test_marks" 
                                       value="{{ $studentMark->student_first_test_marks }}" max="100" required>
                            </div>
                            <div class="mb-3">
                                <label for="second_test_marks" class="form-label">Second Test Marks</label>
                                <input type="number" class="form-control" id="second_test_marks" name="student_second_test_marks" 
                                       value="{{ $studentMark->student_second_test_marks }}" max="100" required>
                            </div>
                            <div class="mb-3">
                                <label for="exam_marks" class="form-label">Exam Marks</label>
                                <input type="number" class="form-control" id="exam_marks" name="student_exam_marks" 
                                       value="{{ $studentMark->student_exam_marks }}" max="100" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Marks</button>
                        </form>
                    

                    </div>
                </div>

            </div>
        </div>
    </section>

@include('footer')
