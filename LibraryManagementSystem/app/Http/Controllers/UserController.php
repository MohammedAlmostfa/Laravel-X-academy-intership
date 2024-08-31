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







    

    


    /**
     * *This function is creat to update a new user.
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



      

    /**
     * *This function is created to show  a user.
     * *@param $id
     * *@return \Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {


            return response()->json(['error' => 'user not found'], 404);
        } else {
            return response()->json([
                'data' => $user
            ]);
        }
    }




    /**
     * *This function is creat to delet a user.
     * *@param $id
     * *@return \Illuminate\Http\JsonResponse
     */

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Deleted successfully.'], 200);
    }


}
