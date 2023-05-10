<?php

    function Connect(){
        $db_servername = "localhost";
        $db_name = "my_ititv";
        $db_username = "ititv";
        $db_password = "";

        $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

        // Controlla la connessione
        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        return $conn;
    }
    function Select($mysqli){

        $giorno = date("d");
        $mese = date("m");

        $q = $mysqli->prepare("SELECT * FROM `giornate` WHERE `Giorno`=? AND `Mese`=?");
        $q->bind_param("ss", $giorno, $mese);
        $q->execute();
        $risultati = $q->get_result();

        if($risultati->num_rows > 0){
            return $risultati->fetch_all();
        }
        else{
            return null;
        }
    }

    $mysqli = Connect();
    $eventi = Select($mysqli);
    echo json_encode($eventi);
?>
