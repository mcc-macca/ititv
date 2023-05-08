<?php
    require '../../../includes/config.php';
    $result = $con->query("SELECT * FROM `tblnews` ORDER BY `id` DESC");
            
    if ($result->num_rows > 0) {
        header('Content-Type: application/json');
        echo json_encode($result->fetch_all());
    }
    else{
        header('Content-Type: application/json');
        echo json_encode(array());
    }
    $con->close();

?>