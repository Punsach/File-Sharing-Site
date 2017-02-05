<?php
    //Redirects user to login page if they logout
    if(isset($_POST['logoutButton']))
    {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
?>