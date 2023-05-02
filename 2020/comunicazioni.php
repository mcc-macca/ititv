<html>
<head>
    <title>Comunicazioni</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/image/FaviconITITV.ico" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');
        body, html {
                margin-top: 0;
                margin-left: 0;
                height: 100%;
                width: 100%;
                overflow: hidden;
                cursor: no-drop;
            }

        body
        {
            background-color: #168AAD;
            text-align: center;
        }

        ::selection{
                    background: none; /* background della selezione */
                    color: none;
                    }

        ::-moz-selection {
                            background: none; /* background della selezione */
                            color: none; /* colore del testo della selezione */
                        }

        .page{
                display: grid;
                grid-template-rows: auto 1fr auto;
                pointer-events: none;
                margin: auto;
            }
        
        /*---------------   HEADER   ---------------*/
        .header {
            position: relative;
            margin-left: 0;
            width: 100%;
            height: 15%;
            background: #102c4c;
        }

        #logoITI{
            height: 10em;
            position: relative;
            display: inline-block;
            vertical-align: 500%;
        }

        #separatoreVerticale{
            position: relative;
            vertical-align: 530%;
            width: 0.5%;
            height: 80%;
            display: inline-block;
            background-color: white;
            border: 0;
            margin-left: 1em;
            margin-right: 1em;
        }

        #titoloPagina{
            display: inline;
            color: #FF7746;
            font-size: 5.5em;
            font-family: "Roboto";
            font-weight: bold;
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            vertical-align: 120%;
        }

        #logoITITV{
            position: relative;
            height: 9em;
            mix-blend-mode: lighten;
            display: inline-block;
            vertical-align: 520%;
        }

    
        
        /*---------------   MAIN   ---------------*/
        .main{
                margin-left: 0;
                position: relative;
                width: 100%;
                height: 70%;
                background-color: #168AAD;
                text-align: center;
            }

        #data_seg_container {
            position: relative;
            float: left;
            margin-top: 3%;
            margin-left: 2.6%;
            width: 30%;
            height: 88.2%;
        }

        #ora{
            font-size: 6em;
            font-family: 'Roboto', sans-serif;
            color: white;
            text-align: center;
            font-weight: bold;
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); 
            display: inline;
            vertical-align: 30%;
        }

        #data{
            font-size: 5.5em;
            font-family: 'Roboto', sans-serif;
            color: #E18476;
            text-align: center;
            font-weight: bold;
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            -webkit-text-stroke-width: 3px;
            -webkit-text-stroke-color: #39434C; 
            display: inline;
            vertical-align: -30%;
        }
        
        #date {
            position: relative;
            width: 99%;
            height: 40%;
            background: #1B5583;
            border: 0.2rem solid white;
            text-align: center;
        }
        
        #info_seg {
            position: relative;
            width: 99%;
            height: 53.3%;
            margin-top: 3%;
            background: #1B5583;
            border: 0.2rem solid white;
            text-align: center;
        }

        #infoSegreteria{
            font-size: 3.5em;
            font-family: 'Roboto', sans-serif;
            color: #E18476;
            text-align: center;
            font-weight: bold;
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            display: inline;
        }

        #orarioUno{
            font-size: 3em;
            font-family: 'Roboto', sans-serif;
            color: white;
            text-align: center;
            font-weight: bold;
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            display: inline;
        }

        #info{
            font-size: 3.5em;
            font-family: 'Roboto', sans-serif;
            text-align: center;
            font-weight: bold;
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            display: inline;
        }

        #com1 {
            position: relative;
            float: left;
            margin-top: 3%;
            margin-left: 2.6%;
            width: 30%;
            height: 85.3%;
            background: #1B5583;
            border: 0.2rem solid white;
            overflow: hidden;
        }
        
        #com2 {
            position: relative;
            float: left;
            margin-top: 3%;
            margin-right: 2.6%;
            margin-left: 1.2%;
            width: 30%;
            height: 85.3%;
            background: #1B5583;
            border: 0.2rem solid white;
            border-collapse: collapse;
            overflow: hidden;
        }
        
        #header_com {
            position: relative;
            width: 100%;
            height: 20%;
            background: #102C54;
            text-align: center;
            border: 0.1rem solid white;
            border-collapse: collapse;
        }
        
        #n_com,
        #n_com2 {
            position: relative;
            float: left;
            width: 23%;
            height: 100%;
            text-align: center;
            color: white;
            font-size: 1.5em;
            font-weight: bold;
            font-family: 'Roboto';
        }
        
        #barra {
            position: relative;
            margin-top: 0;
            width: 0.3%;
            height: 100%;
            display: inline-block;
            float: left;
            background-color: white;
            border: 0;
        }
        
        #titolo_com,
        #titolo_com2 {
            position: relative;
            height: 100%;
            margin: auto;
            text-align: center;
            color: white;
            font-size: 1em;
            font-weight: bold;
            font-family: 'Roboto';
        }
        
        #tcom,
        #tcom2 {
            position: relative;
            float: left;
            margin: auto;
            width: 100%;
            height: 80%;
            max-height: 80%;
            text-align: center;
            color: white;
            font-size: 1.7em;
            font-weight: bold;
            font-family: 'Roboto';
        }
        
        
        /*---------------   FOOTER   ---------------*/
        .footer{
            margin-left: 0;
            width: 100%;
            height: 15%;
            position: relative;
            text-align: center;
            background: #102c4c;
        }

        #live_news {
            position: relative;
            background: #FF6B35;
            float: left;
            width: 12%;
            height: 100%;
        }
        
        #sep_footer {
            position: relative;
            margin-top: 0;
            width: 0.3%;
            height: 100%;
            display: inline-block;
            float: left;
            background-color: white;
            border: 0;
        }
        
        #LN {
            position: relative;
            display: inline;
            color: white;
            font-size: 4em;
            font-family: "Roboto";
            font-weight: bold;
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: black; 
            line-height: 67px;
        }

        #notizia {
            position: relative;
            float: left;
            width: 87.7%;
            color: white;
            display: inline;
            font-size: 5em;
            font-family: "Roboto";
            font-weight: bold;
        }

        .scroll-left {
            height: 300px;
            overflow: hidden;
            position: relative;
        }

        .scroll-left h1 {
            position: absolute;
            width: 100%;
            height: 100%;
            margin-top: 3%;
            line-height: 50px;
            text-align: center;
            /* Starting position */
            -moz-transform:translateX(100%);
            -webkit-transform:translateX(100%);
            transform:translateX(100%);
            /* Apply animation to this element */ 
            /*-moz-animation: scroll-left 25s linear infinite;
            -webkit-animation: scroll-left 25s linear infinite;
            animation: scroll-left 25s linear infinite;*/
        }

        /* Move it (define the animation) */
       /*@-moz-keyframes scroll-left {
        0% { -moz-transform: translateX(113%); }
        100% { -moz-transform: translateX(-133%); }
        }
        @-webkit-keyframes scroll-left {
        0% { -webkit-transform: translateX(113%); }
        100% { -webkit-transform: translateX(-133%); }
        }
        @keyframes scroll-left {
        0% { 
        -moz-transform: translateX(113%); /* Browser bug fix */
        -webkit-transform: translateX(133%); /* Browser bug fix */
        transform: translateX(113%); 
        }
        100% { 
        -moz-transform: translateX(-%); /* Browser bug fix */
        -webkit-transform: translateX(-133%); /* Browser bug fix */
        transform: translateX(-133%); 
        }*/
        }
    
    </style>

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