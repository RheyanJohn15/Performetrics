<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coordinator- {{session('user_name')}} ?></title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
  <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
  <link rel="stylesheet" href="{{asset('dashboard/css/mycss.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
    <script src="./assets/js/charts-pie.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <link rel="icon" href="{{asset('images/icon.png')}}">


  <style>
    @keyframes slideCloseMorning {
      0%{
       height: 53vh;
      }
      100%{
        height: 0vh;
      }
    }
    @keyframes slideOpenMorning {
      0%{
       height: 0vh;
      }
      100%{
        height: 40vh;
      }
    }

    @keyframes slideCloseAfternoon {
      0%{
       height: 40vh;
      }
      100%{
        height: 0vh;
      }
    }
    @keyframes slideOpenAfternoon {
      0%{
       height: 0vh;
      }
      100%{
        height: 53vh;
      }
    }
  </style>
  <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
  <body>
    @php
    $image= App\Models\Coordinator::where('id', session('user_id'))->first();

    if($image->coordinator_image===1){
        $profilePic= asset('Users/Coordinator('. session('user_id'). ").". $image->coordinator_image_type);
    }else{
        $profilePic= asset('Users/ph.jpg');
    }
    @endphp
    <div id="completeModal" class="MainModal">
      <div class="contentModal">
      <i style="font-size:40px; color:#7e3af2;" class="fa-solid fa-circle-check fa-bounce"></i>
      <p  class="ml-6 text-lg font-bold text-gray-800">Evaluation Complete</p>
      </div>
    </div>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column; margin-bottom:20px;" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{$profilePic}}" alt=""></div>
          <a style="text-align: center;"
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
        {{session('user_name')}}
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="{{route('student_dashboard')}}"
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
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                @php
                $deployedStatus= App\Models\Admin::where('admin_type', 'Super Admin')->first();
            @endphp
            @if ($deployedStatus->admin_evaluation_status===1)
            <span class="ml-4">Evaluate Teacher</span>
            @else
            <span class="ml-4"><s> Evaluate Teacher</s>(Closed)</span>
            @endif
              </a>
            </li>
          </ul>
          <ul>
           
          
              <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('coordinator_summary')}}"
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
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                  ></path>
                </svg>
                <span class="ml-4">Evaluation Summary</span>
              </a>
            </li>
          </ul>
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
            <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column; margin-bottom:20px;" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
        {{session('user_name')}}
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="{{route('student_dashboard')}}"
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
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                @php
                $deployedStatus= App\Models\Admin::where('admin_type', 'Super Admin')->first();
            @endphp
            @if ($deployedStatus->admin_evaluation_status===1)
            <span class="ml-4">Evaluate Teacher</span>
            @else
            <span class="ml-4"><s> Evaluate Teacher</s>(Closed)</span>
            @endif
              </a>
            </li>
          </ul>
          <ul>
          
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('coordinator_summary')}}"
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
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
              ></path>
                </svg>
                <span class="ml-4">Evaluation Summary</span>
              </a>
            </li>
          </ul>
         
        </div>
      </aside>
      <div class="flex flex-col flex-1 w-full">
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
              <!-- Notifications menu -->
          
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
                        href="{{route('coordinator_profile')}}"
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
                        href="#"
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
   window.location.href="{{route('login.index')}}";
  };
</script>

                  </ul>
                </template>
              </li>
            </ul>
          </div>
        </header>
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">
<div class="containLogo">
<img class="logo" src="{{asset('images/logo.jfif')}}" alt="Logo">
<div class="headerLogo">
  <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Republic Of the Philippines</h3>
  <h3 class=" text-1xl font-semibold text-gray-700 dark:text-gray-200">Notre Dame of Talisay</h3>
  <h1 class=" text-1xl font-semibold text-gray-700 dark:text-gray-200">Carmela Valley Homes, Talisay City, Negros Occidental</h1>
</div>
</div>
<div class="personalDetails">
@php
$coordinator= App\Models\Coordinator::where('id', session('user_id'))->first();
if($coordinator->coordinator_suffix==="none"){
  $finalSuffix=" ";
}else{
  $finalSuffix= $coordinator->coordinator_suffix;
}
$fullName= $coordinator->coordinator_first_name. " ". $coordinator->coordinator_middle_name." ". $coordinator->coordinator_last_name." ". $finalSuffix;

@endphp
 <p class=" text-1xl font-semibold text-gray-700 dark:text-gray-200">Evaluator: {{$fullName}}</p> 
 <p class=" text-1xl font-semibold text-gray-700 dark:text-gray-200">Position: {{$coordinator->coordinator_position}}</p> 
