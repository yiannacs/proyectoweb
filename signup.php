<?php
    include_once 'controller/SiteUser.php';
    session_start();

    // If there's an active session,
    // take them out of here
    if ((isset($_SESSION['user']))) {
        header("Location: index.php");
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

        <title>Laboratorio de electrónica</title>
        <script src="js/signup-form.js"></script>
    </head>
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>

        <div class="container">
            <h5>Registro</h5>
            <form class='signup-form' onsubmit="return validateSignup()" action="signupResult.php" method='post'>
                <div class="form-group">
                    <label for="student-id">Matricula:</label>
                    <input type="text" class="form-control" id="student-id" name="student-id" placeholder="A0XXXXXXX">
                    <div id='empty-id' class='red hidden-element'>Introduce tu matricula</div>
                    <div id='wrong-id' class='red hidden-element'>Introduce tu matricula en el fomato A0XXXXXXX</div>

                    <label for="passwd">Contrasena:</label>
                    <input type="password" class="form-control" id="passwd" name="passwd" placeholder="">
                    <div id='empty-passwd' class='red hidden-element'>Introduce una contrasena</div>

                    <label for="confirm-passwd">Confirma tu contrasena:</label>
                    <input type="password" class="form-control" id="confirm-passwd" placeholder="">
                    <div id='wrong-confirm-passwd' class='red hidden-element'>Las contrasenas no coinciden</div>
                </div>

                <div class="form-group">
                    <label for="student-name">Nombre completo:</label>
                    <input type="text" class="form-control" id="student-name" name="student-name" placeholder="">
                    <div id='empty-name' class='red hidden-element'>Introduce tu nombre completo</div>

                    <label for="email">E-mail:</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="">
                    <div id='empty-email' class='red hidden-element'>Introduce tu email</div>
                    <div id='wrong-email' class='red hidden-element'>Introduce un email valido</div>

                    <label for="phone">Telefono:</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                    <div id='empty-phone' class='red hidden-element'>Introduce tu telefono</div>
                    <div id='wrong-phone' class='red hidden-element'>Introduce tu telefono a 10 digitos</div>
                </div>

                <button name='add-user' id='add-user' type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Bootstrap stuff -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <!-- Scripts -->
        <script src="js/signup-form.js"></script>
    </body>
</html>
