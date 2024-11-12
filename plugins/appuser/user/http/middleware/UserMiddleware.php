<?php

namespace AppUser\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use AppUser\User\Http\Resources\UserService;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = UserService::getTokenFromAuth($request);

        if (!$token) {
            // REVIEW - taktiež, treba hodiť Exception
            return response()->json(['error' => 'Authorization failed'], 401);

        } else {
            $user = UserService::getUserByToken($token);
        }

        return $next($request);
    }
}