<?php include("templates/page_header.php");?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//$_GET['username'] = $_POST['username'];
	//$_GET['otpVerify'] = $_POST['otp'];
	//$_GET['id'] = $_POST['id'];
	//echo $_POST['otp'];
	//echo $_SESSION['otp'];
	if(isset($_POST['otp'])){
		if($_SESSION['otp'] == $_POST['otp']){
			$_SESSION['authenticated'] = TRUE;
			$_SESSION['id'] = $_POST['id'];
			$_SESSION['username'] = $_POST['username'];
			unset($_SESSION['otp']); 
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
