<?php include('header.php'); ?>

<?php
	if($user_checkType == 3) {
		//do nothing
	}
	else {
		header("Location: index.php");
	}
?>

<div id="page-forgotpassword">
	<div class="section_1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Solicitanten</h2>
					<table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Voornaam
                                </th>
                                <th>
                                    Achternaam
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    #
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = mysqli_query($connection, "SELECT * FROM users WHERE Type = '1'");
                                $i = 0;

                                while ($row = mysqli_fetch_array($result)) {
                                    $i++;

                                    echo '<tr>';
                                    echo '<td>' . $i . '</td>';
                                    echo '<td>' . $row['Firstname'] . '</td>';
                                    echo '<td>' . $row['Lastname'] . '</td>';
                                    echo '<td>' . $row['Email'] . '</td>';
                                    echo '<td><a href="user-profile.php?id=' . $row['Id'] . '">Bewerken</a></td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
				</div>
				<div class="col-md-12">
					<h2>Bedrijven</h2>
					<table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Voornaam
                                </th>
                                <th>
                                    Achternaam
                                </th>
                                <th>
                                    Bedrijfsnaam
                                </th>
                                <th>
                                	Email
                                </th>
                                <th>
                                    #
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = mysqli_query($connection, "SELECT * FROM users WHERE Type = '2'");
                                $i = 0;

                                while ($row = mysqli_fetch_array($result)) {
                                    $i++;

                                    echo '<tr>';
                                    echo '<td>' . $i . '</td>';
                                    echo '<td>' . $row['Firstname'] . '</td>';
                                    echo '<td>' . $row['Lastname'] . '</td>';
                                    echo '<td>' . $row['Companyname'] . '</td>';
                                    echo '<td>' . $row['Email'] . '</td>';
                                    echo '<td><a href="user-profile.php?id=' . $row['Id'] . '">Bewerken</a></td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>
</div>