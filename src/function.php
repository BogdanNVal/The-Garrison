<?php
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function check_remember_me($conn) {
    if (isset($_COOKIE['remember_token'])) {
        $remember_token = $_COOKIE['remember_token'];
        $hashed_remember_token = hash('sha256', $remember_token);

        $sql = "SELECT * FROM users WHERE remember_token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $hashed_remember_token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
        }
    }
}


function is_admin_logged_in() {
    return isset($_SESSION['admin_id']);
}

function admin_check_remember_me($conn) {
    if (isset($_COOKIE['remember_token'])) {
        $remember_token = $_COOKIE['remember_token'];
        $hashed_remember_token = hash('sha256', $remember_token);

        $sql = "SELECT * FROM admins WHERE remember_token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $hashed_remember_token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
        }
    }
}
?>
