<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

use App\Models\User;

class ClientUserController extends Controller
{
    public function index(Request $req) : JsonResponse {
        if(!$req->user()->can('index client'))
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

            $data->with(['info.plan_detail.plan', 'info.pay_type', 'info.agent', 'info.staff', 'roles', 'branch', 'region', 'beneficiaries']);

            switch($req->filter) {
                case 'plans':
                    $data->role('client')
                        ->whereHas('info.plan_detail.plan', function($q) use($req) {
                            $q->where('name', 'LIKE', '%'.$req->search.'%');
                        })
                        ->withSum('client_transactions', 'amount');
                    break;
                case 'address':
                    $data->role('client')
                        ->withSum('client_transactions', 'amount')
                        ->whereHas('info', function($q) use($req) {
                            $q->where('address', 'LIKE', '%'.$req->search.'%');
                        });
                    break;
                case 'email':
                    $data->role('client')->where('email', 'LIKE', '%'.$req->search.'%')
                        ->withSum('client_transactions', 'amount');
                    break;
                default:
                    $data->role('client')
                        ->withSum('client_transactions', 'amount')
                        ->where('name', 'LIKE', '%'.$req->search.'%');
            }

            return response()->json([
                ...$this->G_ReturnDefault($req),
                'data' => $data->withSum('client_transactions', 'amount')->orderBy('created_at', 'DESC')->paginate(10)
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
