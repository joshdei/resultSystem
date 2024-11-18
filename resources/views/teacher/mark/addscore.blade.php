@include('header') @include('topheader') @include('sidebar')

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
                        <h5 class="card-title">Scores Form</h5>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('submitMarks') }}">
                            @csrf
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            <input type="text" class="form-control" id="floatingCity" value="{{ $student_id }}" hidden name="student_id" />
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingCity" value="{{ $firstname }} {{ $lastname }}" placeholder="City" readonly />
                                            <label for="floatingCity">Student Name</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" aria-label="State" name="school_session">
                                            @foreach ($schoolSession as $item)
                                            <option value="{{ $item->session }}">{{ $item->session }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCity" value="{{ $student_identication }}" placeholder="City" readonly />
                                        <label for="floatingZip">ID</label>
                                    </div>
                                </div>

                                <br />
                                <input type="text" class="form-control" id="floatingCity" value="{{ $class_id }}" hidden name="class_id" />
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingCity" value="{{ $class_name }} {{ $class_arm }}" readonly />
                                            <label for="floatingCity">Student Class</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingCity" value="{{ $gender }}" readonly />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" aria-label="State" name="term">
                                            @foreach ($term as $item)
                                            <option value="{{ $item->term }}">{{ $item->term }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <br />

                                <div class="row mb-3">
                                    <!-- Class Size -->
                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="floatingCity" value="{{ $class_size }}" readonly />
                                                <label for="floatingCity">Class Size</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Attendance -->
                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="floatingCity" name="attendance" placeholder="City" />
                                                <label for="floatingCity">ATTENDANCE</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- School Opening Number -->
                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" aria-label="State">
                                                    @foreach ($SchoolOpening as $item)
                                                    <option value="{{ $item->number }}">{{ $item->number }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Subject Marks Table -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Subject Table</h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">S/N</th>
                                                    <th scope="col">SUBJECT</th>
                                                    <th scope="col">1ST TEST</th>
                                                    <th scope="col">2ND TEST</th>
                                                    <th scope="col">EXAM</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Subject as $key => $subject)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $subject->id }}</td>
                                                    <td>{{ $subject->subject_name }}</td>
                                                    <td>
                                                        <input type="number" name="marks[{{ $subject->id }}][first_test]" class="form-control" placeholder="Enter 1st Test" required />
                                                    </td>
                                                    <td>
                                                        <input type="number" name="marks[{{ $subject->id }}][second_test]" class="form-control" placeholder="Enter 2nd Test" required />
                                                    </td>
                                                    <td>
                                                        <input type="number" name="marks[{{ $subject->id }}][exam]" class="form-control" placeholder="Enter Exam" required />
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card">
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
                                                            <td><input type="radio" name="class_participation" value="5" /></td>
                                                            <td><input type="radio" name="class_participation" value="4" /></td>
                                                            <td><input type="radio" name="class_participation" value="3" /></td>
                                                            <td><input type="radio" name="class_participation" value="2" /></td>
                                                            <td><input type="radio" name="class_participation" value="1" /></td>
                                                        </tr>

                                                        <tr>
                                                            <td>SCHOOL ATTENDANCE</td>
                                                            <td><input type="radio" name="school_attendance" value="5" /></td>
                                                            <td><input type="radio" name="school_attendance" value="4" /></td>
                                                            <td><input type="radio" name="school_attendance" value="3" /></td>
                                                            <td><input type="radio" name="school_attendance" value="2" /></td>
                                                            <td><input type="radio" name="school_attendance" value="1" /></td>
                                                        </tr>

                                                        <tr>
                                                            <td>CONCENTRATION</td>
                                                            <td><input type="radio" name="concentration" value="5" /></td>
                                                            <td><input type="radio" name="concentration" value="4" /></td>
                                                            <td><input type="radio" name="concentration" value="3" /></td>
                                                            <td><input type="radio" name="concentration" value="2" /></td>
                                                            <td><input type="radio" name="concentration" value="1" /></td>
                                                        </tr>

                                                        <tr>
                                                            <td>ATTITUDE TO PROPERTY</td>
                                                            <td><input type="radio" name="attitude_to_property" value="5" /></td>
                                                            <td><input type="radio" name="attitude_to_property" value="4" /></td>
                                                            <td><input type="radio" name="attitude_to_property" value="3" /></td>
                                                            <td><input type="radio" name="attitude_to_property" value="2" /></td>
                                                            <td><input type="radio" name="attitude_to_property" value="1" /></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
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
                                                            <td>ASSIGNMENT</td>
                                                            <td><input type="checkbox" name="assignment" value="5" /></td>
                                                            <td><input type="checkbox" name="assignment" value="4" /></td>
                                                            <td><input type="checkbox" name="assignment" value="3" /></td>
                                                            <td><input type="checkbox" name="assignment" value="2" /></td>
                                                            <td><input type="checkbox" name="assignment" value="1" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>CLEANLINESS</td>
                                                            <td><input type="checkbox" name="cleanliness" value="5" /></td>
                                                            <td><input type="checkbox" name="cleanliness" value="4" /></td>
                                                            <td><input type="checkbox" name="cleanliness" value="3" /></td>
                                                            <td><input type="checkbox" name="cleanliness" value="2" /></td>
                                                            <td><input type="checkbox" name="cleanliness" value="1" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>PUNCTUALITY</td>
                                                            <td><input type="checkbox" name="punctuality" value="5" /></td>
                                                            <td><input type="checkbox" name="punctuality" value="4" /></td>
                                                            <td><input type="checkbox" name="punctuality" value="3" /></td>
                                                            <td><input type="checkbox" name="punctuality" value="2" /></td>
                                                            <td><input type="checkbox" name="punctuality" value="1" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td>GENERAL CONDUCT</td>
                                                            <td><input type="checkbox" name="general_conduct" value="5" /></td>
                                                            <td><input type="checkbox" name="general_conduct" value="4" /></td>
                                                            <td><input type="checkbox" name="general_conduct" value="3" /></td>
                                                            <td><input type="checkbox" name="general_conduct" value="2" /></td>
                                                            <td><input type="checkbox" name="general_conduct" value="1" /></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <p>
                                                    <strong>Class Teacher's Remark:</strong>
                                                    <select name="class_remark" class="form-control">
                                                        <option value="consistently demonstrates outstanding academic performance and is a role model for her peers.">
                                                            Consistently demonstrates outstanding academic performance and is a role model for her peers.
                                                        </option>
                                                        <option value="is diligent and hardworking, with a positive attitude toward her studies and classmates.">
                                                            Is diligent and hardworking, with a positive attitude toward her studies and classmates.
                                                        </option>
                                                        <option value="is disciplined, focused, and always eager to learn new concepts.">
                                                            Is disciplined, focused, and always eager to learn new concepts.
                                                        </option>
                                                        <option value="shows excellent leadership skills and inspires her peers to work collaboratively.">
                                                            Shows excellent leadership skills and inspires her peers to work collaboratively.
                                                        </option>
                                                        <option value="is creative and proactive, regularly contributing fresh ideas during class discussions.">
                                                            Is creative and proactive, regularly contributing fresh ideas during class discussions.
                                                        </option>
                                                        <option value="struggles to stay focused during lessons and often submits assignments late.">
                                                            Struggles to stay focused during lessons and often submits assignments late.
                                                        </option>
                                                        <option value="frequently disrupts the class and needs to work on her self-discipline.">
                                                            Frequently disrupts the class and needs to work on her self-discipline.
                                                        </option>
                                                        <option value="needs to manage her time better, as she often fails to complete tasks within the deadline.">
                                                            Needs to manage her time better, as she often fails to complete tasks within the deadline.
                                                        </option>
                                                        <option value="participates minimally in class activities and needs encouragement to engage more actively.">
                                                            Participates minimally in class activities and needs encouragement to engage more actively.
                                                        </option>
                                                        <option value="performance is inconsistent, and she needs to put in more effort to meet her potential.">
                                                            Performance is inconsistent, and she needs to put in more effort to meet her potential.
                                                        </option>
                                                    </select>

                                                    <br />

                                                    <strong>Head Teacher's Remark:</strong>
                                                    <select name="head_remark" class="form-control">
                                                        <option value="An excellent performance. Do not relent in your studies.">
                                                            An excellent performance. Do not relent in your studies.
                                                        </option>
                                                        <option value="Keep up the outstanding work. Your efforts are commendable.">
                                                            Keep up the outstanding work. Your efforts are commendable.
                                                        </option>
                                                        <option value="You have done remarkably well. Aim even higher next term.">
                                                            You have done remarkably well. Aim even higher next term.
                                                        </option>
                                                        <option value="This is a remarkable achievement. Your focus is exemplary.">
                                                            This is a remarkable achievement. Your focus is exemplary.
                                                        </option>
                                                        <option value="Great job this term. Remember, consistency is key to success.">
                                                            Great job this term. Remember, consistency is key to success.
                                                        </option>
                                                        <option value="Needs improvement. Focus on your weaker areas for better performance.">
                                                            Needs improvement. Focus on your weaker areas for better performance.
                                                        </option>
                                                        <option value="Your potential is evident, but you need to work harder to achieve your goals.">
                                                            Your potential is evident, but you need to work harder to achieve your goals.
                                                        </option>
                                                        <option value="Your performance is below expectations. Please put in more effort.">
                                                            Your performance is below expectations. Please put in more effort.
                                                        </option>
                                                        <option value="You need to stay more consistent in your studies. Improvement is necessary.">
                                                            You need to stay more consistent in your studies. Improvement is necessary.
                                                        </option>
                                                        <option value="Please take feedback seriously and aim for significant improvement.">
                                                            Please take feedback seriously and aim for significant improvement.
                                                        </option>
                                                    </select>
                                                    <br />
                                                </p>

                                                <div class="form-group">
                                                    <label for="outstandingFees"><strong>Outstanding Fees:</strong></label>
                                                    <input type="number" id="outstandingFees"  name="outstanding_fees" class="form-control" value="0" placeholder="Enter outstanding fees" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="nextTermFees"><strong>Next Term Fees:</strong></label>
                                                    <input type="number" id="nextTermFees" name="next_term_fees" class="form-control" value="0" placeholder="Enter next term fees" />
                                                </div>

                                                <strong>Date of Resumption:</strong>
                                                <select class="form-select" id="floatingSelect" aria-label="State" name="school_opening_number">
                                                    @foreach ($AssignResumption as $item)
                                                    <option value="{{ $item->date }}">{{ $item->date }}</option>
                                                    @endforeach
                                                </select>
                                                <br />
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <p>
                                                    <strong>Class Teacher:</strong>
                                                    <select id="floatingSelect" aria-label="State">
                                                        @foreach ($AssignClassTeacher as $item)
                                                        <option value="{{ $item->teacher_fullname }}">
                                                            {{ $item->teacher_fullname }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <p>
                                                    <strong>Head Teacher:</strong>
                                                    <select id="floatingSelect" aria-label="State">
                                                        @foreach ($AssignHeadClassTeacher as $item)
                                                        <option value="{{ $item->headteacher_fullname }}">
                                                            {{ $item->headteacher_fullname }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit Marks</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Function to handle the change event for class teacher and head teacher
            const classTeacherSelect = document.querySelector('#floatingSelect[class="classTeacher"]');
            const headTeacherSelect = document.querySelector('#floatingSelect[class="headTeacher"]');

            // Optionally, add an event listener to capture any change or submission
            classTeacherSelect.addEventListener("change", function () {
                const selectedTeacher = classTeacherSelect.value;
                console.log("Class Teacher selected:", selectedTeacher);

                // If needed, send the selection to the server via AJAX or update related content
                updateTeacherSelection("class", selectedTeacher);
            });

            headTeacherSelect.addEventListener("change", function () {
                const selectedTeacher = headTeacherSelect.value;
                console.log("Head Teacher selected:", selectedTeacher);

                // If needed, send the selection to the server via AJAX or update related content
                updateTeacherSelection("head", selectedTeacher);
            });

            // Function to send the selected teacher data to the server
            function updateTeacherSelection(type, teacherName) {
                fetch(`/update-teacher-selection`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    },
                    body: JSON.stringify({
                        teacher_type: type,
                        teacher_name: teacherName,
                    }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log(data);
                        // You can update the UI based on the server response
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            }
        });
    </script>
    @include('footer')
</main>
