<!-- main script -->
<script src="{{ asset('toast/toastify/toastify.min.js') }}"></script>
<script src="{{ asset('toast/sweetalert/sweetalert.js') }}"></script>
<script src="{{ asset('admin/js/livewire-load.js') }}"></script>
<script src="{{ asset('admin/js/main.js') }}"></script>
<script src="{{ asset('admin/js/sidebar.js') }}"></script>
<!-- end main script -->
{{-- <script>
  const LOGOUT_URL = "{{ route('logout') }}";

  function openLogoutModal() {
    const dd = document.getElementById('profile-dropdown');
    if (dd) dd.classList.add('hidden');
    document.getElementById('logout-modal')?.classList.remove('hidden');
  }

  function closeLogoutModal() {
    document.getElementById('logout-modal')?.classList.add('hidden');
  }

  // // Alternatif konfirmasi lewat JS (jika pakai tombol, bukan <a>)
  // function confirmLogout() {
  //   window.location.href = LOGOUT_URL; 
  // }

  // Tutup modal dengan tombol Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeLogoutModal();
  });
</script> --}}
