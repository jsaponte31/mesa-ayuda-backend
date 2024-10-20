<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    protected $help_deskController;
    protected $rolController;

    public function __construct()
    {
        $this->help_deskController = new help_deskController();
        $this->rolController = new rolController();
    }

    public function buscarUsuarios(){
        $users = User::all();
        $dataHelpDesk = $this->help_deskController->buscarMesasAyuda()->original['data'];
        $roles = $this->rolController->buscarRoles()->original['roles'];
        return response()->json([
            'users' => $users,
            'dataHelpDesk' => $dataHelpDesk,
            'roles' => $roles,
            'status' => 200
        ]);
    }

    public function buscarUsuarioporId($id){
        $user = User::find($id);
        return response()->json([
            'user' => $user,
            'status' => 200
        ]);
    }

    public function buscarUsuarioporUsername($username){
        $user = User::where('username', $username)->first();
        return response()->json([
            'user' => $user,
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
}
