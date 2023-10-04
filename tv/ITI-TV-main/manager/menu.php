<?php
    require('./backend/init_page.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaccia di Gestione</title>
    <!-- Favicon -->
    <link rel="icon" href="./assets/image/FaviconITITV.png" />
    <link rel="stylesheet" href="./assets/stylesheets/body.css">

    <style type = "text/css">

        /* Modifica la selezione del testo */
        ::selection {
            background: white; /* background della selezione */
            color: #102C54; /* colore del testo della selezione */
        }

        /* Modifica la selezione del testo */
        ::-moz-selection {
            background: white; /* background della selezione */
            color: #102C54; /* colore del testo della selezione */
        }

        /*Creazione di un riquadro*/    
        .riquadro
        {
            margin: auto; /*Ridimensionamento margine*/
            text-align: center; /*Centra il testo*/
            border: 6px solid #FFFFFF; /*Dimensione, tipo e colore del bordo*/
            width: 50em; /*Lunghezza del riquadro*/
            height: 21em; /*Altezza del riquadro*/
        }

        /*Ridimensionamento del testo*/
        h2
        {
            font-size: 2.5em; /*Dimensione del testo*/
        }

        /*Modifica il bottone per la gestione delle comunicazioni*/
        #comunicazioni
        {
            margin: auto; /*Ridimensionamento margine*/
            font-size: 1.25em; /*Dimensione del testo*/
            font-weight: bold; /*Font del testo*/
            background-color: #168AAD; /*Colore di sfondo del bottone*/
            color: #FFFFFF; /*Colore del testo*/
            width: 17em; /*Lunghezza del bottone*/
            height: 4em; /*Altezza del bottone*/
            border: 4px solid white; /*Dimensione, tipo e colore del bottone*/
            vertical-align: middle; /*Allineamneto del bottone*/
            cursor: pointer; /*Modifica del cursore*/
        }

        /* modifica id "elementi" */
        #elementi
        {
            margin: auto; /*Ridimensionamento margine*/
            font-size: 1.25em; /*Dimensione del testo*/
            font-weight: bold; /*Font del testo*/
            background-color: #168AAD; /*Colore di sfondo del bottone*/
            color: #FFFFFF; /*Colore del testo*/
            width: 17em; /*Lunghezza del bottone*/
            height: 4em; /*Altezza del bottone*/
            border: 4px solid white; /*Dimensione, tipo e colore del bottone*/
            vertical-align: middle; /*Allineamneto del bottone*/
            cursor: pointer; /*Modifica del cursore*/
        }

    </style>

</head>
<body>
    
    <?php require('./components/header.php')?>
    <br>
    <div class = "riquadro">
        <h2>Salve, come desideri procedere?</h2>
        <button id = "comunicazioni" onclick="window.location.replace('comunicazioni.php')">Gestione Comunicazioni</button>
        <br><br>
        <button id = "elementi" onclick="window.location.replace('elementiaggiuntivi.php')">Gestione Elementi Aggiuntivi</button>
    </div>
    <br><br>

    <?php require('./components/footer.php')?>
    <?php require('./components/logout.php')?>


</body>
</html>