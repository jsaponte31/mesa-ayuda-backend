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
    protected $helDeskController;
    protected $rolController;
    protected $userController;
    protected $status_requestController;

    public function __construct()
    {
        $this->helDeskController = new help_deskController();
        $this->rolController = new rolController();
        $this->userController = new userController();
        $this->status_requestController = new status_requestController();
    }

    public function buscarSolicitudes($user_id, $rol_id){
        $solicitudes = [];
        $dataHelpDesk = $this->helDeskController->buscarMesasAyuda()->original['data'];
        $rolname = $this->rolController->buscarRolporId($rol_id)->original['rol']->name;
        if($rolname == 'USUARIO'){
            $user = $this->userController->buscarUsuarioporId($user_id)->original['user'];
            $solicitudes = $user->solicitudes;
        }else if($rolname == 'ADMINISTRADOR DE AREA'){
            $solicitudes = ModelsRequest::join('help_desks as h', 'requests.help_desk_id', '=', 'h.id')
                        ->where('h.administrater_id','=', $user_id)
                        ->get();
        }else if($rolname == 'TECNICO'){
            $solicitudes = ModelsRequest::join('assignments as a','a.request_id','=','requests.id')
                        ->where('a.technical_id','=', $user_id)
                        ->get();
        }

        return response()->json([
            'solicitudes' => $solicitudes,
            'dataHelpDesk' => $dataHelpDesk,
            'status' => 200
        ]);
    }

    public function crearSolicitud(Request $request){
        $solicitud = new ModelsRequest();
        $solicitud->description = $request->description;
        $solicitud->user_id = $request->user_id;
        $solicitud->help_desk_id = $request->help_desk_id;
        $solicitud->status_request_id = $this->status_requestController->buscarStatus_requestporNombre('CREADA')->original['status_request']->id;
        $solicitud->save();
        return response()->json([
            'message' => 'Solicitud creada exitosamente',
            'status' => 200
        ]);
    }
}
