<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\UserMovie;
use Illuminate\Support\Facades\Auth;




class MovieController extends Controller
{
    public function movies()
    {
        $movies = Movie::all();
        $userId = Auth::id();

        $savedMovieIds = UserMovie::where('user_id', $userId)->pluck('movie_id')->toArray();

        $movies->each(function ($movie) use ($savedMovieIds) {
            $movie->isSaved = in_array($movie->id, $savedMovieIds);
        });

        return view('movies', ['movies' => $movies]);
    }

    public function savedMovies()
    {
        $userId = Auth::id();

        $saved_movies = UserMovie::where('user_id', $userId)->with('movie')->get();

        return view('list', ['saved_movies' => $saved_movies]);
    }

    public function checkMovies()
    {
        $userId = Auth::id();
        $savedMovies = UserMovie::where('user_id', $userId)->pluck('movie_id')->toArray();

        $movies = Movie::all();

        $movies->each(function ($movie) use ($savedMovies) {
            $movie->isSaved = in_array($movie->id, $savedMovies);
        });

        return view('movies', compact('movies'));
    }

    // public function saveMovies(Request $request)
    // {
    //     $moviesData = $request->input('movies');

    //     foreach ($moviesData as $movieData) {
    //         $movie = new Movie();
    //         $movie->title = $movieData['title'];
    //         $movie->poster_path = $movieData['poster_path'];
    //         $movie->save();
    //     }

    //     return response()->json(['message' => 'Películas guardadas correctamente']);    }

    public function guardarPelicula(Request $request)
    {
        $movieId = $request->input('movie_id');
        $userId = auth()->user()->id;

        $userMovie = UserMovie::where('user_id', $userId)
            ->where('movie_id', $movieId)
            ->first();

        if ($userMovie) {
            $userMovie->delete();
            return back()->with('message', 'Película eliminada');
        } else {
            $userMovie = new UserMovie();
            $userMovie->user_id = $userId;
            $userMovie->movie_id = $movieId;
            $userMovie->save();
            return back()->with('message', 'Película guardada');
        }
    }

    public function removeFilm(Request $request)
    {
        $movieId = $request->input('movie_id');
        $userId = auth()->user()->id;

        $userMovie = UserMovie::where('user_id', $userId)
            ->where('movie_id', $movieId)
            ->first();
            if ($userMovie) {
                $userMovie->delete();
                return redirect()->route('list')->with('success', 'Película eliminada de la lista');            }
    }
}
