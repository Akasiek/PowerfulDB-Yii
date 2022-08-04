// For each select element on page create slimSelect
const selects = document.querySelectorAll("select");
if (selects) {
    selects.forEach(select => {
        new SlimSelect({
            select: select,
        });
    });

}