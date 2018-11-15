<?php
    include_once 'dbConnect.php';
    include_once 'UserDAO.php';
    // include_once 'SiteUser.php';
    session_start();

    $labEquipment = $userDao->fetchTable("stock");
    // echo
    $jsonLab = json_encode($labEquipment);
    echo $jsonLab;
    // $labEquipmentOptions = "<option value='0' selected>Elige...</option>";
    // foreach ($labEquipment as $key => $value) {
    //     $labEquipmentOptions .= "<option value='" . $value['id'] . "'>" . $value['description'] . "</option>";
    // }
 ?>
