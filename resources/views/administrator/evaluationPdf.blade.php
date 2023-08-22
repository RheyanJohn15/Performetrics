<!DOCTYPE html>
    <html>
    <head>
      
      <title>Evaluation Data</title>

      <style>
        body {
          margin: 0;
          padding: 0;
        }
    
        .header {
          width:100%;
          padding: 10px;
          text-align: center;
        }
    
        .logo {
          display: inline-block;
          vertical-align: top;
        }
    .title{
     width:100%;
     text-align:center;
     margin-top:10px
    }
    .table {
        width: 100%;
        padding: 0;
        border-collapse: collapse; /* Add this line to collapse the border spacing */
      }
      
      .table tr {
        margin: 0;
      }
      hr{
        color:white;
      }
      .table th,
      .table td {
        border: 1px solid black;
        margin: 0px;
        padding: 5px; /* Add padding to create space between the cell content and border */
      }
      
      </style>
      <link rel="icon" href="{{asset('images/icon.png')}}">
   
    </head>
    <body>
      <div class="header">
        <img class="logo" src="data:image/jpeg;base64,{{ $logoData }}" alt="Logo" width="200" height="200">
        <h3>NOTRE DAME OF TALISAY CITY-NEGROS OCCIDENTAL, INC.</h3>
        <p>Capitan Sabi St, Carmela Valley Homes, Talisay City</p>
      </div>
      @php
      $teacher= App\Models\Teacher::where('id', $teacher_id)->first();
      if($teacher->teacher_suffix==="none"){
          $finalSuffix= "";
      }else{
          $finalSuffix= $teacher->teacher_suffix;
      }
      $fullname= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ". $teacher->teacher_last_name. " ". $finalSuffix;
      $questions1= App\Models\Question::where('question_criteria', 'TEACHER ACTIONS')->get();
      $questions2= App\Models\Question::where('question_criteria', 'STUDENT LEARNING ACTIONS')->get();
      $s=1;
      $t=1;
      $totalScore1=[];
      $totalScore2=[];
      @endphp
     <div class="title">
       <h3>Evaluation Report Summary of Ms/Mrs. <span style="color:#bda370;">{{$fullname}}</span></h3>
     </div>
    
     <table class="table">
     <thead><tr> <th>#</th>
   <th>Corresponding Questions(Teacher Actions)</th><th>Average Score</th>
  </tr></thead><tbody>
  @foreach($questions1 as $question)
  @php
  $evaluation= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('question_id', $question->id)->where('teacher_id', $teacher_id)->get();
  
  $totalScore= $evaluation->sum('evaluation_score');
  $totalRows= $evaluation->count('evaluation_score');
  
  if($totalScore===0 || $totalRows===0){
      $average="Incomplete Data";
  }else{
      $averageScore= $totalScore/$totalRows;
      $average=number_format($averageScore, 2);
      array_push($totalScore1, $average);   
  }
  
  @endphp
  <tr><td>{{$s}}</td><td>{{$question->question_content}}</td><td>{{$average}}</td></tr>
  
  @php $s++; @endphp
  @endforeach
  @php
  if(array_sum($totalScore1)===0 || count($totalScore1)===0){
    $totalAverage1=0;
  }else{
    $totalAverage1= array_sum($totalScore1)/count($totalScore1);
  }

  
  if($totalAverage1==4){
    $teacherStrong= "Exemplary";
          $TeacherRemarks=" The teacher consistently communicates clear expectations, utilizes various learning    
          materials and strategies, monitors student learning effectively, provides appropriate  
         feedback, manages the classroom environment and time efficiently, and engages students
         in higher-order thinking related to the unit standards and competencies";
        }else if($totalAverage1>=3 && $totalAverage1<4){
          $teacherStrong= "Proficient";
          $TeacherRemarks=" The teacher communicates clear expectations, utilizes a variety of learning materials 
          and strategies, monitors student learning, provides feedback, manages the classroom 
          environment and time effectively, and asks questions to assess understanding of the 
          unit standards and competencies. ";
        }else if($totalAverage1>=2 && $totalAverage1<3){
          $teacherStrong= "Developing";
          $TeacherRemarks=" The teacher partially communicates clear expectations, uses some learning materials and
          strategies, inconsistently monitors student learning, provides limited feedback,
          requires improvement in managing the classroom environment and time, and occasionally
          asks questions to assess understanding of the unit standards and competencies. ";
        }else if($totalAverage1 >=1 && $totalAverage1<2){
          $teacherStrong= "Below Expectations";
          $TeacherRemarks=" The teacher does not effectively communicate clear expectations, lacks variety in
          earning materials and strategies, rarely monitors student learning, provides minimal
          feedback or interventions, struggles to manage the classroom environment and time, and
          rarely asks questions to assess understanding of the unit standards and competencies.";
        }else if($totalAverage1>=0 && $totalAverage1<1 ){
          $teacherStrong= "Below Insufficient Evidence";
          $TeacherRemarks=" There is insufficient evidence or evaluation available to assess the teacher's
          performance in relation to the given criteria.";
        }
  @endphp
  <tr style="background-color:#d1d1e0;"><td>#</td><td>Total</td><td>{{number_format($totalAverage1,3)}}</td></tr></tbody></table>
  <p style="margin-top:40px"><i>Remarks</i>:<strong><u>{{$teacherStrong}}</u></strong>-{{$TeacherRemarks}}</p>
  

