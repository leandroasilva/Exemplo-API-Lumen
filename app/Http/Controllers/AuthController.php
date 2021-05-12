<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function jwt(User $user)
    {
        $payload = [
            'iss' => 'lumen-jwt',
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60*60
        ];
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function autenticate(User $user)
    {
        $this->validate($this->request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $this->request->input('email'))->first();
        if(!$user){
            return response()->json([
                'error'  => 'e-mail não existe'
            ], 400);
        }

        if(Hash::check($this->request->input('password'), $user->password)){
            return response()->json([
                'usuario' => $user,
                'token' => $this->jwt($user)
            ], 200);
        }

        return response()->json([
            'error' => 'e-mail ou senha inválidos'
        ], 400);
    }
}