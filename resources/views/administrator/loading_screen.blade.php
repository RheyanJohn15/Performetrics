<!-- resources/views/loading_screen.blade.php -->
<div class="loader dark:bg-gray-800" id="loader">
    <div id="center" class="center">
        <object id="mySvg" data="{{ asset('dashboard/img/loader.svg') }}" type="image/svg+xml"></object>
        <img style="border-radius:50%" src="{{ asset('dashboard/img/logo.jfif') }}" alt="logo" id="image">
    </div>

    @if($location == "dashboard")
        <h1 id="textLoad" class="dark:text-gray-200">Loading Dashboard.....</h1>
    @elseif($location == "survey")
        <h1 id="textLoad"  class="dark:text-gray-200">Loading Survey Forms.....</h1>
    @elseif($location == "assign")
        <h1 id="textLoad"  class="dark:text-gray-200">Loading Assign Teachers.....</h1>
    @elseif($location == "view")
        <h1 id="textLoad"  class="dark:text-gray-200">Loading View Data.....</h1>
    @elseif($location == "all_user")
        <h1 id="textLoad"  class="dark:text-gray-200">Loading All Users.....</h1>
    @elseif($location == "admin")
        <h1 id="textLoad"  class="dark:text-gray-200">Loading Administrator.....</h1>
    @elseif($location == "class")
        <h1 id="textLoad"  class="dark:text-gray-200">Loading Class Schedules.....</h1>
    @elseif($location == "generate")
        <h1 id="textLoad"  class="dark:text-gray-200">Loading Generate Reports.....</h1>
    @endif
</div>

<script>
    window.addEventListener("load", function() {
        setTimeout(function() {
            var loader = document.getElementById("loader");
            var center = document.getElementById("center");
            var textLoad = document.getElementById("textLoad");
            loader.style.animation = "closes 1s";
            center.style.animation = "fade 1s";
            textLoad.style.display = "none";
            setTimeout(function() {
                var loader = document.getElementById("loader");
                loader.style.display = "none";
                center.style.display = "none";
            }, 500);
        }, 1000);
    });
</script>
