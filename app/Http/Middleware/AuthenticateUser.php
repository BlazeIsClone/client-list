<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\UserClaims;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    use UserClaims;

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): JsonResponse | Response | RedirectResponse
    {
        $user = User::where([
            'uuid' => $this->getUserUUID(),
        ])->first();

        if ($user) {
            Auth::login($user);
        } else {
            $user = User::create([
                'uuid' => $this->getUserUUID(),
            ]);

            Auth::login($user);
        }

        return $next($request);
    }
}
