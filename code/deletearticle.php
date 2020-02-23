<?php
session_start();
include("config.php");
include("lib/db.php");

$tempn = 16;
$tempc = TRUE;
$tempkey = bin2hex(openssl_random_pseudo_bytes($tempn, $tempc));
$_SESSION['pseudo'] = $tempkey;



if($_GET['token'] == $_SESSION['pseudo']){
$aid = $_GET['aid'];
#echo "aid=".$aid."<br>";
$result = delete_article($dbconn, $aid);
#echo "result=".$result."<br>";
# Check result
header("Location: /admin.php");
}
?>
