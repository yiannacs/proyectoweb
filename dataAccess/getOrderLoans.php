<?php
    include_once 'dbConnect.php';
    include_once 'UserDAO.php';
    include_once '../controller/SiteUser.php';
    session_start();
    
    $orderId = $_POST['orderId'];
    $orderLoans = $userDao->getOrderLoans($orderId);

    $encodedLoans = json_encode($orderLoans);
    echo $encodedLoans;
 ?>
