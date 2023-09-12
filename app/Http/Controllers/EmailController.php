<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

use App\Mail\RegistrationMail;
use App\Models\User;
use App\Models\PasswordRecovery;

class EmailController extends Controller
{
    public function registration(Request $req, $email, $name) : JsonResponse {
        $val = Validator::make($req->all(), [
            'email' => 'required|email',
            'name' => 'required',
        ]);

        if($val->fails()) {
            return $this->G_ValidatorFailResponse($val);
        }

        Mail::to('migfus20@gmail.com')->send(new RegistrationMail(
            $req->email, $req->name
        ));

        return response()->json([...$this->G_ReturnDefault($req), 'data' => true]);
    }

    public function sendRecoveryCode(Request $req) : JsonResponse {
        $val = Validator::make($req->all(), [
            'email' => 'required|email',
        ]);

        if($val->fails()) {
            return $this->G_ValidatorFailResponse($val);
        }

        $user = User::where('email', $req->email)->first();

        if(!$user) {
            return $this->G_UnauthorizedResponse('no email available');
        }

        PasswordRecovery::create([
            'user_id' => $user->id,
            'code' => rand(10000, 99999),
        ]);

        Mail::to($user->email)->send(new RegistrationMail(
            $user->email, $user->name
        ));

        return response()->json([...$this->G_ReturnDefault(), 'data' => true]);
    }
}
