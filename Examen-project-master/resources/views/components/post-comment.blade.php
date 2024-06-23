@props(['comment'])
{{--    auth jan-Pieter
        frontend voor comments bij posts.
--}}

<x-panel class="bg-gray-200">
<article class="flex space-x-4">
        <div style="flex-shrink: 0;"><img src="https://i.pravatar.cc/60?u={{ $comment->user_id }}" class="rounded-xl" width="60" height="60"></div>
        <div>
            <header class="mb-4">
                <h3 class="font-bold">
                    {{ $comment->author->name }}
                </h3>
                <p class="text-xs">Posted<time> {{ $comment->created_at}}</time></p>
            </header>
           <p> {{ $comment->body }}</p>
        </div>
    </article>
</x-panel>
