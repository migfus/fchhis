<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Transaction;
use Carbon\Carbon;
use App\Models\Info;
use App\Models\PayType;
use App\Models\User;

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

            if($val->fails())
                return $this->G_ValidatorFailResponse($val);

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

    public function show(Request $req, User $user) : JsonResponse {
        if(!$req->user()->hasPermissionTo('show transaction')) {
            return $this->G_UnauthorizedResponse('unauthorized to [show transaction]');
        }

        $val = Validator::make($req->all(), [
            'search' => '',
            'filter' => 'required',
            'sort' => 'required',
            'start' => '',
            'end' => '',
        ]);

        if($val->fails())
            return $this->G_ValidatorFailResponse($val);

        if($req->user()->hasRole('Staff')) {
            if($user->hasRole('Client')) {
                return $this->StaffForClientShow($req, $user->id);
            }
            else if($user->hasRole('Agent')) {
                return response()->json(['test']);
            }
        }

        return $this->G_UnauthorizedResponse('unauthorized [no role available]');
    }
        private function StaffForClientShow($req, $id) : JsonResponse {
            $data = Transaction::where('client_id', $id)->with(['client', 'plan_details.plan', 'pay_type', 'agent', 'staff']);

            if((bool)strtotime($req->start) OR (bool)strtotime($req->end)) {
                if((bool)strtotime($req->start)) {
                    $data->where('created_at', '>=', $req->start);
                }
                if((bool)strtotime($req->end)) {
                    $data->where('created_at', '<=', $req->end);
                }
            }

            switch($req->filter) {
                case 'plan':
                    $data->whereHas('plan_details.plan', function($q) use($req) { $q->where('name', 'LIKE', '%'.$req->search.'%'); });
                    break;
                case 'or':
                    $data->where('id', 'LIKE', '%'.$req->search.'%')->orWhere('or', 'LIKE', '%'.$req->search.'%');
                    break;
                case 'staff':
                    $data->whereHas('staff', function($q) use($req) { $q->where('name', 'LIKE', '%'.$req->search.'%'); });
                    break;
                default:
                    $data->whereHas('agent', function($q) use($req) { $q->where('name', 'LIKE', '%'.$req->search.'%'); });
            }


            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $data->orderBy('created_at', 'DESC')->get(),
                'due_at' => Info::where('user_id', $id)->first()->due_at
            ]);
        }
        private function StaffForAgentShow($req, $id) : JsonResponse {
            $data = Transaction::where('client_id', $id)->with(['client', 'plan_details.plan', 'pay_type', 'agent', 'staff']);

            if((bool)strtotime($req->start) OR (bool)strtotime($req->end)) {
                if((bool)strtotime($req->start)) {
                    $data->where('created_at', '>=', $req->start);
                }
                if((bool)strtotime($req->end)) {
                    $data->where('created_at', '<=', $req->end);
                }
            }

            switch($req->filter) {
                case 'plan':
                    $data->whereHas('plan_details.plan', function($q) use($req) { $q->where('name', 'LIKE', '%'.$req->search.'%'); });
                    break;
                case 'or':
                    $data->where('id', 'LIKE', '%'.$req->search.'%')->orWhere('or', 'LIKE', '%'.$req->search.'%');
                    break;
                case 'staff':
                    $data->whereHas('staff', function($q) use($req) { $q->where('name', 'LIKE', '%'.$req->search.'%'); });
                    break;
                default:
                    $data->whereHas('agent', function($q) use($req) { $q->where('name', 'LIKE', '%'.$req->search.'%'); });
            }


            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $data->orderBy('created_at', 'DESC')->get(),
                'due_at' => Info::where('user_id', $id)->first()->due_at
            ]);
        }

    public function store(Request $req) : JsonResponse {
        if(!$req->user()->hasPermissionTo('create transaction'))
            return $this->G_UnauthorizedResponse('unauthorized to [create transaction]');

        if($req->user()->hasRole('Staff')) {
            return $this->StaffStore($req);
        }

        return $this->G_UnauthorizedResponse('unauthorized [no role available]');
    }
        private function StaffStore($req) : JsonResponse {
            $val = Validator::make($req->all(), [
                'or' => '',
                'amount' => 'required',
                'pay_type_id' => 'required',
                'plan_detail_id' => 'required',
                'client_id' => 'required',
                'agent_id' => 'required'
            ]);

            $trans = Transaction::create([
                'or' => $req->or,
                'agent_id' => $req->agent_id,
                'staff_id' => $req->user()->id,
                'client_id' => $req->client_id,
                'pay_type_id' => $req->pay_type_id,
                'plan_detail_id' => $req->plan_detail_id,
                'amount' => $req->amount,
            ]);

            // NOTE DUE
            $info = Info::where('user_id', $req->client_id)->first();
            $info->update([
                'due_at' => $this->G_DueAdd(
                    PayType::where('id', $req->pay_type_id)->first()->name,
                    $info->due_at
                )
            ]);

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => true,
            ]);
        }

    public function update(Request $req, $id) : JsonResponse {
        if(!$req->user()->hasPermissionTo('update transaction'))
            return $this->G_UnauthorizedResponse('unauthorized to [upate transaction]');

        if($req->user()->hasRole('Staff')) {
            return $this->StaffUpdate($req, $id);
        }

        return $this->G_UnauthorizedResponse('unauthorized [no role available]');
    }
        private function StaffUpdate($req, $id) : JsonResponse {
            $val = Validator::make($req->all(), [
                'id' => 'required',
                'or' => '',
                'amount' => 'required',
                'pay_type_id' => 'required',
                'plan_detail_id' => 'required',
            ]);

            $trans = Transaction::where('id', $id)->update([
                'or' => $req->or,
                'pay_type_id' => $req->pay_type_id,
                'plan_detail_id' => $req->plan_detail_id,
                'amount' => $req->amount,
            ]);

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => true,
            ]);
        }

    public function destroy(Request $req, $id) : JsonResponse {
        if(!$req->user()->hasPermissionTo('destroy transaction'))
            return $this->G_UnauthorizedResponse('unauthorized to [destroy transaction]');

        if($req->user()->hasRole('Staff')) {
            return $this->StaffDestroy($req, $id);
        }

        return $this->G_UnauthorizedResponse('unauthorized [no role available]');
    }
        private function StaffDestroy($req, $id) : JsonResponse {
            $trans = Transaction::where('id', $id)->delete();

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => true,
            ]);
        }
}
