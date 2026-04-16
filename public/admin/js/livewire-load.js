// // livewire-load.js (ringkas)
// document.addEventListener('DOMContentLoaded', () => {
//   window.lucide?.createIcons?.();
// });

// document.addEventListener('livewire:navigated', () => {
//   window.lucide?.createIcons?.();
// });

// document.addEventListener('livewire:init', () => {
//   Livewire.hook('commit', () => {
//     window.lucide?.createIcons?.();
//   });
// });

// livewire-load.js (ganti bagian hook-nya)
document.addEventListener('DOMContentLoaded', () => {
  window.lucide?.createIcons?.();
});

document.addEventListener('livewire:navigated', () => {
  window.lucide?.createIcons?.();
});

document.addEventListener('livewire:init', () => {
  Livewire.hook('commit', ({ succeed }) => {
    succeed(() => {
      requestAnimationFrame(() => {
        window.lucide?.createIcons?.();
      });
    });
  });
});
