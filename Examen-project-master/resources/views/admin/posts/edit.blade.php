<x-layout>
    <x-settings :heading="'Edit Post: ' . $post->title">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" type="text" :value="old('title', $post->title)"/>

            <x-form.input name="slug" type="text" :value="old('slug', $post->slug)"/>

            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)"/>
                </div>
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="ml-6 rounded-xl" width="100">
            </div>

            <x-form.textarea name="excerpt" value="$post->excerpt">{{ old('excerpt', $post->excerpt) }}</x-form.textarea>

            <x-form.textarea name="body" value="$post->body">{{ old('body', $post->body) }}</x-form.textarea>


            <x-form.field>
                <x-form.label name="category"/>
                    <select name="category_id" id="category_id">
                        @foreach (\App\Models\Category::all() as $category) {
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : ''}}>
                                {{ ucwords($category->name) }}</option>
                            }
                        @endforeach
                    </select>

                <x-form.error name="category" />
            </x-form.field>

            <x-form.submit-button> Update </x-form.submit-button>
        </form>
    </x-settings>
</x-layout>
