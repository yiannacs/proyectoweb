<?php
    include_once 'dbConnect.php';
    include_once 'UserDAO.php';
    include_once '../controller/SiteUser.php';
    session_start();

    $filter = $_POST['filter'];
    $items = $userDao->getAllItems($filter);

    $encodedItems = json_encode($items);
    echo $encodedItems;
 ?>
