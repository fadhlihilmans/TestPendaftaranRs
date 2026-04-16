<!-- Top Navigation -->
<header class="floating-header elevated-header fixed top-0 right-0 left-0 lg:left-64 px-6 py-4 z-30 bg-light border-b border-light">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-light">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>

                    <a href="/pasien">Menu Pasien | </a>
                    <a href="/poli">Menu Poli | </a>
                    <a href="/dokter">Menu Dokter | </a>
                    <a href="/pendaftaran">Menu Pendaftaran</a>


        </div>
        
        <div class="flex items-center space-x-4">
            <!-- User Profile -->
            <div class="relative">
                <button onclick="toggleDropdown('profile-dropdown')" class="flex items-center space-x-1 p-2 bg-light rounded-lg hover:bg-gray-50">
                    <div class="w-8 h-8 bg-light border border-light rounded-full flex items-center justify-center">
                        {{-- <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=000&color=fff" class="rounded-full"> --}}
                    </div>
                    {{-- <span class="text-xs font-medium">{{ Str::limit(Auth::user()->name, 10, '...') }}</span> --}}
                    <img data-lucide="chevron-down" class="w-4 h-4"></img>
                </button>
                {{-- <div id="profile-dropdown" class="dropdown-menu absolute right-0 mt-2 w-48 bg-light border border-light rounded-lg shadow-lg z-50">
                    <a href="{{ route('admin.profile') }}" class="flex items-center px-4 py-2 text-sm hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                        Profile
                    </a>
                    <hr class="my-1">
                    <a herf="javascript:void(0)" onclick="openLogoutModal()" class="flex cursor-pointer items-center px-4 py-2 text-sm hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                        Logout
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
</header>