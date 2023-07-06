<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Library') }}
        </h2>
    </x-slot>

    @push('scripts')
        <script src="{{ asset('js/mylibrary.js') }}" defer></script>
        <link href="{{ asset('css/mylibrary.css') }}" rel="stylesheet">
    @endpush


    <div class="user-container-wrapper">
        <div>
            <div class="user-container">
                <img src="{{ asset('storage/avatars/'.Auth::user()->avatar) }}" alt="User Profile Image" />
                <div class="textcontent-container dark:text-white">
                    <h4>{{auth()->user()->username}}</h4>
                </div>
            </div>
            <hr> <!-- this will add a horizontal line -->
        </div>
    </div>

    <div class="results-container">
    </div>


</x-app-layout>
