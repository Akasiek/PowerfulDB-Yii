const selects = document.querySelectorAll("select.slim-select");
for (let s of selects) {
    new SlimSelect({
        select: s,
    });
}

const featuredBtn = document.getElementsByClassName("featured-btn");
const featuredSelect = document.getElementsByClassName("featured-select");
for (let btn of featuredBtn) {
    btn.addEventListener("click", () => {
        const select = btn.nextElementSibling;
        select.classList.toggle("hidden");
    });
}
