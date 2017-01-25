<?php include('header.php') ?>

<?php
	if(!isset($user_check)) {
		header("Location: index.php");
	}
?>

<div id="page-overview">
	<div class="section_1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Bedrijf</th>
								<th>Functie</th>
								<th>Salaris p/m</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$queryGetVacancies = mysqli_query($connection, "SELECT * FROM vacancies");
                                $i = 0;

                                while ($row = mysqli_fetch_array($queryGetVacancies)) {
                                	$queryGetCompanyname = mysqli_query($connection, "SELECT Companyname FROM users WHERE Id = '" . $row['USE_Id'] . "'");
                                	$row2 = mysqli_fetch_assoc($queryGetCompanyname);
                                	$companyname = $row2['Companyname'];
                                	$queryGetApply = mysqli_query($connection, "SELECT * FROM apply WHERE VAC_Id = '" . $row['Id'] . "' AND USE_ApplyId = '$user_checkId'");
                                	$row4 = mysqli_fetch_assoc($queryGetApply);
                                	if (isset($_SESSION['login_user'])) {
	                                	$queryGetUseId = mysqli_query($connection, "SELECT Id FROM users WHERE Email = '" . $_SESSION['login_user'] . "'");
	                                	$row3 = mysqli_fetch_assoc($queryGetUseId);
	                                	$userId = $row3['Id'];
	                                }
                                	$i++;

                                    echo '<tr>';
                                    echo '<td>' . $i . '</td>';
                                    echo '<td>' . $companyname . '</td>';
                                    echo '<td>' . $row['Functie'] . '</td>';
                                    echo '<td>&#8364;' . $row['salaris'] . '</td>';
                                    if (isset($_SESSION['login_user'])) {
                                    	if ($user_checkType == 1) {
                                    		if ($row4 >= 1) {
                                    			echo '<td><a class="disabled" disabled>Al gesoliciteerd</a></td>';
                                    		}
                                    		else {
	                                    		echo '<td><a href="apply.php?id=' . $row['Id'] . '">Soliciteren</a></td>';
	                                    	}
                                    	}
                                    	elseif ($user_checkType == 2) {
                                    		if ($row['USE_Id'] == $userId) {
		                                    	echo '<td><a href=vacancie-edit.php?id=' . $row['Id'] . '>Bewerk</a></td>';
		                                    }
		                                    else {
		                                    	echo '<td></td>';
		                                	}
                                    	}
	                                    elseif ($user_checkType == 3) {
	                                    	echo '<td><a href=vacancie-edit.php?id=' . $row['Id'] . '>Bewerk</a></td>';
	                                    }
                                	}
                                	else {
                                		echo '<td></td>';
                                	}
                                    echo '</tr>';
                                }
							?>
						</tbody>
					</table>
				</div>
				<?php if (isset($_SESSION['login_user'])) { ?>
				<div class="col-md-4 col-md-offset-4">
					<?php if ($user_checkType == 2) { ?>
					<a href="new-vacancie.php">Maak een nieuwe vacature aan.</a>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>