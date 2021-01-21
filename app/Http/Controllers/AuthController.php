<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    
    public function __construct() {
    	$this->middleware('auth:api', ['except' => ['login']]);
    	$this->guard = 'api';
    }

    public function unauthorized() {
    	return response()->json(Response::HTTP_UNAUTHORIZED);
    }

    public function login() {

    	$credentials = request(['email', 'password']);

    	if (! $token = auth($this->guard)->attempt($credentials)) {
    		return response()->json(['error' => 'Unauthorized'], 401);
    	}

    	return $this->respondWithToken($token);

    }

    public function me() {
    	return response()->json(auth($this->guard)->user());
    }

    public function logout() {
    	auth($this->guard)->logout();
    	return response()->json(['message' => 'Sesión cerrada satisfactoriamente !']);
    }

    public function refresh() {
    	return $this->respondWithToken(auth($this->guard)->refresh());
    }

    protected function respondWithToken($token) {
    	return response()->json([
    		'access_token' => $token,
    		'token_type' => 'bearer',
    		'expires_in' => auth($this->guard)->factory()->getTTL() * 60
    	]);
    }

    public function user() {
        return Auth::user();
    }
}
