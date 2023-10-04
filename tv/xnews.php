<?php

require '../includes/config.php';

header("Content-type: application/json; charset=utf-8");

$getcommquery = "SELECT id, PostTitle, PostDetails, PostAltDet FROM tblposts ORDER BY id DESC LIMIT 2";

$result = $con->query($getcommquery);

if ($result->num_rows > 0) {
    $rows = array();

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    $json_data = json_encode($rows);

    echo $json_data;
} else {
    echo json_encode(array("messaggio" => "Errore. Tabella vuota"));
}