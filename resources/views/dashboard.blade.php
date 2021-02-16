<!--
*
*  INSPINIA - Responsive Admin Theme
*  version 2.8
*
-->

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{$title}}</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" src="img/profile_small.jpg"/>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">{{auth()->user()->name}}</span>
                                <span class="text-muted text-xs block">{{auth()->user()->type}}</span>
                            </a>
                        </div>
                        <div class="logo-element">
                            GCLUB
                        </div>
                    </li>
                    <li class="active">
                        <a href="{{route('page_dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
                    </li>
                    @if(auth()->user()->type == 'admin')
                        <li>
                            <a href="{{route('page_user')}}"><i class="fa fa-diamond"></i> <span class="nav-label">User</span></a>
                        </li>
                    @endif
                    <li>
                        <a href="{{route('page_meeting')}}"><i class="fa fa-bar-chart-o"></i> <span
                                                               class="nav-label">Meeting</span></a>
                    </li>
                    <li>
                        <a href="{{route('logout')}}"><i class="fa fa-key"></i> <span class="nav-label">Logout</span></a>
                    </li>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="{{route('logout')}}">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 card">
                    <div class="card-body">
                        <h1>
                            Panduan penggunaan
                        </h1>
                        <p>
                        Untuk mulai menggunakan platform ini, buat meeting baru di menu meeting di sidebar
                        </p>
                        <ol>
                            <li>
                                Buka Halaman Meeting
                            </li>
                            <li>
                                Isikan Nama Meeting
                            </li>
                            <li>
                                Copy Link Meeting dan Share melalui WA, Email atau SMS
                            </li>
                            <li>
                                Join Meeting dengan mengklik tombol Join
                            </li>
                        </ol>
                        @if(auth()->user()->type == 'admin')
                            <h1>Panduan untuk admin</h1>
                            <p>Admin bertugas untuk mengubah role user dan memverifikasi user. Untuk mengubah role user
                            dapat dilakukan dengan membuka menu user lalu mengganti role user menjadi attendee atau
                            moderator</p>
                            <p>Untuk memverifikasi user yang baru registrasi, dapat dilakukan dengan membuka menu user
                            juga, lalu mengklik tombol verifikasi pada user yang belum di verifikasi</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="footer">
                <div>
                    <strong>Copyright</strong> GCLUB ID &copy; 2020-2021
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>

</body>
</html>
