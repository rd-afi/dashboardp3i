
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/favicon.png') ?>">
    <title>Dashboard</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/lib/chartist/chartist.min.css') ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/lib/owl.carousel.min.css') ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/lib/owl.theme.default.min.css') ?>"/>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/lib/bootstrap/bootstrap.min.css') ?>"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/helper.css') ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>"/>

    <!-- DataTable -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/datatables/DataTables/css/dataTables.bootstrap.min.css') ?>"/> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/lib/data-table/dataTables.bootstrap.min.css') ?>"/> -->
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo site_url('dashboard') ?>">
                        <!-- Logo icon -->
                        <b><img src="<?php echo base_url('assets/images/logo.png') ?>" alt="homepage" class="dark-logo" /></b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span><img src="<?php echo base_url('assets/images/logo-text.png') ?>" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- Messages -->
                        
                        <!-- End Messages -->
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- End Comment -->
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets/images/users/5.jpg') ?>" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="#"><i class="ti-user"></i> Profile</a></li>
                                    <li><a href="#"><i class="ti-wallet"></i> Balance</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                    <li><a href="#"><i class="ti-settings"></i> Setting</a></li>
                                    <li><a href="<?php echo site_url('login/logout') ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a class="" href="<?php echo site_url('dashboard') ?>" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
                        <li class="nav-label">APPS</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-wpforms"></i><span class="hide-menu">Data</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('datamhs') ?>">Data Mahasiswa</a></li>
                                <li><a href="<?php echo site_url('dosen') ?>">Data Dosen</a></li>
                                <li><a href="<?php echo site_url('dosen_tamu') ?>">Data Dosen Tamu</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-wpforms"></i><span class="hide-menu">QS AUR</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('isiqsaurp3i') ?>">Indikator QS AUR</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->