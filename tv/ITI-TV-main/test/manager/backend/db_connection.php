<?php

    require('config.php');  // Importa le configurazioni di connessione con il database

    // Inizializza la connessione con il server DB
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

    // Controlla la connessione
    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
    }
?>