<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

use App\Models\User;
use App\Models\Info;

class AgentUserController extends Controller
{
    public function index(Request $req) : JsonResponse {
        if(!$req->user()->can('index agent'))
            return $this->G_UnauthorizedResponse();

        $val = Validator::make($req->all(), [
            'search' => '',
            'sort' => 'required',
            'start' => '',
            'end' => '',
            'filter' => 'required'
        ]);

        switch($req->user()->roles[0]->name) {
            case 'Staff':
                return $this->StaffIndex($req);
            default:
                return $this->G_UnauthorizedResponse();
        }

    }
        private function StaffIndex($req) : JsonResponse {
            $data = User::select('*');

            if((bool)strtotime($req->start) OR (bool)strtotime($req->end)) {
                if((bool)strtotime($req->start))
                    $data->where('created_at', '>=', $req->start);

                if((bool)strtotime($req->end))
                    $data->where('created_at', '<=', $req->end);
            }

            $data->with([
                'roles',
                'branch',
                'region',
            ])->role('agent');

            switch($req->filter) {
                case 'plans':
                    $data->whereHas('info.plan_detail.plan', function($q) use($req) {
                            $q->where('name', 'LIKE', '%'.$req->search.'%');
                        })
                        ->withSum('client_transactions', 'amount');
                    break;
                case 'address':
                    $data->withSum('client_transactions', 'amount')
                        ->whereHas('info', function($q) use($req) {
                            $q->where('address', 'LIKE', '%'.$req->search.'%');
                        });
                    break;
                case 'email':
                    $data->where('email', 'LIKE', '%'.$req->search.'%')
                        ->withSum('client_transactions', 'amount');
                    break;
                default:
                    $data->withSum('client_transactions', 'amount')
                        ->where('name', 'LIKE', '%'.$req->search.'%');
            }

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $data
                    ->withSum('agent_transactions', 'amount')
                    ->withSum('agent_transactions_current_month', 'amount')
                    ->withCount('agent_client')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10)
            ]);
        }

    public function store(Request $req) : JsonResponse {
        if(!$req->user()->can('create client'))
            return $this->G_UnauthorizedResponse();

        $val = Validator::make($req->all(), [
            'avatar' => '',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',

            'name' => 'required',
            'sex' => 'required',
            'bplace_id' => 'required',
            'bday' => 'required',
            'address_id' => 'required',
            'address' => 'required',
            'mobile' => '',

            'agent.id' => 'required',
            'plan.id' => 'required',
            'payment_type.id' => 'required',
        ]);


        switch($req->user()->roles[0]->name) {
            case 'Staff':
                return $this->StaffStore($req);
            default:
                return $this->G_UnauthorizedReponse();
        }
    }

        private function StaffStore(Request $req) : JsonResponse {
            $user = User::create([
                'region_id' => $req->user()->region_id,
                'branch_id' => $req->user()->branch_id,

                'avatar' => $req->avatar,
                'email' => $req->email,
                'password' => $req->password,
                'name' => $req->name,
            ])->assignRole('Agent');

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => true
            ]);
        }
}
