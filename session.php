<?php
    include('config.php');
  
    session_start();
    
    if (isset($_SESSION['login_user'])) {
        // Storing Session
        $user_check = $_SESSION['login_user'];

        // SQL Query To Fetch Complete Information Of User
        $ses_sql = mysqli_query($connection, "SELECT * FROM users WHERE Email = '$user_check'");
        $row = mysqli_fetch_assoc($ses_sql);
        $login_session = $row['Email'];

    }

    //if(isset($login_session)){
    //    session_destroy(); // Closing Session
    //    header('Location: index.php'); // Redirecting To Home Page
    //}

?>