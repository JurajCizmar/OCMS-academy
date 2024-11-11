<?php namespace AppUser\User\Http\Controllers;

use AppUser\User\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use AppUser\User\Http\Resources\UserResource;

class UserController extends Controller
{
    public function registerNewUser(Request $request)
    {
        $user = new User;
        $user->username = $request->input('username');
        $user->password = $request->input('password');
        $user->token = base64_encode(random_bytes(64));
        $user->save();

        // return UserResource::make($user);
        return response()->json(['message' => "You have been successfully registered"]);
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

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
            response()->json(['error' => 'Login failed'], 401);
        }
    }

    public function logout(Request $request)
    {
        // $username = post('username');
        $username = $request->input('username');
        $user = User::where('username', $username)->firstOrFail();

        if ($user->token != NULL) {
            $user->token = NULL;
            $user->save();
            return response()->json(['message' => "You've been logged out"]);

        } else {
            return redirect('/');
        }
    }

    public function getAllUsers()
    {
        $users = User::all();
        return UserResource::collection($users);
        // return ['data' => $users];
    }

    public function deleteUsers(Request $request)
    {
        $token = UserService::getTokenFromAuth($request);
        $user = UserService::getUserByToken($token);

        User::truncate();
        return response()->json(['message' => "Users deleted successfully"]);
    }
}