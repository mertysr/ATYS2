<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ATYS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="">
    <meta name="keywords" content="coco bootstrap template, coco admin, bootstrap,admin template, bootstrap admin,">
    <meta name="author" content="Huban Creative">

    <!-- Base Css Files -->
    <link href="/assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
    <link href="/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/assets/libs/fontello/css/fontello.css" rel="stylesheet" />
    <link href="/assets/libs/animate-css/animate.min.css" rel="stylesheet" />
    <link href="/assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
    <link href="/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" />
    <link href="/assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" />
    <link href="/assets/libs/pace/pace.css" rel="stylesheet" />
    <link href="/assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" />
    <link href="/assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
    <link href="/assets/libs/jquery-icheck/skins/all.css" rel="stylesheet" />
    <!-- Code Highlighter for Demo -->
    <link href="/assets/libs/prettify/github.css" rel="stylesheet" />

    <!-- Extra CSS Libraries Start -->
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- Extra CSS Libraries End -->
    <link href="/assets/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="shortcut icon" href="/assets/img/favicon.ico">
    <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/apple-touch-icon-152x152.png" />
</head>
<body class="fixed-left">
<!-- Modal Start -->
<!-- Modal Task Progress -->
<div class="md-modal md-3d-flip-vertical" id="task-progress">
    <div class="md-content">
        <h3><strong>Task Progress</strong> Information</h3>
        <div>
            <p>CLEANING BUGS</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80&#37; Complete</span>
                </div>
            </div>
            <p>POSTING SOME STUFF</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                    <span class="sr-only">65&#37; Complete</span>
                </div>
            </div>
            <p>BACKUP DATA FROM SERVER</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                    <span class="sr-only">95&#37; Complete</span>
                </div>
            </div>
            <p>RE-DESIGNING WEB APPLICATION</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    <span class="sr-only">100&#37; Complete</span>
                </div>
            </div>
            <p class="text-center">
                <button class="btn btn-danger btn-sm md-close">Close</button>
            </p>
        </div>
    </div>
</div>

<!-- Modal Logout -->
<div class="md-modal md-just-me" id="logout-modal">
    <div class="md-content">
        <h3><strong>Çıkış</strong> Onaylama</h3>
        <div>
            <p class="text-center">Bu sistemden çıkmak istediğinizden emin misiniz?</p>
        <p class="text-center">
            <button class="btn btn-danger md-close">İptal</button>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="btn btn-success md-close">
                Evet
            </a>
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        </p>
    </div>
    </div>
