// Toggle dropdown menus
function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    dropdown.classList.toggle('show');
    
    // Close other dropdowns
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        if (menu.id !== id && menu.classList.contains('show')) {
            menu.classList.remove('show');
        }
    });
}

// Toggle sidebar submenus
// function toggleSubmenu(id) {
//     const submenu = document.getElementById(id);
//     submenu.classList.toggle('show');
    
//     // Rotate chevron icon
//     const chevron = document.getElementById(id.replace('-submenu', '-chevron'));
//     chevron.classList.toggle('rotate-180');
// }

function toggleSubmenu(id) {
  const submenu = document.getElementById(id);
  if (!submenu) return;
  submenu.classList.toggle('show');

  // rotate chevron
  const chevron = document.getElementById(id.replace('-submenu', '-chevron'));
  if (chevron) chevron.classList.toggle('rotate-180');
}