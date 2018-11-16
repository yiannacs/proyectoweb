<?php
    include_once 'dbConnect.php';
    include_once 'UserDAO.php';
    include_once '../controller/SiteUser.php';
    session_start();
    
    $user = $_SESSION['user']->getId();
    $filter = $_POST['filter'];
    $userOrders = $userDao->getUserOrders($user, $filter);

    $encodedOrders = json_encode($userOrders);
    echo $encodedOrders;
 ?>
