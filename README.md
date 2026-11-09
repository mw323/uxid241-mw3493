# uxid241-mw3493

## Project Description

This project is an online cookbook where users can browse, search, and filter different recipes. Each recipe includes information such as the recipe description, ingredients, images, and cooking steps. The website is built with PHP and a database to store and display the recipe information. At the beta stage, users can log in to access the admin area and manage the recipe collection. From the admin area, users can add new recipes, update existing recipe information, and delete recipes from the database.

## How to run it locally?

1. Clone or download this repository and place the project folder inside your `htdocs` folder.
2. Start Apache and MySQL using XAMPP or MAMP.
3. Create a new database in phpMyAdmin and import `schema.sql`.
4. Copy `config.example.php` to `config.php`.
5. Update `config.php` with your local database credentials and database name.
6. Open the project through `localhost` in your web browser.

## Admin login

The account registration feature is not fully completed at the beta stage. Please use the test account below to log in and access the admin area:

- Email: admin@example.com
- Password: test123

## Feature

I built both Search and Filter features to help users find recipes more easily. The Search feature allows users to enter a keyword to find recipes by their title or subtitle. The Filter feature allows users to select a recipe category, such as Meat, Seafood, or Vegetarian, to only display recipes from that category. Users can also select “All Recipes” to view the full recipe collection.

## AI use

- ChatGPT — I asked how to keep “Difficulty” and “Duration” displayed as the default text in my select boxes without showing them as options when the dropdown is opened. ChatGPT showed me how to use `value=""`, `disabled`, `selected`, and `hidden` and explained what each one does. After understanding the explanation, I applied them to my own HTML.

- ChatGPT — I asked how `foreach` and arrays work together in PHP and where I could use them on my website. ChatGPT explained that I could use them for my recipe cards because I only need one card template, and `foreach` can use that same template for each recipe in the array. ChatGPT also provided an example and explained how it works. After understanding the concept, I wrote the `foreach` loop for my recipe cards myself.

- ChatGPT — After I wrote my `foreach` code, I got an error when I refreshed the page. I shared my code with ChatGPT and asked what was causing the error. ChatGPT analyzed my code and pointed out that I had not closed the `foreach` loop. It provided the `<?php endforeach; ?>` code to close the loop, which I copied into my code. After adding it, the page worked correctly.

- ChatGPT — I asked why the content inside a container was sticking out after I added `border-radius`, and what CSS property I could use to fix it. ChatGPT suggested `overflow: hidden` and explained that it hides any content that extends outside the container. After understanding how it works, I used this solution in my CSS.

- ChatGPT — I shared part of my HTML and asked how to select the recipe number inside the first button so I could style it. ChatGPT broke down the structure of my HTML and explained how to use a CSS selector to target the element I wanted. I then wrote and tested the CSS myself.

- ChatGPT — I understood how `GROUP BY` works and initially wanted to output the query results directly with `echo`. I then realized that the query returns multiple rows, one for each category, and I needed a way to map each returned row to the corresponding category in my fixed UI. I asked ChatGPT how to output the data correctly. ChatGPT explained how to access the returned results and generated the code that assigns each category count to its corresponding variable for display.

- ChatGPT — I asked ChatGPT how to make the category links jump to the recipes section while showing the selected category as active, with “All Recipes” active by default. ChatGPT generated the PHP code using a ternary operator to conditionally apply the `active` class based on the selected category. ChatGPT also explained how this code works: if the condition before the `?` is true, it returns the value after the `?`; otherwise, it returns the value after the `:`.

- ChatGPT — I used ChatGPT to help me plan how to organize recipe content in the database and connect multiple tables using foreign keys. 

- ChatGPT — I used ChatGPT to help generate the add_ingredients() and add_steps() functions for the Create Recipe feature. Before using the code, I asked ChatGPT to explain how each function works and provide examples to help me better understand the loops and how the data is added to the database.

- ChatGPT — I used ChatGPT to help generate the `for` loops for updating multiple ingredients and steps in the Edit Recipe feature. Before using the code, I asked ChatGPT to explain how the loops work and provide examples to help me understand how the index matches and updates the correct ingredient and step data.

- ChatGPT — I shared my Edit Recipe code with ChatGPT, and it pointed out that I was missing a hidden input for keeping track of each ingredient's sort order. ChatGPT explained why it was needed and how it works with the update loop, so I added it to my form.

- ChatGPT — I asked ChatGPT how to better manage multiple ingredient and step inputs in the Create Recipe form. It suggested using arrays such as ingredients[], step_titles[], step_descriptions[], and step_images[], and explained how the values are grouped and submitted to PHP.