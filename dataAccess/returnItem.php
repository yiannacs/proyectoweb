<?php
    include_once 'dbConnect.php';
    include_once 'UserDAO.php';
    include_once '../controller/SiteUser.php';
    session_start();

    // $labEquipment = $userDa/o->fetchTable("stock");
    // $user = $_SESSION['user']->getId();
    $loanId = $_POST['loanId'];
    $success = $userDao->returnItem($loanId);

    // $encodedOrders = json_encode($orders);
    echo $success;
    // echo
    // echo $jsonLab;
    // $labEquipmentOptions = "<option value='0' selected>Elige...</option>";
    // foreach ($labEquipment as $key => $value) {
    //     $labEquipmentOptions .= "<option value='" . $value['id'] . "'>" . $value['description'] . "</option>";
    // }
 ?>
