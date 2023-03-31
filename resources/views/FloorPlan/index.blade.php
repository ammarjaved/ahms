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
        <div class="text-end my-2">
            <button class="btn btn-sm btn-success " onclick="onpenModal()">Add Floor Plan Images</button>
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-md-2">
                <h3>Floor Plan</h3>
            </div>
            <div class="col-md-2">
                <select name="" onchange=callAddBaseMap(this.value) class="form-select" id="floors">
                    <option value="" hidden>-- SELECT FLOOR --</option>
                    <option value="">Floor 1</option>
                    <option value="">Floor 1</option>
                </select>
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
        var imgData='';
        $(document).ready(function() {

            map = L.map('map', {
                minZoom: 1,
                maxZoom: 4,
                center: [0, 0],
                zoom: 0,
                crs: L.CRS.Simple,
                attributionControl: false
            })
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



            floorMap();

        })

        function floorMap() {
            $.ajax({
                type: "GET",
                url: `/floor-map`,
                success: function(data) {
                    imgData=data.data;
                    addBaseMap(imgData[0].image)

                    noOfFloors(data.data)
                    
            }
        })
        }

        function callAddBaseMap(val){
           // alert(val);
           //var floorno= $("#floors").find(":selected").val();
           var filteredFloor = $.grep(imgData, function(v) {
            return v.floor_no === parseInt(val) ;
            });

            addBaseMap(filteredFloor[0].image)

        }

        function addBaseMap(params) {
            if(imgLay!=''){
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
                  imgLay =   L.imageOverlay(url, bounds).addTo(map);

                    map.setMaxBounds(bounds);


                    map.on('draw:created', function(e) {
                    var type = e.layerType;
                    layer = e.layer;
                    drawnItems.addLayer(layer);
                })
                map.on('click', addMarker);

                   

             }
        

        function noOfFloors(data) {
            let val = {{ Auth::user()->no_of_floors }}
            $('#floors').find('option').remove().end()
            // $('#floors').append(`<option value="" hidden>-- SELECT FLOOR --</option>`)
            $('#floors').append(`<option value="${data[0].floor_no}" selected>Floor ${data[0].floor_no}</option>`)
            for (let index = 1; index < data.length; index++) {

                $('#floors').append(`<option value="${data[index].floor_no}" >Floor ${data[index].floor_no}</option>`)



            }
        }

        function addMarker(e) {

            var newMarker = new L.CircleMarker(e.latlng, {
                radius: 5,
                fillOpacity: 0.85,
                color: 'blue'
            }).addTo(map);
            console.log(e.latlng);

          //  newMarker.bindPopup("<b>New Room</b><br>Adventures await");
        }

        function onpenModal() {
            $('#addFloorImages').modal('show');

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
    </script>
@endsection
