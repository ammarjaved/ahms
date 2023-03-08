@extends('layouts.vertical', ['page_title' => 'Personal Detail'])

@section('css')
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
            width: 193px;
        }
        .form-control:disabled {
    background-color: #F2F3F5 !important;
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
      
    </style>
@endsection


@section('content')

                <div class="card p-3 mt-4" style="height">
                        <div class="row p-3">
                            <div class="col-md-5">

                                <div class="row">
                                    <div class="col-md-5  "><label for="name">Name</label></div>
                                    <div class="col-md-5 "> <input   class="form-control" value="{{$data['user']->name}}" disabled></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5"><label for="gender">Gender</label></div>
                                    <div class="col-md-5">
                                      <input class="form-control" value="{{$data['user']->gender}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="age">Age</label></div>
                                    <div class="col-md-5"> <input   class="form-control"   value="{{$data['user']->age}}" disabled></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="phone_no">Phone no</label></div>
                                    <div class="col-md-5"> <input  class="form-control"  value="{{$data['user']->phone_no}}" disabled></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="emergency_no">Emergency no</label></div>
                                    <div class="col-md-5"> <input   class="form-control"  value="{{$data['user']->emergency_no}}" disabled></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="relegion">Religion</label></div>
                                    <div class="col-md-5"> <input   value="{{$data['user']->relegion}}" class="form-control" disabled></div>
                                </div>

                            </div>
                            <div class="col-md-4">

                                <div class="row">
                                    <div class="col-md-5"><label for="nationality">Nationality</label></div>
                                    <div class="col-md-6"> <input   value="{{$data['user']->nationality}}" class="form-control"  disabled></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="passport_no">Passport no</label></div>
                                    <div class="col-md-6"> <input  value="{{$data['user']->passport_no}}" class="form-control" disabled></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="visa">Visa</label></div>
                                    <div class="col-md-6"> <input  value="{{$data['user']->visa}}" class="form-control"  disabled></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="passport_expiry">Passport expiry</label></div>
                                    <div class="col-md-6"> <input    value="{{$data['user']->passport_expiry}}"  class="form-control"  disabled
                                             ></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="visa_expiry">Visa expiry</label></div>
                                    <div class="col-md-6"> <input    value="{{$data['user']->visa_expiry}}" class="form-control" disabled></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"><label for="date_of_birth">Date of Birth</label></div>
                                    <div class="col-md-6"> <input type="date" id="date_of_birth"  value="{{$data['user']->date_of_birth}}"  disabled
                                            class="form-control"></div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                @if (file_exists(public_path ().$data['user']->user_image))

                                <img id="profile_image" src="{{URL::asset($data['user']->user_image)}}" height="162" width="140" />
                                @else
                                <img id="profile_image" src="{{ URL::asset('assets/images/userImage.gif') }}" />
                                {{-- <input type="file"  onchange="encodeImageFileAsURL(this)" name="userImage" style="color:transparent" class="p-5 py-2"> --}}
                                @endif
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
                                            <div class="col-md-5"> <input class="form-control"   value="{{$data['work_info']->company}}" disabled></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5"><label for="work_contact">Work contact</label></div>
                                            <div class="col-md-5"> <input class="form-control" value=" {{$data['work_info']->work_contact}}" disabled></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5"><label for="person_incharge">Person incharge</label>
                                            </div>
                                            <div class="col-md-5"> <input class="form-control" value="{{$data['work_info']->person_incharge}}" disabled></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3 text-end"><label for="work_address">Work Address</label>
                                            </div>
                                            <div class="col-md-7 ">
                                                <textarea  class="form-control"  rows="5" disabled>{{$data['work_info']->work_address}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-2"><label for="floor">Floor</label></div>
                                    <div class="col-md-2"> <input class="form-control" value="{{$data['room_info']->floor}}" disabled></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><label for="room_no">Room no</label></div>
                                    <div class="col-md-2"> <input class="form-control" value=" {{$data['room_info']->room_no}}" disabled></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><label for="bed_no">Bed no</label></div>
                                    <div class="col-md-2"> <input class="form-control" value=" {{$data['room_info']->bed_no}}" disabled></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><label for="rent_per_month">Rent per Month</label></div>
                                    <div class="col-md-2"> <input class="form-control" value=" {{$data['room_info']->rent_per_month}}" disabled></div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                <div class="row">
                                    <div class="col-md-2"><label for="permanent_address">Permanent Address</label></div>
                                    <div class="col-md-4">
                                        <textarea   class="form-control" id="permanent_address" disabled cols="25" rows="5">{{$data['user']->permanent_address}}</textarea>
                                    </div>

                                    <div class="col-md-2"><label for="current_address">Current Address</label></div>
                                    <div class="col-md-4">
                                        <textarea name="current_address" class="form-control" disabled id="current_address" cols="25" rows="5">{{$data['user']->current_address}}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>


                </div>
<!-- 
                    <div class="modal-footer p-1" style="background:#EAEFF4; justify-content:center">

                        <button type="submit" class="btn btn-sm  border-0 bg-made-green"
                            style="background :#90CF5F; color:white">Save changes</button>
                        <button type="button" class="btn btn-sm btn-white border-0 "
                            data-bs-dismiss="modal">Cancel</button>
                    </div> -->

            <!-- </div>

            </form> -->

@endsection
