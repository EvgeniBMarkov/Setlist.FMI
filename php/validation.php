<?php
session_start();
if(isset($_POST['submit']))
{
    include_once 'DBload.php';

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(empty($username) || empty($password))
    {
        header("Location: ../login.html?login=empty");
        exit;
    }

    else
    {
        $query = mysqli_query($conn, "SELECT FacID, Password FROM users WHERE Username='$username'");
        if(!empty($query))
        {
            $row = mysqli_fetch_assoc($query);
            $dbpassword = $row['Password'];

            if($password == $dbpassword)
            {
                $_SESSION['id'] = $row['FacID'];
                $_SESSION['username'] = $username;
                header("Location: ../index.php");
            }

            else
            {
                header("Location: ../login.html?login=empty");
                exit;
            }

        }
    }
}
else
{
    header("Location: ../login.html");
    exit();
}
?>