
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfometrics Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/loading.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
    <script src="{{asset('dashboard/js/dashboard.js')}}"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
    <script src="{{asset('dashboard/js/charts-lines.js')}}" defer></script>
    <script src="{{asset('dashboard/js/charts-pie.js')}}" defer></script>
  </head>
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
@include('administrator/loading_screen', ['location' => 'dashboard'])
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column; margin-bottom:20px" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          ><span style="text-align: center; font-size:15px; ">
            {{session('user_name')}}
         </span>
          </a>

          @include('administrator/desktop_nav', ['location' => 'dashboard'])
  
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
          <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column;margin-bottom:20px" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
        
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          ><span style="text-align: center; font-size:15px">
          {{session('user_name')}}
          </span></a>
          @include('administrator/mobile_nav', ['location' => 'dashboard'])
         
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
                <div class="absolute inset-y-0 flex items-center pl-2">
                
                </div>

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
                      id="logout"
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                       
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
                 var logout= document.getElementById("logout");
                 logout.onclick=function(){
                  window.location.href="{{route('login.index')}}"
                 }
                 </script>
                  </ul>
                </template>
              </li>
            </ul>
          </div>
        </header>
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">
            @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Dashboard
            </h2>
            <!-- CTA -->
           
            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                    ></path>
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    Students
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                 {{$studentCount}}
                  </p>
                </div>
              </div>
             
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                      clip-rule="evenodd"
                    ></path>
                    
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                   Teachers
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                  {{$teacherCount}}
                  </p>
                </div>
              </div>
            
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                    ></path>
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                Coordinators
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                 {{$coordinatorCount}}
                  </p>
                </div>
              </div>
             
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                    ></path>
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    Total User
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                  {{$total}}
                  </p>
                </div>
              </div>
            </div>

            
            
            <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
              <p class="text-sm text-gray-600 dark:text-gray-400">
                Current Semester: {{$semester}} (School Year 2023-2024)<span style="float: right;"> <button @click="openModal" onclick="changeSem()"
                  class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Change Sem
                </button></span>
              </p>
            </div>
 <!-- Modal backdrop. This what you want to place close to the closing body tag -->
 
            <!-- Charts -->
     
            <div class="grid gap-6 mb-8 md:grid-cols-2">
              <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Population
                </h4>
                <canvas id="pie"></canvas>
                <div
                  class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
                >
                  <!-- Chart legend -->
                  <div class="flex items-center">
                    <span
                    style="background-color:#0e9f6e; "
                      class="inline-block w-3 h-3 mr-1  rounded-full"
                    ></span>
                    <span>Teachers</span>
                  </div>
                  <div class="flex items-center">
                    <span
                    style="background-color: #ff5a1f;"
                      class="inline-block w-3 h-3 mr-1 rounded-full"
                    ></span>
                    <span>Student</span>
                  </div>
                  <div class="flex items-center">
                    <span
                    style="background-color:#3f83f8;"
                      class="inline-block w-3 h-3 mr-1 rounded-full"
                    ></span>
                    <span>Coordinators</span>
                  </div>
                </div>
              </div>
              <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Other Options
                </h4>
                <button @click="openModal" onclick="addSection()"
                class="px-4 w-full py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
              <i class="fa-solid fa-people-group"></i>  Sections
              </button>
              <button @click="openModal" onclick="addClassroom()"
              class="px-4 mt-4 w-full py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
            <i class="fa-solid fa-chalkboard-user"></i> Classrooms
            </button>
            <button @click="openModal" onclick="addStrand()"
            class="px-4 mt-4 w-full py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
          <i class="fa-solid fa-graduation-cap"></i>  Strands
          </button>
       
          <button @click="openModal" onclick="deploy()"
          class="px-4 mt-4 w-full py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
      <i class="fa-brands fa-wpforms"></i>  Deploy Evaluation Forms
        </button>
              </div>
            </div>
            <script>
                window.onload = function() {
      pieLoad({{$pie}});
    };
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
  <form method="post" id="changeSem" style="display: none" action="{{route('changeSem')}}">
    @csrf
    @method('post')
  <div class="mt-4 mb-6">
    <!-- Modal title -->
    <p
      class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
    >
     Change Current Sem
    </p>
    <!-- Modal description -->

    <label class="block mt-4 text-sm">
          <span class="text-gray-700 dark:text-gray-400">
           Select Semester
          </span>
          <select name="semester"
            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
          >
            <option value="1st">1st Sem</option>
            <option value="2nd">2nd Sem</option>
          </select>
        </label>
        <label class="block text-sm">
          <span class="text-gray-700 dark:text-gray-400">Admin Password</span>
          <input type="password" name="adminPassword"
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="Admin Password"
          />
        </label>
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
    <input name="submit" type="submit" value="Change"
      class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
    >

  </footer>
