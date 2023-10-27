<?php
// identify the page link
$page = explode('/', $_SERVER['PHP_SELF']);
$page = end($page);

//database connection
require_once '../db_config.php';

// Start the session
session_start();

// Check if the user is already logged in, then redirect to the sign-in page
if (!isset($_SESSION['userlogin1'])) {
    header('location:pages_sign-in.php');
}
?>
<!doctype html>
<html lang="en" class="fixed left-sidebar-top">


<!-- Mirrored from myiideveloper.com/helsinki/last-version/helsinki_green-dark/src/forms_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Mar 2019 13:05:56 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>PMS</title>
   
    <!--load progress bar-->
    <script src="../vendor/pace/pace.min.js"></script>
    <link href="../vendor/pace/pace-theme-minimal.css" rel="../stylesheet" />
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../stylesheets/css/style.css">
    <!--dataTable-->
    <link rel="stylesheet" href="../vendor/data-table/media/css/dataTables.bootstrap.min.css">
</head>

<body>
    <div class="wrap">
        <!-- page HEADER -->
        <!-- ========================================================= -->
        <div class="page-header">
            <!-- LEFTSIDE header -->
            <div class="leftside-header">
                <div class="logo">
                    <a href="index.html" class="on-click">
                        <h3>PMS</h3>
                    </a>
                </div>
                <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open"
                    data-target="html">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>
            <!-- RIGHTSIDE header -->
            <div class="rightside-header">
                <div class="header-middle"></div>

                <!--USER HEADERBOX -->
                <div class="header-section" id="user-headerbox">
                    <div class="user-header-wrap">
                        <div class="user-photo">
                            <img alt="profile photo" src="../images/avatar/user.jpg" />
                        </div>
                        <div class="user-info">
                            <span class="user-name">Ramjan</span>
                            <span class="user-profile">Admin</span>
                        </div>
                        <i class="fa fa-plus icon-open" aria-hidden="true"></i>
                        <i class="fa fa-minus icon-close" aria-hidden="true"></i>
                    </div>
                    <div class="user-options dropdown-box">
                        <div class="drop-content basic">
                            <ul>
                                <li> <a href="log_out.php"><i class="fa fa-user" aria-hidden="true"></i>
                                        Profile</a></li>
                                <li> <a href="pages_lock-screen.html"><i class="fa fa-lock" aria-hidden="true"></i> Lock
                                        Screen</a></li>
                                <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i> Configurations</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header-separator"></div>
                <!--Log out -->
                <div class="header-section">
                    <a href="pages_sign-in.php" data-toggle="tooltip" data-placement="left" title="Logout"><i
                            class="fa fa-sign-out log-out" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="page-body">
            <!-- LEFT SIDEBAR -->
            <!-- ========================================================= -->
            <div class="left-sidebar">
                <!-- left sidebar HEADER -->
                <div class="left-sidebar-header">
                    <div class="left-sidebar-title">Navigation</div>
                    <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs"
                        data-toggle-class="left-sidebar-collapsed" data-target="html">
                        <span></span>
                    </div>
                </div>
                <!-- NAVIGATION -->
                <!-- ========================================================= -->
                <div id="left-nav" class="nano">
                    <div class="nano-content">
                        <nav>
                            <ul class="nav nav-left-lines" id="main-nav">
                                <!-- HOME -->
                                <li class="<?= $page == 'index.php' ? 'active-item' : '' ?>"><a href="index.php"><i
                                            class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>
                                <!-- USER LIST -->
                                <li class="<?= $page == 'userlist.php' ? 'active-item' : '' ?>"><a
                                        href="userlist.php"><i class="fa fa-users" aria-hidden="true"></i><span>User
                                            List</span></a></li>
                                <li
                                    class="has-child-item <?= ($page == 'manage_knitting_order.php' || $page == 'knitting_order_add.php') ? 'open-item active-item' : 'close-item' ?>">
                                    <a><i class="fa fa-table" aria-hidden="true"></i><span>Knitting Order</span></a>
                                    <ul class="nav child-nav level-1" style="">
                                        <li class="<?= $page == 'knitting_order_add.php' ? 'active-item' : '' ?>"><a
                                                href="knitting_order_add.php">Add Knitting Order</a></li>
                                        <li class="<?= $page == 'manage_knitting_order.php' ? 'active-item' : '' ?>"><a
                                                href="manage_knitting_order.php">Manage Knitting Order</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>


            </div>
        </div>