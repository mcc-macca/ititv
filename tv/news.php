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
    <!--<script src="../vendor/jquery/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <h1 id="clockdate"></h1>
                </div>
                <div class="box"> <!-- DIV PER ORARI SEGRETERIA -->
                    <center>
                        <h1>ORARI SEGRETERIA:<br>
                            08:10 - 09:10<br>
                            11:45 - 13:10</h1>
                        <h1 id="orario"></h1>
                    </center>
                </div>
            </div>
            <div class="column">
                <script>
                    $(document).ready(function() {
                        setInterval(function() {
                            $.ajax({
                                url: 'php/recupera_ultima_comunicazione.php',
                                dataType: 'json',
                                success: function(data) {
                                    if (data) {
                                        var id = data.id;
                                        var title = data.PostTitle;
                                        var content = data.PostDetails;
                                        var lastCommunication = $('#last-communication');
                                        lastCommunication.find('table thead #id').text(id);
                                        lastCommunication.find('table thead #title').text(title);
                                        lastCommunication.find('table tbody #lastbody').html(content);
                                    }
                                }
                            });
                        }, 1000); // esegue la chiamata ogni 10 secondi
                    });
                </script>

                <div class="box" id="last-communication">
                    <table>
                        <thead>
                            <tr>
                                <th id="id"></th>
                                <th id="title" class="textcenter"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" id="lastbody" class="textcenter"></td>
                            </tr>
                        </tbody>
                    </table> <!-- ULTIMA COMUNICAZIONE -->
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
            <div class="red">
                <h1>LIVE<br>NEWS</h1>
            </div>
            <div class="ticker marquee">
                <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit voluptatem nemo eaque? Consectetur suscipit nostrum libero provident odit perspiciatis harum nam, repudiandae illum animi, quod ducimus cumque neque voluptatem similique.</h1>
            </div>
        </div>
        <input type="hidden" id="clock">
        <script src="../lib/function.js"></script>
</body>

</html>