<?php
namespace App\Service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class AuthService
{

    /**
       * * login user
       * *@param $credentials (data of user(email,password))
       * *@return array(message,status,data)
       */



    public function login2($credentials)
    {
        try {
            $token = Auth::attempt($credentials);
            if (!$token) {
                return [
                    'message' => 'لا يوجد حساب',
                    'data' => 'لا يوجد بيانات',
                    'status' => 401,
                ];
            }

            $user = Auth::user();
            return [
                'message' => 'تم تسجيل الدخول',
                'status' => 201,
                'data' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ];
        } catch (Exception $e) {
            return [
                'message' => 'حدث خطاء اثناء عملية تسديل الدخول',
                'status' => 500,
                'data' => 'لم يتم عرض البيانات'
            ];
        }
    }


    
    /**
       * * register user
       * *@param $data (data of user(email,password))
       * *@return array(message,status,data,'authorisation' )
       */

    public function register2($credentials)
    {
        try {
            $user = User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password']),
            ]);

            $token = Auth::login($user);
            return [
                'message' => 'تم تسجيل الدخول',
                'status' => 201,
                'data' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ];
        } catch (Exception $e) {
            return [
                'message' => 'حدث خطاء اثنا انشاء الحساب',
                'status' => 500,
                'data' => 'لم يتم عرض البيانات'
            ];
        }
    }
}
