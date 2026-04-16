// // Toggle sidebar on mobile
// function toggleSidebar() {
//     const sidebar = document.getElementById('sidebar');
//     sidebar.classList.toggle('-translate-x-full');
//     sidebar.classList.toggle('lg:translate-x-0');
// }

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
}
