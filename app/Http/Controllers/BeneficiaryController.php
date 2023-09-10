<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class BeneficiaryController extends Controller
{
    public function index(Request $req) : JsonResponse {
        if(!$req->user()->hasPermissionTo('index beneficiary')) {
            return $this->G_UnauthorizedResponse('unauthorized to [index beneficiary]');
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

            $data = Beneficiary::where('user_id', $req->user()->id)
                ->where('name', 'LIKE', $req->search)
                ->orderBy('name', 'ASC')
                ->get();

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $data,
            ]);
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
