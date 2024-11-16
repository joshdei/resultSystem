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
                        <h5 class="card-title">Horizontal Form</h5>

                        <form class="row g-3">
                            <!-- Student Name -->
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCity" placeholder="Student Name" value="{{ $students->first()->name ?? '' }}" />
                                        <label for="floatingCity">Student Name</label>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Session -->
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelect" aria-label="State">
                                        <option selected>SESSION</option>
                                        @foreach($getSession as $session)
                                            <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        
                            <!-- Student ID -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingZip" placeholder="ID" value="{{ $students->first()->id ?? '' }}" />
                                    <label for="floatingZip">ID</label>
                                </div>
                            </div>
                        
                            <!-- Student Class -->
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCity" placeholder="Class" value="{{ $getClass->first()->class_name ?? '' }}" />
                                        <label for="floatingCity">Student Class</label>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Gender -->
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelect" aria-label="Sex">
                                        <option selected>Sex</option>
                                        <option value="1" {{ $students->first()->gender == 'Male' ? 'selected' : '' }}>MALE</option>
                                        <option value="2" {{ $students->first()->gender == 'Female' ? 'selected' : '' }}>FEMALE</option>
                                    </select>
                                </div>
                            </div>
                        
                            <!-- Term -->
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelect" aria-label="Term">
                                        <option selected>TERM</option>
                                        <option value="1">1st Term</option>
                                        <option value="2">2nd Term</option>
                                        <option value="3">3rd Term</option>
                                    </select>
                                </div>
                            </div>
                        
                            <!-- Class Size -->
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCity" placeholder="Class Size" value="{{ $getClass->first()->class_size ?? '' }}" />
                                        <label for="floatingCity">Class size</label>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Attendance -->
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCity" placeholder="Attendance" />
                                        <label for="floatingCity">ATTENDANCE</label>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Days School Opened -->
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCity" placeholder="Days School Opened" />
                                        <label for="floatingCity">DAYS SCHOOL OPENED</label>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Subject Table -->
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
                                                        <td><input type="checkbox" name="class-participation" value="5"></td>
                                                        <td><input type="checkbox" name="class-participation" value="4"></td>
                                                        <td><input type="checkbox" name="class-participation" value="3"></td>
                                                        <td><input type="checkbox" name="class-participation" value="2"></td>
                                                        <td><input type="checkbox" name="class-participation" value="1"></td>
                                                    </tr>
                                                    <!-- Add other behaviour rows here -->
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
                                                        <td><input type="checkbox" name="assignment" value="5"></td>
                                                        <td><input type="checkbox" name="assignment" value="4"></td>
                                                        <td><input type="checkbox" name="assignment" value="3"></td>
                                                        <td><input type="checkbox" name="assignment" value="2"></td>
                                                        <td><input type="checkbox" name="assignment" value="1"></td>
                                                    </tr>
                                                    <!-- Add other behaviour rows here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                        
                                    <!-- Class Teacher's Remark -->
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a remark here" id="floatingRemark" style="height: 100px"></textarea>
                                                <label for="floatingRemark">Class Teacher's Remark</label>
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
