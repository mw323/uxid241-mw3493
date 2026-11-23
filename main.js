// Navigation Menu
const menuButton = document.querySelector('#menuButton');
const navMenu = document.querySelector('#navMenu');

if (menuButton && navMenu) {
    menuButton.addEventListener('click', function () {
        navMenu.classList.toggle('open');
        document.body.classList.toggle('menu-open');

        const menuIcon = menuButton.querySelector('.menu-icon');
        const closeIcon = menuButton.querySelector('.close-icon');

        if (navMenu.classList.contains('open')) {
            menuIcon.style.display = 'none';
            closeIcon.style.display = 'block';
        } else {
            menuIcon.style.display = 'block';
            closeIcon.style.display = 'none';
        }
    });
}


// Add Ingredient
const addIngredient = document.querySelector('#addIngredient');
const ingredientsList = document.querySelector('#ingredientsList');

if (addIngredient && ingredientsList) {
    addIngredient.addEventListener('click', function () {
        const ingredientRows = ingredientsList.querySelectorAll('.ingredient-row');
        const ingredientNumber = ingredientRows.length + 1;

        const newIngredient = document.createElement('div');
        newIngredient.className = 'ingredient-row';

        newIngredient.innerHTML = `
            <span>${ingredientNumber}</span>
            <input
                type="text"
                name="ingredients[]"
                placeholder="e.g. 1 Tbsp Soy Sauce"
                required
            >
        `;

        ingredientsList.appendChild(newIngredient);
    });
}


// Add Step
const addStep = document.querySelector('#addStep');
const stepsList = document.querySelector('#stepsList');

if (addStep && stepsList) {
    addStep.addEventListener('click', function () {
        const steps = stepsList.querySelectorAll('.step-form');
        const stepNumber = steps.length + 1;

        const newStep = document.createElement('div');
        newStep.className = 'step-form';

        newStep.innerHTML = `
            <h3>Step ${stepNumber}</h3>

            <div class="form-group">
                <label>Step Title</label>
                <input
                    type="text"
                    name="step_titles[]"
                    placeholder="e.g. Prepare the ingredients"
                    required
                >
            </div>

            <div class="form-group">
                <label>Instructions</label>
                <textarea
                    name="step_descriptions[]"
                    placeholder="Describe what to do in this step."
                    required
                ></textarea>
            </div>

            <div class="form-group">
                <label>Step Image</label>
                <input
                    type="file"
                    name="step_images[]"
                    required
                >
            </div>
        `;

        stepsList.appendChild(newStep);
    });
}