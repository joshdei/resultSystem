<h1>Student Results</h1>

<p>Student Name: {{ $student->firstname }} {{ $student->lastname }}</p>
<p>Total Students in Class: {{ $totalStudentsInClass }}</p>

<h3>Marks of {{ $student->firstname }}:</h3>
@if($marks)
    <ul>
        @foreach($marks as $subjectId => $mark)
            <li>
                <strong>Subject: {{ $subjectNames[$subjectId] ?? 'Unknown Subject' }}</strong>
                <ul>
                    @foreach($mark as $test => $score)
                        <li>{{ ucfirst($test) }}: {{ $score }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
@else
    <p>No marks available for this student.</p>
@endif
