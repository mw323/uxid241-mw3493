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

function search_recipes(mysqli $conn, string $search): array {
    $sql = 'SELECT recipes.id, recipes.title, recipes.subtitle, recipes.main_image, categories.name AS category
        FROM recipes
        INNER JOIN categories ON recipes.category_id = categories.id
        WHERE recipes.title LIKE ? OR recipes.subtitle LIKE ?
        ORDER BY recipes.title';

    $like = '%' . $search . '%';

    $result = mysqli_execute_query($conn, $sql, [$like, $like]);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}