<?php

declare(strict_types=1);

session_set_cookie_params([
  'httponly' => true,
  'secure' => true,
  'samesite' => 'Lax',
]);

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

$error = '';
$main_image = '';
$ingredients_image = '';

$upload_folder = __DIR__ . '/../images';
$step_images = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = get_post('title');
    $subtitle = get_post('subtitle');
    $description = get_post('description');
    
    try {
        $main_image = 'images/' . save_upload(
            $_FILES['main_image']['tmp_name'],
            $_FILES['main_image']['name'],
            $_FILES['main_image']['size'],
            $_FILES['main_image']['error'],
            $upload_folder
        );

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

    $category_id = (int) get_post('category_id');
    $ingredients = $_POST['ingredients'] ?? [];
    $step_titles = $_POST['step_titles'] ?? [];
    $step_descriptions = $_POST['step_descriptions'] ?? [];

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

            $step_images[] = 'images/' . $saved;

        } catch (RuntimeException $e) {
            $error = $e->getMessage();
        }
      }
    }

    if ($error === '' && ($title === '' || $subtitle === '' || $description === '' || $main_image === '' || $ingredients_image === '' ||
    $category_id < 1 || $category_id > 3 || empty($ingredients) || empty($step_titles) || empty($step_descriptions) || empty($step_images))) {
        $error = 'Please complete all required fields.';
    }

    if ($error === '') {
        $recipe_id = create_recipe($conn, $title, $subtitle, $description, $main_image, $ingredients_image, $category_id);
        add_ingredients($conn, $recipe_id, $ingredients);
        add_steps($conn, $recipe_id, $step_titles, $step_descriptions, $step_images);

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
    <title>Add Recipe</title>
    <link rel="stylesheet" href="../normalize.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
  <main class="add-recipe-page">

  <div class="add-recipe-heading">
    <h1>Add a New Recipe</h1>
    <p>Fill in the details below to add a recipe to your collection.</p>
  </div>

  <?php if ($error !== ''): ?>
    <p class="form-error"><?php echo e($error); ?></p>
  <?php endif; ?>

  <form class="add-recipe-form" method="post" enctype="multipart/form-data">
    <section class="add-recipe-section">
      <div class="form-section-heading">
        <h2>Recipe Details</h2>
        <p>Add the basic information for your recipe.</p>
      </div>

      <div class="form-group">
        <label for="title">Recipe Title</label>
        <input type="text" id="title" name="title" placeholder="e.g. Honey Garlic Chicken" required>
      </div>

      <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" id="subtitle" name="subtitle" placeholder="e.g. with Roasted Vegetables & Rice" required>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Describe the dish, flavors, and what makes this recipe special." required></textarea>
      </div>

      <div class="form-group">
        <label>Category</label>

        <div class="category-options">
          <label><input type="radio" name="category_id" value="1" required> Meat</label>
          <label><input type="radio" name="category_id" value="2"> Seafood</label>
          <label><input type="radio" name="category_id" value="3"> Vegetarian</label>
        </div>
      </div>

      <div class="form-group">
        <label for="main_image">Recipe Image</label>
        <input type="file" id="main_image" name="main_image" required>
      </div>
    </section>

    <section class="add-recipe-section">
      <div class="form-section-heading">
        <h2>Ingredients</h2>
        <p>Add the ingredients needed for this recipe.</p>
      </div>

      <div class="ingredients-list" id="ingredientsList">

        <div class="form-group">
          <label for="ingredients_image">Ingredients Image</label>
          <input type="file" id="ingredients_image" name="ingredients_image" required>
        </div>

        <div class="ingredient-row">
          <span>1</span>
          <input type="text" name="ingredients[]" placeholder="e.g. 2 Boneless Chicken Breasts" required>
        </div>

        <div class="ingredient-row">
          <span>2</span>
          <input type="text" name="ingredients[]" placeholder="e.g. 2 cloves Garlic" required>
        </div>

        <div class="ingredient-row">
          <span>3</span>
          <input type="text" name="ingredients[]" placeholder="e.g. 1 Tbsp Olive Oil" required>
        </div>

      </div>

      <button type="button" class="add-field-button" id="addIngredient">
        + Add Ingredient
      </button>
    </section>

    <section class="add-recipe-section">
      <div class="form-section-heading">
        <h2>Directions</h2>
        <p>Add the cooking instructions step by step.</p>
      </div>

      <div class="steps-list" id="stepsList">
        <div class="step-form">
          <h3>Step 1</h3>

          <div class="form-group">
            <label>Step Title</label>
            <input type="text" name="step_titles[]" placeholder="e.g. Prepare the ingredients" required>
          </div>

          <div class="form-group">
            <label>Instructions</label>
            <textarea name="step_descriptions[]" placeholder="Describe what to do in this step." required></textarea>
          </div>

          <div class="form-group">
            <label>Step Image</label>
            <input type="file" name="step_images[]" required>
          </div>
        </div>

        <div class="step-form">
          <h3>Step 2</h3>

          <div class="form-group">
            <label>Step Title</label>
            <input type="text" name="step_titles[]" placeholder="e.g. Cook the ingredients" required>
          </div>

          <div class="form-group">
            <label>Instructions</label>
            <textarea name="step_descriptions[]" placeholder="Describe what to do in this step." required></textarea>
          </div>

          <div class="form-group">
            <label>Step Image</label>
            <input type="file" name="step_images[]" required>
          </div>
        </div>

        <div class="step-form">
          <h3>Step 3</h3>

          <div class="form-group">
            <label>Step Title</label>
            <input type="text" name="step_titles[]" placeholder="e.g. Cook the ingredients" required>
          </div>

          <div class="form-group">
            <label>Instructions</label>
            <textarea name="step_descriptions[]" placeholder="Describe what to do in this step." required></textarea>
          </div>

          <div class="form-group">
            <label>Step Image</label>
            <input type="file" name="step_images[]" required>
          </div>
        </div>
      </div>

      <button type="button" class="add-field-button" id="addStep">+ Add Step</button>
    </section>

    <div class="form-actions">
      <a href="manage-recipes.php" class="cancel-button">Cancel</a>
      <button type="submit" class="submit-recipe-button">Add Recipe</button>
    </div>
  </form>
</main>
    <script src="../main.js"></script>
</body>
</html>