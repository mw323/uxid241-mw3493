<?php

declare(strict_types=1);

function all_recipes(mysqli $conn): array {
    $sql = 'SELECT recipes.id, recipes.title, recipes.subtitle, recipes.main_image, categories.name AS category
          FROM recipes
          INNER JOIN categories ON recipes.category_id = categories.id
          ORDER BY recipes.title';
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}