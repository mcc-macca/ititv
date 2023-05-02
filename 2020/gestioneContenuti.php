<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestione Contenuti</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/image/FaviconITITV.ico" />
    <style type="text/css">
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
        height: 12%;
        background: #168AAD;
    }

    /*#logoITI{
        height: 10em;
        position: relative;
        display: inline-block;
        vertical-align: 500%;
    }*/

    /*#separatoreVerticale{
        position: relative;
        vertical-align: 530%;
        width: 0.5%;
        height: 80%;
        display: inline-block;
        background-color: white;
        border: 0;
        margin-left: 1em;
        margin-right: 1em;
    }*/

    #titoloPagina{
        display: inline;
        color: #FF7746;
        font-size: 5.5em;
        font-family: "Roboto";
        font-weight: bold;
        text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        margin: auto;
    }

   
    
    /*---------------   MAIN   ---------------*/
    .main{
            margin-left: 0;
            position: relative;
            width: 100%;
            height: 76%;
            background-color: #168AAD;
            text-align: center;
        }

    /*---------------   FOOTER   ---------------*/
    .footer{
        margin-left: 0;
        width: 100%;
        height: 12%;
        position: relative;
        text-align: center;
        background: #168AAD;
    }

    #thirdcontainer{
            /*position: relative;*/
            font-size: 4em;
            font-family: 'Roboto', sans-serif;
            color: white;
            text-align: center;
            font-weight: bold;
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            vertical-align: 120%;
            display: block;
        }

    #photo{
            margin: auto;
            height: 100%;
            text-align: center;
        }

    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function(){

            oraEdata();

            setInterval(() => {
                oraEdata();
            }, 10000);

            $(".video").hide();
            $(".immagine").hide();

            function oraEdata() {
                let data = new Date();

                let Hours = data.getHours();
                let Minutes = data.getMinutes();

                $('#thirdcontainer').text(((Hours < 10 ? '0' : '') + Hours) + ':' + ((Minutes < 10 ? '0' : '') + Minutes));
            }

            var eventi = jQuery.get("assets/php/ricevieventi.php");
            eventi.done(function(result){
                let dati = JSON.parse(result);

                console.log(dati);
                dati.forEach((evento) => {

                    function getMimeType(filename){
                        return filename.substring(filename.lastIndexOf('.')+1, filename.length) || filename;
                    }

                    function convertDate(d) {
                        function pad(s) { return (s < 10) ? '0' + s : s; }
                        return [d.getFullYear(), pad(d.getMonth()+1), pad(d.getDate())].join('-')
                    }

                    let ora = evento[2];
                    let oggi = new Date();
                    let dateEvento = new Date(convertDate(oggi)+'T'+ora+":00.000+02:00");
                    if((dateEvento - oggi) > 0){
                        setTimeout(() => {
                            console.log(evento)
                            if(getMimeType(evento[0]) == 'mp4' || getMimeType(evento[0]) == 'mov'){
                                $(".video").show();
                                $(".video").prop('src',evento[0]);
                                $('video').on('ended',() => {
                                    // TODO: SISTEMARE IL LINK
                                    // window.location = 'Pagina comunicazioni'
                                });
                                
                            }else{
                                $(".immagine").show();
                                $(".immagine").prop('src',evento[0]);
                                setTimeout(() => {
                                    // TODO: SISTEMARE IL LINK
                                    // window.location = 'Pagina comunicazioni'
                                }, 5*60*1000);
                            }
                            console.log("è ora dell'evento....spero che parta altrimenti mi sparo")
                        }, dateEvento - new Date());
                    }
                });
                           
            });

        });


    </script>

</head>

<body>

    <header class="header">
            <!-- <hr id="separatoreVerticale"> -->
            <br>
            <h1 id="titoloPagina">CONTENUTO MULTIMEDIALE</h1>
            <!-- <hr id="separatoreVerticale"> -->  
    </header>

    <main class="main">
        <div id="photo">
        <!--<iframe src="./assets/upload/IntroCovid1.mp4" type="video/mp4" allow="autoplay"></iframe>-->
            <video id="photo" class="video" src="" autoplay muted></video>
            <img id="photo" class="immagine" src="">
        </div>
    </main>

    <footer class="footer">
        <br>
        <div id="thirdcontainer"></div>
    </footer>
    





</body>
</html>