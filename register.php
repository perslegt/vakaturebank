<?php include('header.php') ?>

<?php 
	include('functions.php');
	$message = '';

	if (isset($_POST['register'])) {
        $queryCheckEmail = mysqli_query($connection, "SELECT * FROM users WHERE Email = '" . $_POST['email'] . "'");
        $rows = mysqli_num_rows($queryCheckEmail);

		if (!isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['type']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['phonenumber']) || !isset($_POST['city']) || !isset($_POST['zipcode']) || !isset($_POST['address']) || !isset($_POST['addressnumber'])) {
			$message = 'Vul a.u.b. alle velden in.';
		}
		if (isset($_POST['type'])) {
			if ($_POST['type'] == 'solicitant') {
				$type = 1;
			}
			elseif (isset($_POST['companyname'])) {
				$queryCheckCompanyname = mysqli_query($connection, "SELECT Companyname FROM users WHERE Companyname = '" . $_POST['companyname'] . "'");
    			$rows = mysqli_num_rows($queryCheckCompanyname);

    			if ($rows >= 1) {
    				$message = 'Deze bedrijsnaam is al in gebruik!';
    			}
			}
			elseif ($_POST['type'] == 'bedrijf' && strlen($_POST['companyname']) > 1) {
				$type = 2;
				$companyname = $_POST['companyname'];
			}
			else {
				$message = 'Dit is geen geldig bedrijfsnaam!';
			}
		}
		if (strlen($_POST['password']) < 5 || strlen($_POST['password']) > 30) {
            $message = 'Uw wachtwoord moet tussen de 5 en 30 tekens zijn.';
        }
        if (isset($_POST['email'])) {
    		if (!checkEmail($_POST['email'])) {
    			$message = 'Dit is geen geldig email adres.';
			}
			else {
				$queryCheckEmail = mysqli_query($connection, "SELECT Email FROM users WHERE Email = '" . $_POST['email'] . "'");
    			$rows = mysqli_num_rows($queryCheckEmail);

    			if ($rows >= 1) {
    				$message = 'Dit email adress is al in gebruik.';
    			}
			}
		}
		if ($_POST['phonenumber'] >! 0) {
            $message = 'Dit is geen geldig telefoon nummer,';
        }
        else {
            $password = md5($_POST['password']);
            $address = $_POST['address'] . " " . $_POST['addressnumber'];
            $fullname = $_POST['firstname'] . " " . $_POST['lastname'];
            if ($type == 1) {
            	$queryAddUser = mysqli_query($connection, "INSERT INTO users VALUES ('', '" . $_POST['lastname'] . "', '" . $_POST['firstname'] . "', '" . $_POST['email'] . "', '" . $password . "', '" . $_POST['phonenumber'] . "', '" . $_POST['city'] . "', '" . $_POST['zipcode'] . "', '" . $address . "', '" . $type . "', '')");
            }
            else {
            	$queryAddUser = mysqli_query($connection, "INSERT INTO users VALUES ('', '" . $_POST['lastname'] . "', '" . $_POST['firstname'] . "', '" . $_POST['email'] . "', '" . $password . "', '" . $_POST['phonenumber'] . "', '" . $_POST['city'] . "', '" . $_POST['zipcode'] . "', '" . $address . "', '" . $type . "', '" . $companyname . "')");
        	}
            $message = $fullname . ", Bedankt voor uw aanmelding!";
        }
	}
?>

<div id="page-register">
	<script type="text/javascript">
	$(document).ready(function() {
		$('#companyname-area').hide();

		$('#type').change(function() {
			var value = $('#type').val();

			if (value == 'bedrijf') {
				$('#companyname-area').show();
			}
			else {
				$('#companyname-area').hide();
			}
		});
	});
	</script>
	<div class="section_1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="messageBox">
						<?php echo $message; ?>
					</div>
					<form method="post" action="register.php" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="firstname">Voornaam:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="firstname" name="firstname">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="lastname">Achternaam:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="lastname" name="lastname">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="type">Solicitant/Bedrijf:</label>
							<div class="col-sm-8">
								<select class="form-control" id="type" name="type">
									<option value="solicitant">Solicitant</option>
									<option value="bedrijf">Bedrijf</option>
								</select>
							</div>
						</div>
						<div class="form-group" id="companyname-area">
							<label class="control-label col-sm-2" for="companyname">Bedrijfsnaam:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="companyname" name="companyname">
							</div>
						</div>
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
							<label class="control-label col-sm-2" for="phonenumber">Telefoon nummer:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="phonenumber" name="phonenumber">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="city">Woonplaats:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="city" name="city">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="zipcode">Postcode:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="zipcode" name="zipcode">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="address">Adres:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="address" name="address">
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="addressnumber" name="addressnumber">
							</div>
						</div>
						<div class="form-group"> 
					    	<div class="col-sm-offset-4 col-sm-4">
					      		<input type="submit" id="register" name="register" value="Registreren" class="btn btn-default">
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