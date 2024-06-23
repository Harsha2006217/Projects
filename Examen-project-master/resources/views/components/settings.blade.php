
@props(['heading'])
{{--    auth jan-Pieter
        GUI met routes voor admins
--}}

<section class="px-6 py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">{{ $heading }}</h1>
    <div class="flex">
        <aside class="w-48 flex-shrink-0">
            <h4 class="font-semibold mb-4">links</h4>
            <ul>
                <li>
                    <a href="/admin/posts" class="{{ request()->is('admin/posts') ? 'text-blue-500' : '' }}"> All Posts</a>
                </li>
                <li>
                    <a href="/user/posts/create" class="{{ request()->is('user/posts/create') ? 'text-blue-500' : '' }}">New Post</a>
                </li>
                <li>
                    <a href="#" class="{{ request()->is('#') ? 'text-blue-500' : 'text-gray-400 pointer-events-none' }}" id='mylink'> My Posts</a>
                </li>
                <li>
                    <a href="#" class="{{ request()->is('#') ? 'text-blue-500' : 'text-gray-400 pointer-events-none' }}" id='mylink'> Saved posts</a>
                </li>
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>
