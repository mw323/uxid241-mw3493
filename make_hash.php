<?php

declare(strict_types=1);

$plain = 'test123';
$hash = password_hash($plain, PASSWORD_DEFAULT);
echo $hash;