<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use App\Models\Help_desk;
use App\Models\Request as ModelsRequest;
use App\Models\Rol;
use App\Models\Status_request;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class requestController extends Controller
{
    public function buscarSolicitudes($user_id, $rol_id){
        $solicitudes = [];
        $dataHelpDesk = [];
        $tecnicos = [];
        $rolName = Rol::find($rol_id)->name;
        if($rolName == 'USUARIO'){
            $user = User::find($user_id);
            $solicitudes = DB::table('requests as r')
                        ->select('r.*','a.technical_id as id_tecnico','u.name as tecnico','u.phone as telefono_tecnico')
                        ->leftJoin('assignments as a','a.request_id','=','r.id')
                        ->leftJoin('users as u','u.id','=','a.technical_id')
                        ->where('r.user_id','=', $user_id)
                        ->get();
            $dataHelpDesk = Help_desk::all();
        }else if($rolName == 'ADMINISTRADOR DE AREA'){
            $solicitudes = DB::table('requests as r')
                        ->select('r.*','a.technical_id as id_tecnico','u.name as tecnico','u.phone as telefono_tecnico')
                        ->join('help_desks as h','h.id','=','r.help_desk_id')
                        ->leftJoin('assignments as a','a.request_id','=','r.id')
                        ->leftJoin('users as u','u.id','=','a.technical_id')
                        ->where('h.administrater_id','=', $user_id)
                        ->get();
            $mesa_id = DB::table('help_desks as h')
                        ->select('h.id')
                        ->where('h.administrater_id','=', $user_id)
                        ->first()->id;
            $tecnicos = DB::table('users as u')
                        ->select('u.id','u.name','u.username','u.phone')
                        ->join('rols as r','r.id','=','u.rol_id')
                        ->join('tecnicos_mesas_relacion as tmr','tmr.tecnico_id','=','u.id')
                        ->where('r.name', 'TECNICO')
                        ->where('u.is_active', 1)
                        ->where('tmr.help_desk_id', $mesa_id)
                        ->get();
        }else if($rolName == 'TECNICO'){
            $solicitudes = DB::table('requests as r')
                        ->select('r.*')
                        ->join('assignments as a','a.request_id','=','r.id')
                        ->where('a.technical_id','=', $user_id)
                        ->get();
        }

        return response()->json([
            'solicitudes' => $solicitudes,
            'dataHelpDesk' => $dataHelpDesk,
            'tecnicos' => $tecnicos,
            'status' => 200
        ]);
    }

    public function crearSolicitud(Request $request){
        $solicitud = new ModelsRequest();
        $solicitud->description = $request->description;
        $solicitud->user_id = $request->user_id;
        $solicitud->help_desk_id = $request->help_desk_id;
        $solicitud->status_request_id = Status_request::where('name', 'CREADA')->first()->id;
        $solicitud->save();
        return response()->json([
            'message' => 'Solicitud creada exitosamente',
            'status' => 200
        ]);
    }

    public function asignarSolicitud(Request $request){
        $asignacion = new Assignments();
        $asignacion->request_id = $request->request_id;
        $asignacion->technical_id = $request->technical_id;
        $asignacion->date_assignment = now();
        $asignacion->save();
        $requestororig = ModelsRequest::find($request->request_id);
        $requestororig->status_request_id = Status_request::where('name', 'ASIGNADA')->first()->id;
        $requestororig->save();
        $userName = User::find($request->technical_id)->name;
        return response()->json([
            'message' => "Solicitud al asignada exitosamente al tecnico $userName",
            'status' => 200
        ]);
    }

    public function procesarSolicitud(Request $request){
        $requestororig = ModelsRequest::find($request->request_id);
        $requestororig->status_request_id = Status_request::where('name', 'EN PROCESO')->first()->id;
        $requestororig->save();
        return response()->json([
            'message' => 'Solicitud cambiada de estado exitosamente',
            'status' => 200
        ]);
    }

    public function finalizarSolicitud(Request $request){
        $asignacion = Assignments::where('request_id', $request->request_id)->first();
        $asignacion->technical_description = $request->technical_description;
        $asignacion->date_completion = now();
        $asignacion->save();
        $requestororig = ModelsRequest::find($request->request_id);
        $requestororig->status_request_id = Status_request::where('name', 'FINALIZADA')->first()->id;
        $requestororig->save();
        return response()->json([
            'message' => 'Solicitud finalizada exitosamente',
            'status' => 200
        ]);
    }
}
