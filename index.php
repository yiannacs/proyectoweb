<?php
    include_once 'controller/SiteUser.php';
    session_start();

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
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
    </head>
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>

        <div class="container">

            <h5>Busqueda de articulos</h5>

            <!-- Filtro -->
            <label for="filter-items">Filtrar:</label>
            <input type="text" class="form-control" id="filter-items" name="filter-items">
            <!-- Tabla -->
            <table class="table" id='avl-items'>
                <thead>
                    <tr>
                        <th scope="col">Articulo</th>
                        <th scope="col"># disponible</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aqui van tr's -->
                </tbody>
            </table>
        </div>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <!-- Bootstrap stuff -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script src='js/avl-items.js' type="text/javascript"></script>

    </body>
</html>
