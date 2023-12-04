<?php

namespace App\ViewModels;

use Carbon\Carbon;

class MoviesViewModel
{
    public $popularMovies;
    public $nowPlayingMovies;
    public $topRated;
    public $genres;

    public function __construct($popularMovies, $nowPlayingMovies, $genres, $topRated)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->topRated = $topRated;
        $this->genres = $genres;
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    public function topRated()
    {
        return $this->formatMovies($this->topRated);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovies($movies)
    {
        return collect($movies)->map(function ($movie) {
            $genresFormatted = [];
    
            if (isset($movie['genre_ids']) && is_array($movie['genre_ids'])) {
                $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                    return [$value => $this->genres()->get($value)];
                })->toArray();
            }
    
            $posterPath = isset($movie['poster_path']) ? 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] : 'https://via.placeholder.com/500x750';
    
            $voteAverage = isset($movie['vote_average']) && !is_bool($movie['vote_average']) ? $movie['vote_average'] * 10 . '%' : 'N/A';
    
            return collect($movie)->merge([
                'poster_path' => $posterPath,
                'vote_average' => $voteAverage,
                'release_date' => isset($movie['release_date']) ? Carbon::parse($movie['release_date'])->format('M d, Y') : '',
                'genres' => implode(', ', $genresFormatted), // Use implode on the array
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            ]);
        });
    }
}
