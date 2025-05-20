document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.querySelector('.fa-bars');
    const navLinks = document.querySelector('.nav-links');

    function showMenu() {
        navLinks.classList.add('open');
    }

    // Função para fechar o menu
    function hideMenu() {
        navLinks.classList.remove('open');
    }

    menuButton.addEventListener('click', (event) => {
        event.preventDefault();
        navLinks.classList.toggle('open');
    });

   
    function toggleMenu(event) {
        event.preventDefault();
        const submenus = document.querySelectorAll('.submenu');
        submenus.forEach(submenu => {
            if (submenu !== event.target.nextElementSibling) {
                submenu.style.display = 'none';
            }
        });

        const submenu = event.target.nextElementSibling;
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    }

    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.addEventListener('click', toggleMenu);
    });

    const closeButton = document.querySelector('.fa-times');
    if (closeButton) {
        closeButton.addEventListener('click', hideMenu);
    }

    const openButton = document.querySelector('.fa-bars');
    if (openButton) {
        openButton.addEventListener('click', showMenu);
    }

});

document.querySelectorAll('.dropdown-toggle').forEach(function(dropdown) {
    dropdown.addEventListener('click', function() {
        var dropdownMenu = this.nextElementSibling;
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });
});
