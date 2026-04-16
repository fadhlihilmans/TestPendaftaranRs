(function () {
  try {
    var t = localStorage.getItem('theme');
    var prefers = window.matchMedia('(prefers-color-scheme: dark)').matches;
    var wantDark = t ? (t === 'dark') : prefers;

    if (wantDark) {
      document.documentElement.classList.add('dark');
      document.documentElement.style.colorScheme = 'dark';

      var s = document.createElement('style');
      s.setAttribute('data-dark-boot', '');
      s.textContent = 'html,body{background:#0b1220;}';
      document.head.appendChild(s);

      var l = document.createElement('link');
      l.rel = 'stylesheet';
      l.href = '/admin/css/dark-theme.css';     
      l.id = 'dark-theme-css';
      l.setAttribute('data-navigate-once', ''); 
      document.head.appendChild(l);

      l.addEventListener('load', function () {
        var guard = document.querySelector('style[data-dark-boot]');
        if (guard) guard.remove();
      });
    }
  } catch (e) {}
})();
