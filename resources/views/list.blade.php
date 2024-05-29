<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movie list') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="movie-container">
                    @foreach ($saved_movies as $movie)
                        <div
                        class="movie-card">
                            <div>
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie->movie->poster_path }}"
                                    style="height: 400px; width: 100%; object-fit: cover;" />
                                <h2>{{ $movie->movie->title }}</h2>
                            </div>
                            <form action="{{ route('list.delete') }}" method="post"> @csrf
                                @method('DELETE') 
                                <input type="hidden" name="movie_id" value={{ $movie["movie_id"] }}>
                                <button type="submit"
                                    style="display: flex; justify-content: center; align-items: center; margin-top: 10%; border:1px solid; border-radius:10px; background-color:rgb(255, 69, 0); width:100%;"
                                    onmouseover="this.style.backgroundColor='rgb(255, 0, 0)'"
                                    onmouseout="this.style.backgroundColor='rgb(255, 69, 0)'">Remove</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
