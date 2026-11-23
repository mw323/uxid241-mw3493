<?php

declare(strict_types=1);

session_set_cookie_params([
  'httponly' => true,
  'secure' => true,
  'samesite' => 'Lax',
]);

session_start();
$_SESSION = [];
session_destroy();

header('Location: login.php');
exit;