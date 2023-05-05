<html>
<head>
    <title>Comunicazioni</title>
    <!-- Favicon -->
    <link rel="stylesheet" href="./css/news.css">
    <link rel="shortcut icon" href="./assets/image/FaviconITITV.ico" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./assets/js/jquery.marquee.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#ora").text(new Date().toLocaleTimeString('it-IT', {
                hour: "numeric",
                minute: "numeric"
            }));
            $("#data").text(new Date().toLocaleDateString());
            let actual = new Date();

                let hours = actual.getHours();
                let minutes = actual.getMinutes();

                switch (hours) {
                    case 8:
                        $("#info").html('<span style="color: #52B788;">--APERTO--</span>');
                        break;
                    case 11:
                        if (minutes >= 45)
                            $("#info").html('<span style="color: #52B788;">--APERTO--</span>');
                        else
                            $("#info").html('<span style="color: #CC0605;">--CHIUSO--</span>');
                        break;
                    case 12:
                        $("#info").html('<span style="color: #52B788;">--APERTO--</span>');
                        break;
                    case 13:
                        if (minutes <= 45)
                            $("#info").html('<span style="color: #52B788;">--APERTO--</span>');
                        else
                            $("#info").html('<span style="color: #CC0605;">--CHIUSO--</span>');
                        break;
                    default:
                        $("#info").html('<span style="color: #CC0605;">--CHIUSO--</span>');
                }
            setInterval(() => {
                $("#ora").text(new Date().toLocaleTimeString('it-IT', {
                    hour: "numeric",
                    minute: "numeric"
                }));
                $("#data").text(new Date().toLocaleDateString());
            }, 1000);
            setInterval(() => {
                let actual = new Date();

                let hours = actual.getHours();
                let minutes = actual.getMinutes();

                switch (hours) {
                    case 8:
                        if (minutes >= 10)
                            $("#info").html('<span style="color: #52B788;">--APERTO--</span>');
                        else
                            $("#info").html('<span style="color: #CC0605;">--CHIUSO--</span>');
                        break;
                    case 9:
                        if (minutes <= 10)
                            $("#info").html('<span style="color: #52B788;">--APERTO--</span>');
                        else
                            $("#info").html('<span style="color: #CC0605;">--CHIUSO--</span>');
                        break;
                    case 11:
                        if (minutes >= 45)
                            $("#info").html('<span style="color: #52B788;">--APERTO--</span>');
                        else
                            $("#info").html('<span style="color: #CC0605;">--CHIUSO--</span>');
                        break;
                    case 12:
                        $("#info").html('<span style="color: #52B788;">--APERTO--</span>');
                        break;
                    case 13:
                        if (minutes <= 10)
                            $("#info").html('<span style="color: #52B788;">--APERTO--</span>');
                        else
                            $("#info").html('<span style="color: #CC0605;">--CHIUSO--</span>');
                        break;
                    default:
                        $("#info").html('<span style="color: #CC0605;">--CHIUSO--</span>');
                }
            }, 1000);

            function getCommm(){
                $.get("assets/php/getComunicazioni.php")
                .done(function(risultati) {
                    let dati;

                    try {
                        dati = JSON.parse(risultati);
                    } catch (error) {
                        dati = JSON.parse("[]");
                    }

                    let i = 0;
                    let comunicazioni = dati.filter((comunicazione) => {
                        if (comunicazione[3] != "News") {
                            return comunicazione
                        }
                    });

                    if(comunicazioni.length == 0){
                        $("#n_com").children().text('0');
                        $("#titolo_com").children().text('Nessuna comunicazione');
                        $("#tcom").children().text('Non sono presenti comunicazioni in archivio');

                        $("#n_com2").children().text('0');
                        $("#titolo_com2").children().text('Nessuna comunicazione');
                        $("#tcom2").children().text('Non sono presenti comunicazioni in archivio');

                        return 0;
                    }

                    function communicazioni(){
                        if (comunicazioni[i]) {
                            $("#n_com").children().text(comunicazioni[i][0]);
                            $("#titolo_com").children().text(comunicazioni[i][1]);
                            $("#tcom").children().text(comunicazioni[i][2]);

                            if(!comunicazioni[i + 1]){
                                $("#n_com2").children().text(comunicazioni[0][0]);
                                $("#titolo_com2").children().text(comunicazioni[0][1]);
                                $("#tcom2").children().text(comunicazioni[0][2]);
                            }else{
                                $("#n_com2").children().text(comunicazioni[i + 1][0]);
                                $("#titolo_com2").children().text(comunicazioni[i + 1][1]);
                                $("#tcom2").children().text(comunicazioni[i + 1][2]);
                            }
                            

                            i++;
                            if (i == comunicazioni.length - 1) {
                                i = 0;
                            }
                        }
                    }

                    communicazioni();
                    setInterval(() => {
                        communicazioni();
                    }, 5*60*1000);


                });
            }

            getCommm();
            setInterval(() => {
                getCommm();
            }, 30*60*1000);
            

            function getEventtt(){
                $.get("assets/php/getEventiAggiuntivi.php")
                    .done(function(risultati) {
                        let dati;

                        try {
                            dati = JSON.parse(risultati);
                        } catch (error) {
                            dati = JSON.parse("[]");
                        }
                        

                        let j = 0;

                        let news = dati.filter((comunicazione) => {
                            if (comunicazione[3] == "News") {
                                return comunicazione;
                            }
                        });

                        if(news.length == 0){
                            $("#notizia").children().text("NESSUNA LIVE NEWS DA MOSTRARE!");
                            $("#notizia").marquee({
                                    delayBeforeStart: 10,
                                    allowCss3Support: true,
                                    duplicated: true,
                                    pauseOnCycle: false,
                                    pauseOnHover: false,
                                    startVisible: true,
                                    gap: 1500
                                });
                            return 0;
                        }

                        var lastmarquee = $("#notizia").marquee();
                        function newscgange(){
                            lastmarquee.marquee('destroy');
                            if (news[j]) {
                                $("#notizia").children().text(news[j][2])
                                j++;
                                if (j == news.length) {
                                    j = 0;
                                }
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

                        newscgange();
                        setInterval(() => {
                            newscgange();
                        }, 30*1000);

                    });
            }

            getEventtt();
            setInterval(() => {
                getEventtt();
            }, 5*60*1000);
               
            


            setTimeout(() => {
                window.location.replace("tmpvideo.php");
            }, 1000*60);
        });
    </script>