</div>

            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Questions
            </h2>
            <!-- CTA -->
            <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <h5
              class="text-gray-700 dark:text-gray-200"
            >
             Rating Scale
            </h5>
            <p class="text-sm text-gray-600 dark:text-gray-400" style="display: inline-flex; align-items: center;">
  <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" viewBox="0 0 10 10" width="10" height="10">
    <circle cx="5" cy="5" r="4" fill="black"/>
  </svg>
    4 - Performance of this item is innovatively done.
</p><br>
<p class="text-sm text-gray-600 dark:text-gray-400" style="display: inline-flex; align-items: center;">
  <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" viewBox="0 0 10 10" width="10" height="10">
    <circle cx="5" cy="5" r="4" fill="black"/>
  </svg>
  3 - Performance of this item is satisfactory done.
</p><br>
<p class="text-sm text-gray-600 dark:text-gray-400" style="display: inline-flex; align-items: center;">
  <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" viewBox="0 0 10 10" width="10" height="10">
    <circle cx="5" cy="5" r="4" fill="black"/>
  </svg>
 2 - Performance of this item is partially due to some omissions.
</p><br>
<p class="text-sm text-gray-600 dark:text-gray-400" style="display: inline-flex; align-items: center;">
  <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" viewBox="0 0 10 10" width="10" height="10">
    <circle cx="5" cy="5" r="4" fill="black"/>
  </svg>
 1 - Performance of this item is partially done due to serious errors and misconceptions.
</p><br>
<p class="text-sm text-gray-600 dark:text-gray-400" style="display: inline-flex; align-items: center;">
  <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" viewBox="0 0 10 10" width="10" height="10">
    <circle cx="5" cy="5" r="4" fill="black"/>
  </svg>
 0 - Performance of this item is not observe at all.
</p>


            </div>






            <button   @click="openModal" id="buttonForTeacherSelected"
                  class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
               
                NO SELECTED TEACHER TO EVALUATE
                
                </button>
<br>
          
          <form method="post" id="evaluationSubmit"><!-- Cards -->
         @csrf
         @method('post')
         @if ($deployedStatus->admin_evaluation_status===1)
         <div style="display:none" id="wholeForm">
          <div id="teacher" class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full ">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                  >
                    <th class="px-4 py-3">TEACHER ACTIONS</th>
                    <th class="px-4 py-3">4</th>
                    <th class="px-4 py-3">3</th>
                    <th class="px-4 py-3">2</th>
                    <th class="px-4 py-3">1</th>
                    <th class="px-4 py-3">0</th>
                  </tr>
                </thead>
                <tbody
                  class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >
                @php
                $questions= App\Models\Question::where('question_criteria', 'STUDENT LEARNING ACTIONS')->get();
                $t=1;
                @endphp
                @foreach($questions as $question)
                <input type="hidden" name="ques{{$t}}" value="{{$question->id}}">
                <tr class="text-gray-700 dark:text-gray-400"><td class="px-4 py-3"><div class="flex items-center text-sm"><div><p class="font-semibold">{{$t}}. {{$question->question_content}}</p>
                  </div></div></td><td class="px-4 py-3 text-sm"><label
                          class="inline-flex items-center text-gray-600 dark:text-gray-400"
                      >
                          <input
                          type="radio"
                          class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="t{{$t}}"
                          value="4"
                          required
                          />
                          <span class="ml-2"></span>
                      </label></td>
                      </div></div></td><td class="px-4 py-3 text-sm"><label
                          class="inline-flex items-center text-gray-600 dark:text-gray-400"
                      >
                          <input
                          type="radio"
                          class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="t{{$t}}"
                          value="3"
                          required
                          />
                          <span class="ml-2"></span>
                      </label></td>
                      </div></div></td><td class="px-4 py-3 text-sm"><label
                          class="inline-flex items-center text-gray-600 dark:text-gray-400"
                      >
                          <input
                          type="radio"
                          class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="t{{$t}}"
                          value="2"
                          required
                          />
                          <span class="ml-2"></span>
                      </label></td>
                      </div></div></td><td class="px-4 py-3 text-sm"><label
                          class="inline-flex items-center text-gray-600 dark:text-gray-400"
                      >
                          <input
                          type="radio"
                          class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="t{{$t}}"
                          value="1"
                          required
                          />
                          <span class="ml-2"></span>
                      </label></td>
                      </div></div></td><td class="px-4 py-3 text-sm"><label
                          class="inline-flex items-center text-gray-600 dark:text-gray-400"
                      >
                          <input
                          type="radio"
                          class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="t{{$t}}"
                          value="0"
                          required
                          />
                          <span class="ml-2"></span>
                      </label></td></tr>

                      @php
                        $t++;
                      @endphp
                @endforeach
              
                 

                </tbody>
              </table>
            </div>
            <input type="hidden" name="teacher_id" id="teacherSelectedId" value="">
            <input type="hidden" name="student_id" value="{{session('user_id')}}">
          </div>
           <!-- New Table -->
           <br>
         
  
           <label class="block mt-4 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Comment/Remarks(Type NA if None)</span>
              <textarea
              required
              id="message"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                rows="3"
                name="remarks"
                placeholder="Remarks."
              ></textarea>
            </label><span class="text-gray-700 dark:text-gray-400" style="float: right;" id="character">0/255 Characters</span><br>
            <button
            name="submit" type="submit"
                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
             Submit Evaluation
              </button>
          </div>
              
         @else
         <h2 style="text-align: center"
         class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
       >
         Sorry Evaluation Form is Currently Closed
       </h2>
       <h2 style="text-align: center; font-size:100px"
       class="my-6  font-semibold text-gray-700 dark:text-gray-200"
     >
     <i class="fa-solid fa-face-frown"></i>
     </h2>
         @endif
        
             </form>
             <script>
                var message= document.getElementById("message");
  var character = document.getElementById("character");

  message.addEventListener('input', function(){
  
    var text= message.value;
    var remaining= 255 - text.length;

    if(remaining>=0){
        character.textContent= text.length +'/255 Characters';
    }else{
       message.value= text.slice(0,255);
       character.textContent= '255/255 Characters';
    }
    
  });

 


                  var closeModal= document.getElementById("completeModal");
                  window.addEventListener('click', function(event) {
  if (event.target === closeModal) {
    
    closeModal.style.animation= "questionClose 1s linear";
   location.reload();
    setTimeout(function() {
      closeModal.style.display= "none";
    }, 1000);
  }
});

                </script>
