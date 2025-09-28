<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $user = Auth::user();

      if ($user && $user->hasRole('admin')) {
        return $next($request);
      }

      abort(403, 'Accès non autorisé ❌');
    }
}
