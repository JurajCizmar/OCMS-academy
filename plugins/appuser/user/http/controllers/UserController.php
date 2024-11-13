<?php namespace AppUser\User\Http\Controllers;

use AppUser\User\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use AppUser\User\Http\Resources\UserResource;
use October\Rain\Exception\ApplicationException as ApplicationException;

class UserController extends Controller
{
    public function registerNewUser(Request $request)
    {
        $user = new User;
        $user->username = input('username');
        $user->password = input('password');
        $user->token = base64_encode(random_bytes(64));
        $user->save();
        
        return response()->json(['message' => "You have been successfully registered"]);
    }

    public function login(Request $request)
    {
        $username = input('username');
        $password = input('password');

        $user = User::where('username', $username)->firstOrFail();
        $hashedPassword = $user->password;

        if (Hash::check($password, $hashedPassword)) {

            if ($user->token == NULL){
                $user->token = base64_encode(random_bytes(64));
                $user->save();
            }

            return response()->json([
                'message' => "Login successful",
                'token' => $user->token,
            ]);

        } else {
            throw new ApplicationException('Login failed');
        }
    }

    public function logout(Request $request)
    {
        $username = input('username');
        $user = User::where('username', $username)->firstOrFail();

        if ($user->token != NULL) {
            $user->token = NULL;
            $user->save();
            return response()->json(['message' => "You've been logged out"]);
        }
    }

    public function getAllUsers()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    public function deleteUsers()
    {
        User::truncate();
        return response()->json(['message' => "Users deleted successfully"]);
    }
}