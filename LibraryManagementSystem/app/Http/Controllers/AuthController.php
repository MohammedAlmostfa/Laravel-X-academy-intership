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
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
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
        $credentials = $request->validated();
        $result = $this->authService->login2($credentials);
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
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ], 200);
    }


    //**________________________________________________________________________________________________


    /**
 ** refresh user
** @param Nothing
** @return Responsejson(data ,user's data,authorisation)
 */

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
                'message' => 'Successfully refresh',
            ]
        ], 200);
    }
}
