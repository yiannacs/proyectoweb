<?php
    include_once 'dbConnect.php';
    include_once 'UserDAO.php';
    include_once '../controller/SiteUser.php';
    session_start();

    $filter = $_POST['filter'];
    $orders = $userDao->getAllOrders($filter);

    $encodedOrders = json_encode($orders);
    echo $encodedOrders;
 ?>
