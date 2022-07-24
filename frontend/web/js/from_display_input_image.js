const display = document.getElementById('image-display');
const input = document.getElementById('image-url-input');

const show = () => {
    const url = input.value;
    if (isImage(url)) display.src = url;
    else display.src = '/resources/images/no_image.jpg';
}
window.onload = show;

input.addEventListener('input', () => show());


