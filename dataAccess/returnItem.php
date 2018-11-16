<?php
    include_once 'dbConnect.php';
    include_once 'UserDAO.php';
    include_once '../controller/SiteUser.php';
    session_start();
    
    $loanId = $_POST['loanId'];
    $success = $userDao->returnItem($loanId);

    echo $success;
 ?>
