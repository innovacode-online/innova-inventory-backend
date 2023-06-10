<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login( LoginRequest $request ){
        $credentials = $request->validated();

        if( !Auth::attempt($credentials) ){
            return response([
                'message' => ['Correo o contraseña incorrectos']
            ],422);
        }

        $user = User::find(Auth::user()['id']);
        $token = $user->createToken('token')->plainTextToken;      

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    // REGISTRAR UN USUARIO
    public function register( RegisterRequest $request ){
        $request->validated();

        $user = User::create($request->all());
        $token = $user->createToken('token')->plainTextToken;      
        
        return [
            'user' => $user,
            'token' => $token
        ];
    }

    // CERRAR SESION
    public function logout( Request $request ){
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return $request;
    }
}
