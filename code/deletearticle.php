<?php
session_start();
include("config.php");
include("lib/db.php");

if($_GET['token'] == $_SESSION['token']){
	$aid = $_GET['aid'];
	$result = delete_article($dbconn, $aid);
	header("Location: /admin.php");
}
else{
	header("Location: /admin.php");
}
?>
