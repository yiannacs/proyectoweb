<?php
    include_once 'dataAccess/dbConnect.php';
    include_once 'dataAccess/UserDAO.php';
    include_once 'controller/SiteUser.php';
    session_start();

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

        <p>This is the new order page!</p>

        <form action="newOrderResult.php" method='post'>
            <div class="form-group">
                <label for="student-id">Matricula del alumno:</label>
                <input value='a01234567' type="text" class="form-control" id="student-id" name="student-id" placeholder="A0XXXXXXX">
                <!-- aria-describedby="idHelp" -->
                <!-- <small id="idHelp" class="form-text text-muted">Introduce tu matricula en formato A0XXXXXXX</small> -->
                <div id='empty-id' class='hidden-element'>Elige una matricula</div>
                <div id='wrong-id' class='hidden-element'>La matricula no esta registrada</div>
            </div>

            <label class="my-1 mr-2" for="items-list">Dispositivo:</label>
            <select class="custom-select my-1 mr-sm-2" id="items-list">
                <?php echo $labEquipmentOptions; ?>
            </select>
            <a class="btn btn-outline-success mr-1" href="#" role="button" id='add-to-order'>Agregar</a>

            <div id='item-not-seld' class="hidden-element">Elige un dispositivo antes de agregar</div>
            <div id='item-not-available' class="hidden-element">Este dispositivo ya no esta disponible</div>

            <h5>Resumen de la orden</h5>
            <table class="table" id='order-summary'>
                <thead>
                    <tr>
                        <th scope="col">Dispositivo</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Agregar/Quitar</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aqui van tr's -->
                </tbody>
            </table>

            <div id='empty-order' class='hidden-element'>Agrega articulos antes de enviar la orden</div>
            <input type="text" class="form-control hidden-element" id="order-items" name="order-items">

            <button name='new-order' id='new-order' type="submit" class="btn btn-primary">Enviar orden</button>
        </form>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <!-- Bootstrap stuff -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script src='js/neworder-form.js' type="text/javascript"></script>

    </body>
</html>
