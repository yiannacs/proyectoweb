<?php
    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = 'root';
    $DB_NAME = 'labelectronica';

    try {
        $DB_CON = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
        $DB_CON->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }

    include_once 'UserDAO.php';
    // echo 'db1';
    $userDao = new UserDAO($DB_CON);
    // echo 'db2';
    // $test = $userDao->authenticateUser('user1', '1234');
    // echo $test;
    // echo 'db3';
?>
