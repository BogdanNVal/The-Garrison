<?php
$host = "mysql_db";
$uid = "root";
$pwd = "toor";
$dbname = "test";
$conn = new mysqli($host, $uid, $pwd, $dbname);

if ($conn->connect_error)
    die("DB connection failed ".$conn->connect_error);

// Creeaza automat un admin implicit daca tabelul "admins" e gol
// (o singura data, la prima accesare a site-ului dupa ce tabelele exista).
$check = $conn->query("SELECT COUNT(*) AS total FROM admins");
if ($check && $check->fetch_assoc()['total'] == 0) {
    $default_email = "admin@garrison.com";
    $default_pwd_hash = password_hash("admin123", PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
    $default_name = "Admin";
    $stmt->bind_param("sss", $default_name, $default_email, $default_pwd_hash);
    $stmt->execute();
}