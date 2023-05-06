<?php
// Configurazione database
$db_servername = "localhost";
$db_name = "my_ititv";
$db_username = "root";
$db_password = "";

// Inizializza la connessione con il server DB
$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

// Controlla la connessione
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
$result = $conn->query("SELECT `id`, `PostTitle`, `PostDetails` FROM `tblposts` ORDER BY `id` DESC");

if ($result->num_rows > 0) {
    $jsonArray = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($jsonArray as &$row) {
        $row['PostDetails'] = strip_tags($row['PostDetails']);
    }
    $jsonString = json_encode($jsonArray);
    file_put_contents('data.json', $jsonString);
} else {
    echo json_encode(array());
}
$conn->close();