<table  class="table mt-8" style="margin-top:100px">
  <thead>
  <tr><th>#</th> <th>Corresponding Questions(Student Learning Actions)</th><th>Average Score</th></tr>
  </thead>
  <tbody>
      @foreach($questions2 as $question)
      @php
  $evaluation= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('question_id', $question->id)->where('teacher_id', $teacher_id)->get();
  
  $totalScore= $evaluation->sum('evaluation_score');
  $totalRows= $evaluation->count();
  
  if($totalScore===0 && $totalRows===0){
      $average="Incomplete Data";
  }else{
      $averageScore= $totalScore/$totalRows;
      $average=number_format($averageScore, 2);
      array_push($totalScore2, $average);
    
  }
  
  @endphp
      <tr><td>{{$t}}</td><td>{{$question->question_content}}</td><td>{{$average}}</td></tr>
      @php $t++; @endphp
      @endforeach
      @php
      if(array_sum($totalScore2)===0 || count($totalScore2)){
        $totalAverage2=0;
      }else{
        $totalAverage2= array_sum($totalScore2)/count($totalScore2);
      }

  if($totalAverage2==4){
          $studentStrong="Exemplary";
          $StudentRemarks="The students consistently demonstrate high levels of engagement and actively participate in
          various learning tasks related to the unit standards and competencies. They effectively use
          different learning materials, resources, and technology to achieve learning goals. They
          actively share their ideas, reflections, and solutions, and collaborate meaningfully with
          peers. Their performance exceeds expectations in all aspects.";
      }else if($totalAverage2<4 && $totalAverage2>=3){
        $studentStrong="Proficient";
          $StudentRemarks= " The students demonstrate proficiency in engaging with learning tasks related to the unit
          standards and competencies. They effectively utilize different learning materials, resources,
          and technology to achieve learning goals. They actively share their ideas and engage in
          collaborative activities. Their performance meets expectations and shows a solid level of
          engagement. ";
      }else if($totalAverage2<3 && $totalAverage2>=2){
        $studentStrong="Developing";
          $StudentRemarks= " The students show some progress in engaging with learning tasks related to the unit standards
          and competencies. They partially utilize different learning materials, resources, and 
          technology. They attempt to share their ideas and collaborate with peers but with limited
          success. Their performance requires further improvement to meet expectations.";
      }else if($totalAverage2<2 && $totalAverage2 >=1){
        $studentStrong="Below Expectations";
          $StudentRemarks=" The students demonstrate limited engagement and struggle to actively participate in learning
          tasks related to the unit standards and competencies. They struggle to utilize different
          learning materials, resources, and technology effectively. Their performance falls below
          expectations and requires significant improvement.";
      }else if($totalAverage2<1 && $totalAverage2>=0){
        $studentStrong="Below Insufficient Evidence";
          $StudentRemarks=" There is insufficient evidence available to evaluate the students' performance in relation to
          the given criteria. ";
      }
 
  @endphp
  <tr style="background-color:#d1d1e0;"><td>#</td><td>Total</td><td>{{number_format($totalAverage2, 3)}}</td></tr></tbody></table>
  <p style="margin-top:40px"><i>Remarks</i>:<strong><u>{{$studentStrong}}<u></strong>- {{$StudentRemarks}}</p>
  
</body>
</html>

