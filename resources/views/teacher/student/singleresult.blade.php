<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termly Academic Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<style type="css/style">
    .watermark-container {
    position: relative;
}

.watermark-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 5rem; /* Adjust the size as needed */
    color: rgba(0, 0, 0, 0.1); /* Light grey color with opacity */
    white-space: nowrap;
    pointer-events: none; /* Prevent interaction with the watermark */
    z-index: 1;
    transform: rotate(-45deg); /* Rotate the watermark text */
    user-select: none; /* Prevent selection */
}

.content {
    position: relative;
    z-index: 2; /* Ensure content is above the watermark */
}

    </style>
<body>
    <div class="container mt-5">
        @foreach ($school_information as $item)
        <div class="row my-4 border border-dark p-3">
            <div class="col-md-5">
                <div class="col-md-3 text-center">
                    <img src="{{ asset('school_logo') }}" alt="Student Photo" class="img-fluid rounded-circle" style="height: 150px;">
                </div>
            </div> 
            <div class="col-md-5">
                <div class="text-center" style="padding: 10px 0; margin: 0;">
                    <h2 class="watermark-text" style="margin-bottom: 5px; line-height: 1.2;">{{ $item->school_name }}</h2>
                    <p style="margin: 2px 0; line-height: 1.2;">{{ $item->school_motto }}</p>
                    <p style="margin: 2px 0; line-height: 1.2;">{{ $item->school_address }} {{ $item->school_phone }} {{ $item->school_email }}</p>
                    <br>
                    <h3 class="text-decoration-underline blue-text" style="color: blue; margin-top: 10px;">TERMLY ACADEMIC REPORT</h3>
                </div>
            </div>
            
            @endforeach
        </div>
        
       

        <!-- Student Information -->
        <div class="row my-4 border border-dark p-3">
            <div class="col-md-6">
                <p><strong>NAME:</strong> <span style="color: black;">{{ strtoupper($student->firstname . ' ' . $student->lastname) }}</span></p>
                <p><strong>STUDENT ID:</strong> <span style="color: black;">{{ $student->student_identication }}</span></p>
                <p><strong>SEX:</strong> <span style="color: black;">{{ strtoupper($student->gender) }}</span></p>
                <p><strong>POSITION:</strong> <span style="color: black;">{{ $position }}{{ $position == 1 ? 'st' : ($position == 2 ? 'nd' : ($position == 3 ? 'rd' : 'th')) }}</span></p>
                <p><strong>HIGHEST CLASS AVERAGE:</strong> <span style="color: black;">{{ $highestAverage}}</span></p>
                <p><strong>LOWEST CLASS AVERAGE:</strong> <span style="color: black;">{{ number_format($lowestAverage, 2) }}</span></p>
            </div>
            
            <div class="col-md-3">
                <p><strong>SESSION:</strong> <span style="color: black;">{{ $session ?? 'N/A' }}</span></p>
                <p><strong>CLASS:</strong> <span style="color: black;">{{ $className ?? 'N/A' }} {{ $classArm ?? 'N/A' }}</span></p>
                <p><strong>TERM:</strong> <span style="color: black;">{{ $term ?? 'N/A' }}</span></p>
                <p><strong>CLASS SIZE:</strong> <span style="color: black;">{{ $classSize ?? 'N/A' }}</span></p>
                <p><strong>DAYS SCHOOL OPENED:</strong> <span style="color: black;">{{ $daysSchoolOpened ?? 'N/A' }}</span></p>
                <p><strong>ATTENDANCE:</strong> <span style="color: black;">{{ $attendance ?? 'N/A' }}</span></p>
            </div>
            
            
            <div class="col-md-3 text-center">
                <img src="profile.jpg" alt="Student Photo" class="img-fluid rounded-circle" style="height: 150px;">
            </div>
        </div>

        @php
        $totalSubjects = count($marks); // Number of subjects
        $maxTotalScore = $totalSubjects * 100; // Total possible score
        $obtainedTotalScore = 0; // Initialize total score obtained
    
        foreach ($marks as $subjectId => $markDetails) {
            $firstTest = $markDetails['first_test'] ?? 0;
            $secondTest = $markDetails['second_test'] ?? 0;
            $exam = $markDetails['exam'] ?? 0;
    
            $obtainedTotalScore += $firstTest + $secondTest + $exam; // Accumulate scores
        }
    @endphp
    
    <p class="text-start">
        <strong>TOTAL SCORE OBTAINED:</strong> {{ $obtainedTotalScore }} out of {{ $maxTotalScore }}
    </p>
    
    <!-- Results Table -->
    @if($marks)
        <table class="table table-bordered text-center border border-dark p-3">
            <thead>
                <tr>
                    <th style="color: blue">SN</th>
                    <th style="color: blue">SUBJECT</th>
                    <th style="color: blue">1ST TEST (10%)</th>
                    <th style="color: blue">2ND TEST (10%)</th>
                    <th style="color: blue">EXAM (80%)</th>
                    <th style="color: blue">TOTAL (100%)</th>
                    <th style="color: blue">SUBJECT AVERAGE</th>
                    <th style="color: blue">SUBJECT POSITION</th>
                    <th style="color: blue">REMARK</th>
                </tr>
            </thead>
            <tbody>
                @php $sn = 1; @endphp
                @foreach($marks as $subjectId => $markDetails)
                    @php
                        $subjectName = $subjectNames[$subjectId] ?? 'Unknown Subject';
                        $firstTest = $markDetails['first_test'] ?? 0;
                        $secondTest = $markDetails['second_test'] ?? 0;
                        $exam = $markDetails['exam'] ?? 0;
    
                        $total = $firstTest + $secondTest + $exam;
                        $average = $subjectDetails[$subjectId]['average'] ?? 0;
                        $position = $subjectDetails[$subjectId]['position'] ?? 'N/A';
    
                        $remark = $total >= 90 ? 'Excellent' :
                                  ($total >= 85 ? 'Very Good' :
                                  ($total >= 80 ? 'Very Good' :
                                  ($total >= 70 ? 'Good' :
                                  ($total >= 60 ? 'Fair' :
                                  ($total >= 50 ? 'Satisfactory' :
                                  ($total >= 40 ? 'Pass' : 'Fail'))))));
                    @endphp
                    <tr>
                        <td>{{ $sn++ }}</td>
                        <td>{{ $subjectName }}</td>
                        <td>{{ $firstTest }}</td>
                        <td>{{ $secondTest }}</td>
                        <td>{{ $exam }}</td>
                        <td>{{ number_format($total, 2) }}</td>
                        <td>{{ is_numeric($average) ? number_format($average, 2) : 'N/A' }}</td>
                        <td>{{ $position }}</td>
                        <td>{{ $remark }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No marks available for this student.</p>
    @endif
    

    
    <div class="row border border-dark p-3">
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
                    @php
                        $behaviors = [
                            'class_participation' => 'Class Participation',
                            'school_attendance' => 'School Attendance',
                            'concentration' => 'Concentration',
                            'attitude_to_property' => 'Attitude to Property',
                        ];
                    @endphp
                    @foreach ($behaviors as $key => $label)
                        <tr>
                            <td style="font-weight: bold;">{{ $label }}</td>
                            @for ($i = 5; $i >= 1; $i--)
                                <td>
                                    <input 
    class="form-check-input border border-dark bg-dark text-light" 
    type="radio" 
    name="{{ $key }}" 
    value="{{ $i }}" 
    {{ isset($behaviorAttributes[$key]) && $behaviorAttributes[$key] == $i ? 'checked' : '' }} 
    disabled 
/>

                                </td>
                            @endfor
                        </tr>
                    @endforeach
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
                    @php
                        $additionalBehaviors = [
                            'assignment' => 'Assignment',
                            'cleanliness' => 'Cleanliness',
                            'punctuality' => 'Punctuality',
                            'general_conduct' => 'General Conduct',
                        ];
                    @endphp
                    @foreach ($additionalBehaviors as $key => $label)
                        <tr style="font-weight: bold;">
                            <td>{{ $label }}</td>
                            @for ($i = 5; $i >= 1; $i--)
                                <td style="font-weight: bold;">
                                    <input class="form-check-input border border-dark bg-dark text-light"  type="radio" name="{{ $key }}" value="{{ $i }}" 
                                        {{ isset($behaviorAttributes[$key]) && $behaviorAttributes[$key] == $i ? 'checked' : '' }} disabled />
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
<!-- Remarks Section -->
<div class="row border border-dark p-3">
    <div class="col-md-6">
        @php
        $totalSubjects = count($marks); // Number of subjects
        $maxTotalScore = $totalSubjects * 100; // Maximum possible score
        $totalscoreobtaine = 0; // Initialize total score obtained
    
        foreach ($marks as $subjectId => $markDetails) {
            $firstTest = $markDetails['first_test'] ?? 0;
            $secondTest = $markDetails['second_test'] ?? 0;
            $exam = $markDetails['exam'] ?? 0;
    
            $totalscoreobtaine += $firstTest + $secondTest + $exam; // Accumulate total score
        }
    
        // Calculate the cumulative average
        $cumulativeAverage = $totalSubjects > 0 ? ($totalscoreobtaine / $totalSubjects) : 0; // Average per subject
    @endphp
    
    <p class="text-start">
        <strong>TOTAL SCORE OBTAINED:</strong><strong>  {{ $totalscoreobtaine }}</strong>  OUT OF <strong>{{ $maxTotalScore }}</strong>
    </p>
    <p class="text-start"><strong>OUTSTANDING FEES:</strong> ₦{{ number_format($outstandingFees, 2) }}</p>

</div>
    <div class="col-md-6">
        <p class="text-start">
            <strong>CUMULATIVE AVERAGE:</strong> {{ number_format($cumulativeAverage, 2) }}
        </p> 
        <p class="text-start"><strong>NEXT TERM FEES:</strong>  ₦{{ $nextTermFees }}</p>
    </div>
    
 
    <p class="text-start"><strong>DATE OF RESUMPTION:</strong>  {{ ucwords($resumptionDate) }}</p>

    </div>
    

<div class="row border border-dark p-3">
   
    <div class="col-md-6 text-start">
        <p>
            <strong>Class Teacher's Remark:</strong> 
            {{ $classRemark }}
        </p>
        <p>
            <strong>Class Teacher's:</strong> 
            {{ $teacher_name }}
        </p>
    </div>
    <div class="col-md-6 text-end">
        <p>
            <strong>Head Teacher's Remark:</strong> 
            {{ $headRemark }}
        </p>
        <p>
            <strong>Head Teacher's:</strong> 
            {{ $headteacher_name }}
        </p>
    </div>
</div>


       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
