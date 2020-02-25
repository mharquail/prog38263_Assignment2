<?php include("templates/page_header.php");?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['otp'])){
		if($_SESSION['otp'] == $_POST['otp']){
			$_SESSION['authenticated'] = True;
			unset($_SESSION['otp']);

			$fp = fopen("log/access.log", 'ab+');
			fwrite($fp, $_SERVER['REMOTE_ADDR'] . ' - User ID#: ' . $_SESSION['id'] . ' - SUCCESS Login Permitted at: ' . gmdate("Y-m-d H:i:s") . " UTC\n");
			fclose($fp);

			header("Location: /admin.php");
		}
	}
	
}
?>
<!doctype html>
<html lang="en">
<head>
	<title>Verify</title>
	<?php include("templates/header.php"); ?>
<style>

.form-verify {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}

.form-verify .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}

.form-verify .form-control:focus {
  z-index: 2;
}

.form-verify input[type="text"] {
  margin-bottom: 10px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
</style>
</head>

<body>
	<?php include("templates/nav.php"); ?>
	<?php include("templates/contentstart.php"); ?>

<form class="form-verify" action='#' method='POST'>
      <h1 class="h3 mb-3 font-weight-normal">Verification Token</h1>
      <label for="inputOTP" class="sr-only">Token</label>
      <input type="text" id="inputOTP" class="form-control" placeholder="Token" required autofocus name='otp'>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Verify</button>
    </form>
<br>
	<?php include("templates/contentstop.php"); ?>
	<?php include("templates/footer.php"); ?>
</body>
</html>
