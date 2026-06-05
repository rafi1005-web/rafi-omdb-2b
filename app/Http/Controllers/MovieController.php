<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieService;
use App\Models\Favorite;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index(Request $request)
    {
        $keyword = $request->input('s', '');
        $movies = [];

        if ($keyword) {
            $movies = $this->movieService->searchMovies($keyword);
            session(['search_results' => $movies]);
        }

        return view('movies.index', compact('movies'));
    }

    public function detail($id)
    {
        $movie = $this->movieService->getMovieDetail($id);
        $isFavorited = Favorite::where('user_id', auth()->id())->where('imdb_id', $id)->exists();
        return view('movies.detail', compact('movie', 'isFavorited'));
    }

    public function listFavorites()
    {
        $favorites = Favorite::where('user_id', auth()->id())->get();
        return view('favoritemovie.favorites', compact('favorites'));
    }

    public function storeFavorite(Request $request)
    {
        $exists = Favorite::where('user_id', auth()->id())->where('imdb_id', $request->imdbID)->exists();

        if (!$exists) {
            Favorite::create([
                'user_id' => auth()->id(),
                'imdb_id' => $request->imdbID,
                'title' => $request->title,
                'poster' => $request->poster,
                'year' => $request->year,
                'type' => $request->type,
            ]);

            $cleanTitle = html_entity_decode($request->title, ENT_QUOTES, 'UTF-8');

            if (app()->getLocale() == 'id') {
                $message = $cleanTitle . ' telah ditambahkan ke favorit!';
            } else {
                $message = $cleanTitle . ' has been added to favorites!';
            }

            return back()->with('success', $message);
        }

        $cleanTitle = html_entity_decode($request->title, ENT_QUOTES, 'UTF-8');

        if (app()->getLocale() == 'id') {
            $message = 'Film ' . $cleanTitle . ' sudah ada di daftar favorit Anda.';
        } else {
            $message = 'Movie ' . $cleanTitle . ' is already in your favorites list.';
        }

        return back()->with('warning', $message);
    }

    public function destroyFavorite($id)
    {
        $favorite = Favorite::where('user_id', auth()->id())->where('imdb_id', $id)->first();

        if ($favorite) {
            $title = $favorite->title;
            $favorite->delete();

            $cleanTitle = html_entity_decode($title, ENT_QUOTES, 'UTF-8');

            if (app()->getLocale() == 'id') {
                $message = $cleanTitle . ' telah dihapus dari favorit!';
            } else {
                $message = $cleanTitle . ' has been removed from favorites!';
            }

            return redirect()->route('movies.favorite')->with('success', $message);
        }

        if (app()->getLocale() == 'id') {
            $message = 'Film tidak ditemukan di daftar favorit.';
        } else {
            $message = 'Movie not found in favorites list.';
        }

        return redirect()->route('movies.favorite')->with('error', $message);
    }
}
