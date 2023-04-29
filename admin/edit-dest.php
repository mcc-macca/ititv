<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['sucatdescription'])) {
        $subcatid = intval($_GET['scid']);
        $categoryid = $_POST['category'];
        $subcatname = $_POST['subcategory'];
        $subcatdescription = $_POST['sucatdescription'];
        $query = mysqli_query($con, "update tblsubcategory set CategoryId='$categoryid',Subcategory='$subcatname',SubCatDescription='$subcatdescription' where SubCategoryId='$subcatid'");
        if ($query) {
            $msg = "Sub-Category created ";
        } else {
            $error = "Something went wrong . Please try again.";
        }
    }


?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Aggiorna sottocategorie | itiTV</title>

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Modifica destinario</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Mail </a>
                                        </li>
                                        <li class="active">
                                            Modifica destinatario
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
                                    <h4 class="m-t-0 header-title"><b>Modifica destinatario</b></h4>
                                    <hr />



                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!---Success Message--->
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    <strong>Tutto ok!</strong> <?php echo htmlentities($msg); ?>
                                                </div>
                                            <?php } ?>

                                            <!---Error Message--->
                                            <?php if ($error) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Oh no!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>


                                        </div>
                                    </div>

                                    <?php
                                    //fetching Category details
                                    $subcatid = intval($_GET['scid']);
                                    $query = mysqli_query($con, "SELECT * FROM tblmaildest WHERE id='$destid'");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($query)) {

                                    ?>



                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="form-horizontal" name="category" method="post">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Categoria</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control" name="category" required>
                                                                <option value="<?php echo htmlentities($row['catid']); ?>"><?php echo htmlentities($row['catname']); ?></option>
                                                                <?php
                                                                // Feching active categories
                                                                $ret = mysqli_query($con, "select id,CategoryName from  tblcategory where Is_Active=1");
                                                                while ($result = mysqli_fetch_array($ret)) {
                                                                ?>
                                                                    <option value="<?php echo htmlentities($result['id']); ?>"><?php echo htmlentities($result['CategoryName']); ?></option>
                                                                <?php } ?>

                                                            </select>
                                                        </div>
                                                    </div>




                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Sottocateogia</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['subcatname']); ?>" name="subcategory" required>
                                                        </div>
                                                    </div>






                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Descrizione sottocategoria</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" rows="5" name="sucatdescription" required><?php echo htmlentities($row['SubCatDescription']); ?></textarea>
                                                        </div>
                                                    </div>

                                                <?php } ?>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">&nbsp;</label>
                                                    <div class="col-md-10">

                                                        <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submitsubcat">
                                                            Modifica
                                                        </button>
                                                    </div>
                                                </div>

                                                </form>
                                            </div>


                                        </div>











                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include('includes/footer.php'); ?>

            </div>




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

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>