<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function CreatePost(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|string|max:255',
            'excerpt' => 'required|min:3|string|max:255',
            'body' => 'required|string|min:8|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

        $token = $request->bearerToken();
        $userId = Cache::get($token);

        $post = Post::create([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'user_id' => $userId,
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post,
            'status' => Response::HTTP_ACCEPTED]);
    }


        public function viewUserPost(Request $request){

            $validator = Validator::make($request->all(), [
                'email' => 'required|min:3|email|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors(),
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }

            $user = User::where('email', $request->email)->first();
            $posts = $user->posts;

            return response()->json([
                'message' => 'Post fetched successfully',
                'posts' => $posts,
                'status' => Response::HTTP_ACCEPTED]);
    }
}
