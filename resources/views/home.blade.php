<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    @push('scripts')
        <script src="{{ asset('js/home.js') }}" defer></script>
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    @endpush


    <div class="grid">
    </div>


</x-app-layout>
