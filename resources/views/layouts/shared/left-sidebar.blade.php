<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        {{-- <div class="user-box text-center">
            <img src="{{ asset('assets/images/users/user-9.jpg') }}" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">James Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
           
        </div> --}}

        <!--- Sidemenu -->

        {{-- <aside>
            <div id="sidebar" class="nav-collapse index" style="overflow: hidden; outline: none;" tabindex="5000">
            
            <ul class="sidebar-menu">
            <li class="logo"><img src="/Images/logo-opud.png"></li>
            <li class="active">
            <a class="" href="/">
            <i class="dbkl-opud-icon icon-senarai"></i><br>
            <span>SENARAI<br>PERMOHONAN</span>
            </a>
            </li>
            <li data-toggle="collapse" data-target="#report" class="collapsed" aria-expanded="false">
            <a href="#">
            <i class="dbkl-opud-icon icon-repot"></i><br>
            <span>LAPORAN</span><b class="caret"></b>
            </a>
            </li>
            <ul class="sub-menu collapse" id="report" aria-expanded="false" style="height: 0px;">
            <li><a href="/Reportings/Index/PermitTotalDataByType">Total By Permit Type</a></li>
            <li><a href="/Reportings/Index/ListPermits">List of Permits</a></li>
            <li><a href="/Reportings/Index/PermitByStreetName">Permits by <br>Street Name</a></li>
            <li><a href="/Reportings/Index/PermitCountByStatus">Permits Count</a></li>
            <li><a href="/Reportings/Index/PermitDataByType">Length And <br> Deposit</a></li>
            <li><a href="/Reportings/Index/PermitByActions">Permit Activities</a></li>
            </ul>
            <li>
            <a class="" href="/Prestasi">
            <i class="dbkl-opud-icon icon-prestasi"></i><br>
            <span>PRESTASI</span>
            </a>
            </li>
            <li>
            <a class="" href="/Profiles">
            <i class="dbkl-opud-icon icon-syarikat"></i><br>
            <span>SENARAI SYARIKAT</span>
            </a>
            </li>
            </ul>
            
            </div>
            
            </aside> --}}
        <div id="sidebar-menu">

            <ul id="side-menu">
                {{-- <li class="menu-title">Navigation</li> --}}
                {{-- <li>
                    <a href="/dashboard">
                        <i data-feather="airplay"></i>

                        <span> Dashboard </span>
                    </a>

                </li> --}}
                <div class="card ml-3">
                    <div class="card-body  left-sidebar">
                    <li>
                        <a href="#sidebarApplication" class="text-center" data-bs-toggle="collapse">
                         <p class="text-center">   <i data-feather="file-text" style="color:white"></i></p>
                           <span class="text-white ml-3"> Application </span>
                           
                        </a>
                        <div class="collapse" id="sidebarApplication">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('application.create') }}">
                                        <p class="text-center"><i class="mdi mdi-book-plus-outline"></i></p>
                                        <span class="text-white">Add Application</span>

                                    </a>
                                </li>
                                <li>
                                    {{-- <form action="/search-payment" method="POST">
                                        @csrf
                                         <input type="hidden" name="month" id="month">
                                         <input type="hidden" name="year" id="year">
                                          <a  class="btn " type="submit">  <p class="text-center"><i class="mdi mdi-format-list-text"></i></p> <span class="text-white">Show </span></a>
                                 </form> --}}
                                   
                                    <a href="{{ route('application.index') }}">  <p class="text-center"><i class="mdi mdi-format-list-text"></i></p> <span class="text-white">Show </span></a>
                                </li>

                            </ul>
                        </div>  
                    </li>
                </div>

                </div>
     

            
                {{-- <li class="menu-title mt-2">Apps</li> --}}

                
{{--                 
                    <li>
                        <a href="#sidebarApplication" data-bs-toggle="collapse">
                            <i data-feather="file-text"></i>
                            <span > Application </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarApplication">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('application.create') }}">
                                       

                                        <span>Add Application</span>

                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('application.index') }}"> <span>Show</span></a>
                                </li>

                            </ul>
                        </div>  
                    </li> --}}






            </ul>
        </div>
        </li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->


<style>
  ul.sidebar-menu {
    margin-top: 80px;
    margin-left: 20px;
    background-color: #1a3869;
    text-align: center;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}.sidebar-menu {
    list-style: none;}
    ul.sidebar-menu li.logo {
    text-align: center;
    background-color: #fff;
    padding: 10px;
    height: auto;
}ul li {
    list-style: none;
}
ul.sidebar-menu li.active, ul.sidebar-menu li:hover, ul.sidebar-menu li:focus {
    /* background: #9d1e07; */
    cursor: pointer;}
    ul.nav-second-level {
    padding: 0px;
}
li{
    border-bottom: 1px solid white;
}
p.text-center {
    font-size: 33px;
    padding: 0px;
    line-height: initial;
    color: white;
    margin-bottom: 0px;
}
span.text-white.ml-3 {
    padding: 0px 23px;
    font-size: 16px;
}
.card-body.left-sidebar {
    margin-top: 80px;
    margin-left: 20px;
    background-color: #1a3869;
}
.nav-second-level li a {
    padding:11px 11px !important;
     }.left-side-menu.menuitem-active {
    background-color: #F4F5F7 !important;
    box-shadow: none;
}.card.ml-3.show {
    background-color: #F3F4F6;
}
</style>
