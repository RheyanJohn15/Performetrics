<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Users-Perfometrics Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/loading.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
 
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
  </head>
  <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
  <link rel="icon" href="{{asset('images/icon.png')}}">
  <body>
    @php
    $image= App\Models\Admin::where('id', session('user_id'))->first();

    if($image->admin_image===1){
        $profilePic= asset('Users/Admin('. session('user_id'). ").". $image->admin_image_type);
    }else{
        $profilePic= asset('Users/ph.jpg');
    }
    @endphp
@include('administrator/loading_screen', ['location' => 'all_user'])
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen}"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
        <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column; margin-bottom:20px;" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
        
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          ><span style="text-align: center; font-size:15px">
          {{session('user_name')}}
         </span> </a>
       @include('administrator/desktop_nav', ['location'=> 'all_user'])
          <div class="px-6 my-6">
          
          </div>
        </div>
      </aside>
      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
      ></div>
      <aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
        <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column;margin-bottom:20px;" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
        
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          ><span style="text-align: center; font-size:15px">
         {{session('user_name')}}
        </span>  </a>
        @include('administrator/mobile_nav', ['location'=>'all_user'])
        </div>
      </aside>
      <div class="flex flex-col flex-1">
        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
          <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
          >
            <!-- Mobile hamburger -->
            <button
              class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
              @click="toggleSideMenu"
              aria-label="Menu"
            >
              <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button>
            <!-- Search input -->
            <div class="flex justify-center flex-1 lg:mr-32">
              <div
                class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
              >
                <div class="absolute inset-y-0 flex items-center pl-2">
                  <svg
                    class="w-4 h-4"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <input
                  class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                  type="text"
                  placeholder="Search for Users"
                  aria-label="Search"
                />
              </div>
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Theme toggler -->
              <li class="flex">
                <button
                  class="rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleTheme"
                  aria-label="Toggle color mode"
                >
                  <template x-if="!dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                      ></path>
                    </svg>
                  </template>
                  <template x-if="dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </template>
                </button>
              </li>
              <li class="flex">
                <button
                @click="openModal"
                  class="rounded-md focus:outline-none focus:shadow-outline-purple"
                  aria-label="Toggle color mode">
                 
                <i class="fa-solid fa-arrow-down-wide-short"></i>
                </button>
              </li>
             <!-- Notifications menu -->
             <li class="relative">
                <button
                  class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleNotificationsMenu"
                  @keydown.escape="closeNotificationsMenu"
                  aria-label="Notifications"
                  aria-haspopup="true"
                >
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
                    ></path>
                  </svg>
                  <!-- Notification badge -->
              
                </button>
                <template x-if="isNotificationsMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeNotificationsMenu"
                    @keydown.escape="closeNotificationsMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700"
                    aria-label="submenu"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="messages.php"
                      >
                        <span>Messages</span>
                        <span
                          class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                        >
                         
                        </span>
                      </a>
                    </li>
                  
                  </ul>
                </template>
              </li>
              
             
              <!-- Profile menu -->
              <li class="relative">
                <button
                  class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                  @click="toggleProfileMenu"
                  @keydown.escape="closeProfileMenu"
                  aria-label="Account"
                  aria-haspopup="true"
                >
                  <img
                    class="object-cover w-8 h-8 rounded-full"
                   src="{{$profilePic}}"
                    alt=""
                    aria-hidden="true"
                  />
                </button>
                <template x-if="isProfileMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeProfileMenu"
                    @keydown.escape="closeProfileMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                    aria-label="submenu"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="{{route('AdminProfile')}}"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                          ></path>
                        </svg>
                        <span>Profile</span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="{{route('settings')}}"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                          ></path>
                          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li class="flex">
                      <button
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                       id="logout"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                          ></path>
                        </svg>
                        <span>Log out</span>
</button>
                    </li>
                    <script>
  var logoutBtn = document.getElementById("logout");
  logoutBtn.onclick = function() {
    window.location.href = "{{route('login.index')}}";
  };
