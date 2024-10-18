<?php

namespace App\Http\Controllers;

use App\Models\Help_desk;
use Illuminate\Http\Request;

class help_deskController extends Controller
{
    public function buscarMesaAyuda(){
        $mesaAyuda = Help_desk::all();
        return response()->json([
            'data' => $mesaAyuda,
            'status' => 200
        ]);
    }
}
