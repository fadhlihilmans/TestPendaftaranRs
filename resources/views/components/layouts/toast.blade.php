<script data-navigate-once>
  window.CHECK_SVG ||= `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
         width="20" height="20" fill="currentColor"
         style="margin-right:8px;flex-shrink:0" role="img" aria-label="Berhasil">
      <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10
               10-4.477 10-10S17.523 2 12 2zm-1.293 13.293
               -3.293-3.293 1.414-1.414L10.707 13.586l4.879-4.879
               1.414 1.414-6.293 6.293z"/>
    </svg>`;

  window.WARN_SVG ||= `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
         width="20" height="20" fill="currentColor"
         style="margin-right:8px;flex-shrink:0" role="img" aria-label="Kesalahan">
      <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3
               L13.71 3.86a2 2 0 00-3.42 0zM12 9c.552 0 1 .448 1 1v4
               a1 1 0 01-2 0v-4c0-.552.448-1 1-1zm0 8a1.25 1.25 0 110-2.5
               1.25 1.25 0 010 2.5z"/>
    </svg>`;
</script>

<!-- toastify -->
<script>
  document.addEventListener('livewire:init', () => {
    Livewire.on('success-message', (event) => {
      Toastify({
        text: `<span style="display:flex;align-items:center;">${CHECK_SVG}${event}</span>`,
        className: "info",
        duration: 5000,
        newWindow: true,
        gravity: "top",
        position: "center",
        style: {
          background: "linear-gradient(135deg, #76d275, #4caf50)",
          borderRadius: "8px",
          fontWeight: "normal",
          boxShadow: "0 4px 20px rgba(0,0,0,.2)",
          color: "#fff",
          padding: "10px 20px",
          fontSize: "16px",
          textAlign: "left"
        },
        escapeMarkup: false
      }).showToast();
    });

    Livewire.on('failed-message', (event) => {
      Toastify({
        text: `<span style="display:flex;align-items:center;">${WARN_SVG}${event}</span>`,
        className: "info",
        duration: 5000,
        newWindow: true,
        gravity: "top",
        position: "center",
        style: {
          background: "linear-gradient(135deg, #e53935, #c62828)",
          borderRadius: "8px",
          fontWeight: "normal",
          boxShadow: "0 4px 20px rgba(0,0,0,.2)",
          color: "#fff",
          padding: "10px 20px",
          fontSize: "16px",
          textAlign: "left"
        },
        escapeMarkup: false
      }).showToast();
    });
  });
</script>


<!-- sweetalert -->
<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('warning-message', (event) => {
      let overlay;
      Swal.fire({
        template: '#my-template',
        toast: true,
        position: 'center',
        timer: 0,
        showConfirmButton: true,
        didOpen: (popup) => {
          const el = popup.querySelector('#warn-msg');
          if (el) el.textContent = event;

          const container = Swal.getContainer();
          const zStr = getComputedStyle(container).zIndex;
          const baseZ = Number.isFinite(parseInt(zStr, 10)) ? parseInt(zStr, 10) : 1060;

          overlay = document.createElement('div');
          overlay.style.cssText = `
            position:fixed; inset:0;
            background:rgba(17,24,39,.55);
            z-index:${baseZ - 1}; /* pasti di bawah toast */
          `;
          overlay.addEventListener('click', () => Swal.close());

          container.parentNode.insertBefore(overlay, container);
        },
        willClose: () => {
          if (overlay && overlay.parentNode) overlay.parentNode.removeChild(overlay);
        }
      });
    });
});
</script>

<template id="my-template">
  <swal-title>
    Peringatan!
  </swal-title>
  <swal-html>
    <p id="warn-msg"></p>
  </swal-html>
  <swal-icon type="warning" color="#c62828"></swal-icon>
  <swal-button type="confirm" color="#051240">
    Mengerti
  </swal-button>
  <swal-param name="allowEscapeKey" value="true" />
</template>