<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\User;

class AgentSelectController extends Controller
{
    public function index(Request $req) : JsonResponse {
        if(!$req->user()->hasPermissionTo('index agent')) {
            return $this->G_UnauthorizedResponse('index agent');
        }

        $user = User::where('name', 'LIKE', '%'.$req->search.'%')
            ->role('Agent')
            ->withCount('agent_client')
            ->orderBy('name', 'ASC')
            ->limit(10)
            ->get();

        return response()->json([...$this->G_ReturnDefault($req), 'data' => $user]);
    }
}
