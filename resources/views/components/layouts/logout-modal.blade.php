<div id="logout-modal" class="fixed bg-gray-600 bg-opacity-50 inset-0 z-[100] hidden">
  <div class="absolute inset-0" onclick="closeLogoutModal()"></div>

  <div x-data="{ loading: false }"
       class="relative max-w-sm w-[92vw] sm:w-full mx-auto mt-[35vh] bg-white border border-gray-200 rounded-xl shadow-xl">
    <div class="p-5">
      <div class="flex items-start gap-3">
        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
          <i data-lucide="alert-triangle" class="w-8 h-8 text-red-600"></i>
        </div>
        <div class="flex-1">
          <h3 class="text-base font-semibold">Konfirmasi Logout</h3>
          <p class="text-sm text-gray-600 mt-1">Anda yakin ingin keluar?</p>
        </div>
        <button class="p-2 rounded-lg hover:bg-gray-100" onclick="closeLogoutModal()">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>
      </div>

      <div class="mt-5 flex justify-end gap-3">
        <button type="button"
                @click="closeLogoutModal()"
                class="px-4 py-2 border border-gray-200 rounded-lg text-sm hover:bg-gray-50">
          Batal
        </button>

        <form x-ref="f" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"
                  @click.prevent="loading = true; $refs.f.submit()"
                  :disabled="loading"
                  class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 flex items-center gap-2">
            <span x-show="!loading">Keluar</span>
            <span x-show="loading" class="inline-flex items-center">
              <i class="mdi mdi-loading mdi-spin"></i>
            </span>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function openLogoutModal(){ document.getElementById('logout-modal')?.classList.remove('hidden'); }
  function closeLogoutModal(){ document.getElementById('logout-modal')?.classList.add('hidden'); }
</script>
