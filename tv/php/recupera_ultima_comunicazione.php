<?php
require '../../includes/config.php';
$query_last = $con->query("SELECT `id`, `PostTitle`, `PostDetails` FROM tblposts ORDER BY id DESC LIMIT 1;");
$last_res = $query_last->fetch_assoc();
echo json_encode($last_res);
?>
