<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coordinator Profile- {{session('user_name')}}</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/profile.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
  </head>
  <link rel="icon" href="{{asset('images/icon.png')}}">
  <body>
    @php
    $image= App\Models\Coordinator::where('id', session('user_id'))->first();

    if($image->coordinator_image===1){
        $profilePic= asset('Users/Coordinator('. session('user_id'). ").". $image->coordinator_image_type);
    }else{
        $profilePic= asset('Users/ph.jpg');
    }
    @endphp
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
          </span></a>
       
        
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
                        href="profile.php"
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
                        href="settings.php"
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
        <main class="h-full pb-16 overflow-y-auto">
          <div class="container px-6 mx-auto grid h-full">
            <h4 class="mt-8 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Coordinator Information
              </h4>

            <div class="flex flex-col md:flex-row h-screen w-screen mt-4">
                <!-- First div - Occupies half width and whole height -->
                <div class="md:w-1/2 h-full mr-4 px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
                  <div class="profile">
                    
                    <img class="profileImage border border-solid-gray-800" src="{{$profilePic}}" alt="profile_picture">
                    <div style="margin-top: -20px; align-items:center; display:flex; justify-content:center;" class="w-full" >  <button @click="openModal"
                       style="background: transparent">
                       <i class="fa-solid fa-camera" style="color:#7e3af2; font-size:1.75rem"></i>
                      </button></div>
                  </div>
                  <h4 class="mt-4 text-lg font-semibold text-xl text-center text-gray-600 dark:text-gray-300">
                    {{$fullname}}
                  </h4>
                  <h4 class=" text-sm  text-xs text-center text-gray-600 dark:text-gray-300">
                   Username: {{$username}}
                  </h4>
                  <h4 class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    Personal Information
                  </h4>
                  <form style="display: block" action="{{route('personalDataCoordinator')}}" id="personalForm" method="POST" class="border border-solid-gray-800">
                    @csrf
                    @method('post')
                    <div class="flex h-full w-full">
                 
                        <div class="flex-1 h-full px-4 py-3">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">First Name</span>
                                <input type="text"
                                name="first_name"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="First Name"
                                  required
                                  disabled
                                  value="{{$first_name}}"
                                />
                              </label>
                         
                              <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Middle Name</span>
                                <input
                                type="text"
                                required
                                name="middle_name"
                                disabled
                                value="{{$middle_name}}"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="Middle Name"
                                />
                              </label>
                         
                              <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Username</span>
                                <input
                                type="text"
                                required
                                name="username"
                                disabled
                                value="{{$username}}"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="Username"
                                />
                              </label>
                         
                        </div>
                        <div class="flex-1 h-full px-4 py-3">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Last Name</span>
                                <input type="text"
                                required
                                disabled
                                name="last_name"
                                value="{{$last_name}}"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="Last Name"
                                />
                              </label>
                              <label  id="text" class="block text-sm mt-4">
                                <span  class="text-gray-700 dark:text-gray-400">Suffix</span>
                                <input
                               
                                type="text"
                                required
                                disabled
                                value="{{$suffix}}"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="suffix"
                                />
                              </label>
                              <label style="display: none" id="dropdown" class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Suffix</span>
                                <select name="suffix" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                  <option value="none" {{ $suffix === 'none' ? 'selected' : '' }}>None</option>
                                  <option value="Jr." {{ $suffix === 'Jr.' ? 'selected' : '' }}>Jr.(Junior)</option>
                                  <option value="Sr." {{ $suffix === 'Sr.' ? 'selected' : '' }}>Sr.(Senior)</option>
                                  <option value="I" {{ $suffix === 'I' ? 'selected' : '' }}>I(The First)</option>
                                  <option value="II" {{ $suffix === 'II' ? 'selected' : '' }}>II(The Second)</option>
                                  <option value="III" {{ $suffix === 'III' ? 'selected' : '' }}>III(The Third)</option>
                                  <option value="IV" {{ $suffix === 'IV' ? 'selected' : '' }}>IV(The Fourth)</option>
                                  <option value="V" {{ $suffix === 'V' ? 'selected' : '' }}>V(The Fifth)</option>
                                </select>
                              </label>
                          
                          
                         
                            
                             
                             
                       
                                <button style="display: none" id="save"
                                class="px-4 mt-8 w-full py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                              >
                              <i class="fa-regular fa-floppy-disk"></i> Save
                              </button>
                              
                        </div>
            
                     </div>
              
                  </form>


                  <form action="{{route('changePasswordCoordinator')}}" style="display: none" id="changePassword" method="POST" class="border border-solid-gray-800">
                    @csrf
                    @method('post')
                    <div class="flex h-full w-full">
                 
                        <div class="flex-1 h-full px-4 py-3">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">New Password</span>
                                <input
                                id="password"
                                type="password"
                                required
                              
                                name="newPassword"
                                value=""
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="New Password"
                                />
                              </label>
                         
                            
                        </div>
                        <div class="flex-1 h-full px-4 py-3">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Current Password</span>
                                <input
                                id="password"
                                type="password"
                                required
                                
                                name="currentPassword"
                                value=""
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="Current Password"
                                />
                              </label>
                             
                                <input type="hidden" name="getStudentId" value="{{$username}}" id="">
                       
                                <button id="save"
                                class="px-4 mt-8 w-full py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                              >
                              <i class="fa-regular fa-floppy-disk"></i> Save
                              </button>
                              
                        </div>
              
                     </div>
              
                  </form>
                </div>
                
                <!-- Second div - Occupies half width and half height -->
                <div class="md:w-1/2 flex flex-col">
                  <div class="flex-1/2 px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800 mb-4">
                    <h4 class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                        School Information
                       </h4>
                    <div id="infoSchool" class="border border-solid-gray-800 p-4">
                        <h4 class=" text-lg font-semibold text-gray-600 dark:text-gray-300">
                           School Position: {{$position}}
                          </h4>
                    </div>
                
                    
                  </div>
                  <div class="flex-1/2 flex flex-col px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800 mt-4">
                    <h4 class="mt-4 mb-4 text-lg text-gray-600 dark:text-gray-300">
                       Options
                       </h4>
                 
                  <button
                  onclick="editPersonalData()" id="editPersonal"
                  class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                <i class="fa-solid fa-user-pen"></i> Edit Details
                </button>
                <button  id="editingPersonal" style="display: none" disabled
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg opacity-50 cursor-not-allowed focus:outline-none"
              >
              <i class="fa-solid fa-pen-to-square"></i>  Editing.....
              </button>

              <button
              onclick="editPassword()" id="editPassword"
              class="px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
            <i class="fa-solid fa-key"></i> Change Password
            </button>
            <button  id="editingPassword" style="display: none" disabled
            class="px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg opacity-50 cursor-not-allowed focus:outline-none"
          >
          <i class="fa-solid fa-key"></i> Changing..
          </button>
          <button onclick="returnToMain()"
          class="px-4 mt-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
        <i class="fa-solid fa-circle-arrow-left"></i> Return
        </button>
           
              <button style="display: none" id="cancel" onclick="cancelAll()"
              class="px-4 mt-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
            <i class="fa-regular fa-rectangle-xmark"></i> Cancel All Edit
            </button>
                  </div>
                </div>
              </div>
              
              
              <script>
                function returnToMain(){
                  window.location.href="{{route('coordinator_dashboard')}}";
                }
                function editPersonalData(){
                    const personalForm= document.getElementById('personalForm');
                    const changePassword= document.getElementById('changePassword');
                    const editPassword= document.getElementById('editPassword');
                    const editingPassword= document.getElementById('editingPassword');

                  const disabledInputs = document.querySelectorAll('input[disabled]');
                  const password= document.querySelectorAll('input[type=password]');
                  const text= document.getElementById('text');
                  const dropdown= document.getElementById('dropdown');
                  const editingPersonal= document.getElementById('editingPersonal');
                  const editPersonal= document.getElementById('editPersonal');
                  
                  const save= document.getElementById('save');
                 const cancel= document.getElementById('cancel');

                 personalForm.style.display="block";
                    changePassword.style.display="none";
                    editPassword.style.display="block";
                    editingPassword.style.display="none";
// Loop through the NodeList and remove the "disabled" attribute from each input
disabledInputs.forEach((input) => {
  input.removeAttribute('disabled');
});


  text.style.display= "none";
  dropdown.style.display="block";
  save.style.display="block";
   
    cancel.style.display="inline"
  editingPersonal.style.display="inline";
    editPersonal.style.display="none";
                }


                function editPassword(){
                    const personalForm= document.getElementById('personalForm');
                    const changePassword= document.getElementById('changePassword');
                    const editPassword= document.getElementById('editPassword');
                    const editingPassword= document.getElementById('editingPassword');

                    const editingPersonal= document.getElementById('editingPersonal');
                  const editPersonal= document.getElementById('editPersonal');

                  const cancel= document.getElementById('cancel');

                    personalForm.style.display="none";
                    changePassword.style.display="block";
                    editPassword.style.display="none";
                    editingPassword.style.display="block";

                    editingPersonal.style.display="none";
    editPersonal.style.display="inline";
    cancel.style.display="inline"
                }
             
