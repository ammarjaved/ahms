@extends('layouts.vertical', ['page_title' => 'Application'])
@section('css')
<!-- third party css -->
<link href="{{asset('assets/libs/ladda/ladda.min.css')}}" rel="stylesheet" type="text/css" />

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Aero</a></li>
                        <li class="breadcrumb-item"><a href="#">Application</a></li>
                        <li class="breadcrumb-item active">create</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Application</h4>
            </div>
        </div>
    </div>

    
<form id="regForm" action="{{ route('application.store') }}" method="POST">
    @csrf
    <h1>Applicaiton</h1>
    <!-- One "tab" for each step in the form: -->
    <div class="tab m-3">
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="ref_num form-label">Nombor Rujukan Utiliti</label><br>
                <span class="text-danger">
                    @error('ref_num')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-md-7">

                <input type="text" class="form-control  @error('ref_num') is-invalid @enderror" name="ref_num"
                    id="ref_num" value="{{old('ref_num')}}">
            </div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="application_type">Panjang kabel</label><br>
                <span class="text-danger">
                    @error('application_type')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-md-7"><input type="text"
                    class="form-control @error('application_type') is-invalid @enderror" name="application_type"
                    id="application_type" value="{{old('application_type')}}"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="digout_area">Nama Division</label><br>
                <span class="text-danger">
                    @error('digout_area')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-md-7"><input type="text"
                    class="form-control @error('digout_area') is-invalid @enderror" name="digout_area"
                    id="digout_area" value="{{old('digout_area')}}"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="name_of_applicant">Nama Pemohon</label><br>
                <span class="text-danger">
                    @error('name_of_applicant')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-md-7"><input type="text"
                    class="form-control @error('name_of_applicant') is-invalid @enderror" name="name_of_applicant"
                    id="name_of_applicant" value="{{old('name_of_applicant')}}"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="company_name">Nama Syarikat</label><br>
                <span class="text-danger">
                    @error('company_name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-md-7"><input type="text"
                    class="form-control @error('company_name') is-invalid @enderror" name="company_name"
                    id="company_name" value="{{old('company_name')}}"></div>
        </div>
        <div class="row p-3 pb-0 ">
            <div class="col-md-5"><label for="telephone_no">No Telefon</label><br>
                <span class="text-danger">
                    @error('telephone_no')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-md-7"><input type="number"
                    class="form-control @error('telephone_no') is-invalid @enderror" name="telephone_no"
                    id="telephone_no" value="{{old('telephone_no')}}"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="address">Alamat Pemohon</label><br>
                <span class="text-danger">
                    @error('address')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-md-7"><input type="text" class="form-control @error('address') is-invalid @enderror"
                    name="address" id="address" value="{{old('address')}}"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="parlimen">Parlimen*</label><br>
                <span class="text-danger">
                    @error('parlimen')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-md-7"><input type="text" class="form-control @error('parlimen') is-invalid @enderror"
                    name="parlimen" id="parlimen" value="{{old('parlimen')}}"></div>
        </div>

        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="road_involved">Senarai Jalan Yang Terlibat</label><br>
                <span class="text-danger">
                    @error('road_involved')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-md-7"><input type="text"
                    class="form-control @error('road_involved') is-invalid @enderror" name="road_involved"
                    id="road_involved" value="{{old('road_involved')}}"></div>
        </div>
    </div>
    <div class="tab m-3">A. Borang JKPB / P - 02 : 
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="">Tajuk Kerja</label><span class="text-danger">@error('job_title_a'){{$message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" oninput="this.className = ''" class="form-control" id="job_title_a" value="{{old('job_title_a')}}" name="job_title_a"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="advance_deposit_a">Bayaran</label><span class="text-danger">@error('advance_deposit_a'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="number" class="form-control" id="advance_deposit_a" value="{{old('advance_deposit_a')}}" name="advance_deposit_a"></div>
        </div>
    </div>
    
    <div class="tab p-3">BAHAGIAN B: CAJ GANTIRUGI :
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="streetname_b">NAMA JALAN</label><span class="text-danger">@error('streetname_b'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="streetname_b" value="{{old('streetname_b')}}" name="streetname_b"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="distance_b">PANJANG (METER)</label><span class="text-danger">@error('distance_b'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="number" class="form-control" id="distance_b" value="{{old('distance_b')}}"  name="distance_b"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="damage_method_b">KAEDAH KERJA</label><span class="text-danger">@error('damage_method_b'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="damage_method_b" value="{{old('damage_method_b')}}" name="damage_method_b"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="damage_rate_per_unit_b">KADAR (RM/METER)</label><span class="text-danger">@error('damage_rate_per_unit_b'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="number" class="form-control" id="damage_rate_per_unit_b" value="{{old('damage_rate_per_unit_b')}}" name="damage_rate_per_unit_b"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="total_cost_b">BAYARAN (RM)</label><span class="text-danger">@error('total_cost_b')This field is required @enderror</span></div>
            <div class="col-md-7"><input type="number" class="form-control" id="total_cost_b" value="{{old('total_cost_b')}}" name="total_cost_b"></div>
        </div>
    </div>
    <div class="tab p-3">BAHAGIAN C: KADAR CAJ BAIK PULIH JALAN (HDD, PIPE JACKING, PENYIASATAN TANAH) : 
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="road_repair_descriptioon_c">Penerangan pembaikan jalan</label><span class="text-danger">@error('road_repair_descriptioon_c'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="road_repair_descriptioon_c" value="{{old('road_repair_descriptioon_c')}}" name="road_repair_descriptioon_c"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="repair_perunit_chages_c">Membaiki per unit charges</label><span class="text-danger">@error('repair_perunit_chages_c'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="number" class="form-control" id="repair_perunit_chages_c" value="{{old('repair_perunit_chages_c')}}" name="repair_perunit_chages_c"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="total_road_repair_cost_c">Jumlah kos pembaikan jalan</label><span class="text-danger">@error('total_road_repair_cost_c'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="number" class="form-control" id="total_road_repair_cost_c"  value="{{old('total_road_repair_cost_c')}}" name="total_road_repair_cost_c"></div>
        </div>
    </div>
    <div class="tab p-3">Owner description : 
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="owner_phone"> Telefon no</label><span class="text-danger">@error('owner_phone'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="phone" value="{{old('owner_phone')}}" name="owner_phone"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="owner_fax">Faks</label><span class="text-danger">@error('owner_fax'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="owner_fax" value="{{old('owner_fax')}}" name="owner_fax"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="owner_company_name">Nama syarikat</label><span class="text-danger">@error('owner_company_name'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="owner_company_name" value="{{old('owner_company_name')}}" name="owner_company_name"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="owner_address">Alamat</label><span class="text-danger">@error('owner_address'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="owner_address" value="{{old('owner_address')}}" name="owner_address"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="owner_email">Email</label><span class="text-danger">@error('owner_email'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="owner_email" value="{{old('owner_email')}}" name="owner_email"></div>
        </div>

    </div>

    <div class="tab p-3">Contractor description : 
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="name">Nama</label><span class="text-danger">@error('name'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="name" value="{{old('name')}}" name="name"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="phone">Telefon no</label><span class="text-danger">@error('phone'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="phone" value="{{old('phone')}}" name="phone"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="fax">Faks</label><span class="text-danger">@error('fax'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="fax" value="{{old('fax')}}" name="fax"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="company_name">Nama syarikat</label><span class="text-danger">@error('company_name'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="company_name" value="{{old('company_name')}}" name="company_name"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="postcode">Postcode</label><span class="text-danger">@error('postcode'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="postcode" value="{{old('postcode')}}" name="postcode"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="state">Negeri</label><span class="text-danger">@error('state'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="state" value="{{old('state')}}" name="state"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="address">Alamat</label><span class="text-danger">@error('address'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="address" value="{{old('address')}}" name="address"></div>
        </div>
        <div class="row p-3 pb-0">
            <div class="col-md-5"><label for="email">Email</label><span class="text-danger">@error('email'){{message}}@enderror</span></div>
            <div class="col-md-7"><input type="text" class="form-control" id="email" value="{{old('email')}}" name="email"></div>
        </div>
    </div>
    <div style="overflow:auto;">
      <div style="float:right;">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        <button type="submit" id="submit" style="display: none">Submit<button>
      </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
    </div>
  </form>
    
@endsection

@section('script')


<script>
    $(document).ready(function(){
        const buttons = document.getElementsByTagName('button');

// Remove the last button
const lastButton = buttons[buttons.length - 1];
lastButton.parentNode.removeChild(lastButton);
    })
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    
    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").style.display ="none";
        document.getElementById("submit").style.display = "inline";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }
    
    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length+1) {
        // ... the form gets submitted:
        // document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }
    
    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }
    
    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
    </script>
    

@endsection