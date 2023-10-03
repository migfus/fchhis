<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Beneficiary;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(Request $req) : JsonResponse {
        if(!$req->user()->hasPermissionTo('summary user'))
            return $this->G_UnauthorizedResponse('unauthorized to [index user]');

        if($req->user()->hasRole('Staff')) {
            if($req->summary)
                return $this->StaffSummary($req);
            else
                return $this->StaffIndex($req);
        }


        return $this->G_UnauthorizedResponse('unauthorized [no role available]');
    }
        private function StaffSummary($req) : JsonResponse {
            $data = [
                'client' => [
                    'name' => 'Clients',
                    'current' => User::where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->role('client')
                        ->count(),
                    'total' => User::role('Client')->count(),
                ],
                'agent' => [
                    'name' => 'Agents',
                    'current' => User::where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->role('Agent')
                        ->count(),
                    'total' => User::role('Agent')->count(),
                ],
                'beneficiary' => [
                    'name' => 'Beneficiaries',
                    'current' => Beneficiary::where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->count(),
                    'total' => Beneficiary::count(),
                ],
            ];

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $data,
            ]);
        }
        private function StaffIndex($req) : JsonResponse {
            $val = Validator::make($req->all(), [
                'search' => '',
                'filter' => 'required',
            ]);

            if($val->fails())
                return $this->G_ValidatorFailResponse($val);

            $data = User::whereHas('person', function($q) use($req) {
                $q->where('last_name', 'LIKE', '%'.$req->search.'%')
                ->orWhere('first_name', 'LIKE', '%'.$req->search.'%');
            });

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $data->paginate(10),
            ]);
        }


    public function destroy(string $id, Request $req) : JsonResponse {
        if($req->user()->hasPermissionTo('destroy user')) {
            $data = User::where('id', $id)->first();
            $data->roles()->detach();
            $data->person()->delete();
            $data->delete();
            // $data->roles()->detach();
            // $data->delete();

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $data,
            ]);
        }
        return $this->G_UnauthorizedResponse('unauthorized to [destroy user]');
    }


    public function store(Request $request) : JsonResponse {

    }


    public function show(Request $req, string $id) : JsonResponse {
        if(!$req->user()->hasPermissionTo('show client'))
            return $this->G_UnauthorizedResponse('unauthorized to [show user]');

        if($req->user()->hasRole('Staff')) {
            return $this->StaffShow($req, $id);
        }

        return $this->G_UnauthorizedResponse('no authorization to access');
    }
        private function StaffShow($req, $id) : JsonResponse {
            $user = User::where('id', $id)->with(['roles', 'info.agent'])->first();

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $user,
            ]);
        }


    public function update(Request $request, string $id) : JsonResponse {

    }
}
