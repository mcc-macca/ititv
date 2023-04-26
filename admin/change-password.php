<?php
session_start();
require_once 'includes/config.php';
error_reporting(0);
if (empty($_SESSION['login'])) {
    header('Location: index.php');
    exit();
} else {
    if (isset($_POST['submit'])) {
        $password = trim($_POST['password']);
        $newpassword = trim($_POST['newpassword']);
        $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
        if (preg_match($passwordPattern, $password) || !preg_match($passwordPattern, $newpassword)) {
            $error = "La password deve contenere almeno 8 caratteri, di cui almeno una lettera minuscola, una lettera maiuscola e un numero";
        } else {
            $adminid = mysqli_real_escape_string($con, $_SESSION['login']);
            $options = ['cost' => 12];
            $hashedpass = password_hash($password, PASSWORD_BCRYPT, $options);
            $newhashedpass = password_hash($newpassword, PASSWORD_BCRYPT, $options);
            $currentTime = date('Y-m-d h:i:s A', time());
            // PARAMETRI QUERY PER PREVENIRE SQL INJECTION
            $stmt = mysqli_prepare($con, "SELECT AdminPassword FROM tbladmin where AdminUserName=? OR AdminEmailId=?");
            mysqli_stmt_bind_param($stmt, "ss", $adminid, $adminid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $dbpassword = $row['AdminPassword'];
                if (password_verify($password, $dbpassword)) {
                    $stmt = mysqli_prepare($con, "UPDATE tbladmin SET AdminPassword=?, updationDate=? WHERE AdminUserName=?");
                    mysqli_stmt_bind_param($stmt, "sss", $newhashedpass, $currentTime, $adminid);
                    mysqli_stmt_execute($stmt);
                    $msg = "Password aggiornata con successo";
                } else {
                    $error = "La vecchia password non è corretta";
                }
            } else {
                $error = "Utente non trovato";
            }
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Modifica password | itiTV</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
        <script type="text/javascript">
            function valid() {
                if (document.chngpwd.password.value == "") {
                    alert("PASSWORD ATTUALE: INPUT VUOTO!");
                    document.chngpwd.password.focus();
                    return false;
                } else if (document.chngpwd.newpassword.value == "") {
                    alert("NUOVA PASSWORD: INPUT VUOTO!");
                    document.chngpwd.newpassword.focus();
                    return false;
                } else if (document.chngpwd.confirmpassword.value == "") {
                    alert("CONFERMA PASSWORD: INPUT VUOTO!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                } else if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                    alert("NUOVE PASSWORD: CAMPI NON CORRISPONDENTI");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
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
                                    <h4 class="page-title">Cambia password</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Amministratore</a>
                                        </li>
                                        <li class="active">
                                            Cambia password
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Cambia password </b></h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    <strong>Password cambiata con successo!</strong> <?php echo htmlentities($msg); ?>
                                                </div>
                                            <?php } ?>
                                            <?php if ($error) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Oh no, errore!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <form class="form-horizontal" name="chngpwd" method="post" onSubmit="return valid();">

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Password attuale</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="" name="password" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Nuova password</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="" name="newpassword" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Conferma nuova password</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="" name="confirmpassword" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">&nbsp;</label>
                                                    <div class="col-md-8">
                                                        <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                            Cambia password
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