function cancelAll(){

                 const disabledInputs = document.querySelectorAll('input');
                 
                  const text= document.getElementById('text');
                  const dropdown= document.getElementById('dropdown');
                  const editingPersonal= document.getElementById('editingPersonal');
                  const editPersonal= document.getElementById('editPersonal');
                
                  const save= document.getElementById('save');
                 const cancel= document.getElementById('cancel');

                 const personalForm= document.getElementById('personalForm');
                    const changePassword= document.getElementById('changePassword');
                    const editPassword= document.getElementById('editPassword');
                    const editingPassword= document.getElementById('editingPassword');

                 const pass= "{{$password}}";
               
disabledInputs.forEach((input) => {
  input.disabled = true;
});


text.style.display= "block";
  dropdown.style.display="none";
  
    save.style.display="none";

    editingPersonal.style.display="none";
    editPersonal.style.display="inline";

    personalForm.style.display="block";
                    changePassword.style.display="none";
                    editPassword.style.display="block";
                    editingPassword.style.display="none";

    cancel.style.display="none"
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
      Change Profile Picture
    </p>
   
<div class="profileHolder">
<img id="preview" class="placeholder" capture="user" accept="image/*" src="{{$profilePic}}"
 alt="alt">

    <form method="post" action="{{route('updateProfilePicCoordinator')}}" enctype="multipart/form-data">
        @csrf
       @method('post')
<input accept="image/*" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple custom-file-input" type="file" name="picture" id="picture">
<input class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit" name="upload" value="Update">
</form>  
</div>
 


  </div>

</div>
</div>
<script>
const input = document.querySelector('input[type="file"]');
const preview = document.getElementById('preview');

input.addEventListener('change', function() {
  const file = this.files[0];
  const objectURL = URL.createObjectURL(file);
  
  // Revoke object URL of previous image
  if (preview.src) {
    URL.revokeObjectURL(preview.src);
  }
  
  preview.src = objectURL;
});
</script>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
