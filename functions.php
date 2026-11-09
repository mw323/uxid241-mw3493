<?php

declare(strict_types=1);

function get_post(string $key): string {
  return trim($_POST[$key] ?? '');
}

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
            recipes.main_image, recipes.ingredients_image, recipes.category_id, categories.name AS category
            FROM recipes
            INNER JOIN categories ON recipes.category_id = categories.id
            WHERE recipes.id = ?';

    $result = mysqli_execute_query($conn, $sql, [$id]);
    return mysqli_fetch_assoc($result);
}

function ingredients_by_recipe(mysqli $conn, int $recipe_id): array {
    $sql = 'SELECT ingredient, sort_order
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

/* Create recipe functions */
function create_recipe(mysqli $conn, string $title, string $subtitle, string $description, string $main_image, string $ingredients_image, int $category_id): int {
    $sql = 'INSERT INTO recipes (title, subtitle, description, main_image, ingredients_image, category_id) VALUES (?, ?, ?, ?, ?, ?)';
    mysqli_execute_query($conn, $sql, [$title, $subtitle, $description, $main_image, $ingredients_image, $category_id]);
    return (int) mysqli_insert_id($conn);
}

function add_ingredients(mysqli $conn, int $recipe_id, array $ingredients): void {
    $sort_order = 1;
    foreach ($ingredients as $ingredient) {
        $sql = 'INSERT INTO ingredients (recipe_id, ingredient, sort_order) VALUES (?, ?, ?)';
        mysqli_execute_query($conn, $sql, [$recipe_id, $ingredient, $sort_order]);
        $sort_order++;
    }
}

function add_steps(mysqli $conn, int $recipe_id, array $step_titles, array $step_descriptions, array $step_images): void {
    for ($i = 0; $i < count($step_titles); $i++) {
        $step_number = $i + 1;
        $sql = 'INSERT INTO steps (recipe_id, step_number, title, description, step_image) VALUES (?, ?, ?, ?, ?)';
        mysqli_execute_query($conn, $sql, [$recipe_id, $step_number, $step_titles[$i], $step_descriptions[$i], $step_images[$i]]);
    }
}

/* Delete recipe function */
function delete_recipe(mysqli $conn, int $id): void {
    mysqli_execute_query($conn, 'DELETE FROM recipes WHERE id = ?', [$id]);
}

/* Update recipe function */
function update_recipe(mysqli $conn, int $id, string $title, string $subtitle, string $description, string $main_image, string $ingredients_image, int $category_id): void {
    $sql = 'UPDATE recipes SET title = ?, subtitle = ?, description = ?, main_image = ?, ingredients_image = ?, category_id = ? WHERE id = ?';
    mysqli_execute_query($conn, $sql, [$title, $subtitle, $description, $main_image, $ingredients_image, $category_id, $id]);
}

/* Update ingredients */
function update_ingredient(mysqli $conn, int $recipe_id, int $sort_order, string $ingredient): void {
    $sql = 'UPDATE ingredients SET ingredient = ? WHERE recipe_id = ? AND sort_order = ?';
    mysqli_execute_query($conn, $sql, [$ingredient, $recipe_id, $sort_order]);
}

/* Update steps */
function update_step(mysqli $conn, int $recipe_id, int $step_number, string $title, string $description, string $step_image): void {
    $sql = 'UPDATE steps SET title = ?, description = ?, step_image = ? WHERE recipe_id = ? AND step_number = ?';
    mysqli_execute_query($conn, $sql, [$title, $description, $step_image, $recipe_id, $step_number]);
}