
@props(['heading'])
{{--    auth jan-Pieter
        GUI met mogelijk toekomstige routes voor users
--}}

<section class="px-6 py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">{{ $heading }}</h1>
    <div class="flex">
        <aside class="w-48 flex-shrink-0">
            <h4 class="font-semibold mb-4">links</h4>
            @auth
            @admin
            <ul>
                <li>
                    <a href="/admin/posts" class="{{ request()->is('admin/posts') ? 'text-blue-500' : '' }}"> All Posts</a>
                </li>
                <li>
                    <a href="/user/posts/create" class="{{ request()->is('user/posts/create') ? 'text-blue-500' : '' }}">New Post</a>
                </li>
            </ul>
            @endadmin
            <ul>
                {{-- Deze frontend code is in de toekomst verantwoordelijk voor het laten zien van een UI die de mogelijkheid bied om zelf gemaakte posts aan te passen of verwijderen
                    of om opgeslagen post te bekijken tot de functionaliteit beschikbaaar is in de backend zijn de links er alleen pom te zorgen dat de UI er goed uitziet en zijn niet aanklikbaar--}}
                <li>
                    <a href="#" class="{{ request()->is('#') ? 'text-blue-500' : 'text-gray-400 pointer-events-none' }}" id='mylink'> My Posts</a>
                </li>
                <li>
                    <a href="#" class="{{ request()->is('#') ? 'text-blue-500' : 'text-gray-400 pointer-events-none' }}" id='mylink'> Saved posts</a>
                </li>
            </ul>
            @endauth
        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>

