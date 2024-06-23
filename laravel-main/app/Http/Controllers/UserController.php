<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\User;

class UserController extends Controller
{
    //get the data from the user
    public function me(Request $request)
    {
        $token = $request->bearerToken();
        $userId = Cache::get($token);
        $user = $request->user()->where("id", $userId);

        return response()->json(['user' => $user]);
    }

    //function to create a new user in the application itself (only accessible for admin in the future)
    public function CreateUser(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:255|confirmed',
            'is_admin' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

        $isAdmin = $request->input('is_admin', false);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $isAdmin,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            'status' => Response::HTTP_CREATED
        ]);
    }

    // Function to get all users (only accessible for admin in the future)
    public function getAllUsers(Request $request)
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }
}
