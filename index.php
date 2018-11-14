<?php
    include_once 'controller/SiteUser.php';
    session_start();

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
        header("Location: index.php");
    }
    // if (isset($_POST['login'])) {
    //     $username = $_POST['student-id'];
    //     $password = $_POST['passwd'];
    //     // echo $username . " " . $password;
    //
    //     $loginreturn = $userDao->authenticateUser($username, $password);
    //
    //     // variable used to display wrong password message
    //     // $wrongpasswd = 0;
    //     if ($loginreturn != 0) { //correct password
    //         $_SESSION['user'] = new SiteUser($username, $loginreturn);
    //         header("Location: index.php");
    //         // unset($wrongpasswd);
    //     } // else { // wrong password
    //     //
    //     //     // $wrongpasswd = 1;
    //     // }
    // }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/main.css">

        <title>Laboratorio de electrónica</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>

        <p>This is the index page!</p>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Bootstrap stuff -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
