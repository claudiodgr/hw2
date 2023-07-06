<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    @push('scripts')
        <script>
            let profileImageUrlBase = "{{ asset('storage/avatars/') }}";
        </script>
        <script src="{{ asset('js/people.js') }}" defer></script>
        <link href="{{ asset('css/people.css') }}" rel="stylesheet">
    @endpush


    <div class="wrapper">
        <form class="search-form" action="javascript:void(0);">
            <input type="text" placeholder="Search Users..." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <div class="results-container">
        </div>
    </div>


</x-app-layout>
