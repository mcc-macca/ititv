<?php
    require '../../../includes/config.php';
    $result = $con->query("SELECT `id`,`Posttitle`,`PostAltDet` FROM `tblposts` ORDER BY `id` DESC");
            
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_all());
    }
    else{
        echo json_encode(array());
    }
    $con->close();