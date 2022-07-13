// If search input value length is smaller than 2, disable search submit button
const searchInput = document.getElementById("search-input");
const searchSubmit = document.getElementById("search-submit");

const searchSubmitDisable = () => {
    if (searchInput.value.length < 2) {
        searchSubmit.disabled = true;
    } else {
        searchSubmit.disabled = false;
    }
};

searchSubmitDisable();
searchInput.addEventListener("input", searchSubmitDisable);
const sidebar = document.getElementById("sidebar");
const menuShowBtn = document.getElementById("menu-show");
const menuHideBtn = document.getElementById("menu-hide");

// Add event listener to menu show button
menuShowBtn.addEventListener("click", () => {
    sidebar.classList.remove("hidden");
    sidebar.classList.add("block");
    menuShowBtn.classList.add("!hidden");
    menuHideBtn.classList.remove("!hidden");
});

// Add event listener to menu hide button
menuHideBtn.addEventListener("click", () => {
    sidebar.classList.remove("block");
    sidebar.classList.add("hidden");
    menuShowBtn.classList.remove("!hidden");
    menuHideBtn.classList.add("!hidden");
});
