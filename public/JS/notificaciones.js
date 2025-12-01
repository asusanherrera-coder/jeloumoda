document.addEventListener('DOMContentLoaded', function () {
    const bell = document.querySelector('.icono-notificaciones');
    const dropdown = document.getElementById('notificaciones-dropdown');

    if (bell && dropdown) {
        bell.addEventListener('click', function (e) {
            e.preventDefault();
            dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
        });

        document.addEventListener('click', function (e) {
            if (!bell.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });
    }
});