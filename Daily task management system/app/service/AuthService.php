<?php

namespace App\Service;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            // check of user
            if (!$token) {
                return [
                    'message' => 'لا يوجد حساب',
                    'data' => 'لا يوجد بيانات',
                    'status' => 401,
                    'authorisation' => []
                ];
            } else {
                $user = Auth::user();
                // rturn respons
                return [
                    'message' => 'تم تسجيل الدخول',
                    'status' => 201,
                    'data' => [
                        'name' => $user['name'],
                        'email' => $user['email']
                    ],
                    'authorisation' => [
                        //rturn tokeen
                        'token' => $token,
                        'type' => 'bearer',
                    ]
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in returning book: ' . $e->getMessage());

            return [
                'message' => 'حدث خطاء اثناء عملية تسديل الدخول',
                'status' => 500,
                'data' => 'لم يتم عرض البيانات'
            ];
        }
    }
    public function register($data)
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            return redirect()->route('view')->with('success', 'User registered successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to register user: ');
        }


    }

    //**________________________________________________________________________________________________
    /*
    * logout user
       * *@param Nothing
       * *@return array(message,status )
       */
    public function logout2()
    {
        try {
            Auth::logout();
            return [
                'message' => 'تم تسجيل الخروج',
                'status' => 200,
            ];
        } catch (Exception $e) {
            Log::error('Error in returning book: ' . $e->getMessage());
            return [
                'message' => ' حدث خطاء اثناء تسجيل الخروج',
                'status' => 500,
            ];
        }
    }
    //**________________________________________________________________________________________________
    /*
    * refresh user
       * *@param Nothing
       * *@return array(message,status )
       */
    public function refresh2()
    {
        return [
            'message' => 'تمت عملية التحديث',
            'status' => '200',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ];
    }
}
