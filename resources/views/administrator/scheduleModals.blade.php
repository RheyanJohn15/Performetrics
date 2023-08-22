<div id="monday1" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">7:30AM - 8:30AM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="7:30AM - 8:30AM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday1" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">7:30AM - 8:30AM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="7:30AM - 8:30AM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Tuesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday1" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">7:30AM - 8:30AM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="7:30AM - 8:30AM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>


  <div id="thursday1" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">7:30AM - 8:30AM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="7:30AM - 8:30AM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>


  <div id="friday1" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">7:30AM - 8:30AM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="7:30AM - 8:30AM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Friday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'7:30AM - 8:30AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <!--8:30AM-9:30AM-->
  <div id="monday2" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">8:30AM - 9:30AM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="8:30AM - 9:30AM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday2" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">8:30AM - 9:30AM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="8:30AM - 9:30AM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Tuesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday2" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">8:30AM - 9:30AM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="8:30AM - 9:30AM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday2" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">8:30AM - 9:30AM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="8:30AM - 9:30AM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday2" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">8:30AM - 9:30AM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="8:30AM - 9:30AM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Friday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'8:30AM - 9:30AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="monday3" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">9:45AM - 10:45AM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="9:45AM - 10:45AM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'9:45AM - 10:45AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday3" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">9:45AM - 10:45AM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="9:45AM - 10:45AM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Tuesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'9:45AM - 10:45AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday3" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">9:45AM - 10:45AM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="9:45AM - 10:45AM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'9:45AM - 10:45AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday3" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">9:45AM - 10:45AM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="9:45AM - 10:45AM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'9:45AM - 10:45AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday3" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">9:45AM - 10:45AM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="9:45AM - 10:45AM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Friday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'9:45AM - 10:45AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="monday4" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">10:45AM - 11:45AM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="10:45AM - 11:45AM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday4" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">10:45AM - 11:45AM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="10:45AM - 11:45AM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Tuesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday4" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">10:45AM - 11:45AM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="10:45AM - 11:45AM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday4" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">10:45AM - 11:45AM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="10:45AM - 11:45AM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday4" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">10:45AM - 11:45AM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="10:45AM - 11:45AM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Friday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'10:45AM - 11:45AM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  
  <div id="monday5" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">1:00PM - 1:00PM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="1:00PM - 2:00PM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday5" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">1:00PM - 2:00PM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="1:00PM - 2:00PM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Tuesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday5" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">1:00PM - 1:00PM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="1:00PM - 2:00PM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday5" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">1:00PM - 1:00PM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="1:00PM - 2:00PM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday5" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">1:00PM - 1:00PM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="1:00PM - 2:00PM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Friday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'1:00PM - 2:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="monday6" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">2:00PM - 3:00PM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="2:00PM - 3:00PM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday6" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">2:00PM - 3:00PM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="2:00PM - 3:00PM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Tuesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday6" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">2:00PM - 3:00PM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="2:00PM - 3:00PM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday6" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">2:00PM - 3:00PM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="2:00PM - 3:00PM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday6" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">2:00PM - 3:00PM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="2:00PM - 3:00PM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Friday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'2:00PM - 3:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="monday7" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">3:00PM - 4:00PM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="3:00PM - 4:00PM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday7" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">3:00PM - 4:00PM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="3:00PM - 4:00PM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Tuesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday7" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">3:00PM - 4:00PM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="3:00PM - 4:00PM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday7" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">3:00PM - 4:00PM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="3:00PM - 4:00PM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday7" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">3:00PM - 4:00PM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="3:00PM - 4:00PM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Friday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'3:00PM - 4:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="monday8" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">4:00PM - 5:00PM</p>
    <p id="day" class="dark:text-gray-300">Monday</p>
    <input type="hidden" name="timeContent" value="4:00PM - 5:00PM">
    <input type="hidden" name="dayContent" value="Monday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Monday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="tuesday8" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">4:00PM - 5:00PM</p>
    <p id="day" class="dark:text-gray-300">Tuesday</p>
    <input type="hidden" name="timeContent" value="4:00PM - 5:00PM">
    <input type="hidden" name="dayContent" value="Tuesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Tuesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="wednesday8" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">4:00PM - 5:00PM</p>
    <p id="day" class="dark:text-gray-300">Wednesday</p>
    <input type="hidden" name="timeContent" value="4:00PM - 5:00PM">
    <input type="hidden" name="dayContent" value="Wednesday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Wednesday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="thursday8" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">4:00PM - 5:00PM</p>
    <p id="day" class="dark:text-gray-300">Thursday</p>
    <input type="hidden" name="timeContent" value="4:00PM - 5:00PM">
    <input type="hidden" name="dayContent" value="Thursday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Thursday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>

  <div id="friday8" class="MainModal">
    <div class="schedContentModal dark:bg-gray-700">
    <h3 class=" text-2xl font-semibold text-gray-700 dark:text-gray-200">Set Schedule</h3>
    <p id="classSection" class="dark:text-gray-300">    
        @if(session('selectedStrand')==="Null")
        ~~~No Class Selected~~~
        @else
          @php 
        $ClassName=App\Models\Section::where('id', session('selectedStrand'))->first();
        @endphp
        {{$ClassName->year_level. "-". $ClassName->section . " ". App\Models\Strand::where('id', $ClassName->strand_id)->first()->strand_shortcut}}
        @endif</p>
             <form method="post" action="{{route('updateSchedule')}}">
              @csrf
              @method('post')
    <p id="time" class="dark:text-gray-300">4:00PM - 5:00PM</p>
    <p id="day" class="dark:text-gray-300">Friday</p>
    <input type="hidden" name="timeContent" value="4:00PM - 5:00PM">
    <input type="hidden" name="dayContent" value="Friday">
    <input type="hidden"  name="strand" value="{{session('selectedStrand')}}">
    <p class=" text-gray-700 dark:text-gray-200">Current Semester: {{$currentSem}}</p>
 
    <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Teacher
                </span>
                <select name="teacher"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php 
                $teachers= App\Models\Teacher::where('id', '!=', '6')->get();
                @endphp
                @foreach($teachers as $teacher)
                @php
                $first_name= $teacher->teacher_first_name;
                $last_name= $teacher->teacher_last_name;
                $middle_name= $teacher->teacher_middle_name;
                $suffix= $teacher->teacher_suffix;

                $fullname= $first_name. " ". substr($middle_name, 0, 1). ". ". $last_name. " ". $suffix;
                @endphp
                
                <option value= "{{$teacher->id}}">{{$fullname}}</option>
                @endforeach
                 
                </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                 Subjects
                </span>
                <select name="subject"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                @php
                $section= App\Models\Section::where('id', session('selectedStrand'))->first();
                

                  $subjects= App\Models\AssignedSubject::where('assigned_year_level', $section->year_level)
                  ->where('assigned_strand', $section->strand_id)
                  ->where('assigned_sem', $currentSem)->get();
                @endphp

                @foreach($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->assigned_subject}}</option>
                @endforeach
              </select>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
               Room
                </span>
                <select name="room"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                @php
                $rooms = App\Models\Room::where('id', '!=', 13)->get();
            @endphp
            
            @foreach ($rooms as $room)
                @php
                    $availableRoom = App\Models\RoomAvailable::where('room_id', $room->id)
                        ->where('room_day', 'Friday')
                        ->first(); // Use first() to get the actual model instance
                @endphp
            
                @if ($availableRoom && $availableRoom->{'4:00PM - 5:00PM'})
                    <option disabled id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }} (Occupied)</option>
                @else
                    <option id="{{ $room->id }}" value="{{ $room->id }}">{{ $room->room_name }}</option>
                @endif
            @endforeach
            
                </select>
              </label>
              <button name="saveChanges" type="submit"
                  class="px-4 py-2 mt-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Save Changes
                </button>
    </form>
    </div>
  </div>