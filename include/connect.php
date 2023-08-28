<?php
    // $host = 'localhost';
    // $db = 'car_selection';
    // $user = 'root';
    // $pass = '';
    // $charset = 'utf8mb4';

    // $dsn = "mysql:host=$host;dbname=$db;charset=$charset;";
    // $options = [
    //     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    //     PDO::ATTR_EMULATE_PREPARES   => false,
    // ];
    // try {
    //     $pdo = new PDO($dsn, $user, $pass, $options);
    // } catch (\PDOException $e) {
    //     throw \PDOException($e->getMessage(), $e->getCode());
    // }

    $host = 'localhost';
    $db_name = 'car_selection';
    $username = 'root';
    $password = '';

    $conn = mysqli_connect($host, $username, $password, $db_name);

    if(!$conn){
        die("Connection Failed " . mysqli_connect_error());
    }

    // session_start();
    date_default_timezone_set('Asia/Jakarta');
?>