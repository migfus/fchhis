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
    public function Login(Request $req) : JsonResponse {
        $val = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if($val->fails())
            return $this->G_ValidatorFailResponse($val);

        $user = User::where('email', $req->email)->with([
                'info.plan_detail.plan', 'region', 'branch',
                'logs' => function($q) {
                    return $q->orderBy('created_at', 'DESC')->limit(5);
                }
            ])
            ->first();
        if(!$user || !Hash::check($req->password, $user->password))
            return response()->json(['status' => false, 'message' => 'Invalid Credentials!'], 401);

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

    public function ChangePassword(Request $req) : JsonResponse {
        if(!$req->user()->can('update auth'))
            return $this->G_UnauthorizedResponse();

        $val = Validator::make($req->all(), [
            'currentPassword' => 'required',
            'newPassword' => 'required',
        ]);

        if($val->fails())
            return $this->G_ValidatorFailResponse($val);

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

        $this->G_Log($req, 'Login', 'Login Success');

        return response()->json([...$this->G_ReturnDefault($req), 'data' => true ]);
    }

    public function ChangeAvatar(Request $req) : JsonResponse {
        if(!$req->user()->can('update auth'))
            return $this->G_UnauthorizedResponse();

        $val = Validator::make($req->all(), [
            'avatar' => 'required'
        ]);

        if($val->fails())
            return $this->G_ValidatorFailResponse($val);

        $user = User::find($req->user()->id);
        $user->avatar =  $this->G_AvatarUpload($req->avatar, 'avatars/');
        $user->save();

        return response()->json([...$this->G_ReturnDefault($req), 'data' => $user->avatar]);
    }
}
