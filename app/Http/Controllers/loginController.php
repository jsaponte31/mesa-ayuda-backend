<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class loginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales incorrectas','status' => 401]);
        }else{
            $user = User::where('username', $request->username)->first();
            if($user->is_active == 0){
                return response()->json(['message' => 'Usuario inactivo', 'status' => 401]);
            }
            else{
                
                // $token = $user->createToken('access')->plainTextToken;
                $token = JWTAuth::attempt($credentials);
                $userSessionData  = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'name' => $user->name,        
                    'phone' => $user->phone,  
                    'rol' => $user->rol_id,  
                ];
                $request->session()->put('user', $userSessionData);//guardo datos del usuario en la sesion
                return response()->json([
                    'message' => 'Acceso exitoso', 
                    'user' => $userSessionData,
                    'token' => $token,                
                    'status' => 200                   
                ]);
            }
        }
    }

    public function register(Request $request)
    {
        $userexistente = User::where('username', $request->username)->first();
        if(!$userexistente){
            $user = new User();
            $user->username = $request->username;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->rol_id = Rol::where('name', 'USUARIO')->first()->id;
            $user->is_active = 0;
            $user->save();
            return response()->json(['message' => 'Registro exitoso', 'status' => 200]);
        }else{
            return response()->json(['message' => "Ya existe el nombre de usuario $userexistente->username", 'status' => 401]);
        }
    }

    public function logout(Request $request)
    {
        
        // $request->user()->
        JWTAuth::invalidate(JWTAuth::getToken());
    
        return response()->json(['message' => 'Cierre de sesion exitoso'], 200);
    }
}