</script>

                  </ul>
                </template>
              </li>
            </ul>
          </div>
        </header>
        <main class="h-full pb-16 overflow-y-auto">
          <div class="container px-6 mx-auto grid">
           
         

          <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
           All Users
            </h2>
            
         <div>
         <button onclick="student()"
         
            style="justify-content:center; margin-bottom:8px; float:right;"
                  class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M13,8c0,-2.21 -1.79,-4 -4,-4S5,5.79 5,8s1.79,4 4,4S13,10.21 13,8zM15,10v2h3v3h2v-3h3v-2h-3V7h-2v3H15zM1,18v2h16v-2c0,-2.66 -5.33,-4 -8,-4S1,15.34 1,18z"
                  ></path>
                </svg>
                <span class="ml-4">Add Students</span>
</button>
         </div>
            
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full ">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Student Name</th>
                      <th class="px-4 py-3">LRN</th>
                      <th class="px-4 py-3">Password</th>
                      <th class="px-4 py-3">Year Level</th>
                      <th class="px-4 py-3">Strand</th>
                     
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
    @php

  $students= App\Models\Student::all();
$s=1;
  @endphp

  @foreach($students as $student)
  @php
   $firstName= $student->student_first_name;
   $lastName= $student->student_last_name;
   $middleName= $student->student_middle_name;
   $suffix= $student->student_suffix;
   if($suffix==="none"){
    $finalSuffix=" ";
   }else{
    $finalSuffix= $suffix;
   }
   $fullname= $lastName. ", ". $firstName. " ". $middleName. " ". $finalSuffix;
   $strandId= App\Models\Strand::where('id', $student->student_strand)->first();
   $strand= $strandId->strand_name;

if($student->student_image===1){
 $profilePic= asset('Users/Student('.$student->id.").". $student->student_image_type );
}else{
 $profilePic= asset('Users/ph.jpg');
}
  @endphp
  <tr style="cursor:pointer" onclick="editStudent{{$s}}()" class="text-gray-700 dark:text-gray-400"><td class="px-4 py-3"><div class="flex items-center text-sm">     
    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block"><img class="object-cover w-full h-full rounded-full" src="{{$profilePic}}"/> 
      <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div></div><div><p class="font-semibold">{{$fullname}}</p>  
        <p class="text-xs text-gray-600 dark:text-gray-400">Student</p></div></div></td><td class="px-4 py-3 text-sm">{{$student->student_id}}</td> 
        <td class="px-4 py-3 text-xs"><span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{$student->student_password}}</span>          
        </td><td class="px-4 py-3 text-sm">{{$student->student_year_level}}</td><td class="px-4 py-3 text-sm">{{$strand}}</td>  
      </tr>
      <script>
        function editStudent{{$s}}(){
          const student_id = '{{ $student->student_id}}';
          window.location.href= "{{route('editStudent')}}?student_id="+student_id;
        }
      </script>
      @php $s++ @endphp
           @endforeach
               
                      
                      
                      </tbody>
                </table>
              </div>
              
            </div>
<br><br>

                
<div>
<button onclick="teacher()"
            style="justify-content:center;margin-bottom:8px; float:right"
                  class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M20,7h-5V4c0,-1.1 -0.9,-2 -2,-2h-2C9.9,2 9,2.9 9,4v3H4C2.9,7 2,7.9 2,9v11c0,1.1 0.9,2 2,2h16c1.1,0 2,-0.9 2,-2V9C22,7.9 21.1,7 20,7zM9,12c0.83,0 1.5,0.67 1.5,1.5S9.83,15 9,15s-1.5,-0.67 -1.5,-1.5S8.17,12 9,12zM12,18H6v-0.75c0,-1 2,-1.5 3,-1.5s3,0.5 3,1.5V18zM13,9h-2V4h2V9zM18,16.5h-4V15h4V16.5zM18,13.5h-4V12h4V13.5z"
                  ></path>
                </svg>
                <span class="ml-4">Add Teachers</span>
                    </button>
