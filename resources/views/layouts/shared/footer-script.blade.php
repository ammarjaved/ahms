<!-- bundle -->
<!-- Vendor js -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
@yield('script')
<!-- App js -->
<script src="{{asset('assets/js/app.min.js')}}"></script>
@yield('script-bottom')


<script>
    // function updateAvail() {
    //     $.ajax({
    //             type: "GET",
    //             url:"/update-availability",
    //             success:function(response){
    //                 // console.log("success");
    //             }

    // })}

    // setInterval(updateAvail, 100000);
</script>