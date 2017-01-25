<?php include('header.php') ?>

<?php
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
	$type = $row['Type'];
?>

<div id="page-overview">
	<div class="section_1">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<table class="table">
						<thead>
							<tr>
								<th colspan="2" style="text-align:center">Algemene informatie</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Voornaam</td>
								<td><?php echo $firstname ?></td>
							</tr>
							<tr>
								<td>Achternaam</td>
								<td><?php echo $lastname ?></td>
							</tr>
							<tr>
								<td>Telefoonnummer</td>
								<td><?php echo '0' . $phone ?></td>
							</tr>
							<tr>
								<td>Email adres</td>
								<td><?php echo $email ?></td>
							</tr>
							<tr>
								<td>Woonplaats</td>
								<td><?php echo $city ?></td>
							</tr>
							<tr>
								<td>Adres</td>
								<td><?php echo $address ?></td>
							</tr>
							<tr>
								<td>Postcode</td>
								<td><?php echo $zipcode ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<?php if ($type == 1) { ?>
				<div class="col-md-6">
					<h3>Solicitaties</h3>
					<table class="table">
						<thead>
							<tr>
								<th colspan="2" style="text-align:center">Algemene informatie</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Voornaam</td>
								<td><?php echo $firstname ?></td>
							</tr>
							<tr>
								<td>Achternaam</td>
								<td><?php echo $lastname ?></td>
							</tr>
							<tr>
								<td>Telefoonnummer</td>
								<td><?php echo '0' . $phone ?></td>
							</tr>
							<tr>
								<td>Email adres</td>
								<td><?php echo $email ?></td>
							</tr>
							<tr>
								<td>Woonplaats</td>
								<td><?php echo $city ?></td>
							</tr>
							<tr>
								<td>Adres</td>
								<td><?php echo $address ?></td>
							</tr>
							<tr>
								<td>Postcode</td>
								<td><?php echo $zipcode ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<?php } ?>
				<div class="col-md-12" style="text-align:center">
					<a href="user-profile-edit.php?id=<?php echo $_GET['id'] ?>" class="btn btn-default">Profiel bewerken</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>