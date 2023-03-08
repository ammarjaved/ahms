@extends('layouts.vertical', ['page_title' => 'users'])


@section('css')
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
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


            <h6 class="page-title" style="font-size: 12px; font-family:Arial, Helvetica, sans-serif"><a href="/"
                    class="text-dark">Aero</a> / <a href="{{ route('payment.index') }}" class="text-dark">Payment /
                    Member</a> / payment history
            </h6>

        </div>
    </div>


    <div class="row px-2 bg-transparent ">

        <div class="card p-2 col-md-12 rounded-0">
            <div class="row text-end text-right p-2">
                {{-- <div class="col-md-12">
                    <button type="button" class="btn btn-sm rounded-0" style="background: #90CF5F; color:white"
                        onclick="openPayment()">
                        Add Payment
                    </button>
                </div> --}}
            </div>
            <table id="alternative-page-datatable" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                role="grid" aria-describedby="alternative-page-datatable_info" style="width: 1008px;">
                <thead>
                    <th>Name</th>
                  
                    <th>Rent Of Month</th>
                    
                    <th>Issue date</th>
                    <th>Status</th>
                    <th class="text-center">Detail </th>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment->name }}</td>
                            
                            <td>{{ $payment->due_payment }}</td>
                           
                            <td>{{ date('Y-m-d',strtotime($payment->created_at)) }}</td>
                            <td> @if ($payment->status != '')
                                <span class="badge label-table bg-success">Paid</span>
                            @else
                                <span class="badge label-table bg-danger">Unpaid</span>
                            @endif</td>
                            <td class="text-center d-flex justify-content-center">
                                <!-- <span>
                                    <button type="button" onclick="getUserPayment({{ $payment->id }})"
                                        class="btn  btn-sm"><i class="mdi mdi-circle-edit-outline"
                                            style="color:black"></i></button>
                                </span> -->
                                <span class="">

                                    <a href="#" onclick="openPayment({{ $payment->id }})" class="btn  btn-sm"><i
                                            class=" fas fa-print" style="color:black"></i></a>

                                </span><span>


                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>


    <div class="modal fade" id="staticBackdropDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header" style="background:  #EAEFF4">
                    <h5 class="modal-title " id="exampleModalLabel">Payment Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body  ">
                    <h4 class="text-center">Payment Recipit</h4>
                    <table class=" ">
                        <tr>
                            <th>Name</th>
                            <td><span id="detailName"></span></td>
                        </tr>
                        <tr>
                            <th>Created by</th>
                            <td><span id="detailCreatedBy"></span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span id="status"></span></td>
                        </tr>
                    </table>


                    <h4>Payment summary </h4>

                    <table class="table table-bordered">
                        <tr>
                            <th> Rent Of Month</th>
                            <td><span id="detailDueAmount"></span></td>
                        </tr>
                        <tr>
                            <th> Total paid</th>
                            <td><span id="detailTotalPaid"></span> RM</td>
                        </tr>
                      
                        {{-- <tr>
                            <th> Payment Date</th>
                            <td><span id="detailPaymentDate"></span></td>
                        </tr> --}}

                        <tr>
                            <th> Due Date</th>
                            <td><span id="detailDueDate"></span></td>
                        </tr>

                        <tr>
                            <th> Issue Date

                            </th>
                            <td><span id="detailCreatedAt"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer p-1" style="background:#EAEFF4; justify-content:center">

                    {{-- <button type="submit" class="btn btn-sm  border-0 bg-made-green"
                            style="background :#90CF5F; color:white">Save changes</button> --}}
                    <button type="button" class="btn btn-sm btn-white border-0 " data-bs-dismiss="modal">Close</button>
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header" style="background:  #EAEFF4">
                    <h5 class="modal-title " id="exampleModalLabel">Update Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/payment/{{ 21 }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="modal-body  ">
                        <input type="hidden" name="id" id="id">
                        <input type="" class="form-control" disabled name="" id="name">
                        <div class="row d-felx justify-content-between mt-2">
                            <div class="col-md-5">
                                <label for="due_payment">Due Payment</label>
                                <input type="number" name="due_payment" id="due_payment" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="due_date">Due Date</label>
                                <input type="date" name="due_date" id="due_date" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer p-1" style="background:#EAEFF4; justify-content:center">

                        <button type="submit" class="btn btn-sm  border-0 bg-made-green"
                            style="background :#90CF5F; color:white">Save changes</button>
                        <button type="button" class="btn btn-sm btn-white border-0 "
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        function openPayment(id) {
            $.ajax({
                type: "GET",
                url: `/payment/${id}/edit`,
                success: function(response) {
                    // console.log(response)
                    $('#detailName').html(response.data.name)
                    $('#detailCreatedBy').html(response.data.created_by)
                    if (response.data.status == ""){
                        $('#status').html("Unpaid")
                    }else{
                        $('#status').html("Paid")
                    }
                    
                    $('#detailTotalPaid').html(response.data.due_payment)
                    $('#detailDueAmount').html(response.data.due_payment)
                 
                   
          
                    let day = response.data.due_date.split(" ");
                    $('#detailDueDate').html(day[0])
                

                    let day1 = response.data.created_at.split(" ");
                    $('#detailCreatedAt').html(day1[0])

                    $('#staticBackdropDetail').modal('show');
                }
            })
        }





        function matchCustom(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            if (data.text.indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                modifiedData.text += ' (matched)';

                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }

        function getUserPayment(id) {

            $.ajax({
                type: "GET",
                url: `/payment/${id}/edit`,
                success: function(response) {
                    console.log(response)
                    $('#name').val(response.data.name)



                    $('#due_payment').val(response.data.due_payment)
                    let day = response.data.due_date.split(" ");
                    $('#due_date').val(day[0])

                    $('#id').val(response.data.id)
                    $('#staticBackdrop').modal('show');
                }

            })
        }
    </script>

    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <!-- end demo js-->
@endsection
