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
        $username = $request->input('username'); // REVIEW - stačí input('username') :D
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
            // REVIEW - V prípadoch kde nastala chyba (napr. kvôli zlým údajom) treba hodiť Exception, ale super, kód 401 je správny pre túto situáciu
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
            // REVIEW - Toto ako myslíš? Resp. prečo si sa rozhodol pre redirect()?
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
        $user = UserService::getUserByToken($token); // REVIEW - Usera ktorého nájdeš nakoniec nepoužiješ, buď treba zmazať práve tohto jedného namiesto všetkých alebo to tu proste netreba

        User::truncate();
        return response()->json(['message' => "Users deleted successfully"]);
    }
}