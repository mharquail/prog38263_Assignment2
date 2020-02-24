<?php
session_start();
include("config.php");
include("lib/db.php");

$query = "SELECT articles.author FROM articles WHERE aid='" .$_GET['aid']."'";
$result = run_query($dbconn, $query);
$row = pg_fetch_array($result, 0);

if($_SESSION['id'] != $row['author']){
	header("Location: /admin.php");
}

if(!empty($_SESSION['token'])){
	if($_GET['token'] == $_SESSION['token']){
		$aid = $_GET['aid'];
		$result = delete_article($dbconn, $aid);
		header("Location: /admin.php");
	}
	else{
		header("Location: /admin.php");
	}
}
else{
	header("Location: /admin.php");
}
?>
