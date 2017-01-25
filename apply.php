<?php
	include("header.php");
	$queryGetUserData = mysqli_query($connection, "SELECT * FROM users WHERE Id = '$user_checkId'");
	$row = mysqli_fetch_assoc($queryGetUserData);
	$userId = $row['Id'];
	$firstname = $row['Firstname'];
	$lastname = $row['Lastname'];
	$email = $row['Email'];
	$phone = $row['Phone'];
	$city = $row['City'];
	$zipcode = $row['Zipcode'];
	$address = $row['Address'];
	$companyname = $row['Companyname'];

	$queryGetVacancieData = mysqli_query($connection, "SELECT * FROM vacancies WHERE Id = '" . $_GET['id'] . "'");
	$row = mysqli_fetch_assoc($queryGetVacancieData);
	$vacancieId = $row['Id'];
	$vacancieUserId = $row['USE_Id'];
	$vacancieFunction = $row['Functie'];
	$vacancieSalary = $row['salaris'];

	$createTime = date('d-m-Y G:i');

	if (!isset($_SESSION['login_user'])) {
		header("Location: overview.php");
	}
	else {
		$querySetApply = mysqli_query($connection, "INSERT INTO apply VALUES ('', '$vacancieId', '$vacancieUserId', '$userId', '$createTime')");
		header("Location: overview.php");
	}
?>