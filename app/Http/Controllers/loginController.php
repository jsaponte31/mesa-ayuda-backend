<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{

    protected $userController;
    protected $rolController;
    
    public function __construct()
    {
        $this->userController = new userController();
        $this->rolController = new rolController();
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales incorrectas','status' => 401]);
        }else{
            $user = $this->userController->buscarUsuarioporUsername($request->username)->original['user'];
            if($user->is_active == 0){
                return response()->json(['message' => 'Usuario inactivo', 'status' => 401]);
            }
            else{$token = $user->createToken('access')->plainTextToken;
                return response()->json([
                    'message' => 'Acceso exitoso', 
                    'user' => [
                        'id' => $user->id,
                        'username' => $user->username,
                        'name' => $user->name,        
                        'phone' => $user->phone,  
                        'rol' => $user->rol_id,  
                    ],
                    'token' => $token,                
                    'status' => 200                   
                ]);
            }
        }
    }

    public function register(Request $request)
    {
        $userexistente = $this->userController->buscarUsuarioporUsername($request->username)->original['user'];
        if(!$userexistente){
            $user = new User();
            $user->username = $request->username;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->rol_id = $this->rolController->buscarRolporNombre('USUARIO')->original['rol']->id;
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
