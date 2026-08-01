<?php
session_start();
include 'dbconnection.php';


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];


    $sql = "UPDATE users SET remember_token = '' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}


if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];


    $sql = "UPDATE admins SET remember_token = '' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
}

session_destroy();
setcookie("remember_token", "", time() - 3600, "/");

header("Location: login.php");
exit();
?>