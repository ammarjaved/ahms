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
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
        
               
                <h6 class="page-title" style="font-size: 12px; font-family:Arial, Helvetica, sans-serif">Aero / Users / users</h6>
   
        </div>
    </div>
    <div class="card rounded-0 px-3 py-2 pt-3 bg-white">
        <div class="row col-md-11">
            <div class="col-md-3"><label for="name" class="px-2 text-dark">Name </label><input type="text" name="name">
            </div>
            <div class="col-md-3"><label for="nationality" class="px-2 text-dark">Nationality </label><input type="text"
                    name="nationality"></div>
            <div class="col-md-3"><label for="passport" class="px-2 text-dark">Passport </label><input type="text"
                    name="passport"></div>
            <div class="col-md-3"></div>
        </div>
    </div>

<div class="row px-2 bg-transparent ">
    <div class="card col-md-3 pr-2">
        asdhasjkh
    </div>
    <div class="card p-2 col-md-9 rounded-0">
        <div class="row text-end text-right p-2">
            <div class="col-md-12">
                <button type="button" class="btn btn-sm rounded-0" style="background: #90CF5F; color:white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add New
                </button>
            </div>
        </div>
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
            <thead>
                <th>Name</th>
                <th>Phone</th>
                <th>Nationality</th>
                <th>Gender</th>
                <th>Passport no</th>
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
                        <td class="text-center d-flex justify-content-center"><span class=""><button type="button"
                                    class="btn  btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="mdi mdi-circle-edit-outline" style="color:black"></i></button></span><span>
                                <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" onclick="return confirm('Are you sure')" class="btn  btn-sm"><i
                                            class="mdi mdi-delete-outline" style="color:black"></i></button>
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


    <!-- Button trigger modal -->


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

                        <div class="row p-3">
                            <div class="col-md-5">

                                <div class="row">
                                    <div class="col-md-5  "><label for="name">Name</label></div>
                                    <div class="col-md-7 "> <input type="text" value="" name="name"></div>
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
                                    <div class="col-md-7"> <input type="number" max="3" name="age"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="phone_no">Phone no</label></div>
                                    <div class="col-md-7"> <input type="text" name="phone_no"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="emergency_no">Emergency no</label></div>
                                    <div class="col-md-7"> <input type="text" name="emergency_no"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="relegion">Relegion</label></div>
                                    <div class="col-md-7"> <input type="text" name="relegion"></div>
                                </div>

                            </div>
                            <div class="col-md-4">

                                <div class="row">
                                    <div class="col-md-5"><label for="nationality">Nationality</label></div>
                                    <div class="col-md-7"> <input type="text" name="nationality"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="passport_no">Passport no</label></div>
                                    <div class="col-md-7"> <input type="text" name="passport_no"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="visa">Visa</label></div>
                                    <div class="col-md-7"> <input type="text" name="visa"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="passport_expiry">Passport expiry</label></div>
                                    <div class="col-md-6"> <input type="date" name="passport_expiry"
                                            class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="visa_expiry">Visa expiry</label></div>
                                    <div class="col-md-6"> <input type="date" name="visa_expiry"
                                            class="form-control"></div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <img src="{{ URL::asset('assets/images/userImage.gif') }}" />
                                <input type="file" name="userImage" style="color:transparent" class="p-5 py-2">
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
                                            <div class="col-md-7"> <input type="text" name="company"></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5"><label for="work_contact">Work contact</label></div>
                                            <div class="col-md-7"> <input type="text" name="work_contact"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5"><label for="person_incharge">Person incharge</label>
                                            </div>
                                            <div class="col-md-7"> <input type="text" name="person_incharge"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3 text-end"><label for="work_address">Work Address</label>
                                            </div>
                                            <div class="col-md-7 ">
                                                <textarea type="text" class="form-control" name="work_address" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-3"><label for="floor">Floor</label></div>
                                    <div class="col-md-7"> <input type="text" name="floor"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label for="room_no">Room no</label></div>
                                    <div class="col-md-7"> <input type="text" name="room_no"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label for="bed_no">Bed no</label></div>
                                    <div class="col-md-7"> <input type="text" name="bed_no"></div>
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
        </script>
        <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
        <!-- end demo js-->
    @endsection