</div>

                      <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Teacher</th>
                      <th class="px-4 py-3">Username</th>
                      <th class="px-4 py-3">Passwords</th>
                   
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >


                  @php 
                  $teachers= App\Models\Teacher::where('teacher_username', '!=', 'NULL')->get();
                  $t=1;
                  @endphp

                  @foreach($teachers as $teacher)
                  @php
                   $firstNameTeacher= $teacher->teacher_first_name;
                   $lastNameTeacher= $teacher->teacher_last_name;
                   $middleNameTeacher= $teacher->teacher_middle_name;
                   $suffixTeacher= $teacher->teacher_suffix;
                   
                   if($suffixTeacher==="none"){
                    $suffixTeacherFinal= " ";
                   }else{
                    $suffixTeacherFinal=$suffixTeacher;
                   }

                   if($teacher->teacher_image===1){
 $profilePic= asset('Users/Teacher('.$teacher->id.").". $teacher->teacher_image_type );
}else{
 $profilePic= asset('Users/ph.jpg');
}
                   $TeacherFullName= $lastNameTeacher. ", ". $firstNameTeacher. " ". $middleNameTeacher. " ". $suffixTeacherFinal;
                  @endphp
                  <tr style="cursor: pointer" onclick="editTeacher{{$t}}()" class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                <img class="object-cover w-full h-full rounded-full" src="{{ $profilePic }}" alt="" loading="lazy" />
                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                            </div>
                            <div>
                                <p class="font-semibold">{{ $TeacherFullName }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Teacher</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">{{ $teacher->teacher_username }}</td>
                    <td class="px-4 py-3 text-xs">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{ $teacher->teacher_password }}</span>
                    </td>
                   <script>
                    function editTeacher{{ $t }}(){
                      const teacher_id= {{$teacher->id}};
                      window.location.href= "{{route('editTeacher')}}?teacher_id="+teacher_id;
                    }
                   </script>
                </tr>
                @php $t++ @endphp
                  @endforeach
 
                  </tbody>
                </table>
              </div>
              
            </div>
<br><br>
<div>
<button onclick="coordinator()"
            style=" justify-content:center;margin-bottom:8px;float:right"
                  class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M16.5,12c1.38,0 2.49,-1.12 2.49,-2.5S17.88,7 16.5,7C15.12,7 14,8.12 14,9.5s1.12,2.5 2.5,2.5zM9,11c1.66,0 2.99,-1.34 2.99,-3S10.66,5 9,5C7.34,5 6,6.34 6,8s1.34,3 3,3zM16.5,14c-1.83,0 -5.5,0.92 -5.5,2.75L11,19h11v-2.25c0,-1.83 -3.67,-2.75 -5.5,-2.75zM9,13c-2.33,0 -7,1.17 -7,3.5L2,19h7v-2.25c0,-0.85 0.33,-2.34 2.37,-3.47C10.5,13.1 9.66,13 9,13z"
                  ></path>
                </svg>
                <span class="ml-4">Add Coordinators</span>