<script>
    $(document).ready(function() {
        $('form#evaluationSubmit').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting traditionally
            
            var formData = $(this).serialize(); // Serialize the form data
            
            $.ajax({
                type: 'POST',
                url: '{{ route('evaluationCoordinator') }}', // Set the route to handle the form submission
                data: formData,
                success: function(response) {
                    // Update the content of the page based on the response
                    $('#completeModal').css('display', 'flex');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
  </script>
                

                <br>
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
                    Select Teacher to Evaluate
                    </p>
                    @php
                      $teachers= App\Models\Teacher::where('id', '!=', 6)->get();
                    @endphp
                    @foreach($teachers as $assigned)
                    <label
                    class="inline-flex items-center text-gray-600 dark:text-gray-400"
                  >
                    <input
                      type="radio"
                      class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                      name="teacherSelected"
                      value="{{$assigned->id}}"
                    />
                    @php
                    
                     if($assigned->teacher_suffix==="none"){
                      $teachSuffix="";
                     }else{
                      $teachSuffix= $assigned->teacher_suffix;
                     }
                      $teacherFullName= $assigned->teacher_first_name. " ". substr($assigned->teacher_middle_name, 0, 1). " ". $assigned->teacher_last_name. " ".$teachSuffix;
                   

                      $evaluated= App\Models\EvaluationResult::where('evaluator_id', session('user_id'))->where('evaluator_type', 'Coordinator')
                      ->where('teacher_id', $assigned->id)->count();
                    @endphp
                    <span id="teacherStrings" class="ml-2"><strong>{{$teacherFullName}} </strong> <span style="display: {{$evaluated>0? "inline":"none"}}" >(<i class="fa-solid fa-person-circle-check" style="color: #7e3af2"></i>)</span><br></span>
                  </label><br><hr>

                   
            @endforeach
                 
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
                       id="selectButton" @click="closeModal"
                      class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    >
                      Select
                    </button>
                 
                  </footer>
                </div>
              </div>
              <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var selectButton = document.querySelector("#selectButton");
                    var teacherSelectedId = document.querySelector("#teacherSelectedId");
                    var teacherStrings = document.querySelector("#teacherStrings");
                    var buttonForSelectedTeacher = document.querySelector("#buttonForTeacherSelected");
                    selectButton.addEventListener("click", function() {
                        var selectedTeacherId = document.querySelector('input[name="teacherSelected"]:checked').value;
                        var selectedTeacherFullName = document.querySelector('input[name="teacherSelected"]:checked').nextElementSibling.querySelector("strong").textContent;
                       
                        teacherSelectedId.value = selectedTeacherId;
                        var strongElement = document.createElement("strong");
            strongElement.textContent = selectedTeacherFullName;

         

            // Clear the content and append the elements to the buttonForSelectedTeacher
            buttonForSelectedTeacher.innerHTML = ""; // Clear existing content
            buttonForSelectedTeacher.appendChild(document.createTextNode("Currently Evaluating: "));
            buttonForSelectedTeacher.appendChild(strongElement);
    
       

            document.getElementById('wholeForm').style.display="";
                    });
                });
            </script>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
