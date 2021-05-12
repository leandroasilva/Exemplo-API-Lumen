<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('token');
        if(!$token){
            return response()->json([
                'error' => 'token nao informado'
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        }catch(ExpiredException $e){
            return response()->json([
                'error' => 'token expirado'
            ], 400);
        }catch(Exception $e){
            return response()->json([
                'error' => 'token inválido'
            ], 400);
        }
        
        // $user -> User::find();
        $request->auth = $credentials->sub;

        return $next($request);
    }
}
