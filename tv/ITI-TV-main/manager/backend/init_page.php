<?php

    // Controlla se esiste il COOKIE di sessione con il nome personalizzato
    if(!isset($_COOKIE["ITITVMANAGER"])){
        header("Location: .");
        session_destroy();
        die();
    }

    // Imposta il nome del COOKIE di sessione
    session_name("ITITVMANAGER");
    
    // Avvia la sessione
    session_start();

    // Controlla se l'utente ha eseguito correttamente il login
    if($_SESSION['Logged'] == false){
        // In caso contrario redirige l'utente e ferma l'esecuzione dello script
        header("Location: .");
        die();
    }
?>