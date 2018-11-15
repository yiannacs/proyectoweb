<?php
    include_once 'dbConnect.php';
    include_once 'UserDAO.php';
    include_once '../controller/SiteUser.php';
    session_start();

    // $labEquipment = $userDa/o->fetchTable("stock");
    // $user = $_SESSION['user']->getId();
    $orderId = $_POST['orderId'];
    $orderLoans = $userDao->getOrderLoans($orderId);

    $encodedLoans = json_encode($orderLoans);
    echo $encodedLoans;
    // echo
    // echo $jsonLab;
    // $labEquipmentOptions = "<option value='0' selected>Elige...</option>";
    // foreach ($labEquipment as $key => $value) {
    //     $labEquipmentOptions .= "<option value='" . $value['id'] . "'>" . $value['description'] . "</option>";
    // }
 ?>
