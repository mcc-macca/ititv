<?php
require '../admin/includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | itiTV</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="../vendor/jquery/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="news_header">
            <img src="assets/images/logoiti.png" height="100%">
            <h1>COMUNICAZIONI GIORNALIERE</h1>
            <img src="../admin/assets/images/logo.png" height="100%">
        </div>
        <div class="main_news bg_dark">
            <div class="column inner">
                <div class="box"> <!-- DIV PER DATA E ORA -->
                    <h1 id="clock"></h1>
                </div>
                <div class="box"> <!-- DIV PER ORARI SEGRETERIA -->
                    <h1>ORARI SEGRETERIA:<br>
                        08:10 - 09:10<br>
                        11:45 - 13:10</h1>
                    <h1 id="orario"></h1>
                </div>
            </div>
            <div class="column">
                <div class="box"> <!-- ULTIMA COMUNICAZIONE -->
                    <?php
                    $query_last = $con->query("SELECT * FROM tblposts ORDER BY id DESC LIMIT 1;");
                    $last_res = $query_last->fetch_assoc();
                    $id_last = $last_res['id'];
                    $title_last = $last_res['PostTitle'];
                    $content_last = $last_res['PostDetails'];
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th><?= $id_last ?></th>
                                <th><?= $title_last ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2"><?= $content_last ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="column">
                <div class="box"> <!-- PENULTIMA COMUNICAZIONE -->
                    <?php
                    $query_pen = $con->query("SELECT * FROM tblposts ORDER BY id DESC LIMIT 1,1;");
                    $pen_res = $query_pen->fetch_assoc();
                    $id_pen = $pen_res['id'];
                    $title_pen = $pen_res['PostTitle'];
                    $content_pen = $pen_res['PostDetails'];
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th><?= $id_pen ?></th>
                                <th><?= $title_pen ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2"><?= $content_pen ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="footer_news">
            <div class="ln">
                <center><b>LIVE<br>NEWS</b></center>
            </div>
        </div>
    </div>
    <script src="../lib/function.js"></script>
</body>

</html>