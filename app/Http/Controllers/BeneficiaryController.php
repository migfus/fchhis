<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class BeneficiaryController extends Controller
{
    public function index(Request $req) : JsonResponse {
        if(!$req->user()->hasPermissionTo('index beneficiary'))
            return $this->G_UnauthorizedResponse('unauthorized to [index beneficiary]');

        if($req->user()->hasRole('Client'))
            return $this->ClientIndex($req);
        else if ($req->user()->hasRole('Staff'))
            return $this->StaffIndex($req);

        return $this->G_UnauthorizedResponse('unauthorized [no role available]');
    }
        private function ClientIndex($req) : JsonResponse {
            $val = Validator::make($req->all(), [
                'search' => '',
            ]);

            if($val->fails())
                return $this->G_ValidatorFailResponse($val);

            $data = Beneficiary::where('user_id', $req->user()->id)
                ->where('name', 'LIKE', $req->search)
                ->orderBy('name', 'ASC')
                ->get();

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $data,
            ]);
        }
        private function StaffIndex($req) : JsonResponse {
            $val = Validator::make($req->all(), [
                'user_id' => 'required',
                'search' => '',
            ]);

            if($val->fails())
                return $this->G_ValidatorFailResponse($val);

            $data = Beneficiary::where('user_id', $req->user_id)
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
    public function store(Request $req) : JsonResponse {
        if(!$req->user()->hasPermissionTo('create beneficiary'))
            return $this->G_UnauthorizedResponse('unauthorized to [store beneficiary]');

        if($req->user()->hasRole('Staff')) {
            return $this->StaffStore($req);
        }
    }
        private function StaffStore(Request $req) : JsonResponse {
            $val = Validator::make($req->all(), [
                'user_id' => 'required',
                'name' => 'required',
                'bday' => 'required'
            ]);

            if($val->fails())
                return $this->G_ValidatorFailResponse($val);

            $ben = Beneficiary::create([
                'user_id' => $req->user_id,
                'staff_id' => $req->user()->id,
                'name' => $req->name,
                'bday' => $req->bday,
            ]);

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $ben,
            ]);
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
    public function update(Request $req, string $id) : JsonResponse {
        if(!$req->user()->hasPermissionTo('update beneficiary'))
            return $this->G_UnauthorizedResponse('unauthorized to [upate beneficiary]');

        if ($req->user()->hasRole('Staff'))
            return $this->StaffUpdate($req, $id);

        return $this->G_UnauthorizedResponse('unauthorized [no role available]');
    }
        private function StaffUpdate($req, $id) : JsonResponse {
            $val = Validator::make($req->all(), [
                'name' => 'required',
                'bday' => 'required',
            ]);

            if($val->fails())
                return $this->G_ValidatorFailResponse($val);

            $ben = Beneficiary::where('id', $id)->update([
                'name' => $req->name,
                'bday' => $req->bday,
            ]);

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $ben,
            ]);
        }

    public function destroy(Request $req, string $id) : JsonResponse {
        if(!$req->user()->hasPermissionTo('destroy beneficiary'))
            return $this->G_UnauthorizedResponse('unauthorized to [destroy beneficiary]');

        if ($req->user()->hasRole('Staff'))
            return $this->StaffDestroy($req, $id);

        return $this->G_UnauthorizedResponse('unauthorized [no role available]');
    }
        private function StaffDestroy($req, $id) : JsonResponse {
            $data = Beneficiary::where('id', $id)->delete();

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $data,
            ]);
        }
}
