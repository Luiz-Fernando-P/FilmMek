<?php

namespace App\ViewModels;

use Carbon\Carbon;

class TvShowViewModel
{
    public $tvshow;

    public function __construct($tvshow)
    {
        $this->tvshow = $tvshow;
    }

    public function tvshow()
    {
        return $this->formatTvShow($this->tvshow);
    }

    private function formatTvShow($tvshow)
    {
        return collect($tvshow)->merge([
            'poster_path' => $tvshow['poster_path']
                ? 'https://image.tmdb.org/t/p/w500/' . $tvshow['poster_path']
                : 'https://via.placeholder.com/500x750',
            'vote_average' => $tvshow['vote_average'] * 10 . '%',
            'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
            'genres' => collect($tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'cast' => collect($tvshow['credits']['cast'])->take(5)->map(function ($cast) {
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path']
                        ? 'https://image.tmdb.org/t/p/w300' . $cast['profile_path']
                        : 'https://via.placeholder.com/300x450',
                ]);
            }),
            'images' => collect($tvshow['images']['backdrops'])->take(9),
        ])->only([
            'poster_path', 'id', 'genres', 'name', 'vote_average', 'overview', 'first_air_date', 'credits',
            'videos', 'images', 'crew', 'cast', 'images', 'created_by'
        ]);
    }
}
