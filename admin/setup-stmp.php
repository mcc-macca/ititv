<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    $checkquery = $con->query("SELECT * FROM tblmail");
    $num_row_checkquery = mysqli_num_rows($checkquery);
    $maildata = mysqli_fetch_assoc($checkquery);
    if ($num_row_checkquery > 0) {
        $header = "Dati attuali: (modificare con cautela)";
        $button = "AGGIORNA DATI";
    } else {
        $header = "Aggiungi parametri STMP";
        $button = "Invia";
    }
    if (isset($_POST['submitmail'])) {
        $servername = $con->real_escape_string($_POST['servername']);
        $emailSender = $con->real_escape_string($_POST['emailSender']);
        $passwordSender = $con->real_escape_string($_POST['passwordSender']);
        $port = $con->real_escape_string($_POST['port']);
        $setFromMail = $con->real_escape_string($_POST['setFromMail']);
        $setFromName = $con->real_escape_string($_POST['setFromName']);

        if ($num_row_checkquery > 0) {
            $querymail = $con->query("UPDATE `tblmail` SET `server`='$servername',`emailSender`='$emailSender',`passwordSender`='$passwordSender',`port`='$port',`setFromMail`='$setFromMail',`setFromName`='$setFromName' WHERE 1");
        } else {
            $querymail = $con->query("INSERT INTO `tblmail`(`server`, `emailSender`, `passwordSender`, `port`, `setFromMail`, `setFromName`) VALUES ('$servername','$emailSender','$passwordSender','$port','$setFromMail','$setFromName')");
        }

        if ($querymail) {
            $msg = "Dati aggiornati correttamente ";
        } else {
            $error = "Qualcosa è andato storto... :(( Controlla le connesioni al DB :o";
        }
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Server STMP | itiTV</title>

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
                                    <h4 class="page-title">Setup STMP</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Amministratore</a>
                                        </li>
                                        <li>
                                            <a href="#">Mail </a>
                                        </li>
                                        <li class="active">
                                            Setup STMP
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Dati server STMP</b></h4>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    <strong>Dati aggiunti!</strong> <?php echo htmlentities($msg); ?>
                                                </div>
                                            <?php } ?>
                                            <?php if ($error) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Oddio, un errore!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form class="form-horizontal" name="category" method="post">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Server STMP</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="servername" placeholder="es. stmp.maccacomputer.com" value="<?= $maildata['server'] ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">AUTH Mail</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" value="<?= $maildata['emailSender'] ?>" name="emailSender" placeholder="Mail utenticazione" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">AUTH Password</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" value="<?= $maildata['passwordSender'] ?>" name="passwordSender" placeholder="Password autenticazione" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Porta</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" value="<?= $maildata['port'] ?>" name="port" placeholder="Default: 21" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Valore mail</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" value="<?= $maildata['setFromMail'] ?>" name="setFromMail" placeholder="Uguale a AUTH Mail" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Nome mail</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" value="<?= $maildata['setFromName'] ?>" name="setFromName" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">&nbsp;</label>
                                                    <div class="col-md-9">
                                                        <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submitmail">
                                                            <?= $button ?>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include('includes/footer.php'); ?>
            </div>
        </div>
        <script>
            var resizefunc = [];
        </script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>