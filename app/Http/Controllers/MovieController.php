<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Favorite;

class MovieController extends Controller
{
    private $apiKey = '145ec45b';
    private $baseUrl = 'http://www.omdbapi.com/';


    public function index(Request $request)
    {
        $keyword = $request->input('s', '');
        $movies = [];

        if ($keyword) {
            $response = Http::get($this->baseUrl, [
                'apikey' => $this->apiKey,
                's' => $keyword
            ]);
            $movies = $response->successful() ? ($response->json()['Search'] ?? []) : [];
            session(['search_results' => $movies]);
        }

        return view('movies.index', compact('movies'));
    }


    public function allMovies()
    {
        $movies = session('search_results', []);
        return view('movies.all', compact('movies'));
    }


    public function detail($id)
    {
        $response = Http::get($this->baseUrl, [
            'i' => $id,
            'apikey' => $this->apiKey
        ]);
        $movie = $response->json();
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

        if (app()->getLocale() == 'id') {
            $message = 'Film "' . $request->title . '" sudah ada di daftar favorit Anda.';
        } else {
            $message = 'Movie "' . $request->title . '" is already in your favorites list.';
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
