<?php
require '../../../includes/config.php';
$result = $con->query("SELECT `id`, `PostTitle`, `PostDetails` FROM `tblpostgs` ORDER BY `id` DESC");

if ($result->num_rows > 0) {
    $jsonArray = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($jsonArray as &$row) {
        $row['PostDetails'] = strip_tags($row['PostDetails']);
    }
    echo json_encode($jsonArray);
} else {
    echo json_encode(array());
}
$con->close();