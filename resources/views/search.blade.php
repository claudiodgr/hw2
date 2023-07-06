<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    @push('scripts')
        <script src="{{ asset('js/search.js') }}" defer></script>
        <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    @endpush


    <div class="body-container bg-gray-100 dark:bg-gray-900">
        <div class="wrapper">
            <form class="search-form" action="javascript:void(0);">
                <input type="text" placeholder="Search Deezer playlists..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

    </div>
    <div class="results-container bg-gray-100 dark:bg-gray-900"></div>


</x-app-layout>
