<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
    $uname = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string($_POST['password']);
    $hashedPassword = md5($password);
    $sql = $con->query("SELECT * FROM tbladmin WHERE AdminUserName='$uname' AND AdminPassword='$hashedPassword' LIMIT 1");
    if ($sql->num_rows > 0) {
        $row = $sql->fetch_assoc();
        $_SESSION['login'] = $row['AdminUserName'];
        $_SESSION['utype'] = $row['userType'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Credenziali errate');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Accesso a itiTV">
    <meta name="author" content="Macca Computer">
    <title>Accesso portale admin | itiTV</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/modernizr.min.js"></script>

</head>


<body class="bg-dark">

    <!-- HOME -->
    <section>
        <div class="container-alt">
            <div class="row">
                <div class="col-sm-12">

                    <div class="wrapper-page">

                        <div class="m-t-40 account-pages shadow-lg">
                            <div class="text-center account-logo-box">
                                <h2 class="text-uppercase">
                                    <a href="index.html" class="text-success">
                                        <span>
                                            <img src="../images/loginlogo.png" width="300px">
                                        </span>
                                    </a>
                                </h2>
                            </div>
                            <div class="account-content">
                                <form class="form-horizontal" method="post">

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" required="" name="username" placeholder="Username" autocomplete="off">
                                        </div>
                                    </div>
                                    <a href="forgot-password.php"><i class="mdi mdi-lock"></i>&nbsp;Password dimenticata?</a>
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="password" name="password" required="" placeholder="Password" autocomplete="off">
                                        </div>
                                    </div>



                                    <div class="form-group account-btn text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="login">Accedi</button>
                                        </div>
                                    </div>

                                </form>

                                <div class="clearfix"></div>
                                <a href="../index.php"><i class="mdi mdi-home"></i> Torna all'indice</a>
                            </div>
                        </div>
                        <!-- end card-box-->




                    </div>
                    <!-- end wrapper -->

                </div>
            </div>
        </div>
    </section>
    <!-- END HOME -->

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

    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

    </body>

</html>