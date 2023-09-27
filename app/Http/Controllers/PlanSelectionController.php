<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\Plan;
use App\Models\PlanDetail;

class PlanSelectionController extends Controller
{
    public function index(Request $req) : JsonResponse {
        if(!$req->user()->hasPermissionTo('index plan')) {
            return $this->G_UnauthorizedResponse('index plan');
        }

        $plan = Plan::where('name', 'LIKE', '%'.$req->search.'%')
            ->with(['plan_detail' => function ($q) {
                $q->orderBy('created_at', 'DESC');
            }])
            ->orderBy('name', 'ASC')
            ->limit(10)
            ->get();

        return response()->json([...$this->G_ReturnDefault($req), 'data' => $plan]);
    }
}
