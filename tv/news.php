<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | itiTV</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="news_header">
            <img src="assets/images/logoiti.png" height="100px">
            <h1>COMUNICAZIONI GIORNALIERE</h1>
            <img src="../admin/assets/images/logo.png" height="100%">
        </div>
        <div class="main_news bg_dark">
            <div class="column">
                <div class="box1"> <!-- DIV PER DATA E ORA -->
                    <h1 id="clock"></h1>
                </div>
                <div class="box2"> <!-- DIV PER ORARI SEGRETERIA -->
                    <h1>ORARI SEGRETERIA:<br>
                        08:10 - 09:10<br>
                        11:45 - 13:10</h1>
                    <h1 id="orario"></h1>
                </div>
            </div>
            <div class="column">
                <div class="box3"> <!-- ULTIMA COMUNICAZIONE -->

                </div>
            </div>
            <div class="column">
                <div class="box4"> <!-- PENULTIMA COMUNICAZIONE -->

                </div>
            </div>
        </div>
        <div class="footer_news">
            <div class="ln">
                <b>LIVE<br>NEWS</b>
            </div>
        </div>
    </div>
    <script src="../lib/function.js"></script>
</body>

</html>