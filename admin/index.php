<?php

declare(strict_types=1);
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: ../login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | addSalt</title>
</head>

<body>
    <h1>Login successful!</h1>
    <a href="../logout.php">Log Out</a>
</body>
</html>