</form>

<!--ClassRoom -->
<form method="post" id="classroom" style="display: none" action="{{route('addRoom')}}">
  @csrf
  @method('post')
<div class="mt-4 mb-6">
  <!-- Modal title -->
  <p
    class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
  >
  Add Classrooms
  </p>
  <!-- Modal description -->
  <p
  class=" text-sm  text-gray-700 dark:text-gray-300"
>
List of Rooms
</p>
@php
$rooms = App\Models\Room::where('id', '!=', 13)->get();
$r=1;
$rc=1;
@endphp
<ul id="list" class="text-sm text-gray-600 dark:text-gray-200">
  
   @foreach ($rooms as $room)
       <ol>{{$r}}. {{$room->room_name}}</ol>
       @php
           $r++;
       @endphp
   @endforeach
</ul>

<div style="display: none" id="check">
  @foreach ($rooms as $room)
  <div class="flex text-sm">
    <label class="flex items-center dark:text-gray-400">
      <input
        type="checkbox"
        name="selectedRoom[]"
        class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
        value="{{$room->id}}"
      />
      <span class="ml-2">
      {{$room->room_name}}
      </span>
    </label>
  </div>
@endforeach

</div>

      <label id="add" class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Add Room Name</span>
        <input type="text" name="addRoom"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Add Room Name"
        />
      </label>

      <label id="pass" style="display: none" class="block text-sm mt-4">
        <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
        <input type="password" name="password"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Enter Admin Password"
          
        />
      </label>
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
  <button type="button" onclick="roomCheckList()" id="deleteRoom"
  class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
><i class="fa-solid fa-trash-can"></i> Delete Rooms</button>

<button style="display: none" id="cancelRoom" type="button" onclick="roomCancel()"
class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
><i class="fa-solid fa-x"></i> Cancel</button>

  <button name="submit" type="submit" value="add" id="addR"
    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
  ><i class="fa-solid fa-square-plus"></i> Add Rooms</button>
  <button name="submit" type="submit" value="delete" style="display: none" id="deleteR"
  class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
><i class="fa-solid fa-delete-left"></i> Delete Rooms</button>
</footer>
</form>

<!--Strands-->
<form method="post" id="strands" style="display: none" action="{{route('addStrand')}}">
  @csrf
  @method('post')
<div class="mt-4 mb-6">
  <!-- Modal title -->
  <p
    class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
  >
Edit Strands
  </p>
  <!-- Modal description -->
  <p
  class=" text-sm  text-gray-700 dark:text-gray-300"
>
List of Strands
</p>
@php
$strands = App\Models\Strand::where('id', '!=', 7)->get();
$s=1;
$sc=1;
@endphp
<ul id="strandList" class="text-sm text-gray-600 dark:text-gray-200">
  
   @foreach ($strands as $strand)
       <ol>{{$s}}. {{$strand->strand_name}} - ({{$strand->strand_shortcut}})</ol>
       @php
           $s++;
       @endphp
   @endforeach
</ul>

<div style="display: none" id="checkStrand">
  @foreach ($strands as $strand)
  <div class="flex text-sm">
    <label class="flex items-center dark:text-gray-400">
      <input
        type="checkbox"
        name="selectedStrand[]"
        class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
        value="{{$strand->id}}"
      />
      <span class="ml-2">
      {{$strand->strand_name}}({{$strand->strand_shortcut}})
      </span>
    </label>
  </div>
@endforeach

</div>

      <label id="addStrand" class="block text-sm mt-4">
        <span class="text-gray-700 dark:text-gray-400">Add Strand</span>
        <input type="text" name="addStrand"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Strand Name"
          
        />
      </label>
      <label id="addStrandShortcut" class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Add Strand Shortcut</span>
        <input type="text" name="addStrandShortcut"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Strand Shortcut"
          
        />
      </label>

      <label id="passStrand" style="display: none" class="block text-sm mt-4">
        <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
        <input type="password" name="password"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Enter Admin Password"
          
        />
      </label>
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
  <button type="button" onclick="strandCheckList()" id="deleteStrand"
  class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
><i class="fa-solid fa-trash-can"></i> Delete Strand</button>

<button style="display: none" id="cancelStrand" type="button" onclick="strandCancel()"
class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
><i class="fa-solid fa-x"></i> Cancel</button>

  <button name="submit" type="submit" value="add" id="addS"
    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
  ><i class="fa-solid fa-square-plus"></i> Add Strand</button>
  <button name="submit" type="submit" value="delete" style="display: none" id="deleteS"
  class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
><i class="fa-solid fa-delete-left"></i> Delete Strand</button>
</footer>
</form>

