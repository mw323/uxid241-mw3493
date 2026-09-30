# uxid241-mw3493

## Project Description

This project is an online cookbook designed to provide a simple way to browse and manage a collection of recipes. It is a server-side web application built with PHP and a database, with features for browsing, searching, filtering, and managing recipe information. The project brings together the PHP and database skills developed throughout the course into a complete web application.

## AI use

- ChatGPT — I asked how to keep “Difficulty” and “Duration” displayed as the default text in my select boxes without showing them as options when the dropdown is opened. ChatGPT showed me how to use `value=""`, `disabled`, `selected`, and `hidden` and explained what each one does. After understanding the explanation, I applied them to my own HTML.

- ChatGPT — I asked how `foreach` and arrays work together in PHP and where I could use them on my website. ChatGPT explained that I could use them for my recipe cards because I only need one card template, and `foreach` can use that same template for each recipe in the array. ChatGPT also provided an example and explained how it works. After understanding the concept, I wrote the `foreach` loop for my recipe cards myself.

- ChatGPT — After I wrote my `foreach` code, I got an error when I refreshed the page. I shared my code with ChatGPT and asked what was causing the error. ChatGPT analyzed my code and pointed out that I had not closed the `foreach` loop. It provided the `<?php endforeach; ?>` code to close the loop, which I copied into my code. After adding it, the page worked correctly.

- ChatGPT — I asked why the content inside a container was sticking out after I added `border-radius`, and what CSS property I could use to fix it. ChatGPT suggested `overflow: hidden` and explained that it hides any content that extends outside the container. After understanding how it works, I used this solution in my CSS.

- ChatGPT — I shared part of my HTML and asked how to select the recipe number inside the first button so I could style it. ChatGPT broke down the structure of my HTML and explained how to use a CSS selector to target the element I wanted. I then wrote and tested the CSS myself.