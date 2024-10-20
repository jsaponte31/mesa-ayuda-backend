<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class rolController extends Controller
{
    public function buscarRoles(){
        $roles = Rol::all();
        return response()->json([
            'roles' => $roles,
            'status' => 200
        ]);
    }
    
    public function buscarRolporId($id){
        $rol = Rol::find($id);
        return response()->json([
            'rol' => $rol,
            'status' => 200
        ]);
    }

    public function buscarRolporNombre($nombre){
        $rol = Rol::where('name', $nombre)->first();
        return response()->json([
            'rol' => $rol,
            'status' => 200
        ]);
    }
}
