<!-- Sidebar -->
<aside id="sidebar" class="w-64 bg-light border-r border-light flex-shrink-0 transition-transform duration-300 transform lg:translate-x-0 -translate-x-full fixed lg:relative z-40 h-screen overflow-y-auto custom-scroll">
  <div class="p-6">
    <div class="flex items-center justify-between mb-8">
      <div class="flex items-center space-x-2">
        {{-- <img src="/pklflow.webp" alt="Logo" class="w-6 h-6 object-contain"> --}}
        <span class="text-xl font-semibold">{{ config('app.name') }}</span>
      </div>
      <button onclick="closeSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-light">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
      </button>
    </div>

    <nav class="space-y-1">

      <!-- Main -->
      <div class="mb-6">
        @role('super-admin,kakom,pokja,guru-pembimbing,instruktur-dudi')
        <p class="text-xs font-medium uppercase tracking-wider my-3">Main</p>

        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ Request::segment(2) === 'dashboard' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="home" class="w-4 h-4 mr-3"></i>
          Dashboard
        </a>
        @endrole

        <!-- Manajemen User -->
        @php $seg = Request::segment(2); @endphp
        @php $userSegs = ['user','list-user','role','list-role']; @endphp
        @role('super-admin')
        <div class="mt-1">
          <button onclick="toggleSubmenu('user-submenu')"
                  aria-expanded="{{ in_array($seg, $userSegs) ? 'true' : 'false' }}"
                  class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg {{ in_array($seg, $userSegs) ? 'bg-gray-100' : 'hover hover:bg-gray-50' }}">
            <div class="flex items-center">
              <i data-lucide="users" class="w-4 h-4 mr-3"></i>
              Manajemen User
            </div>
            <i id="user-chevron" data-lucide="chevron-down" class="w-4 h-4 transition-transform {{ in_array($seg, $userSegs) ? 'rotate-180' : '' }}"></i>
          </button>
          <div id="user-submenu" class="sidebar-submenu ml-7 mt-2 space-y-1 {{ in_array($seg, $userSegs) ? 'show' : '' }}">
            <a href="{{ route('admin.user') }}"
               class="block px-3 py-2 text-sm rounded-lg {{ in_array($seg, ['user','list-user']) ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Users</a>
            <a href="{{ route('admin.role') }}"
               class="block px-3 py-2 text-sm rounded-lg {{ in_array($seg, ['role','list-role']) ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Roles</a>
          </div>
        </div>
        @endrole
      </div>

      @role('pokja,kakom')
      <!-- Sekolah -->
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider my-3">Sekolah</p>

        @role('super-admin,pokja')
        <a href="{{ route('admin.periode') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'periode' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="calendar" class="w-4 h-4 mr-3"></i>
          Periode
        </a>

        @php $kelasSegs = ['konsentrasi-keahlian','program-keahlian','kelas']; @endphp
        <div class="mt-1">
          <button onclick="toggleSubmenu('kelas-submenu')"
                  aria-expanded="{{ in_array($seg, $kelasSegs) ? 'true' : 'false' }}"
                  class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg {{ in_array($seg, $kelasSegs) ? 'bg-gray-100' : 'hover hover:bg-gray-50' }}">
            <div class="flex items-center">
              <i data-lucide="graduation-cap" class="w-4 h-4 mr-3"></i>
              Kelas &amp; Jurusan
            </div>
            <i id="kelas-chevron" data-lucide="chevron-down" class="w-4 h-4 transition-transform {{ in_array($seg, $kelasSegs) ? 'rotate-180' : '' }}"></i>
          </button>
          <div id="kelas-submenu" class="sidebar-submenu ml-7 mt-2 space-y-1 {{ in_array($seg, $kelasSegs) ? 'show' : '' }}">
            <a href="{{ route('admin.konsentrasi-keahlian') }}"
               class="block px-3 py-2 text-sm rounded-lg {{ $seg === 'konsentrasi-keahlian' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Konsentrasi Keahlian</a>
            <a href="{{ route('admin.program-keahlian') }}"
               class="block px-3 py-2 text-sm rounded-lg {{ $seg === 'program-keahlian' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Program Keahlian</a>
            <a href="{{ route('admin.kelas') }}"
               class="block px-3 py-2 text-sm rounded-lg {{ $seg === 'kelas' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Kelas</a>
          </div>
        </div>
        @endrole

        @role('super-admin,kakom,pokja,guru-pembimbing')
        <a href="{{ route('admin.peserta-didik') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'peserta-didik' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="id-card" class="w-4 h-4 mr-3"></i>
          Peserta Didik
        </a>
        @endrole

      </div>
      @endrole


      @role('pokja')
      <!-- Guru & TU -->
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider my-3">Guru dan TU</p>

        <a href="{{ route('admin.jabatan') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'jabatan' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="badge-check" class="w-4 h-4 mr-3"></i>
          Jabatan
        </a>

        <a href="{{ route('admin.golongan') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'golongan' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="layers" class="w-4 h-4 mr-3"></i>
          Golongan
        </a>

        <a href="{{ route('admin.status-kepegawaian') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'status-kepegawaian' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="users-2" class="w-4 h-4 mr-3"></i>
          Status Kepegawaian
        </a>

        <a href="{{ route('admin.guru') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg  {{ in_array($seg, ['guru']) ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="briefcase" class="w-4 h-4 mr-3"></i>
          Guru dan TU
        </a>
      </div>
      @endrole

      @role('pokja')
      <!-- DUDI -->
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider my-3">Dunia Usaha dan Industri</p>

        <a href="{{ route('admin.dudi') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ in_array($seg, ['dudi']) ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="factory" class="w-4 h-4 mr-3"></i>
          Data Dudi
        </a>

        <a href="{{ route('admin.instruktur-dudi') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'instruktur-dudi' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="user-cog" class="w-4 h-4 mr-3"></i>
          Instruktur Dudi
        </a>
        @role('pokja')
        <a href="{{ route('admin.pengajuan-dudi') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'pengajuan-dudi' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="file-plus-2" class="w-4 h-4 mr-3"></i>
          Pengajuan Dudi
        </a>
        @endrole
      </div>
      @endrole

      @role('pokja,guru-pembimbing,kakom,instruktur-dudi')
      <!-- PKL -->
      @php 
        $pklSegs = ['pkl','pengajuan-pkl'];
        $pembimbingSegs = ['pengajuan-pembimbing', 'verifikasi-pembimbing']; 
      @endphp
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider my-3">Praktek Kerja Lapangan</p>

        <div class="mt-1">
          @role('kakom,pokja,guru-pembimbing,instruktur-dudi')
          <button onclick="toggleSubmenu('pkl-submenu')"
                  aria-expanded="{{ in_array($seg, $pklSegs) ? 'true' : 'false' }}"
                  class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg {{ in_array($seg, $pklSegs) ? 'bg-gray-100' : 'hover hover:bg-gray-50' }}">
            <div class="flex items-center">
              <i data-lucide="briefcase-business" class="w-4 h-4 mr-3"></i>
              PKL
            </div>
            <i id="pkl-chevron" data-lucide="chevron-down" class="w-4 h-4 transition-transform {{ in_array($seg, $pklSegs) ? 'rotate-180' : '' }}"></i>
          </button>
          @endrole
          <div id="pkl-submenu" class="sidebar-submenu ml-7 mt-2 space-y-1 {{ in_array($seg, $pklSegs) ? 'show' : '' }}">
            
            @role('kakom,pokja,guru-pembimbing,instruktur-dudi')
            <a href="{{ route('admin.pkl') }}"
               class="block px-3 py-2 text-sm rounded-lg  {{ in_array($seg, ['pkl', 'pkl-add']) ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Data PKL
            </a>
            @endrole

            @role('pokja')
            <a href="{{ route('admin.pengajuan-pkl') }}"
               class="block px-3 py-2 text-sm rounded-lg {{ $seg === 'pengajuan-pkl' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Pengajuan PKL
            </a>
            @endrole

          </div>
        </div>

        @role('pokja,guru-pembimbing')
        <div class="mt-1">
          <button onclick="toggleSubmenu('pembimbing-submenu')"
                  aria-expanded="{{ in_array($seg, $pembimbingSegs) ? 'true' : 'false' }}"
                  class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg {{ in_array($seg, $pembimbingSegs) ? 'bg-gray-100' : 'hover hover:bg-gray-50' }}">
            <div class="flex items-center">
              <i data-lucide="monitor-cog" class="w-4 h-4 mr-3"></i>
              Pembimbing
            </div>
            <i id="pembimbing-chevron" data-lucide="chevron-down" class="w-4 h-4 transition-transform {{ in_array($seg, $pembimbingSegs) ? 'rotate-180' : '' }}"></i>
          </button>
          <div id="pembimbing-submenu" class="sidebar-submenu ml-7 mt-2 space-y-1 {{ in_array($seg, $pembimbingSegs) ? 'show' : '' }}">
            @role('guru-pembimbing')
            <a href="{{ route('admin.pengajuan-pembimbing') }}"
               class="block px-3 py-2 text-sm rounded-lg {{ $seg === 'pengajuan-pembimbing' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Pengajuan
            </a>
            @endrole
            <a href="{{ route('admin.verifikasi-pembimbing') }}"
               class="block px-3 py-2 text-sm rounded-lg {{ $seg === 'verifikasi-pembimbing' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Verifikasi
            </a>
          </div>
        </div>
        @endrole

        @role('guru-pembimbing,instruktur-dudi')
        <a href="{{ route('admin.presensi') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'presensi' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="check-square" class="w-4 h-4 mr-3"></i>
          Review Presensi
        </a>
        <a href="{{ route('admin.tugas') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'tugas' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="clipboard-list" class="w-4 h-4 mr-3"></i>
          Review Tugas
        </a>
        @endrole

        @role('kakom,pokja,guru-pembimbing')
        @php $monSegs = ['uraian-monitoring','monitoring-siswa', 'monitoring-siswa-detail']; @endphp
        <div class="mt-1 hidden fitur">
          <button onclick="toggleSubmenu('monitoring-submenu')"
                  aria-expanded="{{ in_array($seg, $monSegs) ? 'true' : 'false' }}"
                  class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg {{ in_array($seg, $monSegs) ? 'bg-gray-100' : 'hover hover:bg-gray-50' }}">
            <div class="flex items-center">
              <i data-lucide="monitor-check" class="w-4 h-4 mr-3"></i>
              Monitoring
            </div>
            <i id="monitoring-chevron" data-lucide="chevron-down" class="w-4 h-4 transition-transform {{ in_array($seg, $monSegs) ? 'rotate-180' : '' }}"></i>
          </button>
          <div id="monitoring-submenu" class="sidebar-submenu ml-7 mt-2 space-y-1 {{ in_array($seg, $monSegs) ? 'show' : '' }}">
            <a href="{{ route('admin.uraian-monitoring') }}"
               class="block px-3 py-2 text-sm rounded-lg {{ $seg === 'uraian-monitoring' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Uraian Monitoring</a>
            <a href="{{ route('admin.monitoring-siswa') }}" class="block px-3 py-2 text-sm rounded-lg {{ in_array($seg, ['monitoring-siswa-detail','monitoring-siswa']) ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Monitoring Siswa</a>
          </div>
        </div>
        @endrole
      </div>
      @endrole

      @role('kakom,guru-pembimbing,instruktur-dudi')
      <!-- Penilaian -->
      @php $ujianSegs = ['kriteria-ujian','penilaian-ujian-detail','penilaian-ujian']; @endphp
      @php $obsSegs = ['tp','atp', 'kttp','lembar-observasi', 'lembar-observasi-detail']; @endphp
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider my-3">Penilaian</p>

        <div class="mt-1 hidden fitur">
          <button onclick="toggleSubmenu('ujian-submenu')"
                  aria-expanded="{{ in_array($seg, $ujianSegs) ? 'true' : 'false' }}"
                  class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg {{ in_array($seg, $ujianSegs) ? 'bg-gray-100' : 'hover hover:bg-gray-50' }}">
            <div class="flex items-center">
              <i data-lucide="trophy" class="w-4 h-4 mr-3"></i>
              Ujian Akhir
            </div>
            <i id="ujian-chevron" data-lucide="chevron-down" class="w-4 h-4 transition-transform {{ in_array($seg, $ujianSegs) ? 'rotate-180' : '' }}"></i>
          </button>
          <div id="ujian-submenu" class="sidebar-submenu ml-7 mt-2 space-y-1 {{ in_array($seg, $ujianSegs) ? 'show' : '' }}">
            <a href="{{ route('admin.kriteria-ujian') }}"
               class="block px-3 py-2 text-sm rounded-lg {{ $seg === 'kriteria-ujian' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Kriteria Ujian</a>
            <a href="{{ route('admin.penilaian-ujian') }}" class="block px-3 py-2 text-sm rounded-lg {{ in_array($seg, ['penilaian-ujian-detail','penilaian-ujian']) ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Penilaian</a>
          </div>
        </div>

        <div class="mt-1">
          <button onclick="toggleSubmenu('observasi-submenu')"
                  aria-expanded="{{ in_array($seg, $obsSegs) ? 'true' : 'false' }}"
                  class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg {{ in_array($seg, $obsSegs) ? 'bg-gray-100' : 'hover hover:bg-gray-50' }}">
            <div class="flex items-center">
              <i data-lucide="file-search" class="w-4 h-4 mr-3"></i>
              Lembar Observasi
            </div>
            <i id="observasi-chevron" data-lucide="chevron-down" class="w-4 h-4 transition-transform {{ in_array($seg, $obsSegs) ? 'rotate-180' : '' }}"></i>
          </button>
          <div id="observasi-submenu" class="sidebar-submenu ml-7 mt-2 space-y-1 {{ in_array($seg, $obsSegs) ? 'show' : '' }}">
            @role('kakom')
            <a href="{{ route('admin.tp') }}"
               class="block px-3 py-2 text-sm rounded-lg  {{ in_array($seg, ['tp','atp', 'kttp']) ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">TP ATP KTTP</a>
            @endrole
            @role('guru-pembimbing,instruktur-dudi')
            <a href="{{ route('admin.lembar-observasi') }}" class="block px-3 py-2 text-sm rounded-lg {{ in_array($seg, ['lembar-observasi', 'lembar-observasi-detail']) ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Lembar Observasi</a>
            @endrole
          </div>
        </div>
      </div>
      @endrole

      <!-- Surat -->
      @php $suratSegs = ['surat-tugas','sppd', 'surat-permohonan-pkl']; @endphp
      <div class="mb-6 hidden fitur">
        <p class="text-xs font-medium uppercase tracking-wider my-3">Surat</p>

        <div class="mt-1">
          <button onclick="toggleSubmenu('surat-submenu')"
                  aria-expanded="{{ in_array($seg, $suratSegs) ? 'true' : 'false' }}"
                  class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg {{ in_array($seg, $suratSegs) ? 'bg-gray-100' : 'hover hover:bg-gray-50' }}">
            <div class="flex items-center">
              <i data-lucide="files" class="w-4 h-4 mr-3"></i>
              Cetak Surat
            </div>
            <i id="surat-chevron" data-lucide="chevron-down" class="w-4 h-4 transition-transform {{ in_array($seg, $suratSegs) ? 'rotate-180' : '' }}"></i>
          </button>
          <div id="surat-submenu" class="sidebar-submenu ml-7 mt-2 space-y-1 {{ in_array($seg, $suratSegs) ? 'show' : '' }}">
            <a href="{{ route('admin.surat-tugas') }}" class="block px-3 py-2 text-sm rounded-lg {{ $seg === 'surat-tugas' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Surat Tugas</a>
            <a href="{{ route('admin.surat-permohonan-pkl') }}" class="block px-3 py-2 text-sm rounded-lg {{ $seg === 'surat-permohonan-pkl' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Surat Permohonan PKL</a>
          </div>
        </div>
      </div>

      @role('kakom,pokja,guru-pembimbing')
      <!-- Lainnya -->
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider my-3">Lain-lain</p>

        <a href="{{ route('admin.pengumuman') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'pengumuman' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="megaphone" class="w-4 h-4 mr-3"></i>
          Pengumuman
        </a>

        <a href="{{ route('admin.download') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'download' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }} hidden fitur">
          <i data-lucide="download" class="w-4 h-4 mr-3"></i>
          Download
        </a>

      </div>

      @php $helpSegs = ['format-import','hak-akses']; @endphp
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider my-3">Help</p>

        <div class="mt-1">
          <button onclick="toggleSubmenu('help-submenu')"
                  aria-expanded="{{ in_array($seg, $helpSegs) ? 'true' : 'false' }}"
                  class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg {{ in_array($seg, $helpSegs) ? 'bg-gray-100' : 'hover hover:bg-gray-50' }}">
            <div class="flex items-center">
              <i data-lucide="message-circle-question-mark" class="w-4 h-4 mr-3"></i>
              Bantuan
            </div>
            <i id="help-chevron" data-lucide="chevron-down" class="w-4 h-4 transition-transform {{ in_array($seg, $helpSegs) ? 'rotate-180' : '' }}"></i>
          </button>
          <div id="help-submenu" class="sidebar-submenu ml-7 mt-2 space-y-1 {{ in_array($seg, $helpSegs) ? 'show' : '' }}">
            <a href="{{ route('admin.format-import') }}"
              class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'format-import' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
              Format Import
            </a>
            <a href="{{ route('admin.hak-akses') }}"
              class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'hak-akses' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }} hidden fitur">
              Hak Akses
            </a>
          </div>
        </div>
      </div>
      @endrole

      <!-- System -->
      @role('super-admin')
      @php $sysSegs = ['web-setting','error-log','report-bug']; @endphp
      <div class="mb-6">
        <p class="text-xs font-medium uppercase tracking-wider my-3">System</p>

        <div class="mt-1">
          <button onclick="toggleSubmenu('system-submenu')"
                  aria-expanded="{{ in_array($seg, $sysSegs) ? 'true' : 'false' }}"
                  class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg {{ in_array($seg, $sysSegs) ? 'bg-gray-100' : 'hover hover:bg-gray-50' }}">
            <div class="flex items-center">
              <i data-lucide="settings" class="w-4 h-4 mr-3"></i>
              System
            </div>
            <i id="system-chevron" data-lucide="chevron-down" class="w-4 h-4 transition-transform {{ in_array($seg, $sysSegs) ? 'rotate-180' : '' }}"></i>
          </button>
          <div id="system-submenu" class="sidebar-submenu ml-7 mt-2 space-y-1 {{ in_array($seg, $sysSegs) ? 'show' : '' }}">
            @role('super-admin')
            <a href="{{ route('admin.error-log') }}"
            class="block px-3 py-2 text-sm rounded-lg {{ $seg === 'error-log' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Error Log</a>
            <a href="{{ route('admin.web-setting') }}"
               class="hidden fitur block px-3 py-2 text-sm rounded-lg {{ $seg === 'web-setting' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Web Setting</a>
            @endrole
            <a href="{{ route('admin.report-bug') }}"
               class="hidden fitur block px-3 py-2 text-sm rounded-lg {{ $seg === 'report-bug' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">Report Bug</a>
          </div>
        </div>
      </div>
      @endrole

      <div class="bottom-0 hidden fitur">
          <a href="{{ route('admin.about') }}"
           class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ $seg === 'about' ? 'text-white bg-gray-900' : 'hover hover:bg-gray-50' }}">
          <i data-lucide="info" class="w-4 h-4 mr-3"></i>
          About
        </a>
      </div>

    </nav>
  </div>
</aside>

<!-- overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden lg:hidden z-20" onclick="closeSidebar()"></div>