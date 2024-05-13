<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
session_start();
$label = $_POST['label']; // returns an array of selected msgids
$studentemail = $_SESSION['studentemail'];
$msgid = $_POST['msgid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    define('DB_HOST', "database6.chqgy0y08gjm.us-east-1.rds.amazonaws.com");
    define('DB_USER', "aws_user");
    define('DB_PASS', "aws_user");
    define('DB_NAME', "assignment1");

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("UPDATE msg SET label = ? WHERE msgid = ?");
    $stmt->bind_param("ss", $label, $msgid);
    $stmt->execute();
    $result = $stmt->get_result();
    header("Location: ass4.php");
    exit();
}
