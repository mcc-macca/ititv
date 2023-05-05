<?php
    // Configurazione database
    $db_servername = "localhost";
    $db_name = "ititv";
    $db_username = "ititv";
    $db_password = "ititv";

    // Inizializza la connessione con il server DB
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

    // Controlla la connessione
    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    $result = $conn->query("SELECT * FROM `comunicazioni` ORDER BY `Numero` DESC");
            
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_all());
    }
    else{
        echo json_encode(array());
    }
    $conn->close();

?>