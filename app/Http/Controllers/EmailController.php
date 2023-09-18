<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Mail\RecoveryMail;
use App\Models\User;
use App\Models\PasswordRecovery;

class EmailController extends Controller
{
    // ✅
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
    // ✅
    public function recovery(Request $req) : JsonResponse {
        if($req->confirmPass) {
            return $this->confirmPass($req);
        }
        else if($req->code) {
            return $this->checkCode($req);
        }
        return $this->sendCode($req);
    }
        // ✅
        private function sendCode($req) : JsonResponse{
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

            $recovery = PasswordRecovery::create([
                'user_id' => $user->id,
                'code' => rand(10000, 99999),
            ]);

            Mail::to($user->email)->send(new RecoveryMail(
                $user->email, $user->name, $recovery->code
            ));

            return response()->json([...$this->G_ReturnDefault(), 'data' => true]);
        }
        // ✅
        private function checkCode($req) : JsonResponse {
            $recovery = PasswordRecovery::where('code', $req->code)->whereNull('approved_at')->first();

            if(!$recovery) {
                return response()->json([...$this->G_ReturnDefault(), 'data' => false]);
            }

            return response()->json([...$this->G_ReturnDefault(), 'data' => true]);
        }
        // ✅
        private function confirmPass($req) : JsonResponse {
            $val = Validator::make($req->all(), [
                'password' => 'required|min:8',
                'code' => 'required'
            ]);

            $recovery = PasswordRecovery::where('code', $req->code)->whereNull('approved_at')->first();
            $user = User::where('id', $recovery->user_id)->update([
                'password' => Hash::make($req->password)
            ]);

            PasswordRecovery::where('id', $recovery->id)->update([
                'approved_at' => Carbon::now()
            ]);

            if(!$user) {
                return response()->json([...$this->G_ReturnDefault(), 'data' => false]);
            }

            return response()->json([...$this->G_ReturnDefault(), 'data' => true]);

        }
}
