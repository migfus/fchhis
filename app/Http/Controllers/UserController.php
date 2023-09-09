<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(Request $req) {
        if(!$req->user()->hasPermissionTo('index user')) {
            return $this->G_UnauthorizedResponse('unauthorized to [index user]');
        }

        $val = Validator::make($req->all(), [
            'search' => '',
            'filter' => 'required',
        ]);

        if($val->fails()) {
            return $this->G_ValidatorFailResponse($val);
        }

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


    public function show(string $id) : JsonResponse {

    }


    public function update(Request $request, string $id) : JsonResponse {

    }
}
