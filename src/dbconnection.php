<?php
$host = getenv('DB_HOST') ?: 'mysql_db';
$uid = getenv('DB_USER') ?: 'root';
$pwd = getenv('DB_PASSWORD') ?: 'toor';
$dbname = getenv('DB_NAME') ?: 'test';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $uid, $pwd, $dbname);
} catch (Throwable $e) {
    http_response_code(503);
    die("DB connection failed: " . htmlspecialchars($e->getMessage()));
}

// Seed default admin when the table is empty.
try {
    $check = $conn->query("SELECT COUNT(*) AS total FROM admins");
    if ($check && $check->fetch_assoc()['total'] == 0) {
        $default_email = "admin@garrison.com";
        $default_pwd_hash = password_hash("admin123", PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
        $default_name = "Admin";
        $stmt->bind_param("sss", $default_name, $default_email, $default_pwd_hash);
        $stmt->execute();
    }
} catch (Throwable $e) {
    http_response_code(503);
    die("DB schema error: " . htmlspecialchars($e->getMessage()));
}
