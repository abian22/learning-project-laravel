<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $client = new Client();

        $response = $client->get('https://api.themoviedb.org/3/discover/movie', [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
                'page' => 1,
            ]
        ]);

        $first_page_movies = json_decode($response->getBody()->getContents(), true)['results'];

        $response = $client->get('https://api.themoviedb.org/3/discover/movie', [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
                'page' => 2,
            ]
        ]);

        $second_page_movies = json_decode($response->getBody()->getContents(), true)['results'];

        $response = $client->get('https://api.themoviedb.org/3/discover/movie', [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
                'page' => 3,
            ]
        ]);

        $third_page_movies = json_decode($response->getBody()->getContents(), true)['results'];

        $response = $client->get('https://api.themoviedb.org/3/discover/movie', [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
                'page' => 4,
            ]
        ]);

        $fourth_page_movies = json_decode($response->getBody()->getContents(), true)['results'];

        $all_movies = array_merge($first_page_movies, $second_page_movies, $third_page_movies, $fourth_page_movies);
        return view('index', ['movies' => $all_movies]);
    }
}
