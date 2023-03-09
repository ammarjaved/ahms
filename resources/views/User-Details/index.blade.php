@extends('layouts.vertical', ['page_title' => 'users'])


@section('css')
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .content-page {

            margin-left: 0px !important;
        }

        input[type='text'],
        input[type='number'],
        textarea {
            font-size: 13px;
            margin-bottom: 5px;
            border: 1px solid #a9a7a79e;
            padding: 3px;
            border-radius: 4px;
        }

        input[type="text"]:focus {
            border-color: 1px solid green;
        }

        button.nav-link {
            color: black;
            font-size: 13px;
        }

        .btn-white {
            background: white !important;
            border: 1px solid #a9a7a7;
        }

        input[type=file]::file-selector-button {
            border: 0px;
            padding: .2em .4em;
            border-radius: .2em;
            background-color: #90CF5F;
            transition: 1s;
            color: white
        }

        .bg-made-green {
            background-color: #90CF5F;
        }

        select#gender {
            padding: 3px;
            margin-bottom: 5px;

        }

        input.form-control {
            padding: 4px 5px;
            margin-bottom: 5px;
        }

        td {
            padding: 10px 0px 0px 19px !important;
            font-size: 12px !important;
            color: black;
        }

        .card.col-md-3.pr-2 {
            width: 24%;
            margin-right: 1%;
        }

        .is-invalid {
            border: 2px solid #ff00009c !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">


            <h6 class="page-title" style="font-size: 12px; font-family:Arial, Helvetica, sans-serif">Aero / Users / users</h6>

        </div>
    </div>
    {{-- <div class="card rounded-0 px-3 py-2 pt-3 bg-white">
        <div class="row col-md-11">
            <div class="col-md-3"><label for="name" class="px-2 text-dark">Name </label><input id="name_s" type="text" name="name">
            </div>
            <div class="col-md-3"><label for="nationality" class="px-2 text-dark">Nationality </label><input id="nationality_s" type="text"
                    name="nationality"></div>
            <div class="col-md-3"><label for="passport" class="px-2 text-dark">Passport </label><input id="passport_s" type="text"
                    name="passport"></div>
            <div class="col-md-3"></div>
        </div>
    </div> --}}

    <div class="row px-2 bg-transparent ">
        <!-- <div class="card col-md-3 pr-2">
                asdhasjkh
            </div> -->
        <div class="card p-2 col-md-12 rounded-0">
            <div class="row text-end d-flex justify-content-end text-right p-2">
                {{-- <div class="col-md-2">
                    <button type="button" class="btn btn-sm bg-primary rounded-0" style="  color:white"
                        onclick="onpenModal()">
                        Add Balance
                    </button>
                </div> --}}
                <div class="col-md-2">
                    <button type="button" class="btn btn-sm rounded-0" style="background: #90CF5F; color:white"
                        onclick="onpenModal()">
                        Add Member
                    </button>
                </div>
            </div>
            <table id="alternative-page-datatable" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                role="grid" aria-describedby="alternative-page-datatable_info" style="width: 1008px;">
                <thead>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Nationality</th>
                    <th>Gender</th>
                    <th>Passport no</th>
                    <th>Status</th>
                    <th class="text-center">Operations </th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone_no }}</td>
                            <td>{{ $user->nationality }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->passport_no }}</td>
                            <td class="text-center">
                                @if ($user->availability == 'available')
                                    <span class="badge label-table bg-success">Available</span>
                                @else
                                    <span class="badge label-table bg-danger">Unavailable</span>
                                @endif
                            </td>
                            <td class="text-center d-flex justify-content-center"><span class="">
                                    <button type="button"   onclick="getUser({{$user->id}})" class="btn  btn-sm"><i class="mdi mdi-circle-edit-outline" style="color:black"></i></button>

                                    <a href="/personal/{{ $user->id }}" class="btn  btn-sm"><i
                                            class="mdi mdi-account-details" style="color:black"></i></a>

                                </span><span>

                                    <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" onclick="return confirm('Are you sure')"
                                            class="btn  btn-sm"><i class="mdi mdi-delete-outline"
                                                style="color:black"></i></button>
                                    </form>

                                </span></td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

    {{-- <h1>sdfsdf</h1> --}}
    {{-- 
    <div id="dialog1" title="NEW" class="col-md-8">


    </div> --}}


    <!-- Modal balance -->

    <div class="modal fade" id="exampleModalk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  ">
            <div class="modal-content">
                <div class="modal-header" style="background:  #EAEFF4">
                    <h5 class="modal-title " id="exampleModalLabel">New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('manage-balance.store')}}" method="post" onsubmit="return submimtBalance()">
                @csrf
             
                <div class="modal-body  ">
                    <input name="name_member" type="hidden" id="name_member">
                    <label for="userID">Select User</label>
                    <span class="text-danger" id="er_userID"></span>
                    <select name="userID" id="userID" class="form-select" onchange="getName()">
                        <option value="" hidden>-- SELECT  USER --</option>

                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>

                    <label for="addBalacne">Add Balance</label>
                    <span class="text-danger" id="er_balacne"></span>
                    <input type="number" class="form-control" name="balance" id="balacne">
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



    <!-- Modal -->


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background:  #EAEFF4">
                    <h5 class="modal-title " id="exampleModalLabel">New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body  ">


                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row p-3">
                            <div class="col-md-5">

                                <div class="row">
                                    <div class="col-md-5  "><label for="name">Name</label></div>
                                    <div class="col-md-7 "> <input type="text" id="name" value=""
                                            name="name"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5"><label for="gender">Gender</label></div>
                                    <div class="col-md-5">
                                        <select name="gender" id="gender" class="form-select">
                                            <option hidden value="">--- Select gender ---</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="age">Age</label></div>
                                    <div class="col-md-7"> <input type="number" id="age" name="age"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="phone_no">Phone no</label></div>
                                    <div class="col-md-7"> <input type="text" id="phone_no" name="phone_no"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="emergency_no">Emergency no</label></div>
                                    <div class="col-md-7"> <input type="text" id="emergency_no" name="emergency_no">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="relegion">Religion</label></div>
                                    <div class="col-md-7"> <input type="text" id="relegion" name="relegion"></div>
                                </div>

                            </div>
                            <div class="col-md-4">

                                <div class="row">
                                    <div class="col-md-5"><label for="nationality">Nationality</label></div>
                                    <div class="col-md-7"> <input type="text" id="nationality" name="nationality">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="passport_no">Passport no</label></div>
                                    <div class="col-md-7"> <input type="text" name="passport_no" id="passport_no">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="visa">Visa</label></div>
                                    <div class="col-md-7"> <input type="text" id="visa" name="visa"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="passport_expiry">Passport expiry</label></div>
                                    <div class="col-md-6"> <input type="date" id="passport_expiry"
                                            name="passport_expiry" class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="visa_expiry">Visa expiry</label></div>
                                    <div class="col-md-6"> <input type="date" id="visa_expiry" name="visa_expiry"
                                            class="form-control"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5"><label for="date_of_birth">Date of Birth</label></div>
                                    <div class="col-md-6"> <input type="date" id="date_of_birth" name="date_of_birth"
                                            class="form-control"></div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <img id="profile_image" src="{{ URL::asset('assets/images/userImage.gif') }}"
                                    height="162" width="140" />
                                <input type="file" onchange="encodeImageFileAsURL(this)" name="userImage"
                                    style="color:transparent" class="p-5 py-2">
                            </div>
                        </div>


                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist" style="background: #EAEFF4">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">Work info</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">Room
                                    info</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address"
                                    type="button" role="tab" aria-controls="address"
                                    aria-selected="false">Address</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="row p-3">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-5"><label for="company">Company</label></div>
                                            <div class="col-md-7"> <input type="text" id="company" name="company">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5"><label for="work_contact">Work contact</label></div>
                                            <div class="col-md-7"> <input type="text" id="work_contact"
                                                    name="work_contact"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5"><label for="person_incharge">Person incharge</label>
                                            </div>
                                            <div class="col-md-7"> <input type="text" id="person_incharge"
                                                    name="person_incharge"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3 text-end"><label for="work_address">Work Address</label>
                                            </div>
                                            <div class="col-md-7 ">
                                                <textarea type="text" class="form-control" id="work_address" name="work_address" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-3"><label for="floor">Floor</label></div>
                                    <div class="col-md-7"> <input type="text" id="floor" name="floor"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label for="room_no">Room no</label></div>
                                    <div class="col-md-7"> <input type="text" id="room_no" name="room_no"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label for="bed_no">Bed no</label></div>
                                    <div class="col-md-7"> <input type="text" id="bed_no" name="bed_no"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label for="rent_per_month">Rent per Month</label></div>
                                    <div class="col-md-7"> <input type="number" id="rent_per_month" name="rent_per_month"></div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                <div class="row">
                                    <div class="col-md-2"><label for="permanent_address">Permanent Address</label></div>
                                    <div class="col-md-4">
                                        <textarea name="permanent_address" class="form-control" id="permanent_address" cols="25" rows="5"></textarea>
                                    </div>

                                    <div class="col-md-2"><label for="current_address">Current Address</label></div>
                                    <div class="col-md-4">
                                        <textarea name="current_address" class="form-control" id="current_address" cols="25" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="modal-footer p-1" style="background:#EAEFF4; justify-content:center">

                        <button type="submit" class="btn btn-sm  border-0 bg-made-green"
                            style="background :#90CF5F; color:white">Save changes</button>
                        <button type="button" class="btn btn-sm btn-white border-0 "
                            data-bs-dismiss="modal">Cancel</button>
                    </div>

            </div>

            </form>
        </div>
    @endsection


    @section('script')
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

        <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />

        <script>
            $(function() {
                $("#dialog1").dialog({
                    autoOpen: false
                });

                $("#opener").click(function() {
                    $("#dialog1").dialog('open');
                });
            });

            function onpenModal() {
                $('#id').val('');
                $('#name').val('');
                $('#gender').val('');
                $('#age').val('');
                $('#phone_no').val('');
                $('#emergency_no').val('');
                $('#relegion').val('');
                $('#nationality').val('');
                $('#passport_no').val('');
                $('#visa').val('');
                $('#visa_expiry').val('');
                $('#company').val('');
                $('#work_contact').val('');
                $('#work_address').val('');
                $('#person_incharge').val('');
                $('#floor').val('');
                $('#room_no').val('');
                $('#rent_per_month').val('');
                $("#date_of_birth").val('');
                $('#bed_no').val('');
                $('#permanent_address').val('');
                $('#current_address').val('');
                $("#profile_image").attr("src", 'assets/images/userImage.gif');
                $('#exampleModal').modal('show');
            }


            function getUser(id) {
                $.ajax({
                    type: "GET",
                    url: `user/${id}`,
                    success: function(response) {
                        // console.log(response);
                        var data = response.data;
                        $('#id').val(id);
                        $('#name').val(data['user'].name);
                        $('#gender').val(data['user'].gender);
                        $('#age').val(data['user'].age);
                        $('#phone_no').val(data['user'].phone_no);
                        $('#emergency_no').val(data['user'].emergency_no);
                        $('#relegion').val(data['user'].relegion);
                        $('#nationality').val(data['user'].nationality);
                        $('#passport_no').val(data['user'].passport_no);
                        $('#visa').val(data['user'].visa);

                        $('#company').val(data['work_info'].company);
                        $('#work_contact').val(data['work_info'].work_contact);
                        $('#work_address').val(data['work_info'].work_address);
                        $('#person_incharge').val(data['work_info'].person_incharge);
                        $('#floor').val(data['room_info'].floor);
                        $('#room_no').val(data['room_info'].room_no);
                        $('#bed_no').val(data['room_info'].bed_no);
                        $('#permanent_address').val(data['user'].permanent_address);
                        $('#current_address').val(data['user'].current_address);
                        $('#rent_per_month').val(data['user'].rent_per_month);
                     $("#date_of_birth").val(data['user'].date_of_birth);

                        // console.log(data['user'].visa_expiry)


                        let day = data['user'].visa_expiry.split(" ");
                        // console.log(day[0]);
                        $('#visa_expiry').val(day[0]);

                        let day_p = data['user'].visa_expiry.split(" ");
                        $('#passport_expiry').val(day_p[0])

                        $.get(data['user'].user_img)

                            .done(function() {
                                $("#profile_image").attr("src", data['user'].user_image);


                            }).fail(function() {
                                // console.log("SDfsd");
                                $("#profile_image").attr("src", 'assets/images/userImage.gif');

                            })

                        $('#exampleModal').modal('show');


                    }
                })
            }

            function submitFoam() {


                let ret = true;

                if ($('#name').val() == '') {
                    $('#name').addClass('is-invalid')

                }
                if ($('#gender').val('') == "") {

                }
                if ($('#age').val('') == "") {

                }
                if ($('#phone_no').val('')) {

                }
                return false;
            }

            function getName(){
                
                let name = $( "#userID option:selected" ).text();
                $('#name_member').val(name)
            }

            function submimtBalance(){
                let ret = true;

                if($('#name_member').val() == ""){
                    $('#er_name_member').html('Select User')
                    ret = false
                }

                if($('#balacne').val() == ""){
                    $('#er_balacne').html('This feild is required')
                    ret = false
                }
                return ret;
            }

            function encodeImageFileAsURL(element) {
                var file = element.files[0];
                var reader = new FileReader();
                reader.onloadend = function() {
                    // console.log('RESULT', reader.result)
                    $("#profile_image").attr("src", reader.result);
                    $("#profile_image").attr('height', '162');
                    $("#profile_image").attr('width', '140');
                }
                reader.readAsDataURL(file);
            }
        </script>
        <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
        <!-- end demo js-->
    @endsection
