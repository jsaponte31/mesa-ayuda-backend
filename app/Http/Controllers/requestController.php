<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use App\Models\Request as ModelsRequest;
use App\Models\Rol;
use App\Models\Status_request;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class requestController extends Controller
{
    public function buscarSolicitudes($user_id, $rol_id){
        $rolname = Rol::select('name')->where('id', $rol_id)->first()->name;
        if($rolname == 'USUARIO'){
            $user = User::find($user_id);
            $solicitudes = $user->solicitudes;
            return response()->json([
                'solicitudes' => $solicitudes,
                'status' => 200
            ]);
        }else if($rolname == 'ADMINISTRADOR DE AREA'){
            $solicitudes = ModelsRequest::join('help_desks as h', 'requests.help_desk_id', '=', 'h.id')
                        ->where('h.administrater_id','=', $user_id)
                        ->get();
            return response()->json([
                'solicitudes' => $solicitudes,
                'status' => 200
            ]);
        }else if($rolname == 'TECNICO'){
            $solicitudes = ModelsRequest::join('assignments as a','a.request_id','=','requests.id')
                        ->where('a.technical_id','=', $user_id)
                        ->get();
            return response()->json([
                'solicitudes' => $solicitudes,
                'status' => 200
            ]);
        }
    }

    public function crearSolicitud(Request $request){
        $solicitud = new ModelsRequest();
        $solicitud->description = $request->observacion;
        $solicitud->user_id = $request->user_id;
        $solicitud->help_desk_id = $request->help_desk_id;
        $solicitud->status_request_id = Status_request::where('name', 'CREADA')->first()->id;
        $solicitud->save();
        return response()->json([
            'message' => 'Solicitud creada exitosamente',
            'status' => 200
        ]);
    }
}
