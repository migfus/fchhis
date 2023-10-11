<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Beneficiary;
use App\Models\Info;

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
            $user = User::where('id', $id)->with(['roles', 'info.agent', 'info.plan_detail.plan', 'info.pay_type'])->withSum('client_transactions', 'amount')->first();

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $user,
            ]);
        }


    public function update(Request $req, string $id) : JsonResponse {
        if(!$req->user()->hasPermissionTo('update client'))
            return $this->G_UnauthorizedResponse('unauthorizaed to [update client]');

        if($req->user()->hasRole('Staff'))
            return $this->StaffUpdate($req, $id);

        return $this->G_UnauthorizedResponse('no authorizeation to access');
    }
        private function StaffUpdate($req, $id) : JsonResponse {
            $val = Validator::make($req->all(), [
                'email' => 'required|email|unique:users,email,'.$id,
                'name' => 'required',
                'info.sex' => 'required',
                'info.bplace_id' => 'required',
                'info.bday' => 'required',
                'info.address_id' => 'required',
                'info.address' => 'required',
                'info.cell' => 'required',
                'info.plan_detail_id' => 'required',
                'info.pay_type_id' => 'required',
            ]);

            if($val->fails()) {
                return $this->G_ValidatorFailResponse($val);
            }

            $user = User::where('id', $id)->first();
            $user->update([
                'email' => $req->email,
                'name' => $req->name,
            ]);

            $info = Info::where('user_id', $user->id)->update([
                'sex' => $req->info['sex'] ? true : false,
                'bplace_id' => $req->info['bplace_id'],
                'bday' => $req->info['bday'],
                'address_id' => $req->info['address_id'],
                'address' => $req->info['address'],
                'cell' => $req->info['cell'],
                'plan_detail_id' => $req->info['plan_detail_id'],
                'pay_type_id' => $req->info['pay_type_id'],
            ]);

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => true,
            ]);
        }

    public function download(Request $req, string $id) : JsonResponse {
        if(!$req->user()->hasPermissionTo('download user'))
            return $this->G_UnauthorizedResponse('unauthorizaed to [download user]');

        if($req->user()->hasRole('Staff'))
            return $this->StaffDownload($req, $id);

        return $this->G_UnauthorizedResponse('no authorizeation to access');
    }
        private function StaffDownload($req, $id) : JsonResponse {
            $user = User::where('id', $id)->with([
                'info.pay_type',
                'info.plan_detail.plan',
                'beneficiaries',
                'client_transactions.plan_details.plan',
                'client_transactions.pay_type',
                'client_transactions.agent',
                'client_transactions.staff',
            ])->first();

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $user,
            ]);
        }
}
