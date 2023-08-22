<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Info-Perfometrics Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/profile.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
    <script src="{{asset('dashboard/js/init-alpine.js')}}"></script>
  </head>
  <link rel="icon" href="{{asset('images/icon.png')}}">
  <body>
    
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
          </span></a>
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
                    @php
                    $image2= App\Models\Admin::where('id', session('user_id'))->first();
                
                    if($image2->admin_image===1){
                        $profilePic2= asset('Users/Admin('. session('user_id'). ").". $image2->admin_image_type);
                    }else{
                        $profilePic2= asset('Users/ph.jpg');
                    }
                    @endphp
                    src="{{$profilePic2}}"
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
                Student Information
              </h4>
          @php
           $image= App\Models\Student::where('student_id', $student_id)->first();

           if($image->student_image===1){
            $profilePic= asset('Users/Student('.$image->id.").". $image->student_image_type );
           }else{
            $profilePic= asset('Users/ph.jpg');
           }
          @endphp
            <div class="flex flex-col md:flex-row h-screen w-screen mt-4">
                <!-- First div - Occupies half width and whole height -->
                <div class="md:w-1/2 h-full mr-4 px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
                  <div class="profile">
                    
                    <img class="profileImage border border-solid-gray-800" src="{{$profilePic}}" alt="">
                  </div>
                  <h4 class="mt-4 text-lg font-semibold text-xl text-center text-gray-600 dark:text-gray-300">
                    {{$fullname}}
                  </h4>
                  <h4 class=" text-sm  text-xs text-center text-gray-600 dark:text-gray-300">
                    {{$mail}}
                  </h4>
                  <h4 class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    Personal Information
                  </h4>
                  <form action="{{route('alterStudent')}}" method="POST" class="border border-solid-gray-800">
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
                              <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <input
                                type="email"
                                required
                                disabled
                                value="{{$mail}}"
                                name="email"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="Email"
                                />
                              </label>
                        </div>
                        <div class="flex-1 h-full px-4 py-3">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">LRN(Learners Reference Number)</span>
                                <input
                                type="text"
                                disabled
                                required
                                value="{{$student_id}}"
                                name="student_id"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="LRN"
                                />
                              </label>
                              <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input
                                id="password"
                                type="password"
                                required
                                disabled
                                name="password"
                                value="{{$password}}"
                                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="Password"
                                />
                              </label>
                          
                              <label style="display: none" id="gLevelSection" class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">
                                  Grade Level/Section
                                </span>  

                                <select name="sections" id="sectioningSelect"
                                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                >
                                @php
                                  $yearSections11= App\Models\Section::where('year_level', 'Grade 11')->where('strand_id', $strand)->get();
                                  $yearSections12= App\Models\Section::where('year_level', 'Grade 12')->where('strand_id', $strand)->get();

                                @endphp
                                @forEach($yearSections11 as $yearSection)
                                  <option {{$section === $yearSection->id ? 'selected' : ''}}  value="{{$yearSection->id}}">{{YearLevelSectionConcat('Grade 11', $yearSection->section)}}</option>
                                @endforeach
                                @forEach($yearSections12 as $yearSection)
                                <option {{$section === $yearSection->id ? 'selected' : ''}} value="{{$yearSection->id}}">{{YearLevelSectionConcat('Grade 12', $yearSection->section)}}</option>
                              @endforeach
                                </select>
                              </label>
                              <label style="display: none" id="strands" class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">
                                Strand
                                </span>
                                <select name="strands" onchange="disablingSelect(event, this)"
                                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                >
                                @php
                                $selectAllStrand=App\Models\Strand::where('id', '!=', 7)->get();
                                @endphp
                                @forEach($selectAllStrand as $selectStrand)
                                <option value="{{$selectStrand->id}}" {{App\Models\Strand::where('id', $strand)->first()->strand_name === $selectStrand->strand_name ? 'selected' : ''}}> {{$selectStrand->strand_name}}</option>
                               @endforeach
                                </select>
                              </label>
                             
                                <input type="hidden" name="getStudentId" value="{{$student_id}}" id="">
                       
                                <button style="display: none" id="save"
                                class="px-4 mt-8 w-full py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                              >
                              <i class="fa-regular fa-floppy-disk"></i> Save
                              </button>
                              
                        </div>
                <script>
                  function disablingSelect(event, selectedOption){
                    event.preventDefault();
                    var sectioningSelect= document.getElementById('sectioningSelect');
                    var strandSelect= document.getElementById('changeSections');
                    var currentStrand="{{$strand}}";
  
                    if(selectedOption.value===currentStrand){
                      sectioningSelect.disabled = false;
                    }else{
                      sectioningSelect.disabled = true;
                    }
                  }</script>
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
                           <h4 class="font-semibold text-lg text-gray-600 dark:text-gray-300">
                             Grade Level/Section: {{$trimYearLevel}} - {{$section_name}}
                            </h4>
                            <h4 class="mt-4 font-semibold text-lg text-gray-600 dark:text-gray-300">
                             Strand: {{App\Models\Strand::where('id', $strand)->first()->strand_name}}
                            </h4>
                    </div>
                
                    
                  </div>
                  <div class="flex-1/2 flex flex-col px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800 mt-4">
                    <h4 class="mt-4 mb-4 text-lg text-gray-600 dark:text-gray-300">
                       Options
                       </h4>
                  @if($status===0)
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
              @else
              <button
              class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg opacity-50 cursor-not-allowed focus:outline-none"
            >
            <i class="fa-solid fa-circle-exclamation"></i> Students Already Edit his/her Account Unable to make Changes
            </button>
           @endif
                  <button
                  class="px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                <i class="fa-regular fa-paper-plane"></i> Send Message
                </button>
                
                <button
                class="px-4 mt-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
              <i class="fa-solid fa-trash-can"></i> Delete
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
                function editPersonalData(){
                  const disabledInputs = document.querySelectorAll('input[disabled]');
                  const password= document.querySelectorAll('input[type=password]');
                  const text= document.getElementById('text');
                  const dropdown= document.getElementById('dropdown');
                  const editingPersonal= document.getElementById('editingPersonal');
                  const editPersonal= document.getElementById('editPersonal');
                  const gLevelSection= document.getElementById('gLevelSection');
                  const strand= document.getElementById('strands');
                  const save= document.getElementById('save');

                 const cancel= document.getElementById('cancel');

// Loop through the NodeList and remove the "disabled" attribute from each input
disabledInputs.forEach((input) => {
  input.removeAttribute('disabled');
});
password.forEach((input) => {
    input.setAttribute('type', 'text');
  });

  text.style.display= "none";
  dropdown.style.display="block";
  save.style.display="block";
    strand.style.display="block";
    gLevelSection.style.display="block";
    cancel.style.display="inline"
  editingPersonal.style.display="inline";
    editPersonal.style.display="none";
                }

             
function cancelAll(){

                 const disabledInputs = document.querySelectorAll('input');
                  const password= document.getElementById('password');
                  const text= document.getElementById('text');
                  const dropdown= document.getElementById('dropdown');
                  const editingPersonal= document.getElementById('editingPersonal');
                  const editPersonal= document.getElementById('editPersonal');
                  const gLevelSection= document.getElementById('gLevelSection');
                  const strand= document.getElementById('strands');
                  const save= document.getElementById('save');
                 const cancel= document.getElementById('cancel');
               
disabledInputs.forEach((input) => {
  input.disabled = true;
});
password.setAttribute('type', 'password');

text.style.display= "block";
  dropdown.style.display="none";
  strand.style.display="none";
    gLevelSection.style.display="none";
    save.style.display="none";

    editingPersonal.style.display="none";
    editPersonal.style.display="inline";

    cancel.style.display="none"
}



              </script>

          </div>
        </main>
      </div>
    </div>
  </body>
</html>
