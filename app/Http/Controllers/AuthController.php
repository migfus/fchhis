<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Log;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function Login(Request $req) {
        $val = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if($val->fails()) {
            return $this->G_ValidatorFailResponse($val);
        }

        $user = User::where('email', $req->email)->with([
                'info.plan_detail.plan', 'region', 'branch',
                'logs' => function($q) {
                    return $q->orderBy('created_at', 'DESC')->limit(5);
                }
            ])
        ->whereHas('logs', function ($q) {
            return $q->orderBy('created_at', 'DESC')->limit(10);
        })
        ->first();
        if(!$user || !Hash::check($req->password, $user->password)) {
            return response()->json(['status' => false, 'message' => 'Invalid Credentials!'], 401);
        }

        $permissions = $user->getAllPermissions()->pluck('name');

        return response()->json([
            ...$this->G_ReturnDefault(),
            'data' => [
                'auth' => $user,
                'token'=> $user->createToken('token idk wv')->plainTextToken,
                'permissions' => $permissions,
            ]
        ], 200);
    }

    public function ChangePassword(Request $req) {
        if(!$req->user()->can('update auth')) {
            return $this->G_UnauthorizedResponse();
        }

        $val = Validator::make($req->all(), [
            'currentPassword' => 'required',
            'newPassword' => 'required',
        ]);

        if($val->fails()) {
            return $this->G_ValidatorFailResponse($val);
        }

        if(!Hash::check($req->currentPassword, $req->user()->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Current Password',
                'errors' => ['Current Password' => 'Incorrect']
            ], 401);
        }

        User::where('id', $req->user()->id)->update([
            'password' => Hash::make($req->newPassword)
        ]);
        Log::create([
            'user_id' => $req->user()->id,
            'log_category_id' => 1,
            'content' => 'Changed Password'
        ]);

        return response()->json([...$this->G_ReturnDefault($req), 'data' => true ]);
    }
}
