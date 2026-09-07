<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Garrison</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
    <a class="navbar-brand" href="index.php">The Garrison</a>
    <div class="navbar-nav ms-auto">
      <?php if (!empty($_SESSION['admin_id'])): ?>
        <a class="nav-link" href="secure.php">Admin</a>
        <a class="nav-link" href="search.php">Reservations</a>
        <a class="nav-link" href="logout.php">Logout</a>
      <?php elseif (!empty($_SESSION['user_id'])): ?>
        <a class="nav-link" href="rezervare.php">Reserve</a>
        <a class="nav-link" href="logout.php">Logout</a>
      <?php else: ?>
        <a class="nav-link" href="login.php">Login</a>
        <a class="nav-link" href="signup.php">Sign up</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
