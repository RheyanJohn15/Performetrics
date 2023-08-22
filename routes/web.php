<?php

use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardViews;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//LOGIN ROUTE
Route::get('/',[LoginController::class, 'LoginView'])->name('login.index');
Route::get('/privacy',[LoginController::class, 'Privacy'])->name('login_privacy');
Route::get('/aboutus',[LoginController::class, 'AboutUs'])->name('login_aboutus');
Route::get('/contactus',[LoginController::class, 'ContactUs'])->name('login_contactus');
Route::get('/terms',[LoginController::class, 'Terms'])->name('login_terms');

// LOGIN POST
Route::post('/loginAdmin',[LoginController::class, 'AdminLogin'])->name('login_Admin');
Route::post('/loginStudent',[LoginController::class, 'StudentLogin'])->name('login_Student');
Route::post('/loginTeacher',[LoginController::class, 'TeacherLogin'])->name('login_Teacher');
Route::post('/loginCoordinator',[LoginController::class, 'CoordinatorLogin'])->name('login_Coordinator');

Route::post('/contactus/sendMessage',[DashboardViews::class, 'SendFeedback'])->name('sendMessage');
//DASHBOARD ROUTE
//ADMINISTRATOR
Route::get('/administrator/dashboard',[LoginController::class, 'AdminDashboard'])->name('admin_dashboard');
Route::get('/administrator/surveyform', [DashboardViews::class, 'SurveyView'])->name('admin_survey');
Route::get('/administrator/alluser', [DashboardViews::class, 'AllUserView'])->name('allUser');

Route::get('/administrator/alluser/student', [DashboardViews::class, 'EditStudent'])->name('editStudent');
Route::get('/administrator/alluser/teacher', [DashboardViews::class, 'EditTeacher'])->name('editTeacher');
Route::get('/administrator/alluser/coordinator', [DashboardViews::class, 'EditCoordinator'])->name('editCoordinator');

Route::get('/administrator/assignteacher', [DashboardViews::class, 'AssignTeacherView'])->name('assignTeacher');
Route::get('/administrator/assigneteacher/editassignedteacher', [DashboardViews::class, 'EditAssignedTeacher'])->name('editAssignedTeacher');

Route::get('/administrator/viewdata', [DashboardViews::class, 'ViewDataView'])->name('viewData');
Route::get('/administrator/viewdata/results', [DashboardViews::class, 'ResultView'])->name('result');
Route::get('/administrator/viewdata/results/data', [DashboardViews::class, 'DataView'])->name('data');

Route::get('/administrator/classSchedules', [DashboardViews::class, 'ClassScheduleView'])->name('classSchedule');
Route::get('/administrator/classSchedules/viewschedule', [DashboardViews::class, 'ViewSchedule'])->name('viewSchedule');
Route::get('/administrator/classSchedules/viewschedule/editclassSchedules', [DashboardViews::class, 'EditClassSchedules'])->name('editClassSchedules');

Route::get('administrator/adminslist', [DashboardViews::class, 'AddAdminView'])->name('addAdminView');

Route::get('administrator/profile', [DashboardViews::class, 'ProfileView'])->name('AdminProfile');
Route::get('administrator/exportdata', [DashboardViews::class, 'ExportDataView'])->name('exportData');

Route::get('administrator/settings', [DashboardViews::class, 'Settings'])->name('settings');
Route::get('administrator/settings/credits', [DashboardViews::class, 'Credits'])->name('credits');
Route::get('administrator/feedback', [DashboardViews::class, 'Feedback'])->name('feedback');

Route::get('administrator/settings/patchnotes', [DashboardViews::class, 'PatchNotes'])->name('patch');
//STUDENT
Route::get('/student/dashboard',[LoginController::class, 'StudentDashboard'])->name('student_dashboard');
Route::get('/student/scheduletoday',[StudentController::class, 'ScheduleToday'])->name('scheduleToday');
Route::get('/student/scheduleoverall',[StudentController::class, 'ScheduleOverall'])->name('scheduleOverall');
Route::get('/student/evaluationsummary',[StudentController::class, 'EvaluationSummary'])->name('summary');
Route::get('/student/studentProfile',[StudentController::class, 'StudentProfile'])->name('studentProfile');
//TEACHER
Route::get('/teacher/dashboard',[LoginController::class, 'TeacherDashboard'])->name('teacher_dashboard');
Route::get('/teacher/classScheduleToday',[TeacherController::class, 'ClassScheduleToday'])->name('teacherClassScheduleToday');
Route::get('/teacher/classScheduleOverall',[TeacherController::class, 'ClassScheduleOverall'])->name('teacherClassScheduleOverall');
Route::get('/teacher/teacherProfile',[TeacherController::class, 'TeacherProfile'])->name('teacherProfile');
//COORDINATOR
Route::get('/coordinator/dashboard',[LoginController::class, 'CoordinatorDashboard'])->name('coordinator_dashboard');
Route::get('/coordinator/profile',[CoordinatorController::class, 'CoordinatorProfile'])->name('coordinator_profile');
Route::get('/coordinator/evaluationSummary',[CoordinatorController::class, 'EvaluationSummary'])->name('coordinator_summary');

