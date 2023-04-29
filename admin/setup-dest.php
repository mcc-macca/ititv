<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $destmail = mysqli_real_escape_string($con, $_POST['destmail']);
        $destname = mysqli_real_escape_string($con, $_POST['destname']);
        $query = mysqli_query($con, "INSERT INTO `tblmaildest`(`email`, `name`) VALUES ('$destmail','$destname')");
        if ($query) {
            echo "<script>alert('Destinatario aggiunto con successo');</script>";
            header("location: setup-dest.php");
        } else {
            echo "<script>alert('Errore, riprova');</script>";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Aggiungi destinatari | itiTV</title>
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
            function checkAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "check_availability.php",
                    data: 'destmail=' + $("#destmail").val(),
                    type: "POST",
                    success: function(data) {
                        $("#user-availability-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>
    </head>

    <body class="fixed-left">
        <div id="wrapper">
            <?php include('includes/topheader.php'); ?>
            <?php include('includes/leftsidebar.php'); ?>
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Aggiungi destinatari</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Server STMP </a>
                                        </li>
                                        <li class="active">
                                            Aggiungi destinatari
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Aggiungi destinatari </b></h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form class="form-horizontal" name="addsuadmin" method="post">
                                                <table>
                                                    <tr>
                                                        <td style="padding-right: 10px;">
                                                            <label for="destname">Nome</label>
                                                            <input type="text" placeholder="Nome" name="destname" id="destname" class="form-control" onBlur="checkAvailability()" required>
                                                        </td>
                                                        <td style="padding-right: 10px;">
                                                            <label for="destmail">Email</label>
                                                            <input type="email" class="form-control" id="destmail" name="destmail" placeholder="Email" required>
                                                            <span id="user-availability-status" style="font-size:14px;"></span>
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" style="height: 100%" id="submit" name="submit">
                                                                Aggiungi
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table m-0 table-colored-bordered table-bordered-primary">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>Nome</th>
                                        <th>Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM tblmaildest");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>

                                        <tr>
                                            <th scope="row"><?php echo htmlentities($row['id']); ?></th>
                                            <td><?php echo htmlentities($row['email']); ?></td>
                                            <td><?php echo htmlentities($row['name']); ?></td>
                                            <td><a href="edit-dest.php?cid=<?php echo htmlentities($row['id']); ?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a>
                                                &nbsp;<a href="manage-categories.php?rid=<?php echo htmlentities($row['id']); ?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
                                        </tr>
                                    <?php
                                        $cnt++;
                                    } ?>
                                </tbody>

                            </table>
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