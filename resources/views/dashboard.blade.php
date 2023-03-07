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

    <div class="row d-flex justify-content-center p-2">
      <div class="col-md-2 py-2 tet-center card m-2 rounded-0" style="background-color: #F0652B; color:white">
        <h4 class="text-center text-white">Total No Of Resident </h6>
          <p class="text-center"> <span >{{ $data['resident']}}</span></p>
      </div>

      <div class="col-md-2 py-2 tet-center card m-2 rounded-0" style="background-color: #8CBD00;">
        <h4 class="text-center text-white">Total No Of Beds </h6>
          <p class="text-center"> <span >{{Auth::user()->no_of_beds}}</span></p>
      </div>

      <div class="col-md-3 py-2 tet-center card my-2 rounded-0" style="background-color: #82b5b2">
        <h4 class="text-center text-white">Total No Of Beds Occupied</h6>
          <p class="text-center"> <span >12</span></p>
      </div>

      <div class="col-md-2 py-2 tet-center card m-2 rounded-0" style="background-color:rgb(247, 189, 0) ">
        <h4 class="text-center text-white">Total Remaining Beds </h6>
          <p class="text-center"> <span >{{Auth::user()->no_of_beds - 12}}</span></p>
      </div>

      <div class="col-md-2 py-2 tet-center card my-2 rounded-0" style="background-color: lightgreen">
        <h4 class="text-center text-white">No Of People Available </h6>
          <p class="text-center"> <span >{{$data['available']}}</span></p>
      </div>
<div class="row  ">
      <div class="col-md-2 py-2 tet-center card my-1  rounded-0" style="background-color: #41b369 ; margin-left: 20px" style="     ">
        <h4 class="text-center text-white">Total No OF Floors</h6>
          <p class="text-center"> <span id="no_of_floors">{{Auth::user()->no_of_floors}}</span></p>
      </div>
    </div>
    

      

     
     
    </div>
    <div class="row bg-white my-2 mx-1 pl-1 py-3">
       <h3 id="greeting">Good Afternoon,</h3>
       <p>Now it’s <span id="date"></span>  <span id="live-time"></span> <span id="day"></span>, welcome back to aero hostel management system</p> 
    </div>

    <div class="card p-3 mx-1">
      <div class="row d-flex justify-content-between">
     <div class="col-md-2"> <h3>Floor plan</h3></div>
     <div class="col-md-2">
     <select name="" class="form-select" id="floors">
      <option value="" hidden>-- SELECT FLOOR --</option>
      <option value="">Floor 1</option>
      <option value="">Floor 1</option>
     </select>
    </div>
    </div>
<div >
      <div id="map"  style="width: 100%;height: 400px;"></div>
    </div>
    </div>
    
@endsection

@section('script')
<script src="{{ asset('assets/libs/ladda/ladda.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="{{ asset('assets/js/pages/loading-btn.init.js') }}"></script>
    <!-- end demo js-->


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"/>
    <link rel="stylesheet" href="{{ URL::asset('map/draw/leaflet.draw.css')}}"/>
       {{-- <link rel="stylesheet" href="{{ URL::asset('assets/src/leaflet.draw.css')}}"/>  --}}




    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>

    {{-- <script src="{{ URL::asset('map/draw/leaflet.draw-custom.js')}}"></script> --}}
    <<script src="{{ URL::asset('assets/js/leaflet.draw.js')}}"></script>

    <script src="{{ URL::asset('map/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js')}}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDBid44NzY6_Olyxu10cpexi_bO0F5bMI&libraries=places"></script>


<script>


var center = [3.016603, 101.858382];
    $(document).ready(function(){
        // var map = L.map('map').setView(center, 11);

        // // Set up the OSM layer
        // L.tileLayer(
        // 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     maxZoom: 18
        // }).addTo(map);


        noOfFloors()
      })
    function updateTime() {
        const now = new Date();

// get the local date as a string
const date = now.toLocaleMonthString();

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

    function noOfFloors(){
      let val = parseInt( $('#no_of_floors').html())
      $('#floors').find('option').remove().end()
      $('#floors').append(`<option value="" hidden>-- SELECT FLOOR --</option>`)
      for (let index = 0; index < val; index++) {
       
        $('#floors').append(`<option value="${index+1}">Floor ${index+1}</option>`)
        

        
      }
    }
  </script>




@endsection