//DASHBOARD POST
Route::post('administrator/changeSem',[LoginController::class, 'AdminChangeSem'])->name('changeSem');
Route::post('/administrator/editQuestion',[DashboardViews::class, 'ChangeQuestion'])->name('editQuestion');
Route::post('/administratot/addquestion',[DashboardViews::class, 'AddQuestion'])->name('addQuestion');
Route::post('/administrator/deletequestion', [DashboardViews::class, 'DeleteQuestion'])->name('deleteQuestion');

Route::post('/administrator/addTeacher', [DashboardViews::class, 'AddTeacher'])->name('addTeacher');
Route::post('/administrator/addStudent', [DashboardViews::class, 'AddStudent'])->name('addStudent');
Route::post('/administrator/addCoordinator', [DashboardViews::class, 'AddCoordinator'])->name('addCoordinator');
Route::post('/administrator/alluser/student/editStudent', [DashboardViews::class, 'AlterStudentPersonalInfo'])->name('alterStudent');
Route::post('/administrator/alluser/teacher/editTeacher', [DashboardViews::class, 'AlterTeacherInfo'])->name('alterTeacher');
Route::post('/administrator/alluser/coordinator/editCoordinator', [DashboardViews::class, 'AlterCoordinatorInfo'])->name('alterCoordinator');

Route::post('/administrator/assigneteacher/editassignedteacher/insertdata', [DashboardViews::class, 'AssignedTeacherUpdate'])->name('insertDataAssignedTeacher');

Route::post('/administrator/classSchedules/viewschedule/editclassSchedules/submitselectedStrand', [DashboardViews::class, 'SubmitSelectedStrand'])->name('submitSelectedStrand');
Route::post('/administrator/classSchedules/viewschedule/editclassSchedules/updateSchedule', [DashboardViews::class, 'UpdateSchedule'])->name('updateSchedule');

Route::post('/administrator/adminslist/addAdmin', [DashboardViews::class, 'AddAdmin'])->name('addAdmin');
Route::post('/administrator/profile/updateProfilePic', [DashboardViews::class, 'UpdateProfilePicAdmin'])->name('updateProfilePicAdmin');
Route::post('/administrator/profile/updatePersonalInfo', [DashboardViews::class, 'UpdatePersonalDataAdmin'])->name('updatePersonalAdmin');
Route::post('/administrator/profile/changePassword', [DashboardViews::class, 'ChangePasswordAdmin'])->name('changePassAdmin');

Route::post('/administrator/exportdata/exportpdf', [DashboardViews::class, 'ExportPdf'])->name('exportPdf');
Route::post('/administrator/exportdata/exportexcel', [DashboardViews::class, 'ExportExcel'])->name('exportExcel');
Route::post('/administrator/exportdata/exportuserPdf', [DashboardViews::class, 'ExportUserPdf'])->name('userPDF');
Route::post('/administrator/exportdata/exportuserExcel', [DashboardViews::class, 'ExportUserExcel'])->name('userExcel');

Route::post('/administrator/exportdata/exportClassSchedulePdf', [DashboardViews::class, 'ClassScheduleExportPDF'])->name('schedulePdf');

Route::post('/administrator/dashboard/addRooms', [DashboardViews::class, 'AddRoom'])->name('addRoom');
Route::post('/administrator/dashboard/addStrand', [DashboardViews::class, 'AddStrand'])->name('addStrand');
Route::post('/administrator/dashboard/addSection', [DashboardViews::class, 'AddSection'])->name('addSection');

Route::post('/administrator/dashboard/deployEvaluation', [DashboardViews::class, 'DeployEvaluation'])->name('deployEval');

Route::post('/administrator/settings/saveEvaluationData', [DashboardViews::class, 'SaveEvaluationDataOnStorage'])->name('saveEvalStorage');
Route::post('/administrator/settings/deleteOrLoadData', [DashboardViews::class, 'DeleteOrLoadData'])->name('deleteOrLoad');


//STUDENT POST
Route::post('/student/submitEvaluation',[StudentController::class, 'SubmitEvaluation'])->name('submitEvaluation');
Route::post('/student/studentProfile/updatepicture',[StudentController::class, 'UpdateProfilePicStudent'])->name('updatePicture');
Route::post('/student/studentProfile/updatePersonalData',[StudentController::class, 'UpdatePersonalData'])->name('updatePersonalData');
Route::post('/student/studentProfile/changePassword',[StudentController::class, 'ChangePassword'])->name('changePassword');

//COORDINATOR POST
Route::post('/coordinator/submitEvaluation',[CoordinatorController::class, 'SubmitEvaluation'])->name('evaluationCoordinator');
Route::post('/coordinator/updateProfilePic',[CoordinatorController::class, 'UpdateProfilePicCoordinator'])->name('updateProfilePicCoordinator');
Route::post('/coordinator/updatePersonalData',[CoordinatorController::class, 'UpdatePersonalDataCoordinator'])->name('personalDataCoordinator');
Route::post('/coordinator/changePassword',[CoordinatorController::class, 'ChangePasswordCoordinator'])->name('changePasswordCoordinator');
//TEACHER POST
Route::post('/teacher/profile/updatepicture',[TeacherController::class, 'UpdateProfilePicTeacher'])->name('updatePictureTeacher');
Route::post('/teacher/profile/updatePersonalInf',[TeacherController::class, 'UpdatePersonalDataTeacher'])->name('updatePersonalTeacher');
Route::post('/teacher/profile/changePassword',[TeacherController::class, 'ChangePassword'])->name('changePassTeacher');