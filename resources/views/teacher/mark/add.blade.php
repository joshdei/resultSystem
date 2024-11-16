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
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCity" placeholder="City" />
                                        <label for="floatingCity">Student Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelect" aria-label="State">
                                        <option selected>SESSION</option>
                                        <option value="1">2023/2024</option>
                                        <option value="2">2024/2025</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingZip" placeholder="Zip" />
                                    <label for="floatingZip">ID</label>
                                </div>
                            </div>
                            <br />
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCity" placeholder="City" />
                                        <label for="floatingCity">Student Class</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelect" aria-label="State">
                                        <option selected>Sex</option>
                                        <option value="1">MALE</option>
                                        <option value="2">FEMALE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelect" aria-label="State">
                                        <option selected>TERM</option>
                                        <option value="1">MALE</option>
                                        <option value="2">FEMALE</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCity" placeholder="City" />
                                        <label for="floatingCity">Class size</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCity" placeholder="City" />
                                        <label for="floatingCity">ATTENDANCE</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingCity" placeholder="City" />
                                        <label for="floatingCity">DAYS SCHOOL OPENED</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Subject Table</h5>

                                    <!-- Default Table -->
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

                                        </tbody>
                                    </table>
                                    <!-- End Default Table Example -->
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
                                            <td><input type="checkbox" name="class-participation" value="5"></td>
                                            <td><input type="checkbox" name="class-participation" value="4"></td>
                                            <td><input type="checkbox" name="class-participation" value="3"></td>
                                            <td><input type="checkbox" name="class-participation" value="2"></td>
                                            <td><input type="checkbox" name="class-participation" value="1"></td>
                                          </tr>
                                          <tr>
                                            <td>SCHOOL ATTENDANCE</td>
                                            <td><input type="checkbox" name="school-attendance" value="5"></td>
                                            <td><input type="checkbox" name="school-attendance" value="4"></td>
                                            <td><input type="checkbox" name="school-attendance" value="3"></td>
                                            <td><input type="checkbox" name="school-attendance" value="2"></td>
                                            <td><input type="checkbox" name="school-attendance" value="1"></td>
                                          </tr>
                                          <tr>
                                            <td>CONCENTRATION</td>
                                            <td><input type="checkbox" name="concentration" value="5"></td>
                                            <td><input type="checkbox" name="concentration" value="4"></td>
                                            <td><input type="checkbox" name="concentration" value="3"></td>
                                            <td><input type="checkbox" name="concentration" value="2"></td>
                                            <td><input type="checkbox" name="concentration" value="1"></td>
                                          </tr>
                                          <tr>
                                            <td>ATTITUDE TO PROPERTY</td>
                                            <td><input type="checkbox" name="attitude-to-property" value="5"></td>
                                            <td><input type="checkbox" name="attitude-to-property" value="4"></td>
                                            <td><input type="checkbox" name="attitude-to-property" value="3"></td>
                                            <td><input type="checkbox" name="attitude-to-property" value="2"></td>
                                            <td><input type="checkbox" name="attitude-to-property" value="1"></td>
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
                                            <td><input type="checkbox" name="assignment" value="5"></td>
                                            <td><input type="checkbox" name="assignment" value="4"></td>
                                            <td><input type="checkbox" name="assignment" value="3"></td>
                                            <td><input type="checkbox" name="assignment" value="2"></td>
                                            <td><input type="checkbox" name="assignment" value="1"></td>
                                          </tr>
                                          <tr>
                                            <td>CLEANLINESS</td>
                                            <td><input type="checkbox" name="cleanliness" value="5"></td>
                                            <td><input type="checkbox" name="cleanliness" value="4"></td>
                                            <td><input type="checkbox" name="cleanliness" value="3"></td>
                                            <td><input type="checkbox" name="cleanliness" value="2"></td>
                                            <td><input type="checkbox" name="cleanliness" value="1"></td>
                                          </tr>
                                          <tr>
                                            <td>PUNCTUALITY</td>
                                            <td><input type="checkbox" name="punctuality" value="5"></td>
                                            <td><input type="checkbox" name="punctuality" value="4"></td>
                                            <td><input type="checkbox" name="punctuality" value="3"></td>
                                            <td><input type="checkbox" name="punctuality" value="2"></td>
                                            <td><input type="checkbox" name="punctuality" value="1"></td>
                                          </tr>
                                          <tr>
                                            <td>GENERAL CONDUCT</td>
                                            <td><input type="checkbox" name="general-conduct" value="5"></td>
                                            <td><input type="checkbox" name="general-conduct" value="4"></td>
                                            <td><input type="checkbox" name="general-conduct" value="3"></td>
                                            <td><input type="checkbox" name="general-conduct" value="2"></td>
                                            <td><input type="checkbox" name="general-conduct" value="1"></td>
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
                                          
                                          <br>
                                      
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
                                          <br>
                                      
                                          <div class="form-group">
                                            <label for="outstandingFees"><strong>Outstanding Fees:</strong></label>
                                            <input type="number" id="outstandingFees" name="outstandingFees" class="form-control" value="0" placeholder="Enter outstanding fees" />
                                          </div>
                                          <div class="form-group">
                                            <label for="nextTermFees"><strong>Next Term Fees:</strong></label>
                                            <input type="number" id="nextTermFees" name="nextTermFees" class="form-control" value="0" placeholder="Enter next term fees" />
                                          </div>
                                          
                                          <strong>Date of Resumption:</strong> April 22, 2024<br>
                                        </p>
                                      </div>
                                      
                                  </div>
                              
                                  <div class="row mt-3">
                                    <div class="col-md-6">
                                      <p><strong>Class Teacher:</strong> MRS PRISCA AKASIGBO</p>
                                    </div>
                                    <div class="col-md-6 text-end">
                                      <p><strong>Head Teacher:</strong> MRS HOPE AWERO</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                        </form>
                        <!-- End floating Labels Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('footer')
</main>
