<?php
require '../lib/function.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Comunicazioni</title>
    <!-- Favicon -->
    <link rel="stylesheet" href="./css/news.css">
    <link rel="shortcut icon" href="./assets/image/FaviconITITV.ico" />
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="./assets/js/jquery.marquee.min.js"></script>
    <script>
        console.log("ITITV - Versione Frontend 4X, Backend Macca Computer");

        $(document).ready(function() {
            setInterval(() => {
                $("#ora").text(new Date().toLocaleTimeString('it-IT', {
                    hour: "numeric",
                    minute: "numeric"
                }));
                $("#data").text(new Date().toLocaleDateString());
            }, 1000);
            setInterval(() => {
                var currentTime = new Date();
                var currentHour = currentTime.getHours();
                var currentMinute = currentTime.getMinutes();

                var openingHours = ["08:10", "11:45"];
                var closingHours = ["09:10", "13:10"];

                var isOpen = false;

                for (var i = 0; i < openingHours.length; i++) {
                    var openingTime = openingHours[i].split(":");
                    var openingHour = parseInt(openingTime[0]);
                    var openingMinute = parseInt(openingTime[1]);
                    var openingTotalMinutes = openingHour * 60 + openingMinute;

                    var closingTime = closingHours[i].split(":");
                    var closingHour = parseInt(closingTime[0]);
                    var closingMinute = parseInt(closingTime[1]);
                    var closingTotalMinutes = closingHour * 60 + closingMinute;

                    if (closingTotalMinutes < openingTotalMinutes) {
                        closingTotalMinutes += 24 * 60; // aggiunge un giorno in minuti
                    }

                    var currentTotalMinutes = currentHour * 60 + currentMinute;

                    if (
                        currentTotalMinutes >= openingTotalMinutes &&
                        currentTotalMinutes <= closingTotalMinutes
                    ) {
                        isOpen = true;
                        break;
                    }
                }

                if (isOpen) {
                    document.getElementById("info").innerHTML = "--APERTA--";
                    document.getElementById("info").style.color = "lime";
                } else {
                    document.getElementById("info").innerHTML = "--CHIUSA--";
                    document.getElementById("info").style.color = "red";
                }
            }, 1000);

            $(document).ready(function() {
                // dichiarazione dei var
                var idfirst = document.getElementById("n_com");
                var titolofirst = document.getElementById("titolo_com");
                var contenutofirst = document.getElementById("tcom");

                var idsecond = document.getElementById("n_com2");
                var titolosecond = document.getElementById("titolo_com2");
                var contenutosecond = document.getElementById("tcom2");

                var livenews = document.getElementById("notizia");

                $.ajax({
                    type: "GET",
                    url: "xnews.php",
                    dataType: "json",
                    success: function(data) {
                        if (data[0]) {
                            idfirst.textContent = data[0].id || "001";
                            titolofirst.textContent = data[0].PostTitle || "Ultima notizia";
                            contenutofirst.textContent = data[0].PostDetails || "Dettagli ultima notizia";
                        } else {
                            idfirst.textContent = "001";
                            titolofirst.textContent = "Ultima notizia";
                            contenutofirst.textContent = "Dettagli ultima notizia";
                        }

                        if (data[1]) {
                            idsecond.textContent = data[1].id || "002";
                            titolosecond.textContent = data[1].PostTitle || "Penultima notizia";
                            contenutosecond.textContent = data[1].PostDetails || "Dettagli penultima notizia";
                        } else {
                            idsecond.textContent = "002";
                            titolosecond.textContent = "Penultima notizia";
                            contenutosecond.textContent = "Dettagli penultima notizia";
                        }
                    },
                    error: function(error, xhr) {
                        console.log("%cErrore: %c " + error, "color: red", "color: white");
                    }
                });

                var ultimoTesto = "";

                function aggiornaLiveNews() {
                    $.ajax({
                        type: "GET",
                        url: "xlive.php",
                        dataType: "json",
                        success: function(data) {
                            if (data[0]) {
                                var nuovoTesto = data[0].newsDetails || "Nessuna livenews da mostrare";

                                if (nuovoTesto !== ultimoTesto) {
                                    livenews.textContent = nuovoTesto;
                                    $("#notizia").marquee({
                                        delayBeforeStart: 10,
                                        allowCss3Support: true,
                                        duplicated: true,
                                        pauseOnCycle: false,
                                        pauseOnHover: false,
                                        startVisible: true,
                                        gap: 1500
                                    });

                                    ultimoTesto = nuovoTesto;
                                }
                            } else {
                                livenews.textContent = "Nessuna live news da mostrare";
                                $("#notizia").marquee({
                                    delayBeforeStart: 10,
                                    allowCss3Support: true,
                                    duplicated: true,
                                    pauseOnCycle: false,
                                    pauseOnHover: false,
                                    startVisible: true,
                                    gap: 1500
                                });
                            }
                        }
                    });
                }

                // Esegui l'aggiornamento subito all'apertura della pagina
                aggiornaLiveNews();

                // Esegui l'aggiornamento ogni secondo (1000 millisecondi)
                setInterval(aggiornaLiveNews, 1000);



            });

            /*setTimeout(() => {
                window.location.replace("tmpvideo.php");
            }, 1000*60);*/
        });
    </script>

