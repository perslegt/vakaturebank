<?php include('header.php') ?>

<?php
	$userId = $_GET['id'];
	if (isset($_POST['change'])) {
		if (empty($_POST['password']) || empty($_POST['password-repeat'])) {
			$message = 'Vul a.u.b. alle velden in!';
		}
		elseif ($_POST['password'] == $_POST['password-repeat']) {
			if (strlen($_POST['password']) < 5 || strlen($_POST['password']) > 30) {
				$message = 'Uw wachtwoord moet tussen de 5 en 30 tekens zijn.';
			}
			else {
				$password = md5($_POST['password']);
				$userId = $_GET['id'];
				$queryUpdatePassword = mysqli_query($connection, "UPDATE users SET Password = '$password' WHERE Id = '$userId'");
				$queryDeleteRequest = mysqli_query($connection, "DELETE FROM requests WHERE USE_Id = '$userId'");
				header("Location: login.php");
			}
		}
		else {
			$message = 'De wachtwoorden komen niet overeen.';
		}
	}

?>
<div id="page-forgotpassword">
	<div class="section_1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php if(isset($message)) { ?>
					<div id="messageBox">
						<?php echo $message; ?>
					</div>
					<?php } ?>
					<h2>Wachtwoord Instellen</h2>
					<form method="post" action="password-change.php?id=<?php echo $userId ?>" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="password">Nieuw wachtwoord:</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="password" name="password">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="password-repeat">Herhaal wachtwoord:</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="password-repeat" name="password-repeat">
							</div>
						</div>
						<div class="form-group"> 
					    	<div class="col-sm-offset-4 col-sm-4">
					      		<input type="submit" id="change" name="change" value="Wijzig" class="btn btn-default">
					    	</div>
					  	</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>