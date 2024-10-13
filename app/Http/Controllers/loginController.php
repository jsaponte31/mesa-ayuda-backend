<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales incorrectas','status' => 401]);
        }else{
            $user = User::where('username', $request->username)->first(); 
            $token = $user->createToken('access')->plainTextToken;
            return response()->json([
                'message' => 'Acceso exitoso', 
                'user' => [
                    'username' => $user->username,
                    'name' => $user->name,        
                    'phone' => $user->phone,      
                ],
                'token' => $token,                
                'status' => 200                   
            ]);
        }
    }

    public function register(Request $request)
    {
        $userexistente = User::where('username', $request->username)->first();
        if(!$userexistente){
            $user = new User();
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->name = $request->name;
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
        
        $request->user()->currentAccessToken()->delete();
    
        return response()->json(['message' => 'Cierre de sesion exitoso'], 200);
    }
}
