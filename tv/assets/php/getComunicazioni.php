<?php
require '../../../includes/config.php';
$result = $con->query("SELECT `id`, `PostTitle`, `PostDetails` FROM `tblposts` ORDER BY `id` DESC");
$jsonArray = $result->fetch_assoc();
foreach ($jsonArray as &$row) {
    $row['PostDetails'] = strip_tags($row['PostDetails']);
}
echo json_encode($jsonArray);
$con->close();
