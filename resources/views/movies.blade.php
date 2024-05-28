<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movie list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div style="display: flex; flex-wrap: wrap;">
                    @foreach ($movies as $movie)
                        <div
                            style="display: flex; flex-direction: column; justify-content: space-between; flex: 0 0 calc(22.33% - 20px); margin: 10px;  height: 100%; padding:20px;">
                            <div>
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie->poster_path }}"
                                    style="height: 400px; width: 100%; object-fit: cover;" />
                                <h2>{{ $movie->title }}</h2>
                            </div>
                            <form action="{{ route('movies.save') }}" method="post">
                                @csrf
                                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                @if ($movie->isSaved)
                                    <button type="submit"
                                        style="display: flex; justify-content: center; align-items: center; margin-top: 10%; border:1px solid; border-radius:10px; background-color:rgb(255, 69, 0); width:100%;"
                                        onmouseover="this.style.backgroundColor='rgb(255, 0, 0)'"
                                        onmouseout="this.style.backgroundColor='rgb(255, 69, 0)'">Remove</button>
                                @else
                                    <button type="submit"
                                        style="display: flex; justify-content: center; align-items: center; margin-top: 10%; border:1px solid; border-radius:10px; background-color:rgb(17, 240, 17); width:100%;"
                                        onmouseover="this.style.backgroundColor='rgb(0, 320, 0)'"
                                        onmouseout="this.style.backgroundColor='rgb(17, 240, 17)'">Save</button>
                                @endif
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
