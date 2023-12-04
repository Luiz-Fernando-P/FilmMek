<?php

namespace App\ViewModels;

class ActorsViewModel
{
    public $popularActors;
    public $page;

    public function __construct($popularActors, $page)
    {
        $this->popularActors = $popularActors;
        $this->page = $page;
    }

    

    public function getPopularActors()
    {
        return collect($this->popularActors)->map(function ($actor) {
            return [
                'name' => $actor['name'],
                'id' => $actor['id'],
                'profile_path' => $actor['profile_path']
                    ? 'https://image.tmdb.org/t/p/w235_and_h235_face' . $actor['profile_path']
                    : 'https://ui-avatars.com/api/?size=235&name=' . $actor['name'],
                'known_for' => $this->getKnownFor($actor['known_for']),
            ];
        });
    }

    protected function getKnownFor($knownFor)
    {
        $movies = collect($knownFor)->where('media_type', 'movie')->pluck('title');
        $tvShows = collect($knownFor)->where('media_type', 'tv')->pluck('name');

        return $movies->merge($tvShows)->implode(', ');
    }

    public function getPreviousPage()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function getNextPage()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }
}
