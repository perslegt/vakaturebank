<?php include('header.php') ?>

<?php
	include('functions.php');
	$message = "";

	$queryGetData = mysqli_query($connection, "SELECT * FROM users WHERE Id = '" . $_GET['id'] . "'");
	$row = mysqli_fetch_assoc($queryGetData);
	$userId = $row['Id'];
	$firstname = $row['Firstname'];
	$lastname = $row['Lastname'];
	$email = $row['Email'];
	$phone = $row['Phone'];
	$city = $row['City'];
	$zipcode = $row['Zipcode'];
	$address = $row['Address'];
	$companyname = $row['Companyname'];

	if ($user_checkId == $userId || $user_checkType == 3) {
		if (isset($_POST['bewerken'])) {
			$email = $_POST['email'];
			$phone = $_POST['phonenumber'];
			$city = $_POST['city'];
			$zipcode = $_POST['zipcode'];
			$address = $_POST['address'];
			if (empty($phone) || empty($city) || empty($zipcode) || empty($address)) {
				$message = 'Vul a.u.b. alle velden in.';
			}
			if ($phone >! 0) {
				$message = 'Dit is geen geldig telefoon nummer,';
			}
			if (!preg_match("/^[0-9]{4}\s?[a-zA-Z]{2}+$/", $zipcode)) {
				$message = "Dit is geen geldige postcode.";
			}
			if (!preg_match("/^[a-zA-Z]+\ +[a-zA-Z0-9]+$/", $address)) {
				$message = "Dit is geen geldig adres.";
			}
			else {
				$queryUpdateVacancie = mysqli_query($connection, "UPDATE users SET Phone = '$phone', City = '$city', Zipcode = '$zipcode', Address = '$address' WHERE Id = '" . $_GET['id'] . "'");
				header("Location: user-profile.php?id=" . $_GET['id'] . "");
			}
		}
	}
	else {
		header("Location: index.php");
	}
	
?>

<div id="page-newvacancie">
	<div class="section_1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php if (isset($message)) {?>
					<div id="messageBox">
						<?php echo $message; ?>
					</div>
					<?php } ?>
					<form method="post" action="#" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="firstname">Voornaam:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="firstname" name="firstname" value=<?php echo '"' . $firstname . '"' ?> disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="lastname">Achternaam:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="lastname" name="lastname" value=<?php echo '"' . $lastname . '"' ?> disabled>
							</div>
						</div>
						<?php if ($user_checkType == 2) { ?>
						<div class="form-group">
							<label class="control-label col-sm-2" for="companyname">Bedrijfsnaam:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="companyname" name="companyname" value=<?php echo '"' . $companyname . '"' ?> disabled>
							</div>
						</div>
						<?php } ?>
						<div class="form-group">
							<label class="control-label col-sm-2" for="email">Email adres:</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="email" name="email" value=<?php echo '"' . $email . '"' ?> disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="phonenumber">Telefoon nummer:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="phonenumber" name="phonenumber" value=<?php echo '"0' . $phone . '"' ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="city">Woonplaats:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="city" name="city" value=<?php echo '"' . $city . '"' ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="zipcode">Postcode:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="zipcode" name="zipcode" value=<?php echo '"' . $zipcode . '"' ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="address">Adres:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="address" name="address" value=<?php echo '"' . $address . '"' ?>>
							</div>
						</div>
						<div class="form-group"> 
					    	<div class="col-sm-offset-4 col-sm-4">
					      		<input type="submit" id="bewerken" name="bewerken" value="Bewerken" class="btn btn-default">
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