<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class rolController extends Controller
{
    public function buscarRolporId($id){
        $rol = Rol::find($id);
        return response()->json([
            'rol' => $rol,
            'status' => 200
        ]);
    }
}
