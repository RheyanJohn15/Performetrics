<?php

namespace App\Http\Controllers;
use App\Models\EvaluationResult;
use App\Models\Question;
use App\Models\Student;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function SubmitEvaluation(Request $request){
        $question = Question::where('question_criteria', 'TEACHER ACTIONS')->count();


        for($i=1; $i<=$question; $i++){
           $data= $request->input('t'.$i);
           $remarks= $request->input('remarks');
           $teacher= $request->input('teacher_id');
           $student= $request->input('student_id');
           $questionData= $request->input('ques'.$i);

           $evaluation= EvaluationResult::where('evaluator_id', $student)->where('evaluator_type', 'Student')->where('teacher_id', $teacher)->where('question_id', $questionData)->first();
           if($evaluation){
               $evaluation->update([
                 'evaluation_score'=>$data,
                 'evaluation_remarks'=>$remarks,
               ]);
           }else{
            $result= new EvaluationResult();

            $result->evaluator_id= $student;
            $result->evaluator_type= "Student";
            $result->question_id= $questionData;
            $result->teacher_id= $teacher;
            $result->evaluation_score= $data;
            $result->evaluation_remarks= $remarks;
            $result->save();

           }
           
        }

        return redirect()->back()->with('Success', '[Evaluation Submitted]');
    }

    public function ScheduleToday(){
        return view('student.class_schedule_today');
    }
    public function ScheduleOverall(){
        return view('student.class_schedule_overall');
    }
    public function EvaluationSummary(){
        return view('student.evaluationsummary');
    }
    public function StudentProfile(){
      
        $student= Student::where('id', session('user_id'))->first();

     
        $year_level= $student->student_year_level;
        $suffix= $student->student_suffix;
      
        $trimYearLevel= substr($year_level, -2);
        if($suffix==="none"){
            $finalSuffix= " ";
        }else{
            $finalSuffix=$suffix;
        }
        $section= $student->student_section;
        $sectionQuery= Section::where('id', $section)->first();
        $fullname= $student->student_first_name. " ". substr($student->student_middle_name, 0, 1). ". ". $student->student_last_name. " ". $finalSuffix;
        return view('student.studentprofile', [
            'fullname'=>$fullname,
            'mail'=>$student->student_mail,
            'first_name'=>$student->student_first_name,
            'middle_name'=>$student->student_middle_name,
            'last_name'=>$student->student_last_name,
            'suffix'=>$suffix,
            'student_id'=>$student->student_id,
            'password'=>$student->student_password,
            'strand'=>$student->student_strand,
            'section'=>$student->student_section,
            'trimYearLevel'=>$trimYearLevel,
            'section_name'=>$sectionQuery->section,
          
        ]);
    }

    public function UpdateProfilePicStudent(Request $request){
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        // Store the file in the public folder
        $file = $request->file('picture');
        $fileName = "Student(". session('user_id'). ").". $file->getClientOriginalExtension();
        $filePath = public_path('Users/');  // Adjust the storage path as needed

        // Save the file
        $file->move($filePath, $fileName);
        $student= Student::where('id', session('user_id'))->first();
        $student->update([
            'student_image'=>'1',
            'student_image_type'=> $file->getClientOriginalExtension(),
            'student_status'=>'1',
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function UpdatePersonalData(Request $request){
        $data= $request->validate([
           'first_name'=>'required',
           'middle_name'=>'required',
           'last_name'=>'required',
           'suffix'=>'required',
           'email'=>'required',
        ]);


        $student= Student::where('id', session('user_id'))->first();

        $student->update([
           'student_first_name'=> $data['first_name'],
           'student_middle_name'=>$data['middle_name'],
           'student_last_name'=>$data['last_name'],
           'student_suffix'=>$data['suffix'],
           'student_mail'=>$data['email'],
           'student_status'=>'1',
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');

    }

    public function ChangePassword(Request $request){

        $data= $request->validate([
            'newPassword'=>'required',
            'currentPassword'=>'required',
        ]);

        $student= Student::where('id', session('user_id'))->first();
        if($student->student_password===$data['currentPassword']){
            $student->update([
                'student_password'=>$data['newPassword'],
                'student_status'=>'1',
            ]);
            return redirect()->back()->with('Success', 'Changed Password');
        }else{
            return redirect()->back()->with('Fail', 'Incorrect Password');
        }
    }
}
