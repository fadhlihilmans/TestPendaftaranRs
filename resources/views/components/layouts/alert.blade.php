<script>

(function () {
  // ===== Ikon (fallback). Jika window.CHECK_SVG / WARN_SVG sudah ada, gunakan itu. =====
  const CHECK_SVG =
    (typeof window !== "undefined" && window.CHECK_SVG) ||
    `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
      width="20" height="20" fill="currentColor"
      style="margin-right:8px;flex-shrink:0" role="img" aria-label="Berhasil">
      <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10
               10-4.477 10-10S17.523 2 12 2zm-1.293 13.293
               -3.293-3.293 1.414-1.414L10.707 13.586l4.879-4.879
               1.414 1.414-6.293 6.293z"/>
    </svg>`;

  const WARN_SVG =
    (typeof window !== "undefined" && window.WARN_SVG) ||
    `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
      width="20" height="20" fill="currentColor"
      style="margin-right:8px;flex-shrink:0" role="img" aria-label="Kesalahan">
      <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3
               L13.71 3.86a2 2 0 00-3.42 0zM12 9c.552 0 1 .448 1 1v4
               a1 1 0 01-2 0v-4c0-.552.448-1 1-1zm0 8a1.25 1.25 0 110-2.5
               1.25 1.25 0 010 2.5z"/>
    </svg>`;

  // Cog ala "settings" (mirip Lucide tapi inline, tanpa library)
  const COG_SVG = `
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
         viewBox="0 0 24 24" fill="none" stroke="currentColor"
         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
         style="margin-right:8px;flex-shrink:0" role="img" aria-label="Info">
      <path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"/>
      <circle cx="12" cy="12" r="3"/>
    </svg>`;

  function gradientByType(type) {
    switch ((type || "").toLowerCase()) {
      case "success": return "linear-gradient(135deg, #76d275, #4caf50)";
      case "error":
      case "danger":
      case "failed":  return "linear-gradient(135deg, #e53935, #c62828)";
      case "warning": return "linear-gradient(135deg, #f6c343, #f39c12)";
      default:        return "linear-gradient(135deg, #6ea8fe, #3b82f6)";
    }
  }
  function iconByType(type) {
    switch ((type || "").toLowerCase()) {
      case "success": return CHECK_SVG;
      case "error":
      case "danger":
      case "failed":  return WARN_SVG;
      case "warning":
      case "info":
      default:        return COG_SVG;
    }
  }

  function show(type, message, opts = {}) {
    if (!window.Toastify) {
      console.error("[ToastifyBus] Toastify belum dimuat.");
      return;
    }
    const html = `<span style="display:flex;align-items:center;">${iconByType(type)}${message ?? ""}</span>`;
    const style = Object.assign(
      {
        background: gradientByType(type),
        borderRadius: "8px",
        fontWeight: "normal",
        boxShadow: "0 4px 20px rgba(0,0,0,.2)",
        color: "#fff",
        padding: "10px 20px",
        fontSize: "16px",
        textAlign: "left",
      },
      opts.style || {}
    );
    const options = Object.assign(
      {
        text: html,
        className: "info",
        duration: 3000,
        newWindow: true,
        gravity: "top",      // "top" | "bottom"
        position: "center",  // "left" | "center" | "right"
        escapeMarkup: false,
        close: false,
        stopOnFocus: true,
        style,
      },
      opts
    );
    Toastify(options).showToast();
  }

  // API global
  const api = {
    show,
    success(msg, opts) { show("success", msg, opts); },
    error(msg, opts)   { show("error",   msg, opts); },
    info(msg, opts)    { show("info",    msg, opts); },
    warning(msg, opts) { show("warning", msg, opts); },
  };
  window.ToastifyBus = api;

  // ===== Event Delegation =====
  // Klik pada elemen yang (atau ancestor-nya) punya [data-toast]
  document.addEventListener("click", (e) => {
    const el = e.target.closest("[data-toast]");
    if (!el) return;

    const type = (el.dataset.toast || "info").toLowerCase();
    const msg =
      el.dataset.message ||
      el.getAttribute("aria-label") ||
      "Aksi berhasil.";

    const duration = el.dataset.toastDuration
      ? parseInt(el.dataset.toastDuration, 10)
      : undefined;
    const gravity  = el.dataset.toastGravity;   // "top" | "bottom"
    const position = el.dataset.toastPosition;  // "left" | "center" | "right"

    show(type, msg, { duration, gravity, position });
  });
})();

</script>
