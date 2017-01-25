<?php
	include('session.php');
	include('getdata.php');
?>

<!DOCTYPE html>
<html>
	<head>
	  <title>PowerJobs - Login</title>
      <link rel="stylesheet" href="./css/style.css" />
      <link rel="stylesheet" href="./css/bootstrap.min.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="./js/bootstrap.min.js"></script>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">PowerJobs</a>
					</div>
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home</a></li>
						<li><a href="overview.php">Overzicht</a></li>
						<?php if(isset($user_check)){if ($user_checkType == 3) { ?>
						<li><a href="userlist.php">Leden Overzicht</a></li>
						<?php } }?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php if(isset($user_check)) { ?>
							<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Uitloggen</a></li>
							<li><a href="user-profile.php?id=<?php echo $user_checkId ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $user_check ?></a></li>
						<?php } else { ?>
							<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Inloggen</a></li>
							<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Registreren</a></li>
						<?php } ?>
					</ul>
				</div>
			</nav>
		</header>