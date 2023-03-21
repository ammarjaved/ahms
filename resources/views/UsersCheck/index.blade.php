@extends('layouts.vertical', ['page_title' => 'Dashboard'])

@section('css')
    <style>

    </style>
@endsection


@section('content')
    <div class=" py-3 mx-2 ">
        <div class="row d-flex justify-content-start ">


            @foreach ($users as $user)
                <div class=" col-md-2">
                    <div class="card text-center p-3 shadow">
                        @if (file_exists(public_path() . $user->user_image) && $user->user_image != '')
                            <img id="profile_image" src="{{ URL::asset($user->user_image) }}" height="162" width="140" />
                        @else
                            <img id="profile_image" src="{{ URL::asset('assets/images/userImage.gif') }}" height="162"
                                width="140" />
                            {{-- <input type="file"  onchange="encodeImageFileAsURL(this)" name="userImage" style="color:transparent" class="p-5 py-2"> --}}
                        @endif
                        {{ $user->name }}

                        <div class="check_{{$user->id}}">
                        @if ($user->availability == 'available')
                            <button type="button" class="btn btn-sm btn-success"
                                onclick="userCheck(this,{{ $user->id }})">Check Out</button>
                        @else
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="userCheck(this,{{ $user->id }})">Check In</button>
                        @endif
                    </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection


@section('script')
    <script>
        function userCheck(element,id) {

            $.ajax({
                type: "GET",
                url: "/user/check-in/" + id,
                success: function(response) {
                    if(response.status != 200){return alert('something is wrong try again later') }
                    if($(element).hasClass('btn-success')){
             $(element).removeClass('btn-success')
             $(element).addClass('btn-danger')
             $(element).html('Check In')

           }else{
            $(element).removeClass('btn-danger')
             $(element).addClass('btn-success')
             $(element).html('Check Out')
           }
                }
            })
        }
    </script>
@endsection
