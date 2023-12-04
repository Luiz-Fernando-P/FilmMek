@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-12 pt-16">
        
        <div class="now-playing-movies">
            <h2 class="uppercase tracking-wider text-[#00eeff] text-2xl font-semibold">Now Playing</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($nowPlayingMovies as $movie)
                <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div> <!-- end now-playing-movies -->
        
        <div class="popular-movies py-16">
            <h2 class="uppercase tracking-wider text-[#00eeff] text-2xl font-semibold">Popular Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach

            </div>
        </div> <!-- end pouplar-movies -->

        <div class="now-playing-movies py-16">
            <h2 class="uppercase tracking-wider text-[#00eeff] text-2xl font-semibold">Top Rated Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($topRated as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div>  
    </div>        
    
@endsection
