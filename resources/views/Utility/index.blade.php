<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.shared/title-meta', ['title' => 'Utility'])
    @include('layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])

    <style>
        .content {
            margin-top: 10%;
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
        @include('layouts.shared/topbar')
       
        
        <div class="container  ">
          
            <div class="content p-2">
                @if (Session::has('message'))
      
                <p class="alert {{ Session::get('alert-class', 'alert-secondary') }} text-center text-dark py-3 m-2" style="font-size: 17px">{{ Session::get('message') }}</p>  
            
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</script>

</html>