</div>        <!-- Modal End -->
<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">
        <div class="topbar-left">
            <div class="logo">
                <a href="/"><h1 style="color:white;">ATYS</h1></a>
            </div>
            <button class="button-menu-mobile open-left">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-collapse2">
                    <ul class="nav navbar-nav hidden-xs">

                        <li class="language_bar dropdown hidden-xs">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Turkish(TR) <i class="fa fa-caret-down"></i></a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="#">English(EN)</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right top-navbar">


                        <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                        <li class="dropdown topbar-profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="rounded-image topbar-profile-image"><img src="/images/users/user-35.jpg"></span> <strong>{{\Auth::user()->name}}</strong> <i class="fa fa-caret-down"></i></a>
                            <ul class="dropdown-menu">
                                <!--<li><a href="#">My Profile</a></li>
                                <li><a href="#">Change Password</a></li>
                                <li><a href="#">Account Setting</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="icon-help-2"></i> Help</a></li>
                                <li><a href="#"><i class="icon-lock-1"></i> Lock me</a></li>-->
                                <li><a class="md-trigger" data-modal="logout-modal"><i class="icon-logout-1"></i> Çıkış</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->
    <!-- Left Sidebar Start -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <!-- Search form -->
            <form role="search" class="navbar-form">
                <div class="form-group">
                    <input type="text" placeholder="Ara" class="form-control">
                    <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <div class="clearfix"></div>
            <!--- Profile -->
            <div class="profile-info">
                <div class="col-xs-4">
                    <a href="#" class="rounded-image profile-image"><img src="/images/users/user-100.jpg"></a>
                </div>
                <div class="col-xs-8">
                    <div class="profile-text">Hoşgeldin <b>{{\Auth::user()->name}}</b></div>
                    <div class="profile-buttons">


                        <a class="md-trigger" style="cursor: pointer;" data-modal="logout-modal"><i class="fa fa-power-off text-red-1"></i></a>
                    </div>
                </div>
            </div>
            <!--- Divider -->
            <div class="clearfix"></div>
            <hr class="divider" />
            <div class="clearfix"></div>
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                    <li>
                        <a href='/home'>
                            <i class='icon-home-3'></i>
                            <span>Ana Sayfa</span>
                        </a>
                    </li>
                    @if(\Auth::user()->hasRole('Admin'))
                        <li class='has_sub'>
                            <a href='javascript:void(0);'>
                                <i class='icon-feather'></i>
                                    <span style="color:green;">Düzenleme</span>
                                <span class="pull-right">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                            <ul>
                                <li><a href='/home/duzenleme/hastaneler'><span>Hastaneler</span></a></li>
                                <li><a href='/home/duzenleme/istasyonlar'><span>İstasyonlar</span></a></li>
                                <li><a href='/home/duzenleme/ambulanslar'><span>Ambulanslar</span></a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                @if(\Auth::user()->hasRole('Admin'))
                    <hr>
                    <br><center><b style="color:green;">Admin hesabı aktif</b></center>
                @endif
                @if(\Auth::user()->hasRole('Rütbeli'))
                    <hr>
                    <br><center><b style=" color:orange;">Rütbeli hesabı aktif</b></center>
                @endif
                @if(\Auth::user()->hasRole('Ambulans Gorevlisi'))
                    <hr>
                    <br><center><b style=" color:purple;">Ambulans görevlisi hesabı aktif</b></center>
                @endif
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="portlets">
                <div id="recent_tickets" class="widget transparent nomargin">
                    <h2>Recent Tickets</h2>
                    <div class="widget-content">
                        <ul class="list-unstyled">
                            <li>
                                <a href="javascript:;">My wordpress blog is broken <span>I was trying to save my page and...</span></a>
                            </li>
                            <li>
                                <a href="javascript:;">Server down, need help!<span>My server is not responding for the last...</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div><br><br><br>
        </div>
        <div class="left-footer">
            <div class="progress progress-xs">
                <div class="progress-bar bg-green-1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="progress-precentage">80%</span>
                </div>

                <a data-toggle="tooltip" title="See task progress" class="btn btn-default md-trigger" data-modal="task-progress"><i class="fa fa-inbox"></i></a>
            </div>
        </div>
    </div>
    <!-- Left Sidebar End -->		    <!-- Right Sidebar Start -->

    <!-- Right Sidebar End -->
    <!-- Start right content -->
    <div class="content-page">
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class="content">

            @yield('content')

            <!-- Footer Start -->
            <footer>
                ATYS &copy; 2018
                <div class="footer-links pull-right">
                    <a href="#">Hakkında</a>
                    <a href="#">Destek</a>
                    <a href="#">Kullanım Şartları</a>
                    <a href="#">Yasal</a>
                    <a href="#">Yardım</a>
                    <a href="#">İletişim</a>
                </div>
            </footer>
            <!-- Footer End -->
        </div>
        <!-- ============================================================== -->
        <!-- End content here -->
        <!-- ============================================================== -->

    </div>
    <!-- End right content -->

</div>
<!-- End of page -->
<!-- the overlay modal element -->
<div class="md-overlay"></div>
<!-- End of eoverlay modal -->
<script>
    var resizefunc = [];
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/assets/libs/jquery/jquery-1.11.1.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
<script src="/assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script>
<script src="/assets/libs/jquery-detectmobile/detect.js"></script>
<script src="/assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
<script src="/assets/libs/ios7-switch/ios7.switch.js"></script>
<script src="/assets/libs/fastclick/fastclick.js"></script>
<script src="/assets/libs/jquery-blockui/jquery.blockUI.js"></script>
<script src="/assets/libs/bootstrap-bootbox/bootbox.min.js"></script>
<script src="/assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="/assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
<script src="/assets/libs/nifty-modal/js/classie.js"></script>
<script src="/assets/libs/nifty-modal/js/modalEffects.js"></script>
<script src="/assets/libs/sortable/sortable.min.js"></script>
<script src="/assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
<script src="/assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
<script src="/assets/libs/bootstrap-select2/select2.min.js"></script>
<script src="/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/assets/libs/pace/pace.min.js"></script>
<script src="/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/libs/jquery-icheck/icheck.min.js"></script>

<!-- Demo Specific JS Libraries -->
<script src="/assets/libs/prettify/prettify.js"></script>

<script src="/assets/js/init.js"></script>
</body>
</html>