<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student- {{session('user_name')}}</title>
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
    $image= App\Models\Student::where('id', session('user_id'))->first();

    if($image->student_image===1){
        $profilePic= asset('Users/Student('. session('user_id'). ").". $image->student_image_type);
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
          
              <a
                class="inline-flex items-center w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-800"
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
                class="inline-flex items-center w-full  text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('scheduleToday')}}"
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
                    d="M11.99,2C6.47,2 2,6.48 2,12s4.47,10 9.99,10C17.52,22 22,17.52 22,12S17.52,2 11.99,2zM12,20c-4.42,0 -8,-3.58 -8,-8s3.58,-8 8,-8 8,3.58 8,8 -3.58,8 -8,8z"
                  ></path>
                  <path
                  d="M12.5,7H11v6l5.25,3.15 0.75,-1.23 -4.5,-2.67z"
                ></path>
                </svg>
                <span class="ml-4">Class Schedule({{date('l')}})</span>
              </a>
            </li>
           
             <li class="relative px-6 py-3">
                <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-gray-800 text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-200"
                href="{{route('scheduleOverall')}}"
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
                    d="M11.99,2C6.47,2 2,6.48 2,12s4.47,10 9.99,10C17.52,22 22,17.52 22,12S17.52,2 11.99,2zM15.29,16.71L11,12.41V7h2v4.59l3.71,3.71L15.29,16.71z"
                  ></path>
                </svg>
                <span class="ml-4">Class Schedule(Overall)</span>
              </a>
            </li>
          
              <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('summary')}}"
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
          
              <a
                class="inline-flex items-center w-full text-sm font-semibold  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-800"
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
                href="{{route('scheduleToday')}}"
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
                d="M11.99,2C6.47,2 2,6.48 2,12s4.47,10 9.99,10C17.52,22 22,17.52 22,12S17.52,2 11.99,2zM12,20c-4.42,0 -8,-3.58 -8,-8s3.58,-8 8,-8 8,3.58 8,8 -3.58,8 -8,8z"
              ></path>
              <path
              d="M12.5,7H11v6l5.25,3.15 0.75,-1.23 -4.5,-2.67z"
            ></path>
                </svg>
                <span class="ml-4">Class Schedule({{date('l')}})</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
                <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-gray-800 text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-200"
                href="{{route('scheduleOverall')}}"
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
                    d="M11.99,2C6.47,2 2,6.48 2,12s4.47,10 9.99,10C17.52,22 22,17.52 22,12S17.52,2 11.99,2zM15.29,16.71L11,12.41V7h2v4.59l3.71,3.71L15.29,16.71z"
                  ></path>
                </svg>
                <span class="ml-4">Class Schedule(Overall)</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{route('summary')}}"
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
                        href="{{route('studentProfile')}}"
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
        @php
    $student=App\Models\Student::where('id', session('user_id'))->first();
   $sections= App\Models\ClassSchedule::where('sched_class_name', $student->student_section)->get();

  $strand= App\Models\Section::where('id', $student->student_section)->first();

  $strandname= App\Models\Strand::where('id', $strand->strand_id)->first()->strand_name;

   @endphp
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">

            <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
          >
            Class Schedule of {{$strand->year_level}} - {{$strand->section}} {{$strandname}}
            </h2>
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Teacher Name</th>
                      <th class="px-4 py-3">Classroom</th>
                      <th class="px-4 py-3">Day</th>
                      <th class="px-4 py-3">Time</th>
                      <th class="px-4 py-3">Subject</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
             
                  @foreach($sections as $section)
                  @if($section->sched_room!= 13 && $section->sched_teacher!=6 && $section->sched_subject!=204)
                  @php 
                  $teacherName= App\Models\Teacher::where('id', $section->sched_teacher)->first();
                  $teacherInitials= substr($teacherName->teacher_middle_name, 0, 1);
                  $teacherFullName= $teacherName->teacher_first_name. " ". $teacherInitials. ". ". $teacherName->teacher_last_name. " ". $teacherName->teacher_suffix;
                  $subject= App\Models\AssignedSubject::where('id', $section->sched_subject)->first();
                  $subjectName= $subject->assigned_subject;
                  $room= App\Models\Room::where('id', $section->sched_room)->first();
                  $roomName= $room->room_name;
                   @endphp

                 
                  <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                     
                     {{$teacherFullName}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                 {{$roomName}}
                  </td>
                  <td class="px-4 py-3 text-sm">
                    {{$section->sched_day}}
                     </td>
                <td class="px-4 py-3 text-sm">
             {{$section->sched_time}}
              </td>
              <td class="px-4 py-3 text-sm">
                  {{$subjectName}}
            </td>
                      </tr>
          
                      
                      @endif
                  @endforeach
              </tbody>
          </table>
        </div>
        </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
