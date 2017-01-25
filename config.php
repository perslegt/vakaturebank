<?php 
    $mysql_server = "localhost";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "powerjobs";

    $connection = mysqli_connect("$mysql_server","$mysql_user","$mysql_password","$mysql_database") or die ("Connection failed: " . $connection->connect_error);
?>
