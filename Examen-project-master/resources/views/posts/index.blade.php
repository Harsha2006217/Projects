<x-layout>
{{--    auth jan-Pieter
        index pagina frontend voor posts displayen
--}}
        @include('posts._header')

        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
            @if ($posts->count())

                <x-post-grid :posts="$posts"/>
                    {{$posts->links()}}

            @else
            <p class="text-center">No posts available :/</p>
            @endif
</x-layout>




