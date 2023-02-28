@extends('layouts.vertical', ['page_title' => 'Dashboard'])

@section('css')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <style>
        div#tooltip-container {
    height: 80%;
}
.content-page {

    margin-left: 0px !important;
}

    </style>
@endsection

@section('content')

    <div class="row bg-white my-2 mx-1 pl-1 py-3">
       <h3 id="greeting">Good Afternoon,</h3>
       <p>Now it’s <span id="date"></span>  <span id="live-time"></span> <span id="day"></span>, welcome back to aero hostel management system</p> 
    </div>


@endsection

@section('script')

<script>
    function updateTime() {
        const now = new Date();

// get the local date as a string
const date = now.toLocaleDateString();

// get the local time as a string
const time = now.toLocaleTimeString();

// get the local day as a number (0-6, where 0 = Sunday)
const dayNum = now.getDay();

// convert the day number to a string
const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
const day = daysOfWeek[dayNum];

 
$('#date').html(date);
$('#live-time').html(time);
$('#day').html(day)

const hour = now.getHours();

// set the greeting based on the time of day
let greeting;
if (hour >= 5 && hour < 12) {
  greeting = 'Good morning';
} else if (hour >= 12 && hour < 18) {
  greeting = 'Good afternoon';
} else if (hour >= 18 && hour < 20) {
  greeting = 'Good evening';
}else{
    greeting = 'Good night';
}
$('#greeting').html(greeting)
    }
    
    setInterval(updateTime, 1000); // Update time every second
  </script>
@endsection