<?php

namespace App\Http\Controllers;

use App\Models\Help_desk;
use App\Models\Rol;
use App\Models\User;
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
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->rol_id = $request->rol_id;
        $user->save();
        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'status' => 200
        ]);
    }

    public function getUserSessionData(Request $request){
        $userSessionData = $request->session()->get('user');
        if(!$userSessionData){
            return response()->json([
                'message' => 'No hay usuario en sesion',
                'status' => 401
            ]);
        }else{
            return response()->json([
                'user' => $userSessionData,
                'status' => 200
            ]);
        }
    }
}
