<?php include('header.php') ?>

<?php
	$message = "";
	$queryGetData = mysqli_query($connection, "SELECT * FROM vacancies WHERE Id = '" . $_GET['id'] . "'");
	$row = mysqli_fetch_assoc($queryGetData);
	$userId = $row['USE_Id'];
	$function = $row['Functie'];
	$salary = $row['salaris'];

	if ($user_checkId == $userId || $user_checkType == 3) {
		if (isset($_POST['bewerken'])) {
			$function = $_POST['function'];
			$salary = $_POST['salary'];
			if (empty($function) || empty($salary)) {
				$message = "Vul a.u.b. alle velden in.";
			}
			else {
				$queryUpdateVacancie = mysqli_query($connection, "UPDATE vacancies SET Functie = '$function', salaris = '$salary' WHERE Id = '" . $_GET['id'] . "'");
				header("Location: overview.php");
			}
		}
		elseif (isset($_POST['verwijderen'])) {
			$queryDeleteVacancie = mysqli_query($connection, "DELETE FROM vacancies WHERE Id = '" . $_GET['id'] . "'");
			header("Location: overview.php");
		}
	}
	else {
		header("Location: overview.php");
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
							<label class="control-label col-sm-2" for="function">Functie:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="function" name="function" value=<?php echo '"' . $function . '"' ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="salary">Salaris:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="salary" name="salary" value=<?php echo '"' . $salary . '"' ?>>
							</div>
						</div>
						<div class="form-group"> 
					    	<div class="col-sm-offset-2 col-sm-2">
					      		<input type="submit" id="bewerken" name="bewerken" value="Bewerken" class="btn btn-default">
					    	</div>
					    	<div class="col-sm-offset-2 col-sm-2">
					      		<input type="submit" id="verwijderen" name="verwijderen" value="Verwijderen" class="btn btn-default">
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