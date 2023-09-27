<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\PayType;

class PaymentTypeSelectController extends Controller
{
    public function index(Request $req) : JsonResponse {
        if(!$req->user()->hasPermissionTo('index payment-type')) {
            return $this->G_UnauthorizedResponse('index payment-type');
        }

        $payType = PayType::where('name', 'LIKE', '%'.$req->search.'%')
            ->orderBy('name', 'ASC')
            ->limit(10)
            ->get();

        return response()->json([...$this->G_ReturnDefault($req), 'data' => $payType]);
    }
}
