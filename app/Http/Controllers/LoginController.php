<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Coordinator;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function LoginView(){
        return view('login.index');
    }
    public function AboutUs(){
        return view('login.aboutus');
    }
    public function ContactUs(){
        return view('login.contact');
    }
    public function Privacy(){
        return view('login.privacy');
    }
    public function Terms(){
        return view('login.terms');
    }


    public function AdminLogin(Request $request){
        $data= $request->validate([
            'usernameAdmin'=> 'required',
            'passwordAdmin'=>'required',
           ]);
              // Retrieve the user record from the database based on the provided username
              $administrator = Admin::where('admin_username', $data['usernameAdmin'])->first();
   
              if ($administrator) {
                  $uname= $administrator->id;
                  if ($data['passwordAdmin'] === $administrator->admin_password) {
                    $first_name= $administrator->admin_first_name;
                    $middle_name= $administrator->admin_middle_name;
                    $last_name= $administrator->admin_last_name;
                    $suffix= $administrator->admin_suffix;
                    $middle_initial= substr($middle_name, 0,1);

                    if($suffix="none"){
                        $finalSuffix= " ";
                    }else{
                        $finalSuffix= $suffix;
                    }
                    $name= $first_name. " ". $middle_initial. ". ".$last_name. " ".$finalSuffix;
                    Session::put('user_type', 'Admin');
                    Session::put('user_id', $uname);
                    Session::put('user_name',$name);
                      return redirect()->route('admin_dashboard'); // Redirect to the dashboard or other authorized page
                  } else {
                      // Passwords don't match
                      return redirect()->back()->with('error', 'Invalid login credentials.');
                  }
              } else {
                  // User not found in the database
                  return redirect()->back()->with('error', 'Invalid login credentials.');
              }
    }

    public function TeacherLogin(Request $request){
        $data= $request->validate([
           'usernameTeacher'=>'required',
           'passwordTeacher'=>'required',
        ]);

        $teacher= Teacher::where('teacher_username', $data['usernameTeacher'])->first();

        if($teacher){
            $uname= $teacher->id;
            $fullname= $teacher->teacher_first_name. " ". substr($teacher->teacher_middle_name, 0, 1). ". ". $teacher->teacher_last_name. " ". $teacher->teacher_suffix;
            if($data['passwordTeacher']===$teacher->teacher_password ){

                Session::put('user_type', 'Teacher');
                Session::put('user_id', $uname);
                Session::put('user_name', $fullname);
                return redirect()->route('teacher_dashboard'); 
        }else {
            // Passwords don't match
            return redirect()->back()->with('error', 'Invalid login credentials.');
        }
    }else {
        // User not found in the database
        return redirect()->back()->with('error', 'Invalid login credentials.');
    }
}

public function StudentLogin(Request $request){
    $data= $request->validate([
       'usernameStudent'=>'required',
       'passwordStudent'=>'required',
    ]);

    $student= Student::where('student_id', $data['usernameStudent'])->first();
  

    if($student){
       
        if($data['passwordStudent']===$student->student_password ){
            $uname= $student->id;
            if($student->student_suffix==="none"){
                $finalSuffix= " ";
            }else{
                $finalSuffix= $student->student_suffix;
            }
            $fullname= $student->student_first_name. " ". substr($student->student_middle_name, 0, 1). ". ". $student->student_last_name. " ". $finalSuffix;
            Session::put('user_type', 'Student');
            Session::put('user_id', $uname);
            Session::put('user_name', $fullname);
            return redirect()->route('student_dashboard'); 
    }else {
        // Passwords don't match
        return redirect()->back()->with('error', 'Invalid login credentials.');
    }
}else {
    // User not found in the database
    return redirect()->back()->with('error', 'Invalid login credentials.');
}
}
public function CoordinatorLogin(Request $request){
    $data= $request->validate([
       'usernameCoordinator'=>'required',
       'passwordCoordinator'=>'required',
    ]);

    $coordinator= Coordinator::where('coordinator_username', $data['usernameCoordinator'])->first();
    if($coordinator->coordinator_suffix==="none"){
        $finalSuffix= " ";
    }else{
        $finalSuffix= $coordinator->coordinator_suffix;
    }
    $fullname= $coordinator->coordinator_first_name. " ". substr($coordinator->coordinator_middle_name, 0, 1). ". ". $coordinator->coordinator_last_name. " ". $finalSuffix;

    if($coordinator){
        $uname= $coordinator->id;
        if($data['passwordCoordinator']===$coordinator->coordinator_password ){
            Session::put('user_type', 'Coordinator');
            Session::put('user_id', $uname);
            Session::put('user_name', $fullname);
            return redirect()->route('coordinator_dashboard'); 
    }else {
        // Passwords don't match
        return redirect()->back()->with('error', 'Invalid login credentials.');
    }
}else {
    // User not found in the database
    return redirect()->back()->with('error', 'Invalid login credentials.');
}
}


public function AdminDashboard(){
    $studentCount = Student::count(); 
    $teacherCount = Teacher::count(); 
    $coordinatorCount= Coordinator::count();

    $total= $studentCount+ $teacherCount + $coordinatorCount;

    $pieChart= $studentCount. ",". $teacherCount.",".$coordinatorCount;

    $admin= Admin::where('admin_type', 'Super Admin')->first();
    $sem= $admin->admin_sem;
    return view('administrator.indexAdmin', [  
    'studentCount' => $studentCount,
    'teacherCount' => $teacherCount,
    'coordinatorCount' => $coordinatorCount,
    'total' => $total,
     'pie' => $pieChart,
    'semester'=> $sem]);
}

public function AdminChangeSem(Request $request){
    $data= $request-> validate([
        'semester'=>'required',
        'adminPassword'=>'required',
    ]);

    $admin= Admin::where('admin_type', 'Super Admin')->first();

    if($admin){
        $adminpass=$admin->admin_password;
        if($adminpass===$data['adminPassword']){
            $admin->update(['admin_sem' => $data['semester']]);
            return redirect()->route('admin_dashboard'); 
        }else{
            return redirect()->back()->with('error', 'Invalid Password.');
        }
    }else{
        return redirect()->back()->with('error', 'Invalid Password.');
    }
}

public function TeacherDashboard(){
    return view('teacher.indexTeacher');
}
public function StudentDashboard(){
    return view('student.indexStudent');
}
public function CoordinatorDashboard(){
    return view('coordinator.indexCoordinator');
}
}
