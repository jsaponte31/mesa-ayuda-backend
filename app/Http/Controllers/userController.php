<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    protected $help_deskController;

    public function __construct()
    {
        $this->help_deskController = new help_deskController();
    }

    public function buscarUsuarios(){
        $users = User::all();
        $dataHelpDesk = $this->help_deskController->buscarMesasAyuda()->original['data'];
        return response()->json([
            'users' => $users,
            'dataHelpDesk' => $dataHelpDesk,
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


}
