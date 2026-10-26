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

/* recipe detail page */
function recipe_by_id(mysqli $conn, int $id): array {
    $sql = 'SELECT recipes.id, recipes.title, recipes.subtitle, recipes.description, 
            recipes.main_image, recipes.ingredients_image, categories.name AS category
            FROM recipes
            INNER JOIN categories ON recipes.category_id = categories.id
            WHERE recipes.id = ?';

    $result = mysqli_execute_query($conn, $sql, [$id]);
    return mysqli_fetch_assoc($result);
}

function ingredients_by_recipe(mysqli $conn, int $recipe_id): array {
    $sql = 'SELECT ingredient
            FROM ingredients
            WHERE recipe_id = ?
            ORDER BY sort_order';

    $result = mysqli_execute_query($conn, $sql, [$recipe_id]);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function steps_by_recipe(mysqli $conn, int $recipe_id): array {
    $sql = 'SELECT step_number, title, description, step_image
            FROM steps
            WHERE recipe_id = ?
            ORDER BY step_number';

    $result = mysqli_execute_query($conn, $sql, [$recipe_id]);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}