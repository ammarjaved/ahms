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

    <div class="col-md-3 py-2 tet-center card m-2 rounded-0" style="background-color: #8CBD00;">
        <h4 class="text-center text-white">TOTAL NO OF BEDS </h6>
           <p class="text-center"> <span >{{Auth::user()->no_of_beds}}</span></p> 
          {{-- <p class="text-center"> <span >400</span></p> --}}
      </div>

      <div class="col-md-3 py-2 tet-center card m-2 rounded-0" style="background-color: #82b5b2">
        <h4 class="text-center text-white">TOTAL NO OF BEDS OCCUPIED</h6>
            <p class="text-center"> <span >{{ $data['resident']}}</span></p>
      </div>

      <div class="col-md-3 py-2 tet-center card m-2 rounded-0" style="background-color:rgb(247, 189, 0) ">
        <h4 class="text-center text-white">TOTAL NO OF REMAINING BEDS </h6>
           <p class="text-center"> <span >{{Auth::user()->no_of_beds -  $data['resident']}}</span></p> 
          {{-- <p class="text-center"> <span >300</span></p> --}}
      </div>

      <div class="col-md-3 py-2 tet-center card m-2 rounded-0" style="background-color: #F0652B; color:white">
        <h4 class="text-center text-white">TOTAL NO OF RESIDENTS </h6>
           <p class="text-center"> <span >{{ $data['resident']}}</span></p> 
          {{-- <p class="text-center"> <span >100</span></p> --}}
      </div>


      <div class="col-md-3 py-2 tet-center card m-2 rounded-0" style="background-color: lightgreen">
        <h4 class="text-center text-white">TOTAL RESIDENTS IN </h6>
           <p class="text-center"> <span >{{$data['available']}}</span></p> 
          {{-- <p class="text-center"> <span >30</span></p> --}}
      </div>

      <div class="col-md-3 py-2 tet-center card m-2 rounded-0" style="background-color: #41b369 ; margin-left: 20px" style="     ">
        <h4 class="text-center text-white">TOTAL RESIDENTS OUT</h6>
           <p class="text-center"> <span id="no_of_floors">{{$data['resident'] - $data['available']}}</span></p> 
          {{-- <p class="text-center"> <span id="no_of_floors">70</span></p> --}}
      </div>
   
    

      

     
     
    </div>
    <div class="row bg-white my-2 mx-1 pl-1 py-3">
       <h3 id="greeting">Good Afternoon,</h3>
       <p>Now it’s <span id="date"></span>  <span id="live-time"></span> <span id="day"></span>, Welcome Back to Aero Hostel Management System</p> 
    </div>

    <div class="card p-3 mx-1">
      <div class="row d-flex justify-content-between">
     <div class="col-md-2"> <h3>Floor Plan</h3></div>
     <div class="col-md-2">
        <select name="" onchange=callAddBaseMap(this.value) class="form-select" id="floors">
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


