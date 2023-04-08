<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.shared/title-meta', ['title' => 'Utility'])
    @include('layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])

    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .content {
            margin-top: 10%;
        }
        .active{
            border:none !important;
        }
    </style>

</head>



<body class="loading"
    data-layout='{"mode": "{{ $theme ?? 'light' }}", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "{{ $theme ?? 'light' }}", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'
    @yield('body-extra')>


    <div id="preloader">
        <div id="status">
            <div class="spinner">Loading...</div>
        </div>
    </div>
    <div id="wrapper">
        @if (Auth::check())
              @include('layouts.shared/topbar')

        @endif
      

        <div class="container  ">

            <div class="content p-2">
                @if (Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-secondary') }} text-center text-dark py-3 m-2"
                        style="font-size: 17px">{{ Session::get('message') }}</p>
                @endif
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4  " onclick="openModal('gas')" style="cursor: pointer">
                        <div class="card p-3 shadow">
                            <div class="row">
                                <div class="col-md-2"><i class="fas fa-gas-pump"></i></div>
                                <div class="col-md-10">Gas</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" onclick="openModal('teleco')" style="cursor: pointer">
                        <div class="card p-3 shadow">
                            <div class="row">
                                <div class="col-md-2"><i class=" fas fa-blender-phone"></i></div>
                                <div class="col-md-10">Teleco</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" onclick="openModal('electric')" style="cursor: pointer">
                        <div class="card p-3 shadow">
                            <div class="row">
                                <div class="col-md-2"><i class=" fas fa-broadcast-tower"></i></div>
                                <div class="col-md-10">Electric</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>




    </div>
    <div class="row px-2 bg-transparent mx-3 ">
        <!-- <div class="card col-md-3 pr-2">
                asdhasjkh
            </div> -->
        <div class="card p-2 col-md-12 rounded-0">


            <ul class="nav nav-tabs border-0" id="myTab" role="tablist" style="background: #EAEFF4">
                <li class="nav-item" role="presentation" style="width:50%">
                    <button class="nav-link active form-control" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#home" type="button" role="tab" aria-controls="home"
                        aria-selected="true">User Balance Detail</button>
                </li>
                <li class="nav-item " role="presentation "style="width:50%">
                    <button class="nav-link form-control" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">User Utility Detail</button>
                </li>



            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row text-end d-flex justify-content-end text-right p-2">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-sm bg-primary rounded-0" style="  color:white"
                                onclick="$('#BalanceModal').modal('show')">
                                Add Balance
                            </button>
                        </div>

                        <div class="col-md-2">
                            <button type="button" class="btn btn-sm bg-primary rounded-0" style="  color:white"
                                onclick="$('#BalanceModal1').modal('show')">
                                Make Payment
                            </button>
                        </div>


                    </div>
                    <table id="alternative-page-datatable"
                        class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid"
                        aria-describedby="alternative-page-datatable_info" style="width: 1008px;">
                        <thead>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Balance</th>
                            {{-- <th>Gender</th> --}}
                            <th>Last Balance Updated</th>
                            <th>Status</th>
                            {{-- <th class="text-center">Operations </th> --}}
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone_no }}</td>
                                    <td>

                                        {{ $user->balance == '' ? '00' : $user->balance }} RM

                                    </td>

                                    <td>{{ $user->updated_at == '' ? '0000-00-00 00:00:00' : $user->updated_at }}</td>
                                    <td class="text-center">
                                        @if ($user->availability == 'available')
                                            <span class="badge label-table bg-success">Available</span>
                                        @else
                                            <span class="badge label-table bg-danger">Unavailable</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
                <div class="tab-pane fade p-2" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <table id="utilityDataTable"
                        class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid"
                        aria-describedby="alternative-page-datatable_info" style="width: 1008px;">
                        <thead>
                            <th>Name</th>
                            <th>Type</th>
                            <th>On Time</th>
                            {{-- <th>Gender</th> --}}
                            <th>Off TIme</th>
                            <th>Charge Per Min</th>
                            <th>Toatal Charge (RM)</th>
                            {{-- <th class="text-center">Operations </th> --}}
                        </thead>
                        <tbody>
                            @foreach ($utility as $ut)
                                <tr>
                                    <td>{{ $ut->name }}</td>
                                    <td>

                                        {{ $ut->utility_name }}</td>
                                    <td>

                                        {{ $ut->on_time }} RM

                                    </td>

                                    <td>{{ $ut->off_time }}</td>
                                    <td>{{ $ut->charges_per_min }}</td>
                                    <td class="text-center">
                                        {{ $ut->charges }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>




                </div>


            </div>



        </div>
    </div>

    <div class="modal fade" id="BalanceModal" tabindex="-1" aria-labelledby="BalanceModalLabel" aria-hidden="true">
        <div class="modal-dialog  ">
            <div class="modal-content">
                <div class="modal-header" style="background:  #EAEFF4">
                    <h5 class="modal-title " id="exampleModalLabel">New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('manage-balance.store') }}" method="post"
                    onsubmit="return submimtBalance()">
                    @csrf

                    <div class="modal-body  ">
                        <input name="name_member" type="hidden" id="name_member">
                        <label for="userID">Select User</label>
                        <span class="text-danger" id="er_userID"></span>
                        <select name="userID" id="userID" class="form-select" onchange="getName()">
                            <option value="" hidden>-- SELECT USER --</option>

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                        <label for="addBalacne">Add Balance</label>
                        <span class="text-danger" id="er_balacne"></span>
                        <input type="number" class="form-control" name="balance" id="balacne">
                        <input type="text" class="form-control" name="check" id="check" value="add" hidden>
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


    <div class="modal fade" id="BalanceModal1" tabindex="-1" aria-labelledby="BalanceModalLabel" aria-hidden="true">
        <div class="modal-dialog  ">
            <div class="modal-content">
                <div class="modal-header" style="background:  #EAEFF4">
                    <h5 class="modal-title " id="exampleModalLabel">Make Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('manage-balance.store') }}" method="post"
                  >
                    @csrf

                    <div class="modal-body  ">
                        <input name="name_member" type="hidden" id="name_member">
                        <label for="userID">Select User</label>
                        <span class="text-danger" id="er_userID"></span>
                        <select name="userID" id="userID" class="form-select" onchange="getName()">
                            <option value="" hidden>-- SELECT USER --</option>

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                        <label for="addBalacne">Add Amount</label>
                        <span class="text-danger" id="er_balacne"></span>
                        <input type="number" class="form-control" name="balance" id="balacne">
                        <input type="text" class="form-control" name="check" id="check" value="remove" hidden>
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




    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  ">
            <div class="modal-content">
                <div class="modal-header" style="background:  #EAEFF4">
                    <h5 class="modal-title " id="exampleModalLabel">New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('utility.store') }}" onsubmit="return submitFoam()" method="post">
                    @csrf
                    <div class="modal-body  ">
                        <input type="hidden" name="utility" id="utility">
                        <label for="user">Select User</label>
                        <span class="text-danger" id="er_utility"></span>
                        <select name="user" id="utility" class="form-select">
                            <option value="" hidden>-- Select User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-center">
                            <span class="text-danger" id="chaeckDate"></span>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="on_time">Start Time</label>
                                <span class="text-danger" id="er_on_time"></span>
                                <input class="form-control" type="datetime-local" name="on_time" id="on_time"
                                    onchange="checkDate()">
                            </div>
                            <div class="col-md-6">
                                <label for="off_time">End Time </label>
                                <span class="text-danger" id="er_off_time"></span>
                                <input class="form-control" type="datetime-local" name="off_time" id="off_time"
                                    onchange="checkDate()">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="total_time_in_min" id="total_time_in_min">
                    <div class="modal-footer p-1" style="background:#EAEFF4; justify-content:center">

                        <button type="submit" class="btn btn-sm  border-0 bg-made-green"
                            style="background :#90CF5F; color:white">Save changes</button>
                        <button type="button" class="btn btn-sm btn-white border-0 "
                            data-bs-dismiss="modal">Cancel</button>
                    </div>

            </div>

            </form>
        </div>

        @include('layouts.shared/footer-script')



