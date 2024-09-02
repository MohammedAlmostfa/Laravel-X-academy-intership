<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Service\UserService ;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;

    // Constructor to inject UserService
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    //**________________________________________________________________________________________________
    
    public function index()
    {
        $result =  $this->userService->showUsers();
        return response()->json([
                   'message' => $result['message'],
                   'data' => $result['data'],
               ], $result['status']);

    
    }

    //**________________________________________________________________________________________________
   
    /**
     * *This function is created to store a new user.
     * *@param \Illuminate\Http\Request $request
     * *@return \Illuminate\Http\JsonResponse
     */
    public function store(RegisterRequest $request)
    {
        // Get the validation of data
        $validatedData =  $request->validated();
        // get the result
        $result = $this->userService->createUser($validatedData);
        // return the result
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    /**
      * *This function is creat to update  user.
      * *@param \Illuminate\Http\Request $request
      * * @param $id
      * * @return \Illuminate\Http\JsonResponse
      */
    public function update(RegisterRequest $request, $id)
    {// Get the validation of data
        $validatedData =  $request->validated();
        // get the result
        $result =  $this->userService->updateUser($validatedData, $id);
        // return the result
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    /**
     * *This function is created to show  a user.
     * *@param $id
     * *@return \Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        //show the user
        $result =  $this->userService->showUser($id);
        //return the response
        return response()->json([
            'message' => $result['message'],
           'data' => $result['data'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    /**
     * *This function is creat to delet a user.
     * *@param $id
     * *@return \Illuminate\Http\JsonResponse
     */

    public function destroy($id)
    {
        //delet user
        $result =  $this->userService->deletUser($id);
        //return response
        return response()->json([
        'message' => $result['message'],
        ], $result['status']);

    }
}
