<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Coordinator;
use App\Models\Admin;
use App\Models\AssignedTeacher;
use App\Models\EvaluationResult;
use App\Models\Strand;
use App\Models\Room;
use App\Models\ClassSchedule;
use App\Models\Section;
use App\Models\RoomAvailable;
use App\Models\SavedEvaluation;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File; 
use ZipArchive;
use Illuminate\Support\Facades\Response;
use App\Exports\Users;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DashboardViews extends Controller
{
    public function SurveyView(){
        return view('administrator.survey');
    }
    public function AllUserView(){
        return view('administrator.alluser');
    }
   public function EditStudent(Request $request){
    $student_id= $request->input('student_id');

    $student= Student::where('student_id', $student_id)->first();
    $password= $student->student_password;
    $first_name= $student->student_first_name;
    $last_name= $student->student_last_name;
    $middle_name= $student->student_middle_name;
    $suffix= $student->student_suffix;
    $year_level= $student->student_year_level;
    $strand= $student->student_strand;
    $section= $student->student_section;
    $mail= $student->student_mail;
    $status= $student->student_status;
    $trimYearLevel= substr($year_level, -2);
    if($suffix==="none"){
        $finalSuffix= " ";
    }else{
        $finalSuffix=$suffix;
    }
     $sectionQuery= Section::where('id', $section)->first();
    $fullname= $first_name. " ". $middle_name. " ". $last_name. " ". $finalSuffix;
    return view('administrator.student',[
        'student_id'=>$student_id,
        'password'=>$password,
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'middle_name'=>$middle_name,
        'suffix'=>$suffix,
        'fullname'=>$fullname,
        'year_level'=>$year_level,
        'trimYearLevel'=>$trimYearLevel,
        'strand'=>$strand,
        'section'=>$section,
        'section_name'=>$sectionQuery->section,
        'mail'=>$mail,
        'status'=>$status
    ]);
   }
   public function EditTeacher(Request $request){
    $teacher_id= $request->input('teacher_id');

    $teacher= Teacher::where('id', $teacher_id)->first();
    $first_name= $teacher->teacher_first_name;
    $middle_name= $teacher->teacher_middle_name;
    $last_name= $teacher->teacher_last_name;
    $suffix= $teacher->teacher_suffix;
    if($suffix==="none"){
        $finalSuffix= " ";
    }else{
        $finalSuffix=$suffix;
    }
    $username=$teacher->teacher_username;
    $password= $teacher->teacher_password;
    $fullname= $first_name. " ". $middle_name. " ". $last_name. " ". $finalSuffix;
    return view('administrator.teacher', [
        'fullname'=>$fullname,
        'first_name'=>$first_name,
        'middle_name'=>$middle_name,
        'last_name'=>$last_name,
        'suffix'=>$suffix,
        'username'=>$username,
        'password'=>$password,
        'teacher_id'=>$teacher_id
    ]);
   }
   public function EditCoordinator(Request $request){
    $coordinator_id= $request->input('coordinator_id');

    $coordinator= Coordinator::where('id', $coordinator_id)->first();
    $first_name= $coordinator->coordinator_first_name;
    $last_name= $coordinator->coordinator_last_name;
    $middle_name= $coordinator->coordinator_middle_name;
    $suffix= $coordinator->coordinator_suffix;
    if($suffix=="none"){
        $finalSuffix=" ";
    }else{
        $finalSuffix= $suffix;
    }
    $username= $coordinator->coordinator_username;
    $password= $coordinator->coordinator_password;
    $position= $coordinator->coordinator_position;
    $fullname= $first_name. " ". $middle_name. " ". $last_name. " ". $finalSuffix;
    return view('administrator.coordinator', [
        'fullname'=>$fullname,
        'first_name'=>$first_name,
        'middle_name'=>$middle_name,
        'last_name'=>$last_name,
        'suffix'=>$suffix,
        'username'=>$username,
        'password'=>$password,
        'position'=>$position,
        'coordinator_id'=>$coordinator_id,
    ]);
   }
    public function ChangeQuestion(Request $request){

        $data= $request->validate([
           'question_content'=> 'required',
           'question_id'=> 'required',
        ]);
  $question = Question::where('id', $data['question_id'])->first();
  $question->update(['question_content'=> $data['question_content']]);
  return redirect()->route('admin_survey');
    }

    public function AddQuestion(Request $request){

        $data= $request->validate([
           'criteria'=>'required',
           'question'=> 'required',
        ]);

        $question= new Question();
        $question->question_content= $data['question'];
        $question->question_criteria= $data['criteria'];

        $question->save();
        return redirect()->route('admin_survey');
    }

    public function DeleteQuestion(Request $request){
        $data= $request->validate([
            'question_id'=>'required',
        ]);

        $question = Question::find($data['question_id']);

        if (!$question) {
            return redirect()->back()->with('error', 'Question not found!');
        }
    
        $question->delete();
        return redirect()->back()->with("success", "Question Deleted Succesfully");
    }


    public function AddStudent(Request $request){
    $data= $request->validate([
       'firstNameStudent'=>'required',
       'lastNameStudent'=> 'required',
       'middleNameStudent'=>'required',
       'suffixStudent'=>'required',
       'student_id'=>'required',
       'year'=>'required',
       'strand'=>'required',
       'email'=>'required',
    ]);
  $randomPassword= randomString(8);
    $students = new Student();
    $students->student_id= $data['student_id'];
    $students->student_password=$randomPassword;
    $students->student_first_name= $data['firstNameStudent'];
    $students->student_last_name= $data['lastNameStudent'];
    $students->student_middle_name= $data['middleNameStudent'];
    $students->student_suffix= $data['suffixStudent'];
    $students->student_year_level= $data['year'];
    $students->student_strand= $data['strand'];
    $students->student_section= '25';
    $students->student_mail= $data['email'];
    $students->student_image= '0';
    $students->student_image_type= " ";
    $students->student_status="0";

    $students->save();

    return redirect()->route('allUser');
    }
    public function AddTeacher(Request $request){
      $data= $request->validate([
        'last_name'=>'required',
        'first_name'=>'required',
        'middle_name'=>'required',
        'suffix'=>'required',
        'username'=>'required',
      ]);
      $password= randomString(8);
      $teacher= new Teacher();
      $teacher->teacher_username= $data['username'];
      $teacher->teacher_password= $password;
      $teacher->teacher_first_name= $data['first_name'];
      $teacher->teacher_last_name= $data['last_name'];
      $teacher->teacher_middle_name= $data['middle_name'];
      $teacher->teacher_suffix= $data['suffix'];
      $teacher->teacher_image= '0';
      $teacher->teacher_image_type= " ";
      $teacher->teacher_status= "0";

      $teacher->save();

      return redirect()->route('allUser');
    }
    public function AddCoordinator(Request $request){
        $data= $request->validate([
            'last_name'=>'required',
            'first_name'=>'required',
            'middle_name'=>'required',
            'suffix'=>'required',
            'username'=>'required',
            'Position'=>'required',
          ]);

          $coordinator= new Coordinator();
          $password= randomString(8);
          $coordinator->coordinator_username= $data['username'];
          $coordinator->coordinator_password= $password;
          $coordinator->coordinator_first_name= $data['first_name'];
          $coordinator->coordinator_last_name= $data['last_name'];
          $coordinator->coordinator_middle_name= $data['middle_name'];
          $coordinator->coordinator_suffix= $data['suffix'];
          $coordinator->coordinator_position= $data['Position'];

          $coordinator->coordinator_image= '0';
          $coordinator->coordinator_image_type= " ";
          $coordinator->coordinator_status= "0";
          $coordinator->save();

          return redirect()->route('allUser');
    }


    public function AlterStudentPersonalInfo(Request $request){
        $data= $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_name'=>'required',
            'suffix'=>'required',
            'student_id'=>'required',
            'password'=>'required',
            'email'=>'required',
            'getStudentId'=>'required',
            'strands'=>'required',
        ]);

        if(is_null($request->input('sections'))){
            $finalSection= 25;
        }else{
            $finalSection=$request->input('sections');
        }
        $student= Student::where('student_id', $data['getStudentId'])->first();
        $yearLevel=Section::where('id', $finalSection)->first()->year_level;
        $student->update([
            'student_first_name'=>$data['first_name'],
            'student_last_name'=>$data['last_name'],
            'student_suffix'=>$data['suffix'],
            'student_id'=>$data['student_id'],
            'student_middle_name'=>$data['middle_name'],
            'student_password'=>$data['password'],
            'student_mail'=>$data['email'],
            'student_year_level'=>$yearLevel,
            'student_section'=> $finalSection,
            'student_strand'=>$data['strands'],
        ]);

        return redirect()->route('editStudent', ['student_id' => $data['getStudentId']]);
    }


    public function AlterTeacherInfo(Request $request){

        $data= $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_name'=>'required',
            'suffixTeacher'=>'required',
            'username'=>'required',
            'password'=>'required',
            'hiddenTeacherId'=>'required',
        ]);

        $teacher= Teacher::where('id', $data['hiddenTeacherId'])->first();

        $teacher->update([
           'teacher_first_name'=>$data['first_name'],
           'teacher_last_name'=>$data['last_name'],
           'teacher_middle_name'=>$data['middle_name'],
           'teacher_suffix'=>$data['suffixTeacher'],
           'teacher_username'=>$data['username'],
           'teacher_password'=>$data['password'],
        ]);

        return redirect()->route('editTeacher', ['teacher_id' => $data['hiddenTeacherId']]);
    }

    public function AlterCoordinatorInfo(Request $request){
        $data= $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_name'=>'required',
            'suffixCoordinator'=>'required',
            'username'=>'required',
            'password'=>'required',
            'hiddenCoordinatorId'=>'required',
        ]);

        $coordinator = Coordinator::where('id',$data['hiddenCoordinatorId'])->first();
        $coordinator->update([
          'coordinator_first_name'=>$data['first_name'],
          'coordinator_last_name'=>$data['last_name'],
          'coordinator_middle_name'=>$data['middle_name'],
          'coordinator_suffix'=>$data['suffixCoordinator'],
          'coordinator_username'=>$data['username'],
          'coordinator_password'=>$data['password'],
        ]);

        return redirect()->route('editCoordinator', ['coordinator_id' => $data['hiddenCoordinatorId']]);
    }
    


    //AssignTeacher
    public function AssignTeacherView(){
        return view('administrator.assignteacher');
    }
    public function EditAssignedTeacher(Request $request){
        $strand_id= $request->input('strand_id');
        $gLevel = $request->input('glevel');
        $section= $request->input('section');
        if($gLevel==="Grade11"){
            $finalGlevel="Grade 11";
        }else{
            $finalGlevel="Grade 12";
        }
        $admin= Admin::where('admin_type', 'Super Admin')->first();
        $strand= Strand::where('id',$strand_id)->first();
        return view('administrator.editassigned',[
            'strand_name'=>$strand->strand_name,
            'gLevel'=>$finalGlevel,
            'grade_level'=>$gLevel,
            'semester'=>$admin->admin_sem,
            'strand_id'=>$strand_id,
            'section'=>$section,
        ]);
    }


    public function AssignedTeacherUpdate(Request $request){
        $selectedTeachers = $request->input('selectedTeacher');
        $hiddenSubjectId= $request->input('hiddenSubjectId');
        $hiddenSection= $request->input('hiddenSection');
        $hiddenStrand= $request->input('hiddenStrand');
        $hiddenSemester= $request->input('hiddenSemester');
        $hiddenGlevel= $request->input('hiddenGlevel');
        $itemCount= count($selectedTeachers);
        for($i=0; $i<$itemCount; $i++){
            $assignedTeacherUpdate= AssignedTeacher::where('subject_id', $hiddenSubjectId[$i])
            ->where('section_id', $hiddenSection)
            ->where('strand_id', $hiddenStrand)
            ->where('sem', $hiddenSemester)
            ->where('grade_level', $hiddenGlevel)
            ->first();

           if($assignedTeacherUpdate){
            $assignedTeacherUpdate->update([
                'teacher_id'=>$selectedTeachers[$i],
           ]);
           }else{
            $assignedTeachers= new AssignedTeacher();
            $assignedTeachers ->subject_id=$hiddenSubjectId[$i];
            $assignedTeachers ->section_id=$hiddenSection;
            $assignedTeachers ->strand_id=$hiddenStrand;
            $assignedTeachers ->sem=$hiddenSemester;
            $assignedTeachers ->grade_level=$hiddenGlevel;
            $assignedTeachers ->teacher_id=$selectedTeachers[$i];
            $assignedTeachers->save(); 
           }
        }

      

        if($hiddenGlevel==="Grade 11"){
            $returnGlevel= "Grade11";
        }else{
            $returnGlevel= "Grade12";
        }
        return redirect()->route('editAssignedTeacher', ['strand_id' => $hiddenStrand, 'glevel'=>$returnGlevel,'section'=>$hiddenSection]);
    }


    //Class Schedule
    public function ClassScheduleView(){
        return view('administrator.classschedule');
    }
    public function ViewSchedule(Request $request){
        $type = $request->input('type');
        $id= $request->input('id');

        return view('administrator.viewschedule', [
            'type'=> $type,
            'id'=>$id,
        ]);
    }
    public function EditClassSchedules(){
        $Sem= Admin::where('admin_type', 'Super Admin')->first();
        Session::put('selectedStrand', 'Null');
        return view('administrator.editclass_schedules', [
            'currentSem'=>$Sem->admin_sem,
        ]);
    }
    public function SubmitSelectedStrand(Request $request){
        $data=$request->validate(['strands'=>'required']);
        $Sem= Admin::where('admin_type', 'Super Admin')->first();
        Session::put('selectedStrand',$data['strands']);
        return view('administrator.editclass_schedules', [
            'currentSem'=>$Sem->admin_sem,
        ]);
    }

    public function UpdateSchedule(Request $request){

        $data= $request->validate([
         'timeContent'=>'required',
         'dayContent'=>'required',
         'strand'=>'required',
         'teacher'=>'required',
         'subject'=>'required',
         'room'=>'required',
        ]);


        $schedule= ClassSchedule::where('sched_class_name', $data['strand'])
        ->where('sched_time', $data['timeContent'])
        ->where('sched_day', $data['dayContent'])
        ->first();

        $schedule->update([
          'sched_teacher'=>$data['teacher'],
          'sched_room'=>$data['room'],
          'sched_subject'=>$data['subject'],
        ]);

        $roomAvail= RoomAvailable::where('room_id', $data['room'])
        ->where('room_day', $data['dayContent'])->first();

        $checkRoom= RoomAvailable::where('room_day', $data['dayContent'])->where($data['timeContent'], $data['strand'])->first();
        if($checkRoom){
          $checkRoom->update([
             $data['timeContent']=>'0',
          ]);
        }

        $roomAvail->update([
            $data['timeContent']=>$data['strand'],
        ]);
        $Sem= Admin::where('admin_type', 'Super Admin')->first();
        Session::put('selectedStrand',$data['strand']);
        return view('administrator.editclass_schedules', [
            'currentSem'=>$Sem->admin_sem,
        ]);
    }

    //Add Admin
    public function AddAdminView(){
        return view('administrator.addadmin');
    }
    public function AddAdmin(Request $request){
        $data=$request->validate([
          'first_name'=>'required',
          'last_name'=>'required',
          'middle_name'=>'required',
          'username'=>'required',
          'suffix'=>'required',
        ]);

        $admin= new Admin();
        
        $admin->admin_first_name= $data['first_name'];
        $admin->admin_last_name= $data['last_name'];
        $admin->admin_middle_name= $data['middle_name'];
        $admin->admin_suffix= $data['suffix'];
        $admin->admin_username=$data['username'];
        $admin->admin_password= randomString(8);
        $admin->admin_type= 'Admin';
        $admin->admin_image= '0';
        $admin->admin_image_type= '';
        $admin->admin_sem= '';
        $admin->save();

        return redirect()->route('addAdminView');
    }


        //ViewData
        public function ViewDataView(){
            return view('administrator.viewdata');
        }
        public function ResultView(Request $request){
            $teacher_id= $request->input('teacher_id');
            return view('administrator.result',[
                'teacher_id'=>$teacher_id,
            ]);
        }
        public function DataView(Request $request){
            $evaluator= $request->input('evaluator_id');
            $teacher= $request->input('teacher_id');
            $type= $request->input('type');
            return view('administrator.data', [
                'teacher_id'=>$teacher,
                'evaluator'=>$evaluator,
                'type'=>$type,
            ]);
        
        }
  

        //Profile
        public function ProfileView(){
            $admin= Admin::where('id', session('user_id'))->first();
            if($admin->admin_suffix==="none"){
                $finalSuffix= " ";
            }else{
                $finalSuffix= $admin->admin_suffix;
            }
            $fullName= $admin->admin_first_name. " ". substr($admin->admin_middle_name, 0, 1). ". ". $admin->admin_last_name. " ". $finalSuffix;
            return view('administrator.profile', [
                'fullname'=> $fullName,
                'first_name'=>$admin->admin_first_name,
                'middle_name'=>$admin->admin_middle_name,
                'last_name'=>$admin->admin_last_name,
                'suffix'=>$admin->admin_suffix,
                'username'=>$admin->admin_username,
                'password'=>$admin->admin_password,
            ]);
        }

        public function UpdateProfilePicAdmin(Request $request){
            $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
            ]);
    
            // Store the file in the public folder
            $file = $request->file('picture');
            $fileName = "Admin(". session('user_id'). ").". $file->getClientOriginalExtension();
            $filePath = public_path('Users/');  // Adjust the storage path as needed
    
            // Save the file
            $file->move($filePath, $fileName);
            $admin= Admin::where('id', session('user_id'))->first();
            $admin->update([
                'admin_image'=>'1',
                'admin_image_type'=> $file->getClientOriginalExtension(),
        
            ]);
    
            return redirect()->back()->with('success', 'File uploaded successfully.');
        }
    
        public function UpdatePersonalDataAdmin(Request $request){
            $data= $request->validate([
               'first_name'=>'required',
               'middle_name'=>'required',
               'last_name'=>'required',
               'suffix'=>'required',
               'username'=>'required',
            ]);
    
    
            $admin= Admin::where('id', session('user_id'))->first();
    
            $admin->update([
               'admin_first_name'=> $data['first_name'],
               'admin_middle_name'=>$data['middle_name'],
               'admin_last_name'=>$data['last_name'],
               'admin_suffix'=>$data['suffix'],
               'admin_username'=>$data['username'],
               
            ]);
    
            return redirect()->back()->with('success', 'File uploaded successfully.');
    
        }
    
        public function ChangePasswordAdmin(Request $request){
    
            $data= $request->validate([
                'newPassword'=>'required',
                'currentPassword'=>'required',
            ]);
    
            $admin= Admin::where('id', session('user_id'))->first();
            if($admin->admin_password===$data['currentPassword']){
                $admin->update([
                    'admin_password'=>$data['newPassword'],
                ]);
                return redirect()->back()->with('Success', 'Changed Password');
            }else{
                return redirect()->back()->with('Fail', 'Incorrect Password');
            }
        }

        //ExportData

        public function ExportDataView(){
            return view('administrator.exportdata');
        }

        public function ExportPdf(Request $request){
            $teacher_id= $request->input('teachPDF');
            if ($request->input('action') === 'preview') {

                $imageUrl = public_path('images/logo.jfif');
                $imageData = File::get($imageUrl);
                
               if($teacher_id!='all'){

               
                $data = [
                    'teacher_id' =>$teacher_id,
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];
        
                $pdf = PDF::loadView('administrator.evaluationPdf', $data);
                return $pdf->stream('administrator.evaluationPdf', ['Attachment' => false]);
            }else{
                $data = [
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];
                $pdf = PDF::loadView('administrator.evaluationPDFall', $data);
                return $pdf->stream('administrator.evaluationPDFall', ['Attachment' => false]);
            }
            } elseif ($request->input('action') === 'download') {
                if($teacher_id!='all'){
                    $imageUrl = public_path('images/logo.jfif');
                    $imageData = File::get($imageUrl);
            
                    $data = [
                        'teacher_id' =>$teacher_id,
                        'logoData' => base64_encode($imageData), // Pass the image data to the view
                    ];
                    $teacher= Teacher::where('id', $teacher_id)->first();
            
                    $pdf = PDF::loadView('administrator.evaluationPdf', $data);
                    return $pdf->download('evaluation('.$teacher->teacher_last_name.').pdf');
                }else{
                    $pdfContents = [];
                    $teachers= Teacher::where('id', '!=', 6)->get();
                    $imageUrl = public_path('images/logo.jfif');
                    $imageData = File::get($imageUrl);
                    foreach($teachers as $teacher){
                        $data = [
                            'logoData' => base64_encode($imageData), 
                            'teacher_id' => $teacher->id,
                        ];
            
                        $pdf = PDF::loadView('administrator.evaluationPdf', $data);
                        $pdfContents[] = [
                            'content' => $pdf->output(),
                            'filename' => 'evaluation(' . $teacher->teacher_last_name . ').pdf',
                        ];
                    }
                    $data=[
                        'logoData' => base64_encode($imageData), 
                    ];
                    
                    $pdf = PDF::loadView('administrator.evaluationPDFall', $data);
                    $pdfContents[] = [
                        'content' => $pdf->output(),
                        'filename' => 'evaluation_result_all.pdf',
                    ];
                    $zipFileName = 'teacher_evaluations.zip';
                    $zipFilePath = public_path($zipFileName);
            
                    $zip = new ZipArchive();
                    if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                        foreach ($pdfContents as $pdfContent) {
                            $zip->addFromString($pdfContent['filename'], $pdfContent['content']);
                        }

                        $zip->close();
            
                        // Provide the zip archive for download
                        return Response::download($zipFilePath)->deleteFileAfterSend(true);
                    } else {
                        return response()->json(['message' => 'Failed to create zip archive'], 500);
                    }
                }
            }
    
            // Default action if neither button is clicked
            return redirect()->back();
        }

        public function ExportUserPdf(Request $request){
            $selection= $request->input('userPdf');
            $imageUrl = public_path('images/logo.jfif');
            $imageData = File::get($imageUrl);
            if($request->input('action')==='preview'){
                $data = [
                    'selection' =>$selection,
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];

                $pdf = PDF::loadView('administrator.userAccountsPdf', $data);
                return $pdf->stream('administrator.userAccountsPdf', ['Attachment' => false]);
        
            }else if($request->input('action')==='download'){
        
                $data = [
                    'selection' =>$selection,
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];
       
                $pdf = PDF::loadView('administrator.userAccountsPdf', $data);
                return $pdf->download('Accounts_'.$selection.'.pdf');
            }

        }
        public function ExportUserExcel(Request $request){
            $userData=[];
            $selection = $request->input('userExcel');
        if($selection==="Student"){
        $students=Student::all();
        foreach($students as $student){
         $data=[];
         $fullname= $student->student_first_name. " ". substr($student->student_middle_name, 0, 1). " ". $student->student_last_name. " ". $student->student_suffix;
         array_push($data, $fullname);
         array_push($data,  $student->student_id);
         array_push($data, $student->student_password);
        array_push($userData, $data);
        }
        $fileName = 'student_users.xlsx';
        }else if($selection==="Teacher"){
            $teachers=Teacher::where('id', '!=', 6)->get();
            foreach($teachers as $teacher){
             $data=[];
             $fullname= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). " ". $teacher->teacher_last_name. " ". $teacher->teacher_suffix;
             array_push($data, $fullname);
             array_push($data, $teacher->teacher_username);
             array_push($data, $teacher->teacher_password);
            array_push($userData, $data);
            }
            $fileName = 'teacher_users.xlsx';
        }else if($selection==="Coordinator"){
            $coordinators=Coordinator::all();
            foreach($coordinators as $coordinator){
             $data=[];
             $fullname= $coordinator->coordinator_first_name. " ". substr($coordinator->coordinator_middle_name, 0, 1). " ". $coordinator->coordinator_last_name. " ". $coordinator->coordinator_suffix;
             array_push($data, $fullname);
             array_push($data, $coordinator->coordinator_username);
             array_push($data, $coordinator->coordinator_password);
            array_push($userData, $data);
            }

            $fileName = 'coordinator_users.xlsx';
        }else{
            array_push($userData, ['Student Fullname', 'Student Id', 'Student Password']);
            $students=Student::all();
        foreach($students as $student){
         $data=[];
         $fullname= $student->student_first_name. " ". substr($student->student_middle_name, 0, 1). " ". $student->student_last_name. " ". $student->student_suffix;
         array_push($data, $fullname);
         array_push($data, $student->student_id);
         array_push($data, $student->student_password);
        array_push($userData, $data);
        }
        array_push($userData, ['Teacher Fullname', 'Teacher Username', 'Teacher Password']);
        $teachers=Teacher::where('id', '!=', 6)->get();
        foreach($teachers as $teacher){
         $data=[];
         $fullname= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). " ". $teacher->teacher_last_name. " ". $teacher->teacher_suffix;
         array_push($data, $fullname);
         array_push($data, $teacher->teacher_username);
         array_push($data, $teacher->teacher_password);
        array_push($userData, $data);
        }
        array_push($userData, ['Coordinator Fullname', 'Coordinator Username', 'Coordinator Password']);
        $coordinators=Coordinator::all();
        foreach($coordinators as $coordinator){
         $data=[];
         $fullname= $coordinator->coordinator_first_name. " ". substr($coordinator->coordinator_middle_name, 0, 1). " ". $coordinator->coordinator_last_name. " ". $coordinator->coordinator_suffix;
         array_push($data, $fullname);
         array_push($data, $coordinator->coordinator_username);
         array_push($data, $coordinator->coordinator_password);
        array_push($userData, $data);
        }
        $fileName = 'all_users.xlsx';
        }

        // Set the desired filename for the exported Excel file.
    
        return Excel::download(new Users(collect($userData)), $fileName);
    }

    public function ClassScheduleExportPDF(Request $request){
        $imageUrl = public_path('images/logo.jfif');
        $imageData = File::get($imageUrl);
        $class_id= $request->input('schedPDF');
       
        if($request->input('action')==="preview"){
            if($class_id!='All'){
                $data = [
                    'class_id' =>$class_id,
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];
        
                $pdf = PDF::loadView('administrator.classScheduleExportPdf', $data);
                $pdf->setPaper('legal', 'landscape');
                return $pdf->stream('administrator.classScheduleExportPdf', ['Attachment' => false]);
            }else{
                $data = [
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];
        
                $pdf = PDF::loadView('administrator.classScheduleExportPdfAll', $data);
                $pdf->setPaper('legal', 'landscape');
                return $pdf->stream('administrator.classScheduleExportPdfAll', ['Attachment' => false]);
            }
           
        
        }else if($request->input('action')==='download'){
            $class_id= $request->input('schedPDF');
            $imageUrl = public_path('images/logo.jfif');
            $imageData = File::get($imageUrl);
            if($class_id!='All'){
                $data = [
                    'class_id' =>$class_id,
                    'logoData' => base64_encode($imageData), // Pass the image data to the view
                ];
            $section= Section::where('id', $class_id)->first();
            $strand= Strand::where('id', $section->strand_id)->first();
                $pdf = PDF::loadView('administrator.classScheduleExportPdf', $data);
                $pdf->setPaper('legal', 'landscape');
                return $pdf->download('Schedules_'.$strand->strand_shortcut.'-'.$section->year_level. '-'.$section->section.'.pdf');
            }else{
                $pdfContents = [];
                $sections= Section::where('id', '!=', 25)->get();
                $imageUrl = public_path('images/logo.jfif');
                $imageData = File::get($imageUrl);
                foreach($sections as $section){
                    $data = [
                        'logoData' => base64_encode($imageData), 
                        'class_id' => $section->id,
                    ];
             $strand= Strand::where('id', $section->strand_id)->first();
                    $pdf = PDF::loadView('administrator.classScheduleExportPdf', $data);
                    $pdf->setPaper('legal', 'landscape');
                    $pdfContents[] = [
                        'content' => $pdf->output(),
                        'filename' => 'Class_Schedule(' . $strand->strand_shortcut.'-'.$section->year_level. '-'. $section->section. ').pdf',
                    ];
                }
                $data=[
                    'logoData' => base64_encode($imageData), 
                ];
                
                $pdf = PDF::loadView('administrator.classScheduleExportPdfAll', $data);
                $pdf->setPaper('legal', 'landscape');
                $pdfContents[] = [
                    'content' => $pdf->output(),
                    'filename' => 'All_Class_Schedule.pdf',
                ];
                $zipFileName = 'Class_Schedules.zip';
                $zipFilePath = public_path($zipFileName);
        
                $zip = new ZipArchive();
                if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                    foreach ($pdfContents as $pdfContent) {
                        $zip->addFromString($pdfContent['filename'], $pdfContent['content']);
                    }

                    $zip->close();
        
                    // Provide the zip archive for download
                    return Response::download($zipFilePath)->deleteFileAfterSend(true);
                } else {
                    return response()->json(['message' => 'Failed to create zip archive'], 500);
                }
               
            }
        }
    }
    public function AddRoom(Request $request){
      if($request->input('submit')==="add"){
        $data = $request->validate([
            'addRoom' => 'required',
        ]);
        
        $room = new Room();
        $room->room_name = $data['addRoom'];
        $room->save();
        $newRoomId = $room->id;
        
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timeStamps = ['7:30AM - 8:30AM', '8:30AM - 9:30AM', '9:45AM - 10:45AM', '10:45AM - 11:45AM', '1:00PM - 2:00PM', '2:00PM - 3:00PM', '3:00PM - 4:00PM', '4:00PM - 5:00PM'];
        
        foreach ($days as $day) {
            $roomAvailable = new RoomAvailable(); // Create a new RoomAvailable object for each day
            $roomAvailable->room_id = $newRoomId;
            $roomAvailable->room_day = $day;
        
            foreach ($timeStamps as $time) {
                // Create dynamic property name using a sanitized version of the time
              
                $roomAvailable->$time = 0;
            }
        
            $roomAvailable->save();
        }
        
      }else if($request->input('submit')==="delete"){
        $adminPass = $request->input('password');
        $admin = Admin::where('admin_type', 'Super Admin')->first();
        
        if ($adminPass === $admin->admin_password) {
            $selectedRoomIds = $request->input('selectedRoom', []);
        
            foreach ($selectedRoomIds as $room) {
                $room = Room::find($room);
        
                if ($room) {
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        
                    foreach ($days as $day) {
                        $roomAvailable = RoomAvailable::where('room_day', $day)->where('room_id', $room->id)->first();
        
                        if ($roomAvailable) {
                            $roomAvailable->delete();
                        }
                    }
        
                    $room->delete();
                }
            }
        }
        
        
        
      }
       
        return redirect()->back();
        
    }


    public function AddStrand(Request $request){
        if($request->input('submit')==="add"){
          $data = $request->validate([
              'addStrand' => 'required',
              'addStrandShortcut'=>'required',
          ]);
          
          $strand = new Strand();
          $strand->strand_name = $data['addStrand'];
          $strand->strand_shortcut= $data['addStrandShortcut'];
          $strand->save();
          $strand_id = $strand->id;
          
          $sects= ['A', 'B'];
          $grades= ['Grade 11', 'Grade 12'];
         
          foreach($grades as $grade){
             foreach($sects as $sect){
                $section= new Section();
                $section->section= $sect;
                $section->year_level= $grade;
                $section->strand_id= $strand_id;
                $section->save();
             }
           
          }
          
        }else if($request->input('submit')==="delete"){
            $adminPass = $request->input('password');
            $admin = Admin::where('admin_type', 'Super Admin')->first();
            
            if ($adminPass === $admin->admin_password) {
                $selectedStrand = $request->input('selectedStrand', []);
            
                foreach ($selectedStrand as $strandId) {
                    $strand = Strand::find($strandId);
            
                    if ($strand) {
                        $grades = ['Grade 11', 'Grade 12'];
            
                        foreach ($grades as $grade) {
                            $sections = Section::where('year_level', $grade)->where('strand_id', $strandId)->get();
            
                            foreach ($sections as $section) {
                                $section->delete();
                            }
                        }
            
                        $strand->delete();
                    }
                }
            }
            
          
        }
         
          return redirect()->back();
          
      }


      public function AddSection(Request $request){
        if($request->input('submit')==="add"){
          $data = $request->validate([
              'addSection' => 'required',
              'sectionYear'=>'required',
              'sectionStrand'=>'required',
          ]);
          
          $section = new Section();
          $section->section = $data['addSection'];
          $section->year_level= $data['sectionYear'];
          $section->strand_id= $data['sectionStrand'];
          $section->save();
          $newSection= $section->id;
         
          $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
          $timeStamps = ['7:30AM - 8:30AM', '8:30AM - 9:30AM', '9:45AM - 10:45AM', '10:45AM - 11:45AM', '1:00PM - 2:00PM', '2:00PM - 3:00PM', '3:00PM - 4:00PM', '4:00PM - 5:00PM'];
        
          foreach($days as $day){
            foreach($timeStamps as $time){
                $schedule= new ClassSchedule();
                $schedule->sched_day= $day;
                $schedule->sched_time= $time;
                $schedule->sched_room= 13;
                $schedule->sched_teacher= 6;
                $schedule->sched_subject=204;
                $schedule->sched_class_name= $newSection;
                $schedule->save();
            }
          }
          
        }else if($request->input('submit')==="delete"){
            $adminPass = $request->input('password');
            $admin = Admin::where('admin_type', 'Super Admin')->first();
            
            if ($adminPass === $admin->admin_password) {
                $selectedSection = $request->input('selectedSection', []);
            
                foreach ($selectedSection as $sect) {
                    $section = Section::find($sect);
            
                    if ($section) {
                        $schedules = ClassSchedule::where('sched_class_name', $sect)->get();

                        foreach ($schedules as $schedule) {
                            $schedule->delete();
                        }
            
                          
                       $section->delete();
                    }
                }
            }
            
          
        }
         
          return redirect()->back();
          
      }

      public function DeployEvaluation(Request $request){
      

        $admin= Admin::where('admin_type', 'Super Admin')->first();
        if($admin->admin_password===$request->input('adminPass')){
            if($request->input('status')==="true"){
                $admin->update([
                    'admin_evaluation_status'=>1,
                ]);
            }else{
                $admin->update([
                    'admin_evaluation_status'=>0,
                ]);
            }
            
        }

        return redirect()->back();
      }

      //Settings
      public function Settings(){
        return view('administrator.settings');
      }

      public function SaveEvaluationDataOnStorage(Request $request){

        $data= $request->validate([
            'dataName'=>'required',
        ]);

// Get all rows from the table using Eloquent
$tableData = EvaluationResult::all();

// Generate SQL queries to insert data
$sqlQueries = '';
foreach ($tableData as $row) {
    $remarks = str_replace("'", "", $row->evaluation_remarks);

    $sqlQueries .= "INSERT INTO tbl_evaluation_result (evaluator_id, evaluator_type, teacher_id, question_id, evaluation_score,
    evaluation_remarks, created_at, updated_at) VALUES ('$row->evaluator_id', '$row->evaluator_type', '$row->teacher_id',  '$row->question_id',   '$row->evaluation_score',
    '$remarks', '$row->created_at', '$row->updated_at');\n";
}

