<?php

namespace App\Http\Controllers;

use App\Models\Status_request;
use Illuminate\Http\Request;

class status_requestController extends Controller
{
    public function buscarStatus_requestporNombre($nombre){
        $status_request = Status_request::where('name', $nombre)->first();
        return response()->json([
            'status_request' => $status_request,
            'status' => 200
        ]);
    }
}
