<?php
    include_once 'dbConnect.php';
    include_once 'UserDAO.php';
    session_start();

    $labEquipment = $userDao->fetchTable("stock");

    $jsonLab = json_encode($labEquipment);
    echo $jsonLab;
 ?>
