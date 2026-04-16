<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon">

    <title>{{ config('app.name') }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>

    <x-layouts.head-css />

</head>
<body class="bg-light overflow-hidden">
  <div class="flex">

        {{-- <x-layouts.sidebar /> --}}

        <div class="flex-1 lg:ml-0 relative overflow-hidden">
            <x-layouts.topbar />

            <main class="pt-[100px] px-6 pb-6 h-screen overflow-y-auto custom-scroll">
                <div id="dashboard-content">
                  {{ $slot }}  
                </div>
            </main>
            
        </div>
    </div>

    {{-- <x-layouts.logout-modal /> --}}

    <x-layouts.scripts />

    <x-layouts.toast />

    <x-layouts.alert />

    @stack('scripts')

</body>
</html>