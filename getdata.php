<?php
	if(isset($_SESSION['login_user'])) {
		$queryGetUserData = mysqli_query($connection, "SELECT * FROM users WHERE Email = '$user_check'");
		$row = mysqli_fetch_assoc($queryGetUserData);
	  	$user_checkType = $row['Type'];
	  	$user_checkId = $row['Id'];
  	}
?>