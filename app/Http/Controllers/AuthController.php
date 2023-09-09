<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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

        $user = User::where('email', $req->email)->with(['info', 'region', 'branch'])->first();
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
}
