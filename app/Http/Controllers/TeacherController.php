<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function ClassScheduleToday(){
        return view('teacher.classScheduleToday');
    }
    public function ClassScheduleOverall(){
        return view('teacher.classScheduleOverall');
    }
    public function TeacherProfile(){
        $teacher= Teacher::where('id', session('user_id'))->first();
        if($teacher->teacher_suffix==="none"){
            $finalSuffix= " ";
        }else{
            $finalSuffix= $teacher->teacher_suffix;
        }
        $fullname= $teacher->teacher_first_name. " ". $teacher->teacher_last_name. " ". $teacher->teacher_last_name. " ".$finalSuffix;
        return view('teacher.teacherProfile', [
            'fullname'=>$fullname,
            'first_name'=>$teacher->teacher_first_name,
            'last_name'=>$teacher->teacher_last_name,
            'middle_name'=>$teacher->teacher_middle_name,
            'suffix'=>$teacher->teacher_suffix,
            'username'=>$teacher->teacher_username,
            'password'=>$teacher->teacher_password,
        ]);
    }
    public function UpdateProfilePicTeacher(Request $request){
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        // Store the file in the public folder
        $file = $request->file('picture');
        $fileName = "Teacher(". session('user_id'). ").". $file->getClientOriginalExtension();
        $filePath = public_path('Users/');  // Adjust the storage path as needed

        // Save the file
        $file->move($filePath, $fileName);
        $teacher= Teacher::where('id', session('user_id'))->first();
        $teacher->update([
            'teacher_image'=>'1',
            'teacher_image_type'=> $file->getClientOriginalExtension(),
            'teacher_status'=>'1',
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
    public function UpdatePersonalDataTeacher(Request $request){
        $data= $request->validate([
           'first_name'=>'required',
           'middle_name'=>'required',
           'last_name'=>'required',
           'suffix'=>'required',
           'username'=>'required',
        ]);


        $teacher= Teacher::where('id', session('user_id'))->first();

        $teacher->update([
           'teacher_first_name'=> $data['first_name'],
           'teacher_middle_name'=>$data['middle_name'],
           'teacher_last_name'=>$data['last_name'],
           'teacher_suffix'=>$data['suffix'],
           'teacher_username'=>$data['username'],
           'teacher_status'=>'1',
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');

    }
    public function ChangePassword(Request $request){

        $data= $request->validate([
            'newPassword'=>'required',
            'currentPassword'=>'required',
        ]);

        $teacher= Teacher::where('id', session('user_id'))->first();
        if($teacher->teacher_password===$data['currentPassword']){
            $teacher->update([
                'teacher_password'=>$data['newPassword'],
                'teacher_status'=>'1',
            ]);
            return redirect()->back()->with('Success', 'Changed Password');
        }else{
            return redirect()->back()->with('Fail', 'Incorrect Password');
        }
    }
}
