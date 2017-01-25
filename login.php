<?php include('header.php') ?>

<?php
	$message = "";

	if(isset($user_check)) {
  		header("Location: index.php");
	}
	elseif (isset($_POST['login'])) {
		if (empty($_POST['email']) || empty($_POST['password'])) {
      		$message = "Uw email of wachtwoord is niet ingevuld.";
    	}
    	else {
    		$email = $_POST['email'];
    		$password = md5($_POST['password']);
    		// Protect for MySQL injection
    		$email = mysqli_real_escape_string($connection, $email);
    		$password = mysqli_real_escape_string($connection, $password);

    		$query = mysqli_query($connection, "SELECT * FROM users WHERE Password = '$password' AND Email = '$email'");
    		$rows = mysqli_num_rows($query);

    		if ($rows == 1) {
    			session_start();
    			$_SESSION['login_user'] = $email;
    			header("Location: index.php");
    		}
    		else {
    			$message = "Email en/of wachtwoord klopt niet";
    		}
    	}
	}
?>

<div id="page-login">
	<div class="section_1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="messageBox">
						<?php echo $message; ?>
					</div>
					<form method="post" action="login.php" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="email">Email adres:</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="email" name="email">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="password">Wachtwoord:</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="password" name="password">
							</div>
						</div>
						<div class="form-group"> 
					    	<div class="col-sm-offset-4 col-sm-4">
					      		<input type="submit" id="login" name="login" value="Inloggen" class="btn btn-default">
					    	</div>
					  	</div>
					</form>
					<div class="col-md-4 col-md-offset-4">
						<a href="forgot-password.php">Bent u uw wachtwoord vergeten? klik hier.</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>