<?php

    $db_servername = "localhost";
    $db_name = "ititv";
    $db_username = "ititv";
    $db_password = "ititv";

    //` 
    // Inizializza la connessione con il server DB
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

    // Controlla la connessione
    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
    }


    $dataOdierna = new DateTime();
    $oggi = $dataOdierna->format('Y-m-d');

    $query = $conn->prepare("SELECT
                                `informazioni_temporizzate`.`URL_File`,
                                `informazioni_temporizzate`.`Tipo`,
                                `eventi`.`Orario` 
                            FROM `informazioni_temporizzate` 
                            LEFT JOIN `eventi` ON `informazioni_temporizzate`.`ID_Informazione`=`eventi`.`ID_Informazione` 
                            WHERE `Data_inizio` <= ? AND `Data_fine` >= ? 
                            ORDER BY `eventi`.`Orario` ASC");

    $query->bind_param("ss", $oggi, $oggi);
    $query->execute();
    $risultati = $query->get_result();

    if($risultati->num_rows > 0){
        echo json_encode($risultati->fetch_all());
    }
    else{
        echo json_encode(array());
    }

    

?>