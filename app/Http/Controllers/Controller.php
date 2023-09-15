<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function G_ReturnDefault($req = null) {
        if(!$req) {
            return [
                'status' => true,
                'message' => 'success',
            ];
        }

        $auth = User::where('id', $req->user()->id)->with(['info', 'region', 'branch'])->first();

        return [
            'status' => true,
            'message' => 'success',
            'auth' => [
                'auth' => $auth,
                // 'token'=> $auth->createToken('token idk wv')->plainTextToken,
                'permissions' => $auth->getAllPermissions()->pluck('name'),
            ]
        ];
    }

    public function G_UnauthorizedResponse($message = 'Logout') : JsonResponse {
        return response()->json([
            'status' => false,
            'reason' => $message
        ], 401);
    }

    public function G_ValidatorFailResponse($val) : JsonResponse {
        return response()->json([
            'status' => false,
            'message' => 'Invalid Input',
            'errors' => $val->errors()
        ], 401);
    }

    public function G_AvatarUpload($image, $path = '') : String {
        list($type, $image) = explode(';', $image);
        list(, $image) = explode(',', $image);

        $image = base64_decode($image);
        $imageName = time(). '.jpg';
        $location = '/uploads/'.$path.$imageName;
        file_put_contents('uploads/'.$path.$imageName, $image);

        return $location;
    }

    public function G_Test($req) : JsonResponse {
        return response()->json($req);
    }
}
