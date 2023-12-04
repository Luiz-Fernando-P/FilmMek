<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FilmMek</title>
    <link rel="icon" href="/img/logo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/main.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <livewire:styles />

</head>
<body class="font-sans bg-[#1f242d] text-white">
    <nav class="fixed w-full border-b border-gray-700 bg-[#1f242d] z-10">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between px-4 py-6">
            <ul class="flex flex-col md:flex-row items-center text-white">
                <li>
                    <a href="{{ route('movies.index') }}" class="flex items-center">
                        <h2 class="font-bold text-2xl">FilmMek</h2>
                    </a>
                </li>
                <li class="md:ml-16 mt-3 md:mt-0">
                    <a href="{{ route('movies.index') }}" class="{{ request()->routeIs('/') ? 'active:text-[#00eeff]' : 'hover:text-[#00eeff]' }}">Movies</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{ route('tv.index') }}" class="{{ request()->routeIs('tv.index') ? 'active:text-[#00eeff]' : 'hover:text-[#00eeff]' }}">TV Shows</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{ route('actors.index') }}" class="{{ request()->routeIs('actors.index') ? 'active:text-[#00eeff]' : 'hover:text-[#00eeff]' }}">Actors</a>
                </li>                              
            </ul>
            <div class="flex flex-col md:flex-row items-center">
                <livewire:search-dropdown>
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="#">
                        <img src="/img/avatar.png" alt="avatar" class="rounded-full w-8 h-8">
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="pt-60 md:pt-16 lg:pt-12 mx-auto">
        @yield('content')
    </div>
    <footer class="border border-t border-gray-800">
        <div class="container mx-auto text-sm px-4 py-6">
            Powered by <a href="https://www.themoviedb.org/documentation/api" class="underline hover:text-gray-300">TMDb API</a>
        </div>
    </footer>
    @yield('scripts')
    
    <livewire:scripts />
</body>
</html>
