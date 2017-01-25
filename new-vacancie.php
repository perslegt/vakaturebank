<?php include('header.php') ?>

<?php
	$message = "";

	if (isset($_POST['aanmaken'])) {
		if (empty($_POST['function']) || empty($_POST[''])) {
			$message = "Vul a.u.b. alle velden in!";
		}
		if (!strlen($_POST['function']) > 2) {
			$message = "Dit is geen geldige functie!";
		}
		if ($_POST['salary'] >! 0) {
			$message = "Dit is geen geldig salaris!";
		}
		else {
			$queryGetUserId = mysqli_query($connection, "SELECT * FROM users WHERE Email = '$user_check'");
			$row = mysqli_fetch_assoc($queryGetUserId);
			$userId = $row['Id'];
			$function = $_POST['function'];
			$salary = $_POST['salary'];
			$createTime = date('d-m-Y G:i');

			$querySetVacancie = mysqli_query($connection, "INSERT INTO vacancies VALUES ('', '$userId', '$function', '$salary', '$createTime')");
			header("Location: overview.php");
		}
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
					<form method="post" action="new-vacancie.php" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="function">Functie:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="function" name="function">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="salary">Salaris:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="salary" name="salary">
							</div>
						</div>
						<div class="form-group"> 
					    	<div class="col-sm-offset-4 col-sm-4">
					      		<input type="submit" id="aanmaken" name="aanmaken" value="Aanmaken" class="btn btn-default">
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