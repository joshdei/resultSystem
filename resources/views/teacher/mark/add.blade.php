@include('header')
@include('topheader')
@include('sidebar')

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('access') }}">Home</a></li>
                <li class="breadcrumb-item">Marks</li>
                <li class="breadcrumb-item active">Add Marks</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Horizontal Form</h5>

                        <form class="row g-3" method="POST" action="{{ route('marks.store') }}">
                            @csrf
                            <!-- Student Name -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="studentName" name="student_name" placeholder="Student Name" value="{{ $students->first()->name ?? '' }}" />
                                    <label for="studentName">Student Name</label>
                                </div>
                            </div>

                            <!-- Session -->
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="session" name="session" aria-label="State">
                                        <option selected>SESSION</option>
                                        @foreach($getSession as $session)
                                            <option value="{{ $session->id }}">{{ $session->session }}</option>
                                        @endforeach
                                    </select>
                                    <label for="session">Session</label>
                                </div>
                            </div>

                            <!-- Other fields like Student ID, Class, Gender, Term, etc. -->
                            <!-- ... -->

                            <!-- Subject Table -->
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h5 class="card-title">Subject Table</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>S/N</th>
                                                <th>SUBJECT</th>
                                                <th>1ST TEST</th>
                                                <th>2ND TEST</th>
                                                <th>EXAM</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($getSubjectOfTheClass as $index => $subject)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $subject->id }}</td>
                                                    <td>{{ $subject->subject_name }}</td>
                                                    <td><input type="number" name="test_1[{{ $subject->id }}]" class="form-control" /></td>
                                                    <td><input type="number" name="test_2[{{ $subject->id }}]" class="form-control" /></td>
                                                    <td><input type="number" name="exam[{{ $subject->id }}]" class="form-control" /></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Student Behaviour Report -->
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h5 class="card-title">Student Behaviour Report</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>BEHAVIOUR</th>
                                                        <th>5</th>
                                                        <th>4</th>
                                                        <th>3</th>
                                                        <th>2</th>
                                                        <th>1</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>CLASS PARTICIPATION</td>
                                                        @for($i = 5; $i >= 1; $i--)
                                                            <td><input type="radio" name="class_participation" value="{{ $i }}"></td>
                                                        @endfor
                                                    </tr>
                                                    <!-- Add other behaviour rows here -->
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Add second table -->
                                    </div>

                                    <!-- Class Teacher's Remark -->
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" name="remark" id="classRemark" placeholder="Leave a remark here" style="height: 100px"></textarea>
                                                <label for="classRemark">Class Teacher's Remark</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Save Marks</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('footer')
</main>
