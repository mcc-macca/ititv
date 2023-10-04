<?php

    $errore = "";

    require('./backend/config.php');    // Importa il file con le impostazioni di configurazione base dell'applicazione

    session_name("ITITVMANAGER");   // Imposta il nome del cookie di sessione a ITITVMANAGER
    session_start();    // Inizializza la sessione

    // Controlla se esiste già una sessione preesistente
    if(!isset($_COOKIE["ITITVMANAGER"])){
        // Imposta a false la variabile usata per salvare se utente è loggato
        $_SESSION['Logged'] = false;
    }

    // Funzione che esegue il logoqut
    if(isset($_POST["Logout"])){
        session_destroy();  // Distrugge la sessione
    }

    // Funzione per l'esecuzione del login di un utente della segreteria
    if(isset($_POST["Login"])){
        if(!empty($_POST["Username"]) && !empty($_POST["Password"])){
            // Calcolo l'hash della password per il login
            $hashPass = hash('sha256', $_POST["Password"]);

            // Esegue il controllo per il login
            if($_POST["Username"] === $login_username && $hashPass === $login_password){
                $_SESSION['Logged'] = true;
                header("Location: menu.php");
                die();
            }else{
                // Messaggio di errore in caso di login errato
                $errore.= '<script async defer>alertify.errorAlert("Errore Login, Username o password errati");</script>';
            }
        }
        else {
            $errore.= '<script async defer>alertify.errorAlert("Errore Login, TUTTI i campi sono obbligatori!");</script>';
        }
    }

    // Controlla se un utente è già loggato per postarlo nella pagina del menù
    if(isset($_SESSION['Logged'])){
        if($_SESSION['Logged'] == true){
            header("Location: menu.php");   // fa un redirect a alivello di header della risposta
            die();  // Termina l'esecuzione dello script
        }
    }
    

    
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaccia di Gestione</title>
    <!-- Favicon -->
    <link rel="icon" href="./assets/image/FaviconITITV.png" />
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script defer>
        if(!alertify.errorAlert){
            alertify.dialog('errorAlert',function factory(){
                return{
                    build:function(){
                        this.set('movable', false);
                        var errorHeader = '<span class="fa fa-times-circle fa-2x" '
                        +    'style="vertical-align:middle;color:#e10000;">'
                        + '</span><span style="color: red;">Errore Applicazione</span>';
                        this.setHeader(errorHeader);
                    }
                };
            },true,'alert');
        }


    </script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="./assets/stylesheets/body.css">
    <style type="text/css">
    
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

        /* modifiche scritta login */
        #login
        {
            vertical-align: center; /* allocazione testo */
            margin: auto; /* tipo di margine */
            text-align: center;
            font-weight: bold; /* tipo di font */
            font-size: 2.5em; /* dimensione testo */
            border: 6px solid white; /* spessore, tipo e colore testo */
            width: 20em; /* lunghezza testo */
            height: 10em; /* altezza testo */
        }

        /* input dei dati nel login */
        #login input
        {
            margin: auto; /* tipo di margine */
            font-size: 1em; /* dimensione lettere */
            background-color: #168AAD; /* colore sfondo */
            color: #FFFFFF; /* colore testo */
            width: 7em; /* lunghezza testo */
            height: 1em; /* altezza testo */
            border: 3px solid white; /* spessore, tipo e colore bordo */
            padding: 0.1em; /* spazio tra l'esterno della tabella e l'interno della pagina */
            vertical-align: middle; /* allocazione login */
        } 
        
        /* modifiche pulsante login */
        #login button
        {
            background-color: #168AAD;  /* sfondo pulsante */
            color: #FFFFFF; /* colore pulsante login */
            font-size: 1em; /* dimensione testo */
            border: 4px solid white; /* spessore, tipo e colore bordo */
            cursor: pointer;
        }

    </style>
</head>
<body>

    <?php require('./components/header.php') // Importa il titolo?>
        <br>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id="login">
        <p>LOGIN UTENTE AMMINISTRATIVO</p>

        <label for="Username">Username</label>
        <input type="text" name="Username" autocomplete="off">
        <br><br>
        <label for="Password">Password</label>
        <input type="password" name="Password">

        <br><br>

        <button type="submit" name="Login">LOGIN</button>
    </form>

        <br>
        <br>

    <?php require('./components/footer.php'); // Importa il fondo pagina?>

    <?php echo $errore; ?>

</body>
</html>