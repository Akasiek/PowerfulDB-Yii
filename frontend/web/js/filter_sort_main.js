// On "Filters menu" button click, show/hide filters menu
const filtersText = document.getElementById("filters-text");
const filtersForm = document.getElementById("filters-form");
const expandIcon = document.getElementById("expand-icon");

filtersText.addEventListener("click", () => {
    filtersForm.classList.toggle("hidden");
    filtersForm.classList.toggle("flex");
    expandIcon.classList.toggle("!-rotate-180");
});
