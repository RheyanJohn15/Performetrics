<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Scores-Perfometrics Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('/css/tailwind.css')}}" />
    <link rel="stylesheet" href="{{asset('/dashboard/css/mycss.css')}}" />
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
    <script src="./assets/js/charts-bars.js" defer></script>
  </head>
  <script src="https://kit.fontawesome.com/ccaf8ead0b.js" crossorigin="anonymous"></script>
  <link rel="icon" href="{{asset('images/icon.png')}}">
 <style>
  tbody .scores:hover{
background-color:#e5e7eb; 
    cursor: pointer; 
  }
 </style>
  <body>
    @php
    $image= App\Models\Admin::where('id', session('user_id'))->first();

    if($image->admin_image===1){
        $profilePic= asset('Users/Admin('. session('user_id'). ").". $image->admin_image_type);
    }else{
        $profilePic= asset('Users/ph.jpg');
    }
    @endphp
  <div id="modalContainer" class="MainModal">
              <div class="contentModal">
              <h4
              id="header"
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
           <br>
            </h4>
              <h4
              id="question"
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
            
            </h4>
              </div>
            </div>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen}"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
        <div style="width: 100%; align-items:center; justify-content:center; display:flex; flex-direction:column;margin-bottom:20px;" class="logoContain"><img style="width: 50%; border-radius:50%;" src="{{asset('images/logo.jfif')}}" alt=""></div>
        
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          ><span style="text-align: center; font-size:15px">
         {{session('user_name')}}
         </span> </a>
        @include('administrator/desktop_nav', ['location'=>'view_data'])
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
       @include('administrator/mobile_nav', ['location'=>'view_data'])
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
          <div class="container px-6 mx-auto grid">
          
         
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Evaluation Results
            </h2>
            <!-- CTA -->
        
            <!-- Big section cards -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
            </h4>
     
         @php
         $checkStudent= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('teacher_id', $teacher_id)->get();
         $checkCoordinator= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('teacher_id', $teacher_id)->get();
         @endphp

         @if($checkStudent->count()>0)
            <div id="teacher" style="display: block;" class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Student LRN</th>
                      @php
                      $questions1= App\Models\Question::where('question_criteria', 'TEACHER ACTIONS')->get();
                      $t=1;
                      @endphp
                      @foreach($questions1 as $question)
                      <th class="px-4 py-3"><button onclick="openTheModal('Teacher Actions Question No.(T{{$t}})', '{{$question->question_content}}')">T{{$t}}</button></th>
                      @php $t++; @endphp
                      @endforeach
                      <th class="px-4 py-3">Remarks</th>

                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >

                  @php
                   $evaluations= App\Models\EvaluationResult::where('evaluator_type', 'Student')->where('teacher_id', $teacher_id)->distinct()->pluck('evaluator_id');
                   $finalAverage=0;
                   $count=0;
                  @endphp
                  @foreach($evaluations as $evaluation)
                  <tr onclick="next('{{$evaluation}}', '{{$teacher_id}}')" class="text-gray-700 dark:text-gray-400 scores"><td class="px-4 py-3"><div class="flex items-center text-sm"><div><p class="font-semibold">
                  {{App\Models\Student::where('id', $evaluation)->first()->student_id}}  
                  </p></div></div></td>
                  
                    @foreach($questions1 as $question)
                    @php
                  $score= App\Models\EvaluationResult::where('evaluator_id', $evaluation)->where('question_id', $question->id)->where('teacher_id', $teacher_id)->first();
                  @endphp
                    <td class="px-4 py-3 text-sm">
                    {{$score->evaluation_score}}
                    </td>
                    @endforeach
                    <td class="px-4 py-3 text-sm">
                      {{App\Models\EvaluationResult::where('evaluator_type','Student')->where('evaluator_id', $evaluation)->where('teacher_id', $teacher_id)->first()->evaluation_remarks}}
                      </td>
                      <script>
                        function next(evaluator_id, teacher_id){
                       
                          window.location.href= "{{route('data')}}?evaluator_id="+ evaluator_id + "&teacher_id="+teacher_id+ "&type=Student";
                        }
                      </script>
                  @endforeach
                
                  <tr style="background-color:#d3d3d3 ;" class="text-gray-700 "><td class="px-4 py-3"><div class="flex items-center text-sm"><div><p class="font-semibold">Total Scores</p></div></div></td>
                    @foreach($questions1 as $question)
                   @php
                   $score= App\Models\EvaluationResult::where('question_id', $question->id)->where('teacher_id', $teacher_id)->where('evaluator_type','Student')->get();
                   $totalScore= $score->sum('evaluation_score');
                   $totalRows= $score->count('evaluation_score');
                   if($totalScore===0 && $totalRows===0){
                    $average=0;
                   }else{
                    $average= $totalScore/$totalRows;
                   }

                   $finalAverage+=$average;
                   $count++;
                   @endphp
                   <td class="px-4 py-3 text-sm">
                   {{number_format($average,2)}}
                   </td>
                   @endforeach
                   <td class="px-4 py-3 text-sm">
                    @php $formatAverage= $finalAverage/$count @endphp
                   Total Average: {{number_format($formatAverage, 2)}}
                    </td>
                  </tr>
              
                  

                  
                  </tbody>
                </table>
              </div>
            </div>
        @else
        <h4
        class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
      >
      No Student Evaluation Result
      </h4>

        @endif
            <br><br>
            @if($checkCoordinator->count()>0)
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              View Result of Coordinator Evaluators
            </h4>
            <div id="student" style="display:block;" class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Coordinator</th>
                      @php
                      $questions2= App\Models\Question::where('question_criteria', 'STUDENT LEARNING ACTIONS')->get();
                      $s=1;
                      @endphp
                      @foreach($questions2 as $question)
                      <th class="px-4 py-3"><button onclick="openTheModal('Teacher Actions Question No.(T{{$t}})', '{{$question->question_content}}')">S{{$s}}</button></th>
                      @php $s++; @endphp
                      @endforeach
                      <th class="px-4 py-3">Remarks</th>

                    </tr>
                    <tbody>
                      @php
                   $evaluationsCoordinator= App\Models\EvaluationResult::where('evaluator_type', 'Coordinator')->where('teacher_id', $teacher_id)->distinct()->pluck('evaluator_id');
                   $finalAverageCoordinator=0;
                   $countCoordinator=0;
                  @endphp
                   @foreach($evaluationsCoordinator as $evaluation)
                   <tr onclick="next('{{$evaluation}}', '{{$teacher_id}}')" class="text-gray-700 dark:text-gray-400 scores"><td class="px-4 py-3"><div class="flex items-center text-sm"><div><p class="font-semibold">
                   {{App\Models\Coordinator::where('id', $evaluation)->first()->coordinator_last_name. " ". substr(App\Models\Coordinator::where('id', $evaluation)->first()->coordinator_first_name, 0, 1). ". "}}  
                   </p></div></div></td>
                   
                     @foreach($questions2 as $question)
                     @php
                   $score= App\Models\EvaluationResult::where('evaluator_id', $evaluation)->where('question_id', $question->id)->where('teacher_id', $teacher_id)->first();
                   @endphp
                     <td class="px-4 py-3 text-sm">
                     {{$score->evaluation_score}}
                     </td>
                     @endforeach
                     <td class="px-4 py-3 text-sm">
                       {{App\Models\EvaluationResult::where('evaluator_type','Coordinator')->where('evaluator_id', $evaluation)->where('teacher_id', $teacher_id)->first()->evaluation_remarks}}
                       </td>
                       <script>
                        function next(evaluator_id, teacher_id){
                       
                          window.location.href= "{{route('data')}}?evaluator_id="+ evaluator_id + "&teacher_id="+teacher_id+ "&type=Coordinator";
                        }
                      </script>
                   @endforeach
               
                   <tr style="background-color:#d3d3d3 ;" class="text-gray-700 "><td class="px-4 py-3"><div class="flex items-center text-sm"><div><p class="font-semibold">Total Scores</p></div></div></td>
                     @foreach($questions2 as $question)
                    @php
                    $score2= App\Models\EvaluationResult::where('question_id', $question->id)->where('teacher_id', $teacher_id)->where('evaluator_type','Coordinator')->get();
                    $totalScore2= $score2->sum('evaluation_score');
                    $totalRows2= $score2->count('evaluation_score');
                    if($totalScore2===0 && $totalRows2===0){
                     $average2=0;
                    }else{
                     $average2= $totalScore2/$totalRows2;
                    }
 
                    $finalAverageCoordinator+=$average2;
                    $countCoordinator++;
                    @endphp
                    <td class="px-4 py-3 text-sm">
                    {{number_format($average2, 2)}}
                    </td>
                    @endforeach
                    <td class="px-4 py-3 text-sm">
                     @php $formatAverage2= $finalAverageCoordinator/$countCoordinator @endphp
                    Total Average: {{number_format($formatAverage2, 2)}}
                     </td>
                   </tr>
               
                  </tbody>
                </table>
              </div>
            </div>
            @else
            <h4
            class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
          >
           No Coordinator Evaluation Result
          </h4>
          @endif
            
            <div id="conclude"
            class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs"
          >
            <h4 class="mb-4 font-semibold">
           Evaluation Conclusion
            </h4>
            <p id="conclusion">
            @php
           if(empty($formatAverage2) || empty($formatAverage)){
            $remarkedResult="Unavailable";
            $averageResult="Unable To Compute Total Average";
           $averageSummaryResultEvaluation= 0;
           }else{
           $averageSummaryResultEvaluation= ($formatAverage2 + $formatAverage)/2;
               if($averageSummaryResultEvaluation==4){
                $remarkedResult= "Excellent performance: The teacher consistently demonstrates outstanding performance.Excellent performance: The teacher consistently demonstrates outstanding performance.";
                $averageResult= "The Resulting Average Score for this Teacher is 4(Excellent performance). Therefore  the teacher consistently demonstrates outstanding abilities and exceeds expectations in all aspects of their teaching. They effectively engage students, employ innovative teaching methods, and consistently achieve exceptional results.";
               }elseif ($averageSummaryResultEvaluation>=3 && $averageSummaryResultEvaluation<4){
                $remarkedResult="Good performance: The teacher performs well and meets expectations";
                $averageResult= "The Resulting Average Score for this Teacher is ".number_format($averageSummaryResultEvaluation, 3)."(Good performance). Therefore the teacher demonstrates a solid level of competence and effectiveness in their teaching. They consistently meet expectations and effectively engage students in the learning process. Students generally achieve good results under their instruction.";
               }elseif($averageSummaryResultEvaluation>=2 && $averageSummaryResultEvaluation<3){
                $remarkedResult="Average performance: The teacher's performance is moderate, with some room for improvement.";
                $averageResult= "The Resulting Average Score for this Teacher is ".number_format($averageSummaryResultEvaluation, 3). "(Average performance). Therefore the teacher's performance is satisfactory but shows room for improvement. They meet basic requirements and effectively deliver the curriculum. However, there may be some areas where their teaching could be enhanced to better engage students and improve learning outcomes. ";
               }elseif($averageSummaryResultEvaluation>=1 && $averageSummaryResultEvaluation<2){
                $remarkedResult="Below average performance: The teacher's performance needs significant improvement.";
                $averageResult= "The Resulting Average Score for this Teacher is ".number_format($averageSummaryResultEvaluation, 3). "(Below average performance). Therefore the teacher's performance falls below expectations in several areas. There are noticeable weaknesses and shortcomings in their teaching approach, which impact student engagement and learning outcomes. Significant improvements are needed to enhance their teaching effectiveness.";
               }else{
                $remarkedResult="Performance not observed or evaluated: No evaluation was conducted for the teacher's performance.";
                $averageResult= "The Resulting Average Score for this Teacher is ".number_format($averageSummaryResultEvaluation, 3). "(Performance not observed or evaluated). Therefore no observation or evaluation of the teacher's performance was conducted during the evaluation period.";
               }
              }
          @endphp
            </p>
              <br>
               <p class="text-gray-200 font-semibold text-l dark:text-gray-200">Evaluation Summary Result= {{number_format($averageSummaryResultEvaluation, 3)}}({{$remarkedResult}})</p>
              
           
          </div>
  
      
            <script>
            // Replace 'containerId' with the ID of the scrollable container


              function openTheModal(headers, question){
                var questions= document.getElementById("question");
                var header= document.getElementById("header");
                var modal=  document.getElementById('modalContainer');
               modal.style.display = "flex";
               questions.textContent= question;
               header.textContent= headers;
               modal.style.animation="pop 0.5s linear";
              }
              var modal=  document.getElementById('modalContainer');
              window.addEventListener("click", function(event) {
  if (event.target === modal) {
    modal.style.animation = "questionClose 0.5s linear";
    setTimeout(function() {
      modal.style.display = "none";
    }, 500);
   
  }
});

const word = "{{$averageResult}}";
  let currentIndex = 0;
  const typingSpeed = 30; // Adjust the typing speed (in milliseconds)

  function generateTypingEffect() {
    const typingElement = document.getElementById("conclusion");

    if (currentIndex < word.length) {
      typingElement.textContent += word[currentIndex];
      currentIndex++;
      setTimeout(generateTypingEffect, typingSpeed);
    }
  }
  var speechSynthesizer;
 
  // Trigger typing effect when the typing element is loaded
 
  document.addEventListener("DOMContentLoaded", generateTypingEffect);

            </script>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>