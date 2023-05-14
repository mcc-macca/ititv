<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else { 
    if (isset($_POST['submit'])) {
        $posttitle = mysqli_real_escape_string($con, $_POST['posttitle']);
        $catid = mysqli_real_escape_string($con, $_POST['category']);
        $subcatid = mysqli_real_escape_string($con, $_POST['subcategory']);
        $postdetails = mysqli_real_escape_string($con, $_POST['postdescription']);
        $postdetailsalt = mysqli_real_escape_string($con, strip_tags($_POST['postdescription'], '<br>'));
        $postedby = $_SESSION['login'];
        $arr = explode(" ", $posttitle);
        $url = implode("-", $arr);
        if (!isset($_FILES["postimage"])) {
            $imgfile = "";
        } else {
            $imgfile = $_FILES["postimage"]["name"];
        }
        // get the image extension
        $extension = strtolower(substr($imgfile, strlen($imgfile) - 4, strlen($imgfile)));
        // allowed extensions
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Formato invalido. File accettati: .jpg .jpeg .png .gif');</script>";
        } else {
            //rename the image file
            $imgnewfile = md5($imgfile) . $extension;
            // Code for move image into directory
            move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);

            $status = 1;
            $query = mysqli_query($con, "insert into tblposts(PostTitle,CategoryId,SubCategoryId,PostDetails,PostUrl,Is_Active,PostImage,postedBy, PostAltDet) values('$posttitle','$catid','$subcatid','$postdetails','$url','$status','$imgnewfile','$postedby', '$postdetailsalt')");
            if ($query) {
                $msg = "Notizia aggiunta con successo ";
            } else {
                $error = "Qualcosa è andato storto, riprova.";
            }
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Aggiungi post - itiTV">
        <meta name="author" content="Macca Compiter">
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <title>Aggiungi notizia | itiTV</title>
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
        <script>
            function getSubCat(val) {
                $.ajax({
                    type: "POST",
                    url: "get_subcategory.php",
                    data: 'catid=' + val,
                    success: function(data) {
                        $("#subcategory").html(data);
                    }
                });
            }
        </script>
    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>
            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->



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
                                    <h4 class="page-title">Aggiungi notizia </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Notizie</a>
                                        </li>
                                        <li>
                                            <a href="#">Gestisci notizie </a>
                                        </li>
                                        <li class="active">
                                            Aggiungi notizia
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <!---Success Message--->
                                <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Fantastico!!! Tutto ok campione!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <!---Error Message--->
                                <?php if ($error) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                    </div>
                                <?php } ?>


                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post" enctype="multipart/form-data">
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Titolo</label>
                                                <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="Titolo" required>
                                            </div>



                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Categoria</label>
                                                <select class="form-control" name="category" id="category" onChange="getSubCat(this.value);" required>
                                                    <option value="">Seleziona categoria </option>
                                                    <?php
                                                    // Feching active categories
                                                    $ret = mysqli_query($con, "select id,CategoryName from  tblcategory where Is_Active=1");
                                                    while ($result = mysqli_fetch_array($ret)) {
                                                    ?>
                                                        <option value="<?php echo htmlentities($result['id']); ?>"><?php echo htmlentities($result['CategoryName']); ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Sottocategoria</label>
                                                <select class="form-control" name="subcategory" id="subcategory" required>

                                                </select>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Contenuto</b> <i>Nota bene: Nella visualizazzione TV, la formattazione non sarà visibile</i></h4>
                                                        <textarea class="summernote" style="width: 100%; height: 200px" name="postdescription" required></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Immagine (facoltativa) [.jpg .jpeg .png .gif]</b></h4>
                                                        <input type="file" class="form-control" id="postimage" name="postimage"1>
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Salva e pubblica</button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light">Cancella</button>
                                        </form>
                                    </div>
                                </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include('includes/footer.php'); ?>

            </div>


            <!-- ============================================================== -->
            <!-- END ... -->
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

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- page specific js -->
        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            jQuery(document).ready(function() {

                $('.summernote').summernote({
                    height: 240, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: false // set focus to editable area after initializing summernote
                });
                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                    maximumSelectionLength: 2
                });
            });
        </script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>




    </body>

    </html>
<?php } ?>