</button>
</div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Coordinator</th>
                      <th class="px-4 py-3">Username</th>
                      <th class="px-4 py-3">Passwords</th>
                   
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >

           @php 
            $coordinators= App\Models\Coordinator::all();
            $c=1;
           @endphp

           @foreach($coordinators as $coordinator)
           @php 
            $firstNameCoordinator= $coordinator->coordinator_first_name;
            $lastNameCoordinator= $coordinator->coordinator_last_name;
            $middleNameCoordinator= $coordinator->coordinator_middle_name;
            $suffixCoordinator= $coordinator->coordinator_suffix;
            if($suffixCoordinator==="none"){
              $suffixCoordinatorFinal= " ";
            }else{
              $suffixCoordinatorFinal= $suffixCoordinator;
            }
            $fullnameCoordinator= $lastNameCoordinator. ", ". $firstNameCoordinator. " ". $middleNameCoordinator. " ". $suffixCoordinatorFinal;
            if($coordinator->coordinator_image===1){
 $profilePic= asset('Users/Coordinator('.$coordinator->id.").". $coordinator->coordinator_image_type );
}else{
 $profilePic= asset('Users/ph.jpg');
}
           @endphp
           <tr style="cursor: pointer" onclick="editCoordinator{{$c}}()" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                        <img class="object-cover w-full h-full rounded-full" src="{{ $profilePic}}" alt="" loading="lazy" />
                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                    </div>
                    <div>
                        <p class="font-semibold">{{ $fullnameCoordinator }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Teacher</p>
                    </div>
                </div>
            </td>
            <td class="px-4 py-3">{{ $coordinator->coordinator_username }}</td>
            <td class="px-4 py-3 text-xs">
                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">{{ $coordinator->coordinator_password }}</span>
            </td>
         <script>
          function editCoordinator{{ $c }}(){
            const coordinator_id= {{$coordinator->id}};
            window.location.href= "{{route('editCoordinator')}}?coordinator_id="+coordinator_id;
          }
         </script>
        </tr>
        @php $c++; @endphp
 @endforeach        
                   
                
  

                  
                  </tbody>
                </table>
              </div>
            </div>
 <div id="studentModal" class="studentModal">
            <div id="studentContent" class="contentStudent">
              <div style="width: 100%; height:2%;"><button style="float: right;" onclick="closeStudent()">X</button></div>
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Add Students
            </h2>
            <!-- CTA -->
        
            <!-- Big section cards -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Provide Student Credentials
            </h4>
            <form method="post" action="{{route('addStudent')}}">
              @csrf
              @method('post')
            <div 
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Last Name</span>
             
              <input type="text"
              required
              name="lastNameStudent"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Last Name"
              >
              
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">First Name</span>
           
              <input
              required
              type="text"
              name="firstNameStudent"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="First Name"
              >
              
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
 
              <input required
              type="text"
              name="middleNameStudent"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Middle Name"
              >
          
              
            </label>
            
            <label id="senior" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Suffix</span>
                <select name="suffixStudent" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="none">None</option>
                <option value="Jr.">Jr.(Junior)</option>
                  <option value="Sr.">Sr.(Senior)</option>
                  <option value="I">I(The First)</option>
                  <option value="II">II(The Second)</option>
                  <option value="III">III(The Third)</option>
                  <option value="IV">IV(The Fourth)</option>
                  <option value="V">V(The Fifth)</option>
                </select></label><br>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Learners Reference Number(LRN)</span>
              <input
             
              required
              type="number"
              name="student_id"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="117869070047"
              >
            
            </label>
            <p></p>
         
            
        
                <label id="senior" style="display: block;" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Year Level</span>
                <select name="year" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                  <option>Grade 11</option>
                  <option>Grade 12</option>
                </select></label>
                <label id="strand" style="display: block;" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Strands</span>
                <select name="strand" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                  @php
                   $strands= App\Models\Strand::all();
                  @endphp
                  @foreach($strands as $strand)
                  <option value="{{$strand->id}}" >{{$strand->strand_name}}</option>
                 @endforeach
                </select></label>
                
            
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Email</span>
            
              <input required
              type="email"
              name="email"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Email"
              >
              
            </label>
                <br>
            <button type="submit"
            id="add"
            name="addStudent"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Add
          </button><br><br><br>
          </form>
            </div>
           
            </div>
          </div>

            <script>
            
              function student(){
                var studentModal=  document.getElementById("studentModal");
                var studentContent=  document.getElementById("studentContent");
               studentModal.style.display = "block";
               studentContent.style.animation= "zoom 0.5s linear";
              }
              var studentModal=  document.getElementById("studentModal");
              var studentContent=  document.getElementById("studentContent");
              window.addEventListener('click', function(event) {
  if (event.target === studentModal) {
    
    studentContent.style.animation= "close 0.5s linear";
   
    setTimeout(function() {
      studentModal.style.display= "none";
    }, 500);
  }
});

function closeStudent(){
  var studentContent=  document.getElementById("studentContent");
  var studentModal=  document.getElementById("studentModal");
  studentContent.style.animation= "close 0.5s linear";
  setTimeout(function() {
    studentModal.style.display = "none";
    }, 500);
}
            </script>


<div id="teacherModal" class="teacherModal">
  <div id="teacherContent" class="contentTeacher">
  <div style="width: 100%; height:2%;"><button style="float: right;" onclick="closeTeacher()">X</button></div>
  <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Add Teachers
            </h2>
            <!-- CTA -->
        
            <!-- Big section cards -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Provide Teachers Credentials
            </h4>
            <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <form method="post" action="{{route('addTeacher')}}">
              @csrf
              @method('post')
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Last Name</span>
              <input
              required
              name="last_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Last Name"
              />
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">First Name</span>
              <input
              required
              name="first_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="First Name"
              />
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
              <input
              required
              name="middle_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Middle Name"
              />
            </label>
            <label id="senior" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Suffix</span>
                <select name="suffix" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="none">None</option>
                <option value="Jr.">Jr.(Junior)</option>
                  <option value="Sr.">Sr.(Senior)</option>
                  <option value="I">I(The First)</option>
                  <option value="II">II(The Second)</option>
                  <option value="III">III(The Third)</option>
                  <option value="IV">IV(The Fourth)</option>
                  <option value="V">V(The Fifth)</option>
                </select></label>
            <br>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Username</span>
              <input
              required
              name="username"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Username"
              />
            </label>
           
            <br>
            <button
            name="addTeacher" type="submit"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Add
          </button>
          </form>
            </div>
           
  </div>
</div>

<script>
  function teacher(){
    var teacherModal= document.getElementById("teacherModal");
    var teacherContent= document.getElementById("teacherContent");
    teacherModal.style.display="block";
    teacherContent.style.animation= "zoom 0.5s linear";
  }
  var teacherModal=  document.getElementById("teacherModal");
  var teacherContent= document.getElementById("teacherContent");
              window.addEventListener('click', function(event) {
  if (event.target === teacherModal) {
    teacherContent.style.animation= "close 0.5s linear";
    setTimeout(function() {
      teacherModal.style.display= "none";
    }, 500);

  }
});

function closeTeacher(){
  var teacherModal=  document.getElementById("teacherModal");
  var teacherContent= document.getElementById("teacherContent");
  teacherContent.style.animation = "close 0.5s linear";
  setTimeout(function() {
      teacherModal.style.display= "none";
    }, 500);
}
</script>


<div id="coordinatorModal" class="coordinatorModal">
  <div id="coordinatorContent" class="contentCoordinator">
  <div style="width: 100%; height:2%;"><button style="float: right;" onclick="closeCoordinator()">X</button></div>
  <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Add Coordinators
            </h2>
            <!-- CTA -->
        
            <!-- Big section cards -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Provide Coordinator's Credentials
            </h4>
            <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <form method="post" action="{{route('addCoordinator')}}">
              @csrf
              @method('post')
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Last Name</span>
              <input
              required
              name="last_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Last Name"
              />
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">First Name</span>
              <input
              required
              name="first_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="First Name"
              />
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
              <input
              required
              name="middle_name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Middle Name"
              />
            </label>
            <label id="senior" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Suffix</span>
                <select name="suffix" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="none">None</option>
                <option value="Jr.">Jr.(Junior)</option>
                  <option value="Sr.">Sr.(Senior)</option>
                  <option value="I">I(The First)</option>
                  <option value="II">II(The Second)</option>
                  <option value="III">III(The Third)</option>
                  <option value="IV">IV(The Fourth)</option>
                  <option value="V">V(The Fifth)</option>
                </select></label>
            <br>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Username</span>
              <input
              required
              name="username"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Username"
              />
            </label>
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Position</span>
              <input
              required
              name="Position"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Position"
              />
            </label>
            <br>
            <button
            name="addCoordinator" type="submit"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Add
          </button>
          </form>

         
            </div>
  </div>
</div>

<script>
function coordinator(){
  var coordinatorModal= document.getElementById("coordinatorModal");
  var coordinatorContent= document.getElementById("coordinatorContent");
  coordinatorModal.style.display= "block";
  coordinatorContent.style.animation= "zoom 0.5s linear";
}
var coordinatorModal=  document.getElementById("coordinatorModal");
var coordinatorContent= document.getElementById("coordinatorContent");
              window.addEventListener('click', function(event) {
  if (event.target === coordinatorModal) {
    coordinatorContent.style.animation= "close 0.5s linear";
    setTimeout(function() {
      coordinatorModal.style.display= "none";
    }, 500);
    
  }
});

function closeCoordinator(){
  var coordinatorModal=  document.getElementById("coordinatorModal");
  var coordinatorContent= document.getElementById("coordinatorContent");

  coordinatorContent.style.animation="close 0.5s linear";
  setTimeout(function() {
      coordinatorModal.style.display= "none";
    }, 500);
}
</script>
            <div
      x-show="isModalOpen"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    >
      <!-- Modal -->
      <div
        x-show="isModalOpen"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform translate-y-1/2"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0  transform translate-y-1/2"
        @click.away="closeModal"
        @keydown.escape="closeModal"
        class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
        role="dialog"
        id="modal"
      >
        <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
        <header class="flex justify-end">
          <button
            class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
            aria-label="close"
            @click="closeModal"
          >
            <svg
              class="w-4 h-4"
              fill="currentColor"
              viewBox="0 0 20 20"
              role="img"
              aria-hidden="true"
            >
              <path
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
                fill-rule="evenodd"
              ></path>
            </svg>
          </button>
        </header>
        <!-- Modal body -->
        <div class="mt-4 mb-6">
          <!-- Modal title -->
          <p
            class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
          >
          Display Filter
          </p>
          <!-- Modal description -->
          <div class="flex mt-6 text-sm">
            <form method="post">
                <label class="flex items-center dark:text-gray-400">
                  <input 
                  name="gender"
                    type="checkbox"
                    class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  />
                  <span class="ml-2">
                    By Gender
                  </span>
                </label>
              </div>
              <div class="flex mt-6 text-sm">
                <label class="flex items-center dark:text-gray-400">
                  <input name="year_level"
                    type="checkbox"
                    class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  />
                  <span class="ml-2">
                    By Year Level
                  </span>
                </label>
              </div>
              <div class="flex mt-6 text-sm">
                <label class="flex items-center dark:text-gray-400">
                  <input
                    type="checkbox" name="strand"
                    class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  />
                  <span class="ml-2">
                    By Strand
                  </span>
                </label>
              </div>
              <div class="flex mt-6 text-sm">
                <label class="flex items-center dark:text-gray-400">
                  <input 
                  name="allstudent"
                    type="checkbox"
                    class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  />
                  <span class="ml-2">
                  All Student
                  </span>
                </label>
              </div>
              <div class="flex mt-6 text-sm">
                <label class="flex items-center dark:text-gray-400">
                  <input
                  name="allteacher"
                    type="checkbox"
                    class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  />
                  <span class="ml-2">
                    All Teacher
                  </span>
                </label>
              </div>
        </div>
        <footer
          class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
        >
          <button
            @click="closeModal"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
          >
            Cancel
          </button>
          <button
          name="accept"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Accept
          </button>
        </footer>
        </form>

     
      </div>
    </div>
                  
          


          </div>
        </main>
      </div>
    </div>
  </body>
</html>
