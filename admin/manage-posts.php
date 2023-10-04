<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

    if ($_GET['action'] = 'del') {
        $postid = intval($_GET['pid']);
        $query = mysqli_query($con, "update tblposts set Is_Active=0 where id='$postid'");
        if ($query) {
            $msg = "Post deleted ";
        } else {
            $error = "Something went wrong . Please try again.";
        }
    }

    if (isset($_GET['dlid'])) {
        $dlid = intval($_GET['dlid'], 10);
        if ($con->query("UPDATE tblnews SET isActive = 0 WHERE id = $dlid")) {
            header("location: manage-posts.php");
        }
    }

    if (isset($_POST['livenewssubmit'])) {
        $id = intval($_POST['idlive'], 10);
        $livenewstext = mysqli_real_escape_string($con, $_POST['newtestolive']);
        if ($con->query("UPDATE tblnews SET newsDetails = '$livenewstext' WHERE id = $id;")) {
            header("location: manage-posts.php");
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
        <title>Gestisci notizie | itiTV</title>

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
                                    <h4 class="page-title">Gestisci post</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Notizie</a>
                                        </li>
                                        <li class="active">
                                            Gestisci notizie
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
                                        <table class="table table-colored table-centered table-inverse m-0">
                                            <thead>
                                                <tr>
                                                    <th>Contenuto</th>
                                                    <th>Azioni</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = mysqli_query($con, "SELECT * FROM tblnews WHERE isActive = 1 ORDER BY id DESC");
                                                $rowcount = mysqli_num_rows($query);
                                                if ($rowcount == 0) {
                                                ?>
                                                    <tr>

                                                        <td colspan="4" align="center">
                                                            <h3 style="color:red">Nessuna notizia live da mostrare</h3>
                                                        </td>
                                                    <tr>
                                                        <?php
                                                    } else {
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            if (isset($_GET['lnid']) && $_GET['lnid'] == $row['id']) {
                                                                print "
                                                                    <form action='manage-posts.php' method='post'>
                                                                        <td>
                                                                            <input type='hidden' name='idlive' value='" . $row['id'] . "'>
                                                                            <input type='text' class='form-control' value='" . htmlentities($row['newsDetails']) . "' name='newtestolive'>
                                                                        </td>
                                                                        <td>
                                                                            <button type='submit' name='livenewssubmit'>
                                                                                <i class='fa fa-check' style='color: #29b6f6;'></i>
                                                                            </button>
                                                                        </td>
                                                                    </form>
                                                                ";
                                                            } else {
                                                        ?>
                                                    <tr>
                                                        <td><b><?php echo htmlentities($row['newsDetails']); ?></b></td>

                                                        <td>
                                                            <a href="manage-posts.php?lnid=<?= htmlentities($row['id']) ?>">
                                                                <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="manage-posts.php?dlid=<?php echo htmlentities($row['id']); ?>" onclick="return confirm('Do you reaaly want to delete ?')">
                                                                <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                            <?php }}
                                                    } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-colored table-centered table-inverse m-0">
                                            <thead>
                                                <tr>

                                                    <th>Titolo</th>
                                                    <th>Categoria</th>
                                                    <th>Sottocategoria</th>
                                                    <th>Azioni</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = mysqli_query($con, "select tblposts.id as postid,tblposts.PostTitle as title,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblsubcategory on tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 ");
                                                $rowcount = mysqli_num_rows($query);
                                                if ($rowcount == 0) {
                                                ?>
                                                    <tr>

                                                        <td colspan="4" align="center">
                                                            <h3 style="color:red">No record found</h3>
                                                        </td>
                                                    <tr>
                                                        <?php
                                                    } else {
                                                        while ($row = mysqli_fetch_array($query)) {
                                                        ?>
                                                    <tr>
                                                        <td><b><?php echo htmlentities($row['title']); ?></b></td>
                                                        <td><?php echo htmlentities($row['category']) ?></td>
                                                        <td><?php echo htmlentities($row['subcategory']) ?></td>

                                                        <td><a href="edit-post.php?pid=<?php echo htmlentities($row['postid']); ?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a>
                                                            &nbsp;<a href="manage-posts.php?pid=<?php echo htmlentities($row['postid']); ?>&&action=del" onclick="return confirm('Do you reaaly want to delete ?')"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
                                                    </tr>
                                            <?php }
                                                    } ?>

                                            </tbody>
                                        </table>
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