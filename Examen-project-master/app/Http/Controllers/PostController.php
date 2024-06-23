<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\Rules\Exists;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\Rule;


class PostController extends Controller
{
    public function index(){

        return view('posts.index',
            ['posts' => Post::latest()->filter(request(['search', 'category', 'author']))
            ->simplePaginate(6)->withQueryString(),
        ]);
    }

    public function show(post $post){
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create(){
        return view('user.posts.create');
    }

    public function store(Request $request){

        $attributes = $request->validate([
            'title' => 'required',
            'thumbnail' => $request->exists ? 'image|required' : 'required|image',
            'excerpt' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($request->post)],
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = request()->user()->id;
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);

        return redirect('/');
    }

    protected function validatePost(Post $post = null): array{
        $post ?? new Post();
        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] :['required','image'],
            'excerpt' => 'required',
            'slug' => ['required', Rule::Unique('posts', 'slug')->ignore($post)],
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
