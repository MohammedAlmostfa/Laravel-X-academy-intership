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
     * Login user.
     *
     * @param $data (data of user(email,password))
     * @return array(message,status,data)
     */
    /**
 * Login user.
 *
 * @param array $data (data of user(email,password))
 * @return array(message,status,data)
 */
    public function login2(array $data)
    {

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

    public function logout()
    {
        Auth::guard('api')->logout();
        session()->forget('jwt_token');
        return redirect()->route('login');
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