// Save SQL queries to a file
$fileName = $data['dataName'].'.sql';
Storage::disk('local')->put($fileName, $sqlQueries);
$saved= new SavedEvaluation();
$saved->evaluation_name= $data['dataName'];
$saved->saved_status= 'save';
$saved->save();

return redirect()->back();

      }

      public function DeleteOrLoadData(Request $request){
    

        if($request->input('action')==='delete'){
            $saved= SavedEvaluation::where('id', $request->input('selectedData'))->first();
            $fileName= $saved->evaluation_name. '.sql';
            Storage::disk('local')->delete($fileName);
            $saved->delete(); 
        }else if($request->input('action')==='reset'){
            $evaluations= EvaluationResult::all();
            foreach($evaluations as $eval){
                $eval->delete();
            }
        }else if($request->input('action')==='load'){

            $save= SavedEvaluation::where('id', $request->input('selectedData'))->first();
            if($save->save_status==="save"){
                $name= $save->evaluation_name;
                $fileName = $name.'.sql'; // Replace with the actual file name
    $sqlFileContents = Storage::disk('local')->get($fileName);
    
    $queries = explode(";\n", $sqlFileContents);
    foreach ($queries as $query) {
        if (trim($query) !== '') {
            DB::statement($query);
        }
    }
    $save->update([
       'saved_status'=>'loaded',
    ]);
            }
          
        }

        return redirect()->back();
      }

      public function Credits(){
        return view('administrator.credits');
      }
      public function Feedback(){
        return view('administrator.feedback');
      }

      public function SendFeedback(Request $request){
        $data= $request->validate([
          'email'=>'required',
          'message'=>'required',
        ]);


        $feedback= new Feedback();
        $feedback->sender_mail= $data['email'];
        $feedback->message= $data['message'];
        $feedback->status= "stat";
        $feedback->save();

        return redirect()->back();
      }
      public function PatchNotes(){
        return view('administrator.patchnotes');
      }
}
