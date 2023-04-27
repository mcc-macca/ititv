<?php
require_once("includes/config.php");
// code   username availablity
if (!empty($_POST["username"])) {
	$uname = $_POST["username"];
	$query = mysqli_query($con, "select AdminuserName from tbladmin where AdminuserName='$uname'");
	$row = mysqli_num_rows($query);
	if ($row > 0) {
		echo "<span style='color:red'> Username gia' presente. Prova con un altro</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	} else {
		echo "<span style='color:green'> Username disponibile</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}

if (!empty($_POST["destname"])) {
	$dname = $_POST["destname"];
	$query = mysqli_query($con, "SELECT email FROM tblmaildest WHERE email='$dname';");
	$row = mysqli_num_rows($query);
	if ($row > 0) {
		echo "<span style='color:red'> Email gi&agrave; presente in lista!</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	} else {
		echo "<span style='color:green'> Email destinatario disponibile</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}