</head>

<body>

    <!-- HEADER -->
    <header class="header">
        <img src="assets/image/grezzo.png" id="logoITI">
        <hr id="separatoreVerticale">
        <h1 id="titoloPagina">COMUNICAZIONI GIORNALIERE</h1>
        <hr id="separatoreVerticale">
        <img id ="logoITITV" src="assets/image/logoititv.png">
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
        <div id="com1">
            <div id="header_com">
                <span id="n_com"><h1>9999</h1></span>
                <hr id="barra">
                <br>
                <span id="titolo_com"><h1>COMUNICAZIONE 1</h1></span>
                <br>
                <span id="tcom"><p>asiysdbaoWUIYHD FBUOIASHFBCUASEGVBFUIWEGVFB UOEASVBUOufabseuoiafbaew ufbewufbweubasiysdbaoWUIYHD FBUOIASHFBCUASEGVBFUIWEGVFB UOEASVBUOufabseuoiafbaew ufbewufbweubasiysdbaoWUIYHD FBUOIASHFBCUASEGVBFUIWEGVFB UOEASVBUOufabseuoiafbaew ufbewufbweubasiysdbaoWUIYHD FBUOIASHFBCUASEGVBFUIWEGVFB UOEASVBUOufabseuoiafbaew ufbewufbweubasiysdbaoWUIYHD FBUOIASHFBCUASEGVBFUIWEGVFB</p></span>
            </div>
        </div>

        <!-- DIV SECONDA COMUNICAZIONE -->
        <div id="com2">
            <div id="header_com">
                <span id="n_com2"><h1>002</h1></span>
                <hr id="barra">
                <br>
                <span id="titolo_com2"><h1>COMUNICAZIONE 2</h1></span>
                <br>
                <span id="tcom2"><p>asiysdbaoWUIYHDFBUOIA SHFBCUASEGVBFUIWEGVFBUOEASVBUO ufabseuoiafbaewufbewufbweub</p></span>
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
            <h1 id="notizia"><nobr>ABCDEFGHIJKLMNOPQRSTUVWXYZ</nobr></h1>
        </div>
    </footer>

</body>
</html>