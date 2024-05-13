<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
session_start();
$search = $_POST['search'];
$studentemail = $_SESSION['studentemail'];

if (isset($_COOKIE['studentemail'])) {
    $studentemail = $_COOKIE['studentemail'];
    echo "The value of myCookie is: " . $studentemail;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    define('DB_HOST', "database6.chqgy0y08gjm.us-east-1.rds.amazonaws.com");
    define('DB_USER', "aws_user");
    define('DB_PASS', "aws_user");
    define('DB_NAME', "assignment1");

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT msgtitle FROM msg WHERE studentemail = ? AND msgtitle LIKE ?");
    $search = '%' . $search . '%';
    $stmt->bind_param("ss", $studentemail, $search);
    $stmt->execute();
    $result = $stmt->get_result();
    header("Location: ass10.php?title=$search");
    exit();
}
