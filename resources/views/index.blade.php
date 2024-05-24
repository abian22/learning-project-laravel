<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movie list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div style="display: flex; flex-wrap:wrap;">
                    @foreach($movies as $movie)
                    <div style="flex: 0 0 calc(22.33% - 20px); margin: 10px; border:solid;">
                        <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" style="height:400px;"/>
                        <h2>{{ $movie['title'] }}</h2>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
