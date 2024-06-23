@auth
{{--    auth jan-Pieter
        GUI html form voor comments
--}}
    <x-panel>
        <form method="POST" action="/posts/{{ $post->slug }}/comments" class="">
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" class="rounded-full" width="40" height="40">
                <h2 class="ml-4">Want to participate?</h2>
            </header>
            <div class="mt-6 p-1 border border-grey-200 rounded-md">
                <textarea name="body"
                    required
                    class="shadow-black w-full text-sm focus:outline-none focus:ring"
                    rows="5" placeholder="type something :)">
                </textarea>
                    @error('body')
                        <span class="text-xs text-red"> {{ $message }} </span>
                    @enderror
            </div>
            <div class="flex justify-end mt-8 border-t border-gray-200 pt-6">
                <button type="submit" class="right bg-blue-500 text-xs rounded-2xl uppercase font-semibold px-10 hover:bg-blue-600 text-white py-2">Post</button>
            </div>
        </form>
    </x-panel>

@else
    <p class="font-semibold"><a href="/login">Log In<a> to comment</p>
@endauth
