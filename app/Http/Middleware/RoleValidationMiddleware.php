<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleValidationMiddleware
{
    public function handle(Request $request, \Closure $next, ...$roles): Response
    {
        $user = \Auth::user();

        if (empty($user)) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        if (!$user->hasAnyOfRoles($roles)) {
            $number = count($roles);

            return response()->json([
                'message' => sprintf('Forbidden. %s %s required', implode(', ', $roles), \Str::plural('role', $number)),
            ], 403);
        }

        return $next($request);
    }
}