<!--Section-->
<form method="post" id="sections" style="display: none" action="{{route('addSection')}}">
  @csrf
  @method('post')
<div class="mt-4 mb-6">
  <!-- Modal title -->
  <p
    class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
  >
Add Sections
  </p>
  <!-- Modal description -->
  <p
  class=" text-sm  text-gray-700 dark:text-gray-300"
>
List of Sections
</p>
@php
$sections = App\Models\Section::where('id', '!=', 25)->get();

$sst=1;
@endphp
<div  id="sectionList"  style="height: 30vh;" class="overflow-y-auto">
<ul class="text-sm text-gray-600 dark:text-gray-200">
  
   @foreach ($sections as $section)
   @php
       $strand= App\Models\Strand::where('id', $section->strand_id)->first();
   @endphp
       <ol> {{$section->year_level}} - {{$section->section}} -({{$strand->strand_shortcut}})</ol>
    
   @endforeach
</ul>
</div>
<div class="overflow-y-auto" style="display: none; height:30vh" id="checkSection">
  @foreach ($sections as $section)
  <div class="flex text-sm ">
    <label class="flex items-center dark:text-gray-400">
      <input
        type="checkbox"
        name="selectedSection[]"
        class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
        value="{{$section->id}}"
      />
      <span class="ml-2">
        {{$section->year_level}} - {{$section->section}} -({{$strand->strand_shortcut}})
      </span>
    </label>
  </div>
@endforeach

</div>

<label id="sectionYear" class="block mt-4 text-sm">
  <span class="text-gray-700 dark:text-gray-400">
  Year Level
  </span>
  <select name="sectionYear"
    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
  >
    <option selected disabled>~~~Select~~~</option>
    <option>Grade 11</option>
    <option>Grade 12</option>
   
  </select>
</label>

<label id="sectionStrand" class="block mt-2 text-sm">
  <span class="text-gray-700 dark:text-gray-400">
    Strand
  </span>
  <select name="sectionStrand"
    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
  >
  <option selected disabled>~~~Select~~~</option>
  @php
$strands = App\Models\Strand::where('id', '!=', 7)->get();
  @endphp
  @foreach ($strands as $strand)
  <option value="{{$strand->id}}">{{$strand->strand_name}} - ({{$strand->strand_shortcut}})</option>
  @endforeach
  </select>
</label>

      <label id="addSection"  class="mt-2 block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Section</span>
        <input type="text" name="addSection"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Name of Section"       
        />
      </label>

      <label id="passSection" style="display: none" class="block text-sm mt-4">
        <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
        <input type="password" name="password"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Enter Admin Password"
          
        />
      </label>
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
  <button type="button" onclick="sectionCheckList()" id="deleteSection"
  class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
><i class="fa-solid fa-trash-can"></i> Delete Strand</button>

<button style="display: none" id="cancelSection" type="button" onclick="sectionCancel()"
class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
><i class="fa-solid fa-x"></i> Cancel</button>

  <button name="submit" type="submit" value="add" id="addSect"
    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
  ><i class="fa-solid fa-square-plus"></i> Add Strand</button>
  <button name="submit" type="submit" value="delete" style="display: none" id="deleteSect"
  class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
><i class="fa-solid fa-delete-left"></i> Delete Strand</button>
</footer>
</form>

<!--Deploy-->
<form method="post" id="deploy" style="display: none" action="{{route('deployEval')}}">
  @csrf
  @method('post')
<div class="mt-4 mb-6">
  <!-- Modal title -->
  <p
    class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
  >
   Evaluation Form Deployment
  </p>
  <!-- Modal description -->
@php
    $deploy= App\Models\Admin::where('admin_type', 'Super Admin')->first();
@endphp
  <div class="mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">
    Update Status
    </span>
    <div class="mt-2">
      <label
        class="inline-flex items-center text-gray-600 dark:text-gray-400"
      >
        <input
          type="radio"
          class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
          name="status"
          value="true"
          {{$deploy->admin_evaluation_status === 1 ? 'checked': ''}}
        />
        <span class="ml-2">Deploy Form</span>
      </label>
      <label
        class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400"
      >
        <input
          type="radio"
          class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
          name="status"
          value="false"
          {{$deploy->admin_evaluation_status === 0 ? 'checked': ''}}
        />
        <span class="ml-2">Close Form</span>
      </label>
    </div>
  </div>

      <label class="block text-sm mt-8">
        <span class="text-gray-700 dark:text-gray-400">Admin Password</span>
        <input type="password" name="adminPass"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Admin Password"
          required
        />
      </label>
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
  <button name="submit" type="submit"
    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
  >
Update
</button>
</footer>
</form>


</div>
</div>
<!-- End of modal backdrop -->


          </div>
        </main>
      </div>
    </div>
  </body>
</html>
