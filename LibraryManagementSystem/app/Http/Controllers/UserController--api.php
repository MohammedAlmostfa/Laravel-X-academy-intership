<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($validator, $code);
            }

            $credentials = $request->only(['email', 'password']);
            if (!$token = Auth::attempt($credentials)) {
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');
            }

            $user = Auth::guard('api')->user();
            $user->token = $token;
            //return token
            return $this->returnData('user', $user);

        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