</head>

<body>

    <!-- HEADER -->
    <header class="header">
        <img src="./assets/image/logoiti.png" id="logoITI">
        <hr id="separatoreVerticale">
        <h1 id="titoloPagina">COMUNICAZIONI GIORNALIERE</h1>
        <hr id="separatoreVerticale">
        <img id="logoITITV" src="assets/image/logoititv.png">
    </header>

    <!-- MAIN -->
    <main class="main">

        <!-- DIV DATA/ORA E INFO SEGRETERIA -->
        <div id="data_seg_container">
            <div id="date">
                <br>
                <span id="ora"></span><br>
                <span id="data"></span>
            </div>

            <div id="info_seg">
                <br><br>
                <h4 id="infoSegreteria">ORARI SEGRETERIA</h4>
                <br><br>
                <h4 id="orarioUno">Dalle 08:00 alle 09:00</h4>
                <h4 id="orarioUno">Dalle 11:45 alle 13:45</h4>
                <br><br>
                <h4 id="info"></h4>
            </div>
        </div>

        <!-- DIV PRIMA COMUNICAZIONE -->
        <?php ?>
        <div id="com1">
            <div id="header_com">
                <span id="n_com">
                    <h1>999</h1>
                </span>
                <hr id="barra">
                <br>
                <span id="titolo_com">
                    <h1>Ultima Comunicazione</h1>
                </span>
                <br>
                <span id="tcom">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit non ullam minima hic, iusto quaerat harum voluptates aut laudantium maiores voluptatem exercitationem voluptatibus ipsa veniam enim. Explicabo laborum eum et!</p>
                </span>
            </div>
        </div>

        <!-- DIV SECONDA COMUNICAZIONE -->
        <div id="com2">
            <div id="header_com">
                <span id="n_com2">
                    <h1>002</h1>
                </span>
                <hr id="barra">
                <br>
                <span id="titolo_com2">
                    <h1>PenUltima Comunicazione</h1>
                </span>
                <br>
                <span id="tcom2">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit non ullam minima hic, iusto quaerat harum voluptates aut laudantium maiores voluptatem exercitationem voluptatibus ipsa veniam enim. Explicabo laborum eum et!</p>
                </span>
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div id="live_news">
            <br>
            <h1 id="LN">LIVE NEWS</h1>
        </div>
        <hr id="sep_footer">
        <div class="scroll-left">
            <h1 id="notizia">
                <nobr>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit non ullam minima hic, iusto quaerat harum voluptates aut laudantium maiores voluptatem exercitationem voluptatibus ipsa veniam enim. Explicabo laborum eum et!</nobr>
            </h1>
        </div>
    </footer>

</body>

</html>