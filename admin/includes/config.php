<?php
define('DB_SERVER','localhost');
define('DB_USER','ititv');
define('DB_PASS' ,'');
define('DB_NAME','my_ititv');
define('APP_NAME', 'itiTV');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>