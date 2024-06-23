<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;


// auth Jan-Pieter Ott
// Deze controller is verantwoordelijk voor de functies van gebruikers die de admin status behouden
//

class AdminPostController extends Controller
{
    //weergeev posts voor admins
    public function index(){
        return view('admin.posts.index',[
            'posts' => Post::paginate(50)
        ]);
    }

    // deze functie is verantwoordelijk voor het weergeven van een form waarmee een admin een post kan aanmaken
    public function create(){
        return view('admin.posts.create');
    }

    //deze functie is verantwoordelijk voor het opslaan van posts gegevens door admins
    public function store(){

        $attributes = array_merge($this->validatePost(),[
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
            ]);

        Post::create($attributes);

        return redirect('/');
    }


    //deze functie is verantwoordelijk voor het weergeven van formulier waarmee een admin posts kan aanpassen
    public function edit(Post $post){
        return view('admin.posts.edit',[
            'post' => $post]);
    }


    //deze functie is verantwoordelijk voor het opslaan van post updates uitgevoerd door admins
    public function update(Post $post){

        //valideer gegevens
        $attributes = $this->validatePost(new Post());

        if ($attributes['thumbnail'] ?? false){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        //update gegevens
        $post->update($attributes);

        return back()->with('success', 'Post was successfully updated!');

    }

    // verwijder - delete een post
    public function destroy(Post $post){
        $post->delete();

        return back()->with('success', 'post Deleted');
    }

    //code voor post validatie
    protected function validatePost(Post $post = null): array{

        $post ?? new Post();
        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exist ? ['image'] :['required','image'],
            'excerpt' => 'required',
            'slug' => ['required', Rule::Unique('posts', 'slug')->ignore($post)],
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
