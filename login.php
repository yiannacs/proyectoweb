<?php
    session_start();

    include_once 'dataAccess/dbConnect.php';
    include_once 'dataAccess/UserDAO.php';
    include_once 'controller/SiteUser.php';

    // Go to index if already logged in
    if ((isset($_SESSION['user']))) {
        header("Location: index.php");
    }

    // Assign value without meaning to loginreturn so
    // error message for login isn't displayed
    $loginreturn = -1;

    // Process login
    if (isset($_POST['login'])) {
        $username = $_POST['student-id'];
        $password = $_POST['passwd'];

        $loginreturn = $userDao->authenticateUser($username, $password);
        // Correct password, set session and go to index
        if ($loginreturn != 0) {
            $_SESSION['user'] = new SiteUser($username, $loginreturn);
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <link rel="stylesheet" href="styles/main.css">
        <script src="js/signup-form.js"></script>
        <title>Laboratorio de electrónica</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>

        <div class="container">
            <h5>Login</h5>
            <form class='signup-form' onsubmit="return validateLogin()" action="login.php" method='post'>
                <div class="form-group">
                    <?php if ($loginreturn == 0) : ?>
                        <p>Matricula o contrasena erronea</p>
                    <?php endif; ?>

                    <label for="student-id">Matricula:</label>
                    <input type="text" class="form-control" id="student-id" name="student-id" placeholder="A0XXXXXXX">
                    <div id='empty-id' class='red hidden-element'>Introduce tu matricula</div>
                    <div id='wrong-id' class='red hidden-element'>Introduce tu matricula en el fomato A0XXXXXXX</div>

                    <label for="passwd">Contrasena:</label>
                    <input type="password" class="form-control" id="passwd" name="passwd" placeholder="">
                    <div id='empty-passwd' class='red hidden-element'>Introduce tu contrasena</div>
                </div>

                <button name='login' id='login' type="submit" class="btn btn-primary">Log in</button>
            </form>
        </div>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Bootstrap stuff -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
