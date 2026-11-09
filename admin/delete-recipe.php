<?php

declare(strict_types=1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

require_once '../db.php';
require_once '../functions.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id > 0) {
    delete_recipe($conn, $id);
}

header('Location: manage-recipes.php');
exit;