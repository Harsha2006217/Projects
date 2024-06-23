<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthorizationController extends Controller
{

    // Function to register a new user
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:255|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => 0,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'success' => 'Signup successful!',
            'status' => Response::HTTP_ACCEPTED
        ]);
    }

        // Function to log in a user
        public function SignIn(Request $request)
        {
            $credentials = $request->only('email', 'password');

            if (!auth()->attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid credentials',
                    'status' => Response::HTTP_UNAUTHORIZED
                ]);
            }

            $token = Str::random(32);

            $userId = auth()->user()->id;
            Cache::put($token, "$userId", 1440);

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'status' => Response::HTTP_OK
            ]);
        }

        // Function to log out a user
        public function logout(Request $request)
        {
            $token = $request->token;

            Cache::forget($token);

            return response()->json([
                'message' => 'User logged out',
                'status' => Response::HTTP_ACCEPTED
            ]);
        }
}
