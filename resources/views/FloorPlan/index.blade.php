@extends('layouts.vertical', ['page_title' => 'Floor Plan'])

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
    <div class="card p-3 mx-1 my-3">
        @if (Session::has('error'))
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="text-end my-2">
            <button class="btn btn-sm btn-success " onclick=" $('#addFloorImages').modal('show');">Add Floor Plan
                Images</button>
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-md-2">
                <h3>Floor Plan</h3>
            </div>
            <div class="col-md-2">
                <span id="for-select-point" class="text-danger"></span>
            </div>
            <div class="col-md-4">

                <div class="row">
                    <div class="col-md-6"><button class="btn btn-primary btn-sm" id="for-assign"
                            onclick="selectPoint(true)">Assign bed</button>
                        <button class="btn btn-secondary btn-sm" id="for-cancel" onclick="selectPoint(false)"
                            style="display:none">cancel</button>
                    </div>
                    <div class="col-md-6">
                        <select name="" onchange=callAddBaseMap(this.value) class="form-select" id="floors">
                            <option value="" hidden>-- SELECT FLOOR --</option>
                            <option value="">Floor 1</option>
                            <option value="">Floor 1</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div id="map" style="width: 100%;height: 400px;"></div>
        </div>

        <div class="d-flex justify-content-center">

            <div class="col-md-8 text-center p-3">
                <table class="table table-bordered ">
                    <thead>
                        <th class="text-center" colspan="3">Floor Plan Images</th>
                    </thead>
                    <tbody>
                        @if ($data['floor_images'])
                            @foreach ($data['floor_images'] as $img)
                                <tr>
                                    <th class="col-md-3">Floor {{ $img->floor_no }}</th>
                                    <td class="text-center col-md-3">
                                        @if ($img->image != '')
                                            <a href="{{ URL::asset('asset/images/FloorImages/' . $img->image) }}"
                                                data-lightbox="roadtrip">
                                                <img src="{{ URL::asset('asset/images/FloorImages/' . $img->image) }}"
                                                    alt="reupload image" width="70" height="70">
                                            </a>
                                        @else
                                            no image uploaded
                                        @endif

                                    </td>
                                    <td id="edit-image-{{ $img->id }}" class="col-md-3">
                                        <button class="btn btn-primary btn-sm"
                                            onclick="editImage({{ $img->id }})">edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="3">NO image uploaded</td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addFloorImages" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header" style="background:  #EAEFF4">
                    <h5 class="modal-title " id="exampleModalLabel">Floor Plan Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('floor-plan-images.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body  p-3">


                        <div class="row text-center ">
                            {{-- <img src="{{URL::assets('asset/images/FloorImages/'.$data['floor_images']->)}}" alt=""> --}}
                            @for ($i = 1; $i < Auth::user()->no_of_floors + 1; $i++)
                                <div class="col-md-3 mb-3">
                                    <label for="floor_{{ $i }}">Floor {{ $i }}</label>
                                    <input type="file" class="form-control" name="floor_{{ $i }}"
                                        id="floor_{{ $i }}" accept="image/*">
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="modal-footer p-1" style="background:#EAEFF4; justify-content:center">
                        <button type="submit" class="btn btn-sm  border-0 bg-made-green"
                            style="background :#90CF5F; color:white">Save changes</button>
                        <button type="button" class="btn btn-sm btn-white border-0 "
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="modal fade" id="assignBed-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content ">
                <div class="modal-header" style="background:  #EAEFF4">
                    <h5 class="modal-title " id="exampleModalLabel">Floor Plan Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('assign-room.store') }}" method="POST" enctype="multipart/form-data"
                    onsubmit="return submitAssign()">
                    @csrf
                    <div class="modal-body  p-3">


                        <div class="col-md-6">select member</div>

                        <div class="">
                            <span class="text-danger" id="er_member"></span>
                            <select name="member_id" id="member" class="form-select">
                                <option value="" hidden>-- Select User --</option>
                                @foreach ($data['members'] as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                            
                            <input type="hidden" name="floor" id="floorNo">
                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="lng" id="lng">

                        </div>
                        <div class="">
                            <span class="text-danger" id="er_room"></span>
                            <label for="room">Room no</label>
                            <input type="number" name="room_no" id="room" class="form-control">
                        </div>

                        <div class="">
                            <span class="text-danger" id="er_bed"></span>
                            <label for="bed">Bed no</label>
                            <input type="number" name="bed_no" id="bed" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer p-1" style="background:#EAEFF4; justify-content:center">
                        <button type="submit" class="btn btn-sm  border-0 bg-made-green"
                            style="background :#90CF5F; color:white">Save changes</button>
                        <button type="button" class="btn btn-sm btn-white border-0 "
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/ladda/ladda.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="{{ asset('assets/js/pages/loading-btn.init.js') }}"></script>
    <!-- end demo js-->


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ URL::asset('map/draw/leaflet.draw.css') }}" />
    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/src/leaflet.draw.css')}}"/>  --}}




    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>

    {{-- <script src="{{ URL::asset('map/draw/leaflet.draw-custom.js')}}"></script> --}}
    <<script src="{{ URL::asset('assets/js/leaflet.draw.js') }}"></script>

    <script src="{{ URL::asset('map/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDBid44NzY6_Olyxu10cpexi_bO0F5bMI&libraries=places">
    </script>


    <script>
        //var center = [0,0];
        var map = '';
        var imgLay = '';
        var imgData = '';
        var gFloor = '',
            geojsonLayer = '';
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

        function callPoints(param) {
            if (geojsonLayer) {
                map.removeLayer(geojsonLayer)
            }
            $.ajax({
                type: "GET",
                url: `/floor-map/${param}`,
                success: function(data) {

                    var geojson = JSON.parse(data.data[0].geojson)
                    console.log(geojson);
                    geojsonLayer = L.geoJson(geojson, {
                      
                        style: function(feature) { 
                            console.log();
                             return {
                            // if(feature.properties.availability=== null || feature.properties.availability === 'unavailable'){
                           
                                color: feature.properties.availability === "available"? 'green' : 'red'
                      
                        // }esle{
                            
                        //         color: 'green'
                           
                        // } 
                         };
                        },
                        pointToLayer: function(feature, latlng) {
                            return new L.CircleMarker(latlng, {
                                radius: 5,
                                fillOpacity: 0.85
                            });
                        },
                        onEachFeature: function(feature, layer) {
                           
    
                                            // console.log(data);
                                            let latlong  = feature.geometry.coordinates
                                            // console.log(latlong);
                                            layer.on({
        click: function (e) { map.setView(new L.LatLng(latlong[1], latlong[0]),3);}})
                                            let avail = ''
                                            if(feature.properties.availability === null || feature.properties.availability === 'unavailable'){
                                                avail = 'Not Available'
                                            }else{
                                               
                                                avail = 'Available'
                                            }
                                            layer.bindPopup(`<table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th>First name</th>
                                                                    <td>${feature.properties.name}</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>Last name</th>
                                                                    <td>${feature.properties.last_name}</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>Room no</th>
                                                                    <td>${feature.properties.room_no}</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>Status</th>
                                                                    <td>${avail}</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>Floor no</th>
                                                                    <td>${feature.properties.floor_no}</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>Bed no</th>
                                                                    <td>${feature.properties.bed_no}</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>Detail</th>
                                                                    <td class="text-center  "><a href="/personal/${feature.properties.id}" class="btn btn-sm btn-secondary text-white">Detail</a></td>
                                                                    </tr>
                                                                    
                                                                </tbody>
                                                            </table>`);
                                      
                        
                    } });

                    map.addLayer(geojsonLayer);

                }
            })
        }

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

        //.setView(center, 11);
        // var drawnItems = new L.FeatureGroup();
        // map.addLayer(drawnItems);
        // var drawControl = new L.Control.Draw({
        //     draw: {
        //         circle: false,
        //         marker: true,
        //         polygon: true,
        //         polyline: {
        //             shapeOptions: {
        //                 color: '#f357a1',
        //                 weight: 10
        //             }
        //         },
        //         rectangle: true
        //     },
        //     edit: {
        //         featureGroup: drawnItems
        //     }







        // });

        // map.addControl(drawControl);
    </script>
@endsection
