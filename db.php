<?php

declare(strict_types=1);

$config = require_once 'config.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect(
        $config['host'],
        $config['username'],
        $config['password'],
        $config['database'],
        (int) $config['port']
    );

    mysqli_set_charset($conn, $config['charset']);

} catch (mysqli_sql_exception $e) {
    exit('Database connection failed.');
}