@extends('layouts.vertical', ['page_title' => 'Application'])

@section('css')
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Aero</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Application</a></li>
                        <li class="breadcrumb-item active">index</li>
                    </ol>
                </div>
                <h4 class="page-title">Applications</h4>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="col-8 text-center p-3">
                    @if (Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-secondary') }}">{{ Session::get('message') }}
                        </p>
                    @endif
                </div>

                <div class="card-body" style="height : 60vh">
                    <h4 class="header-title">Applications</h4>
                    {{-- <p class="text-muted font-13 mb-4">
                    DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction
                    function:
                    <code>$().DataTable();</code>.
                </p> --}}

                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Nombor Rujukan Utiliti</th>
                                <th>No Telefon</th>
                                <th>Nama Syarikat</th>
                                <th>Nama Pemohon</th>
                                <th>Nama Division</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $application->ref_num }}</td>
                                <td>{{ $application->telephone_no }}</td>
                                <td>{{ $application->company_name }}</td>
                                <td>{{ $application->name_of_applicant }}</td>
                                <td>{{ $application->division }}</td>
                                <td class="text-center p-1">
                                    <div class="dropdown">
                                        <button class="btn" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ URL::asset('images/three-dots-vertical.svg') }}">
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                            <li><a href="{{ route('application.show', $application->id) }}"
                                                    class="btn  btn-sm dropdown-item">Detail</a>
                                            </li>

                                            <li><a href="{{ route('application.edit', $application->id) }}"
                                                    class="btn btn-sm dropdown-item">Edit</a></li>


                                                    <li>
                                                        <form method="POST"
                                                            action="{{ route('application.destroy', $application->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn  btn-sm dropdown-item"
                                                                onclick="return confirm('Are you Sure')">Delete</button>
                                                        </form>
                                                    </li>
    
                                            {{-- <li>

                                                <button type="button" class="btn  btn-sm dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                    onclick="conDestory({{ $application->id }})">Delete</button>

                                            </li> --}}


                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tbody>

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->






    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>


                    <button type="button" onclick="destroy()" class="btn btn-primary"
                        data-bs-dismiss="modal">confirm</button>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- third party js -->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <!-- end demo js-->



    <script>
        var val = "";
        $(document).ready(function() {
            $(".loader").hide();
        })

        function conDestory($id) {
            val = $id;
        }

        function destroy() {
            console.log("asdsad");
            $(".loader").show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                url: `/application/${val}`,
                success: function(data) {
                    location.reload();

                }
            })
        }
    </script>
@endsection
