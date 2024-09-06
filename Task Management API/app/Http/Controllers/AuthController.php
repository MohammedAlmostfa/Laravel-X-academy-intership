<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Service\AuthService;
use App\Models\User;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
       
        $this->authService = $authService;
    }
    //**________________________________________________________________________________________________


    /**
    ** logain user
   ** @param LoginRequest $request(user data)
   ** @return Responsejson(data,message,authorisation)
    */

    public function login(LoginRequest $request)
    {
        // Retrieve the validated data from the request
        $credentials = $request->validated();
        // login the user
        $result = $this->authService->login2($credentials);
        //return Responsejson
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
            'authorisation' => $result['authorisation']
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    /**
     ** register user
    ** @param RegisterRequest $request(user data)
    ** @return Responsejson(data,message)
     */
    public function register(RegisterRequest $request)
    {
        $credentials = $request->validated();

        // التحقق من صحة البيانات
        if (!isset($credentials['name']) || !isset($credentials['email']) || !isset($credentials['password'])) {
            return response()->json([
                'message' => 'بيانات غير كاملة',
                'status' => 400,
                'data' => 'يرجى تقديم جميع البيانات المطلوبة',
                'authorisation' => [
                    'token' => null,
                    'type' => 'bearer',
                ]
            ], 400);
        }

        // تسجيل المستخدم
        $result = $this->authService->register2($credentials);

        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
            'authorisation' => $result['authorisation']
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    /**
 ** register user
** @param  @param Nothing
** @return Responsejson(data,message)
 */
    public function logout()
    {
        //logout the user
        $result = $this->authService->logout2();
        //return Response
        return response()->json([
            'message' => $result['message'] ,
        ], $result['status']);
    }


    //**________________________________________________________________________________________________
    /**
 ** refresh user
** @param Nothing
** @return Responsejson(data ,user's data,authorisation)
 */
    public function refresh()
    {
        //update user
        $result = $this->authService->refresh2();
        //return Responsejson
        return response()->json([
            'message' => $result['status'],
            'user' => $result['user'],
            'authorisation' =>$result['authorisation'],
        ], $result['status']);
    }
}
