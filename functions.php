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

function category_counts(mysqli $conn): array {
    $sql = 'SELECT categories.name, COUNT(*) AS recipe_count
            FROM recipes
            INNER JOIN categories ON recipes.category_id = categories.id
            GROUP BY categories.name
            ORDER BY recipe_count DESC';

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function recipes_by_category(mysqli $conn, string $category): array {
    $sql = 'SELECT recipes.id, recipes.title, recipes.subtitle, recipes.main_image, categories.name AS category
        FROM recipes
        INNER JOIN categories ON recipes.category_id = categories.id
        WHERE categories.name = ?
        ORDER BY recipes.title';

    $result = mysqli_execute_query($conn, $sql, [$category]);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}