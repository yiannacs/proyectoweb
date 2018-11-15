<?php
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
            <a class="navbar-brand" href="index.php">Lab de electronica</a>
            <div class="navbar-nav ml-auto">

            <!-- There's a user logged in -->
            <?php if (isset($_SESSION['user'])) : ?>
                <!-- New order button when user is an admin -->
                <?php if ($_SESSION['user']->getType() == 2) : ?>
                    <a class="btn btn-outline-success mr-1" href="newOrder.php" role="button">Nuevo prestamo</a>
                <?php endif; ?>

                <!-- Dropdown menu for all users -->
                <div class="nav-item dropdown">
                    <!-- Display user id -->
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo ($_SESSION['user'])->getId() ?>
                    </a>

                    <!-- Dropdown options -->
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Perfil</a>

                        <!-- Student-specific options -->
                        <?php if ($_SESSION['user']->getType() == 1) : ?>
                            <a class="dropdown-item" href="myOrders.php">Mis prestamos</a>
                        <!-- Admin-specific options -->
                        <?php elseif ($_SESSION['user']->getType() == 2) : ?>
                            <a class="dropdown-item" href="#">Administrar prestamos</a>
                            <a class="dropdown-item" href="#">Adminsitrar cuentas</a>
                        <?php endif; ?>

                        <!-- Logout -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php?logout">Cerrar sesion</a>
                    </div>
                    <!-- End of dropdown options -->
                </div>

            <!-- There is no user logged in -->
            <?php else: ?>
                <form class="form-inline">
                    <a class="btn btn-outline-success mr-1" href="login.php" role="button">Login</a>
                    <a class="btn btn-outline-success mr-1" href="signup.php" role="button">Register</a>
                </form>
            <?php endif; ?>

            </div>
        </nav>
