<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'salva') {
            //segreteria
            $oas = $_POST['oas'];
            $mas = $_POST['mas'];
            $ocs = $_POST['ocs'];
            $mcs = $_POST['mcs'];

            //biblioteca
            $oab = $_POST['oab'];
            $mab = $_POST['mab'];
            $ocb = $_POST['ocb'];
            $mcb = $_POST['mcb'];

            //paninaro
            $oap = $_POST['oap'];
            $map = $_POST['map'];
            $ocp = $_POST['ocp'];
            $mcp = $_POST['mcp'];

            // sistemare più avanti
        }
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Gestisci orari | itiTV</title>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="../plugins/morris/morris.css">

        <!-- jvectormap -->
        <link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Gestione orari</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Gestione DATABASE</a>
                                        </li>
                                        <li class="active">
                                            Gestione orari
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->




                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">

                                    <div class="table-responsive">
                                        <form action="manage-orari.php" method="post">
                                            <table class="table table-colored table-centered table-inverse m-0">
                                                <tr>
                                                    <td>
                                                        <h1>Orari Segreteria</h1>
                                                    </td>
                                                    <td>
                                                        <h1>Orari Biblioteca</h1>
                                                    </td>
                                                    <td>
                                                        <h1>Orari Paninaro</h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>Apertura&nbsp;</td>
                                                                <td><input type="text" name="oas" id="oas" style="width: 10%">
                                                                    :
                                                                    <input type="text" name="mas" id="mas" style="width: 10%">
                                                                    <a href="manage-orari.php?action=salva">
                                                                        <button>
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Chiusura&nbsp;</td>
                                                                <td><input type="text" name="ocs" id="ocs" style="width: 10%">
                                                                    :
                                                                    <input type="text" name="mcs" id="mcs" style="width: 10%">
                                                                    <a href="manage-orari.php?action=salva">
                                                                        <button>
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>Apertura&nbsp;</td>
                                                                <td><input type="text" name="oab" id="oab" style="width: 10%">
                                                                    :
                                                                    <input type="text" name="mab" id="mab" style="width: 10%">
                                                                    <a href="manage-orari.php?action=salva">
                                                                        <button>
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Chiusura&nbsp;</td>
                                                                <td><input type="text" name="ocb" id="ocb" style="width: 10%">
                                                                    :
                                                                    <input type="text" name="mcb" id="mcb" style="width: 10%">
                                                                    <a href="manage-orari.php?action=salva">
                                                                        <button>
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>Apertura&nbsp;</td>
                                                                <td><input type="text" name="oap" id="oap" style="width: 10%">
                                                                    :
                                                                    <input type="text" name="map" id="map" style="width: 10%">
                                                                    <a href="manage-orari.php?action=salva">
                                                                        <button>
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Chiusura&nbsp;</td>
                                                                <td><input type="text" name="ocp" id="ocp" style="width: 10%">
                                                                    :
                                                                    <input type="text" name="mcp" id="mcp" style="width: 10%">
                                                                    <a href="manage-orari.php?action=salva">
                                                                        <button>
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include('includes/footer.php'); ?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- CounterUp  -->
        <script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../plugins/counterup/jquery.counterup.min.js"></script>

        <!--Morris Chart-->
        <script src="../plugins/morris/morris.min.js"></script>
        <script src="../plugins/raphael/raphael-min.js"></script>

        <!-- Load page level scripts-->
        <script src="../plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../plugins/jvectormap/gdp-data.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>


        <!-- Dashboard Init js -->
        <script src="assets/pages/jquery.blog-dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>