const sidebar = document.getElementById('sidebar');
const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('focus', (e) => {
    sidebar.classList.remove('!w-72');
});

searchInput.addEventListener('blur', (e) => {
    sidebar.classList.add('!w-72');
});