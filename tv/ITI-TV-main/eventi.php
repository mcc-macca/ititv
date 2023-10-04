<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventi</title>
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
        background: #1C7293;
    }

    #logoITI{
        /*margin-left: -10%;*/
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
            height: 73%;
            background-color: #282828;
            text-align: center;
        }

    #data_container {
        position: relative;
        float: left;
        margin-top: 3%;
        margin-left: 2.6%;
        width: 30%;
        height: 88.2%;
    }

    #today {
        position: relative;
        width: 99%;
        height: 30%;
        background: #293133;
        border: 0.2rem solid white;
        text-align: center;
        padding-top: 4%;
    }

    #oggi{
        font-size: 4.5em;
        font-family: 'Roboto', sans-serif;
        color: #DC9D00;
        text-align: center;
        font-weight: bold;
        text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); 
        display: inline;
        vertical-align: 10%;
    }

    #date{
        font-size: 5em;
        font-family: 'Roboto', sans-serif;
        color: #DC9D00;
        text-align: center;
        font-weight: bold;
        text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); 
        display: inline;
    }

    #img_container {
        position: relative;
        width: 99%;
        height: 53.3%;
        margin-top: 10%;
        background: #293133;
        border: 0.2rem solid white;
        text-align: center;
        background-position: center;
        background-repeat: no-repeat;
        background-size: auto;
    }


    #event {
        position: relative;
        float: left;
        margin-top: 6%;
        margin-left: 2.6%;
        width: 60%;
        height: 70%;
        background: #293133;
        border: 0.2rem solid white;
        overflow: hidden;
    }
    
    #header_container {
        position: relative;
        width: 100%;
        height: 15%;
        background: #DC9D00;
        text-align: center;
        border: 0.1rem solid white;
        border-collapse: collapse;
    }
    
    #titolo_container {
        position: relative;
        text-align: center;
        color: white;
        font-size: 2.5em;
        font-weight: bold;
        font-family: 'Roboto';
        margin: auto;
    }
    
    #descrizione{
        position: relative;
        float: left;
        margin-top: 5%;
        max-width: 100%;
        max-height: 80%;
        text-align: center;
        color: white;
        font-size: 2.5em;
        font-weight: bold;
        font-family: 'Roboto';
    }

    /*---------------   FOOTER   ---------------*/
    .footer{
        margin-left: 0;
        width: 100%;
        height: 12%;
        position: relative;
        text-align: center;
        background: #1C7293;
    }

    #clock{
            font-size: 5em;
            font-family: 'Roboto', sans-serif;
            color: white;
            text-align: center;
            font-weight: bold;
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); 
            display: inline;
            vertical-align: 30%;
        }


    </style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script type="text/javascript">
            $(document).ready(function(){
                var time = function(){
                    var [hour, minute, second] = new Date().toLocaleTimeString("it-EU").split(/:| /);
                    var time = hour + ':' + minute;
                    $('#clock').html("<b>"+time+"</b>");
                }
                var date = function(){
                    var [day, month, year]= new Date().toLocaleDateString("it-EU").split("/")
                    var data = day + '/' + month + '/' + year;
                    return data;
                }
                var stampaData = function(){
                    var data = date();
                    $('#date').html("<b>"+data+"</b>");
                }
                var stampaEvento = function(){
                    $.get("./assets/php/eventi_server.php", function(data){
                        let eventi = JSON.parse(data);
                        //console.log(eventi)
                        var [day, month, year]= new Date().toLocaleDateString("it-EU").split("/")
                        for(var i = 0; i < eventi.length; i++){
                            if(eventi[i][1] == day && eventi[i][2] == month){
                                $('#descrizione').html(eventi[i][4]);
                                $("#img_container").css({"background-image": "url("+ eventi[i][5] +")"});
                            }
                        }
                    });
                    
                }

                time();
                setInterval(time, 30*1000);
                stampaData();
                setInterval(stampaData, 60*60*1000);
                stampaEvento();
                setInterval(stampaEvento, 60*60*1000);
            });


            setTimeout(() => {
                window.location.replace("comunicazioni.php");
            }, 1000*0.1);
		</script>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <img src="assets/image/grezzo.png" id="logoITI">
        <hr id="separatoreVerticale">
        <h1 id="titoloPagina">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RICORRENZA DEL GIORNO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
        <hr id="separatoreVerticale">
        <img id ="logoITITV" src="assets/image/logoititv.png">
    </header>

    <!-- Main -->
    <main class="main">
    <div id="data_container">
        <div id="today">
            <p id="oggi">OGGI:</p><br>
            <span id="date"></span>
        </div>

        <div id='img_container'>

        </div>
    </div>
    
    <div id="event">
            <div id="header_container">
                <br>
                <p id="titolo_container">EVENTO CULTURALE GIORNALIERO</p>
                <p id="descrizione">Errore di Lettura DataBase</p>
            </div>
    </div>

    </main>

    <!-- Footer -->
    <footer class="footer">
        <br>
        <p id="clock"></p>
    </footer>
</body>
</html>
