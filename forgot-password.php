<?php include('header.php') ?>

<?php
	include('functions.php');

	$message = "";
	$hide = false;
	$changepass = false;

	if(isset($user_check)) {
  		header("Location: index.php");
	}
	elseif (isset($_POST['request'])) {
		if (empty($_POST['email'])) {
      		$message = "Uw email adres is niet ingevuld.";
    	}
    	elseif (!checkEmail($_POST['email'])) {
    		$message = 'Dit is geen geldig email adres.';
		}
		else {
			$queryCheckUser = mysqli_query($connection, "SELECT * FROM users WHERE Email = '" . $_POST['email'] . "'");
			$rows = mysqli_num_rows($queryCheckUser);
			if ($rows == 0) {
				$message = 'Dit is email adres word niet gebruikt.';
			}
			else {
				$queryGetUserId = mysqli_query($connection, "SELECT * FROM users WHERE Email = '" . $_POST['email'] . "'");
				$row = mysqli_fetch_assoc($queryGetUserId);
				$userId = $row['Id'];
				$firstname = $row['Firstname'];
				$queryCheckRequest = mysqli_query($connection, "SELECT * FROM requests WHERE USE_Id = '$userId'");
				$rows2 = mysqli_num_rows($queryCheckRequest);
				if ($rows2 >= 1) {
					$queryDeleteRequest = mysqli_query($connection, "DELETE FROM requests WHERE USE_Id = '$userId'");
				}
				$activationCode = randomCode();
				$createTime = date('d-m-Y G:i');
				$querySetRequest = mysqli_query($connection, "INSERT INTO requests VALUES ('', '$userId', '$activationCode', '$createTime')");

				//send Mail
				$to = $_POST['email'];
				$subject = 'Forgot password';
				$message = 'Beste ' . $firstname . ',<br><br>U heeft een activatie code aangevraagd zodat u een nieuw wachtwoord kunt instellen.<br><br>Uw activatie code: ' . $activationCode . '<br><br>Door deze code in tevoeren op onze site.<br>Kunt u een nieuw wachtwoord kiezen<br><br>Met vriendelijke groet,<br>PowerJobs';
				$headers = 'MIME-Version: 1.0' . '\r\n';
				$headers .= 'Content-type:text/html;charset=UTF-8' . '\r\n';
				$headers .= 'From: <noreply@powerjobs.nl>' . '\r\n';
				mail($to,$subject,$message,$headers);

				$message = 'Uw activatie code is succesvol naar uw mail verzonden.';
			}
		}
	}
	elseif (isset($_POST['activate'])) {
		if (empty($_POST['email']) || empty($_POST['activate'])) {
			$message = 'Vul a.u.b. alle velden in.';
		}
		elseif (!checkEmail($_POST['email'])) {
    		$message = 'Dit is geen geldig email adres.';
		}
		else {
			$queryCheckUser = mysqli_query($connection, "SELECT * FROM users WHERE Email = '" . $_POST['email'] . "'");
			$rows = mysqli_num_rows($queryCheckUser);
			$queryGetUserId = mysqli_query($connection, "SELECT * FROM users WHERE Email = '" . $_POST['email'] . "'");
			$row = mysqli_fetch_assoc($queryGetUserId);
			$userId = $row['Id'];
			if ($rows == 0) {
				$message = 'Dit is email adres word niet gebruikt.';
			}
			else {
				$queryCheckRequest = mysqli_query($connection, "SELECT * FROM requests WHERE USE_Id = '$userId' AND Code = '" . $_POST['activationcode'] . "'");
				$rows2 = mysqli_num_rows($queryCheckRequest);
				if ($rows2 >= 1) {
					header("Location: password-change.php?id=$userId");
				}
				else {
					$message = 'Deze code is helaas niet geldig.';
				}
			}
		}
	}
?>

<div id="page-forgotpassword">
	<div class="section_1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="messageBox">
						<?php echo $message; ?>
					</div>
					<h2>Activatie Code aanvragen</h2>
					<form method="post" action="forgot-password.php" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="email">Email adres:</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="email" name="email">
							</div>
						</div>
						<div class="form-group"> 
					    	<div class="col-sm-offset-4 col-sm-4">
					      		<input type="submit" id="request" name="request" value="Aanvragen" class="btn btn-default">
					    	</div>
					  	</div>
					</form>
					<hr>
					<h2>Activatie Code activeren</h2>
					<form method="post" action="forgot-password.php?id=<?php if (isset($userId)) {echo $userId;} ?>" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="email">Email adres:</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="email" name="email">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="activationcode">Activatie Code:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="activationcode" name="activationcode">
							</div>
						</div>
						<div class="form-group"> 
					    	<div class="col-sm-offset-4 col-sm-4">
					      		<input type="submit" id="activate" name="activate" value="Activeer" class="btn btn-default">
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