</body>


<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />

<script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script>
    function openModal(utility) {
        $('#utility').val(utility);

        $('#exampleModal').modal('show')
    }

    var date = true;

    function submitFoam() {




        let utility = $('#utility').val()
        let onTime = $('#on_time').val()
        let ofTime = $('#off_time').val()
        let date = true
        if ($('#utility').val() == "") {
            $('#er_utility').html('Select user')
            ret = false
        } else {
            $('#er_utility').html('')
        }

        if ($('#on_time').val() == "") {
            $('#er_on_time').html('This feild is required')
            ret = false
        } else {
            $('#er_on_time').html('')
        }

        if ($('#off_time').val() == "") {
            $('#er_off_time').html('This feild is required')
            ret = false
        } else {
            $('#er_off_time').html(' ')
            ret = true
        }
        if (date) {
            const startTime = new Date($('#on_time').val());
            const endTime = new Date($('#off_time').val());

            const timeDifferenceInMilliseconds = endTime - startTime;
            const timeDifferenceInMinutes = Math.floor(timeDifferenceInMilliseconds / (1000 * 60));
            $('#total_time_in_min').val(timeDifferenceInMinutes)
            console.log();
        }
        if (date) {
            return ret;
        } else {
            return false;
        }



    }



    function checkDate() {
        let ondate = $('#on_time').val();
        let ofdate = $('#off_time').val();
        if (ondate >= ofdate) {
            $('#chaeckDate').html("End time must be greater than Start time")
            date = false
        } else {
            $('#chaeckDate').html("")
            date = true
        }
    }

    function getName() {

        let name = $("#userID option:selected").text();
        $('#name_member').val(name)
    }

    function submimtBalance() {
        let ret = true;

        if ($('#name_member').val() == "") {
            $('#er_name_member').html('Select User')
            ret = false
        }

        if ($('#balacne').val() == "") {
            $('#er_balacne').html('This feild is required')
            ret = false
        }
        return ret;
    }

        $("#utilityDataTable").DataTable();
   
</script>

</html>
