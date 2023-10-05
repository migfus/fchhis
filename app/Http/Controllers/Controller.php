<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

use App\Models\User;
use App\Models\Log;
use App\Models\LogCategory;
use Carbon\Carbon;

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

        $auth = User::where('id', $req->user()->id)->with([
                'info.plan_detail.plan',
                'region',
                'branch',
                'logs' => function($q) {
                    return $q->orderBy('created_at', 'DESC')->limit(5);
                }
            ])
            ->first();

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

    public function G_Log($req, $categorynName, $content) : Boolean {
        // SECTION AUTHENTICATED
        if($req->user()) {
            $logCategory = LogCategory::firstOrNew(['name' => $categorynName]);

            Log::create([
                'user_id' => $req->user()->id,
                'log_category_id' => $logCategory->id,
                'content' => $content
            ]);

            return true;
        }

        return false;
    }

    public function G_DueAdd($pay_type_name, $due_at) : string {
        if(!$due_at) {
            $due_at = Carbon::now()->format('Y-m-d');
        }
        switch($pay_type_name) {
            case 'Monthly':
                return Carbon::parse($due_at)->addMonths(1);
            case 'Quarterly':
                return Carbon::parse($due_at)->addMonths(3);
            case 'Semi-Annual':
                return Carbon::parse($due_at)->addMonths(6);
            case 'Annual':
                return Carbon::parse($due_at)->addYears(1);
            case 'Spot Payment':
                return null;
            case 'Spot Service':
                return null;
            default:
                return null;
        }
    }
}
