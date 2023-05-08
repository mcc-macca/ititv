<?php
    require '../../../includes/config.php';
    $result = $con->query("SELECT `id`, `PostTitle`, `PostDetails` FROM `tblposts` ORDER BY `id` DESC");
    $jsonArray = array();
    while ($row = $result->fetch_assoc()) {
        $row['PostDetails'] = strip_tags($row['PostDetails'], '<br>');
        $jsonArray[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($jsonArray);
    $con->close();
