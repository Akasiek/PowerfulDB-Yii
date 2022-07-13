// Disable name input and clear it if artist is selected
const artistIdSelector = document.getElementById("select-slim");
const nameInput = document.getElementById("member-name");

artistIdSelector.addEventListener("change", () => {
    console.log(artistIdSelector.value);
    if (artistIdSelector.value === "0") {
        nameInput.disabled = false;
    } else {
        nameInput.disabled = true;
        nameInput.value = "";
    }
});