//var center = [0,0];
var map = '';
        var imgLay = '';
        var imgData = '';
        var gFloor = '', geojsonLayer = '';
        $(document).ready(function() {

            map = L.map('map', {
                minZoom: 1,
                maxZoom: 4,
                center: [0, 0],
                zoom: 0,
                crs: L.CRS.Simple,
                attributionControl: false
            })

            floorMap();

        })

        function floorMap() {
            $.ajax({
                type: "GET",
                url: `/floor-map`,
                success: function(data) {
                    imgData = data.data;

                    addBaseMap(imgData[0].image)
                    noOfFloors(data.data)
                    callPoints(data.data[0].floor_no)
                }
            })
        }

        function callPoints(param){
            if(geojsonLayer){
                map.removeLayer(geojsonLayer)
            }
            $.ajax({
                type: "GET",
                url: `/floor-map/${param}`,
                success: function(data) {
                   
                    var geojson =JSON.parse(data.data[0].geojson)
                   console.log(geojson);
                 geojsonLayer = L.geoJson(geojson, {
        style: function(feature) {
            return {color: 'blue'};
        },
        pointToLayer: function(feature, latlng) {
            return new L.CircleMarker(latlng, {radius: 5, fillOpacity: 0.85});
        },
        onEachFeature: function (feature, layer) {
            layer.bindPopup(`<table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>${feature.properties.user_id}</td>
                        </tr>
                        <tr>
                        <th>user id</th>
                        <td>${feature.properties.user_id}</td>
                        </tr>
                        <tr>
                        <th>Member id</th>
                        <td>${feature.properties.member_id}</td>
                        </tr>
                    </tbody>
                </table>`);
        }
    });

    map.addLayer(geojsonLayer);

                }
        })}

        function callAddBaseMap(val) {
            gFloor = val
            callPoints(val)
            var filteredFloor = $.grep(imgData, function(v) {
                return v.floor_no === parseInt(val);
            });
            addBaseMap(filteredFloor[0].image)

        }

        function addBaseMap(params) {
            if (imgLay != '') {
                map.removeLayer(imgLay);
            }
            var w = 1280 * 2,
                h = 806 * 2,
                url = 'asset/images/FloorImages/' + params;

            // calculate the edges of the image, in coordinate space
            var southWest = map.unproject([0, h], map.getMaxZoom() - 1);
            var northEast = map.unproject([w, 0], map.getMaxZoom() - 1);
            var bounds = new L.LatLngBounds(southWest, northEast);

            // add the image overlay,
            // so that it covers the entire map
            imgLay = L.imageOverlay(url, bounds).addTo(map);

            map.setMaxBounds(bounds);

            map.on('draw:created', function(e) {
                var type = e.layerType;
                layer = e.layer;
                drawnItems.addLayer(layer);
            })


        }
        var newMarker

        function addMarker(e) {
            if (newMarker) {
                map.removeLayer(newMarker)
            }
            newMarker = new L.CircleMarker(e.latlng, {
                radius: 5,
                fillOpacity: 0.85,
                color: 'blue'
            }).addTo(map);
            $('#floorNo').val(gFloor)
            $('#lat').val(e.latlng.lat)
            $('#lng').val(e.latlng.lng)
            $('#assignBed-modal').modal("show")
            console.log(e.latlng);
            //  newMarker.bindPopup("<b>New Room</b><br>Adventures await");

        }



        function noOfFloors(data) {
            let val = {{ Auth::user()->no_of_floors }}
            $('#floors').find('option').remove().end()
            // $('#floors').append(`<option value="" hidden>-- SELECT FLOOR --</option>`)
            gFloor = data[0].floor_no
            $('#floors').append(`<option value="${data[0].floor_no}" selected>Floor ${data[0].floor_no}</option>`)
            for (let index = 1; index < data.length; index++) {
                $('#floors').append(`<option value="${data[index].floor_no}" >Floor ${data[index].floor_no}</option>`)

            }
        }




        function editImage(id) {
            let val = `<form action="update-images/${id}" method="Post" enctype="multipart/form-data">           
                @csrf
                <input name="img"  type="file">
                <button class="btn btn-sm btn-success">submit</button>
                </form>
                `;
            $('#edit-image-' + id).html(val)
        }


        function submitAssign() {
            let res = $('#member').val() === '' ? false : true;
            !res ? $('#er_member').html('Select User') : '';
            return res;
        }

        function selectPoint(par) {
            if (par) {
                $("#for-select-point").html('select point on map')
                $('#for-assign').css("display", 'none')
                $("#for-cancel").css("display", 'block')
                map.on('click', addMarker);
            } else {
                $("#for-select-point").html('')
                $('#for-assign').css("display", 'block')
                $("#for-cancel").css("display", 'none')
                map.off('click', addMarker);
                if (newMarker) {
                    map.removeLayer(newMarker)
                }
            }
        }


//      map.on('click', addMarker);

//   function addMarker(e){

//     var newMarker = new L.CircleMarker(e.latlng, {radius: 5, fillOpacity: 0.85,color:'green'}).addTo(map);
//     console.log(e.latlng);

//     newMarker.bindPopup("<b>New Room</b><br>Adventures await");
// }



        noOfFloors()
    
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

    function noOfFloors(){
      let val = {{Auth::user()->no_of_floors}}
      $('#floors').find('option').remove().end()
      $('#floors').append(`<option value="" hidden>-- SELECT FLOOR --</option>`)
      for (let index = 0; index < val; index++) {
       
        $('#floors').append(`<option value="${index+1}">Floor ${index+1}</option>`)
        

        
      }
    }
  </script>




@endsection