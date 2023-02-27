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

    <div class="row bg-white my-2 mx-1 pl-1 pt-3">
       <h3>Good Afternoon,</h3>
       <p>Now it’s 2023-02-27 <span id="live-time"></span> Monday, welcome back to aero hostel management system</p> 
    </div>


@endsection

@section('script')

<script>
    function updateTime() {
      var now = new Date();
      var time = now.toLocaleTimeString();
      document.getElementById('live-time').innerHTML = time;
    }
    
    setInterval(updateTime, 1000); // Update time every second
  </script>
@endsection