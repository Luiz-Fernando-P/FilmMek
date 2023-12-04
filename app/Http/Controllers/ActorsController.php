<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\ActorViewModel;
use App\ViewModels\ActorsViewModel;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);
    
        $response = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/popular?page=' . $page);
    
        $popularActors = $response->json()['results'];
    
        $viewModel = new ActorsViewModel($popularActors, $page);
    
        return view('actors.index', [
            'popularActors' => $viewModel->getPopularActors(),
            'page' => $viewModel->page,
            'previousPage' => $viewModel->getPreviousPage(),
            'nextPage' => $viewModel->getNextPage(),
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actor = $this->getTmdbData('https://api.themoviedb.org/3/person/' . $id);
        $social = $this->getTmdbData('https://api.themoviedb.org/3/person/' . $id . '/external_ids');
        $credits = $this->getTmdbData('https://api.themoviedb.org/3/person/' . $id . '/combined_credits');

        $viewModel = new ActorViewModel($actor, $social, $credits);

        return view('actors.show', [
            'actor' => $viewModel->actor(),
            'social' => $viewModel->social(),
            'knownForMovies' => $viewModel->knownForMovies(),
            'credits' => $viewModel->credits(),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getTmdbData($url)
    {
        $response = Http::withToken(config('services.tmdb.token'))
            ->get($url);

        return $response->json();
    }
}
