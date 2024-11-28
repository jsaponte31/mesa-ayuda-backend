<?php

namespace App\Http\Controllers;

use App\Models\Help_desk;
use App\Models\Rol;
use App\Models\Tecnico_mesas_relacion;
use App\Models\User;
use Tymon\JWTAuth\Contracts\Providers\Auth as authjwt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function buscarUsuarios(){
        $users = User::all();
        $dataHelpDesk = Help_desk::all();
        $roles = Rol::all();
        return response()->json([
            'users' => $users,
            'dataHelpDesk' => $dataHelpDesk,
            'roles' => $roles,
            'status' => 200
        ]);
    }

    public function crearUsuario(Request $request){
        $userexistente = User::where('username', $request->username)->first();
        if(!$userexistente){
            $user = new User();
            $user->username = $request->username;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->rol_id = $request->rol_id;
            $user->save();
            $rolname = Rol::find($request->rol_id)->name;
            if($rolname == 'TECNICO'){
                $tecnico_mesa = new Tecnico_mesas_relacion();
                $tecnico_mesa->tecnico_id = $user->id;
                $tecnico_mesa->help_desk_id = $request->help_desk_id;
                $tecnico_mesa->save();
            }
            return response()->json([
                'message' => 'Usuario creado exitosamente',
                'status' => 200
            ]);
        }else{
            return response()->json([
                'message' => "Ya existe el nombre de usuario $userexistente->username",
                'status' => 401
            ]);
        }
    }

    public function actualizarUsuario(Request $request){
        $user = User::find($request->id_user);
        $rolNameAnterior = Rol::find($user->rol_id)->name;
        $rolNameNuevo = Rol::find($request->rol_id)->name;
        if($rolNameAnterior == 'TECNICO'){
            $tecnico_mesa = Tecnico_mesas_relacion::where('tecnico_id', $request->id_user)->first();
            $tecnico_mesa->delete();
        }
        if($rolNameNuevo == 'TECNICO'){
            $tecnico_mesa = new Tecnico_mesas_relacion();
            $tecnico_mesa->tecnico_id = $request->id_user;
            $tecnico_mesa->help_desk_id = $request->help_desk_id;
            $tecnico_mesa->save();
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->rol_id = $request->rol_id;
        $user->save();
        return response()->json([
            'message' => 'Usuario actualizado exitosamente',
            'status' => 200
        ]);
    }

    public function getUserSessionData(Request $request){
        $iduser = Auth::id();
        $user = User::find($iduser);
        $userSessionData  = [
            'id' => $user->id,
            'username' => $user->username,
            'name' => $user->name,        
            'phone' => $user->phone,  
            'rol' => $user->rol_id,  
        ];
        return response()->json([
            'user' => $userSessionData,
            'status' => 200                   
        ]);;
    }
}
