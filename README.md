# uxid241-mw3493

## Project Description

This project is an online cookbook designed to provide a simple way to browse and manage a collection of recipes. It is a server-side web application built with PHP and a database, with features for browsing, searching, filtering, and managing recipe information. The project brings together the PHP and database skills developed throughout the course into a complete web application.

## How to run it locally?

1. Clone or download this repository and place the project folder inside your `htdocs` folder.
2. Start Apache and MySQL using XAMPP or MAMP.
3. Create a new database in phpMyAdmin and import `schema.sql`.
4. Copy `config.example.php` to `config.php`.
5. Update `config.php` with your local database credentials and database name.
6. Open the project through `localhost` in your web browser.

## AI use

- ChatGPT — I asked how to keep “Difficulty” and “Duration” displayed as the default text in my select boxes without showing them as options when the dropdown is opened. ChatGPT showed me how to use `value=""`, `disabled`, `selected`, and `hidden` and explained what each one does. After understanding the explanation, I applied them to my own HTML.

- ChatGPT — I asked how `foreach` and arrays work together in PHP and where I could use them on my website. ChatGPT explained that I could use them for my recipe cards because I only need one card template, and `foreach` can use that same template for each recipe in the array. ChatGPT also provided an example and explained how it works. After understanding the concept, I wrote the `foreach` loop for my recipe cards myself.

- ChatGPT — After I wrote my `foreach` code, I got an error when I refreshed the page. I shared my code with ChatGPT and asked what was causing the error. ChatGPT analyzed my code and pointed out that I had not closed the `foreach` loop. It provided the `<?php endforeach; ?>` code to close the loop, which I copied into my code. After adding it, the page worked correctly.

- ChatGPT — I asked why the content inside a container was sticking out after I added `border-radius`, and what CSS property I could use to fix it. ChatGPT suggested `overflow: hidden` and explained that it hides any content that extends outside the container. After understanding how it works, I used this solution in my CSS.

- ChatGPT — I shared part of my HTML and asked how to select the recipe number inside the first button so I could style it. ChatGPT broke down the structure of my HTML and explained how to use a CSS selector to target the element I wanted. I then wrote and tested the CSS myself.

- ChatGPT — I understood how `GROUP BY` works and initially wanted to output the query results directly with `echo`. I then realized that the query returns multiple rows, one for each category, and I needed a way to map each returned row to the corresponding category in my fixed UI. I asked ChatGPT how to output the data correctly. ChatGPT explained how to access the returned results and generated the code that assigns each category count to its corresponding variable for display.

- CharGPT — I asked ChatGPT how to make the category links jump to the recipes section while showing the selected category as active, with “All Recipes” active by default. ChatGPT generated the PHP code using a ternary operator to conditionally apply the `active` class based on the selected category. ChatGPT also explained how this code works: if the condition before the `?` is true, it returns the value after the `?`; otherwise, it returns the value after the `:`.