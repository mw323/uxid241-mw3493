<?php

declare(strict_types=1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

require_once '../db.php';
require_once '../functions.php';

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$id = (int) ($_GET['id'] ?? 0);

$recipe = recipe_by_id($conn, $id);
$ingredients = ingredients_by_recipe($conn, $id);
$steps = steps_by_recipe($conn, $id);

$error = '';
$upload_folder = __DIR__ . '/../images';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = get_post('title');
    $subtitle = get_post('subtitle');
    $description = get_post('description');
    $category_id = (int) get_post('category_id');

    $ingredient_orders = $_POST['ingredient_orders'] ?? [];
    $new_ingredients = $_POST['ingredients'] ?? [];

    $step_numbers = $_POST['step_numbers'] ?? [];
    $step_titles = $_POST['step_titles'] ?? [];
    $step_descriptions = $_POST['step_descriptions'] ?? [];

    $main_image = $recipe['main_image'];
    $ingredients_image = $recipe['ingredients_image'];

    $step_images = [];

    foreach ($steps as $step) {
        $step_images[] = $step['step_image'];
    }

    if ($_FILES['main_image']['error'] !== UPLOAD_ERR_NO_FILE) {
        try {
            $main_image = 'images/' . save_upload(
                $_FILES['main_image']['tmp_name'],
                $_FILES['main_image']['name'],
                $_FILES['main_image']['size'],
                $_FILES['main_image']['error'],
                $upload_folder
            );
        } catch (RuntimeException $e) {
            $error = $e->getMessage();
        }
      }

    if ($_FILES['ingredients_image']['error'] !== UPLOAD_ERR_NO_FILE) {
        try {
            $ingredients_image = 'images/' . save_upload(
                $_FILES['ingredients_image']['tmp_name'],
                $_FILES['ingredients_image']['name'],
                $_FILES['ingredients_image']['size'],
                $_FILES['ingredients_image']['error'],
                $upload_folder
            );
        } catch (RuntimeException $e) {
            $error = $e->getMessage();
        }
      }

    if (isset($_FILES['step_images']['name']) && is_array($_FILES['step_images']['name'])) {
        $files = $_FILES['step_images'];

        foreach ($files['name'] as $i => $original_name) {
            if ($files['error'][$i] === UPLOAD_ERR_NO_FILE) {
                continue;
            }
            try {
                $saved = save_upload(
                    $files['tmp_name'][$i],
                    $original_name,
                    $files['size'][$i],
                    $files['error'][$i],
                    $upload_folder
                );

                $step_images[$i] = 'images/' . $saved;
            } catch (RuntimeException $e) {
                $error = $e->getMessage();
            }
        }
      }


     if ($error === '' && ($title === '' || $subtitle === '' || $description === '' || $main_image === '' || $ingredients_image === '' ||
    $category_id < 1 || $category_id > 3 || empty($new_ingredients) || empty($step_titles) || empty($step_descriptions) || empty($step_images))) {
        $error = 'Please complete all required fields.';
    }
    
    if ($error === '') {
        update_recipe($conn, $id, $title, $subtitle, $description, $main_image, $ingredients_image, $category_id);

        // AI-generated with ChatGPT
        for ($i = 0; $i < count($new_ingredients); $i++) {
            update_ingredient($conn, $id, (int) $ingredient_orders[$i], $new_ingredients[$i]);
        }

        // AI-generated with ChatGPT
        for ($i = 0; $i < count($step_titles); $i++) {
            update_step($conn, $id, (int) $step_numbers[$i], $step_titles[$i], $step_descriptions[$i], $step_images[$i]);
        }

        header('Location: manage-recipes.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="../normalize.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
  <main class="add-recipe-page">
  <div class="add-recipe-heading">
    <h1>Edit Recipe</h1>
    <p>Update the details below to make changes to your recipe.</p>
  </div>

  <?php if ($error !== ''): ?>
    <p class="form-error"><?php echo e($error); ?></p>
  <?php endif; ?>

  <form class="add-recipe-form" method="post" enctype="multipart/form-data">

    <section class="add-recipe-section">
      <div class="form-section-heading">
        <h2>Recipe Details</h2>
        <p>Update the basic information for your recipe.</p>
      </div>

      <div class="form-group">
        <label for="title">Recipe Title</label>
        <input type="text" id="title" name="title" value="<?php echo e($recipe['title']); ?>" required>
      </div>

      <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" id="subtitle" name="subtitle" value="<?php echo e($recipe['subtitle']); ?>" required>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" required><?php echo e($recipe['description']); ?></textarea>
      </div>

      <div class="form-group">
        <label>Category</label>

        <div class="category-options">
          <label>
            <input type="radio" name="category_id" value="1" <?php echo (int) $recipe['category_id'] === 1 ? 'checked' : ''; ?> required>
            Meat
          </label>

          <label>
            <input type="radio" name="category_id" value="2" <?php echo (int) $recipe['category_id'] === 2 ? 'checked' : ''; ?>>
            Seafood
          </label>

          <label>
            <input type="radio" name="category_id" value="3" <?php echo (int) $recipe['category_id'] === 3 ? 'checked' : ''; ?>>
            Vegetarian
          </label>
        </div>
      </div>

      <div class="form-group">
        <label for="main_image">Recipe Image</label>
        <input type="file" id="main_image" name="main_image">
      </div>
    </section>


    <section class="add-recipe-section">
      <div class="form-section-heading">
        <h2>Ingredients</h2>
        <p>Update the ingredients needed for this recipe.</p>
      </div>

      <div class="ingredients-list">
        
        <div class="form-group">
          <label for="ingredients_image">Ingredients Image</label>
          <input type="file" id="ingredients_image" name="ingredients_image">
        </div>

        <?php foreach ($ingredients as $ingredient): ?>
          <div class="ingredient-row">
            <span><?php echo (int) $ingredient['sort_order']; ?></span>
            <input type="hidden" name="ingredient_orders[]" value="<?php echo (int) $ingredient['sort_order']; ?>"> <!-- Added with ChatGPT's help to keep track of each ingredient's sort order -->
            <input type="text" name="ingredients[]" value="<?php echo e($ingredient['ingredient']); ?>" required>
          </div>
        <?php endforeach; ?>

      </div>
    </section>


    <section class="add-recipe-section">
      <div class="form-section-heading">
        <h2>Directions</h2>
        <p>Update the cooking instructions step by step.</p>
      </div>

      <div class="steps-list">

        <?php foreach ($steps as $step): ?>
          <div class="step-form">

            <h3>Step<?php echo (int) $step['step_number']; ?></h3>

            <input type="hidden" name="step_numbers[]" value="<?php echo (int) $step['step_number']; ?>">

            <div class="form-group">
              <label>Step Title</label>
              <input type="text" name="step_titles[]" value="<?php echo e($step['title']); ?>" required>
            </div>

            <div class="form-group">
              <label>Instructions</label>
              <textarea name="step_descriptions[]" required><?php echo e($step['description']); ?></textarea>
            </div>

            <div class="form-group">
              <label>Step Image</label>
              <input type="file" name="step_images[]">
            </div>

          </div>
        <?php endforeach; ?>

      </div>
    </section>

    <div class="form-actions">
      <a href="manage-recipes.php" class="cancel-button">Cancel</a>
      <button type="submit" class="submit-recipe-button">Update Recipe</button>
    </div>
  </form>
</main>
</body>
</html>