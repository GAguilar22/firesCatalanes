<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAccessKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtenim l’API-KEY que envia l’usuari
        $key = $request->headers->get('api-key');
        // Comprovem si coincideix amb en valor desat a la nostra aplicació
        if (isset($key) && $key == env('API_KEY')) {
            return $next($request);
        } else {
            // Si falla retornem un error en format JSON
            return response()->json(['error' => 'unauthorized' ], 401);
        }
    }
}
