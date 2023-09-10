<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index(Request $req) : JsonResponse {
        if(!$req->user()->hasPermissionTo('index transaction')) {
            return $this->G_UnauthorizedResponse('unauthorized to [index transaction]');
        }

        if($req->user()->hasRole('Client')) {
            return $this->ClientIndex($req);
        }

        return $this->G_UnauthorizedResponse('unauthorized [no role available]');
    }

        private function ClientIndex($req) : JsonResponse {
            $val = Validator::make($req->all(), [
                'search' => '',
            ]);

            if($val->fails()) {
                return $this->G_ValidatorFailResponse($val);
            }

            $data = Transaction::with(['plan_details.plan', 'pay_type', 'agent', 'staff'])->where('client_id', $req->user()->id)
                ->whereHas('plan_details.plan', function($q) use($req) {
                    $q->where('name', 'LIKE', '%'.$req->search.'%');
                })
                ->orderBy('created_at', 'DESC')
                ->get();

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $data,
            ]);
        }
}
