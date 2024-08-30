<?php

namespace App\Service;

use App\Models\User;
use App\Models\Rating;
use Illuminate\Validation\ValidationException;

class UserService
{

    /**
        * *This function is created to store a new User.
        ** @param$ data
        * *@return \Illuminate\Http\JsonResponse
        */

    public function createUser($data)
    {
        try {
            $validatedData = $data->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create($validatedData);
            return response()->json([
                'message' => 'User created successfully.',
                'data' => $user,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Insert failed.',
                'errors' => $e->validator->errors(),
            ], 422);
        }
    }


    /**
     * *This function is creat to update a  user.
     * * @param $data
     * *@param User $user
     * *@return \Illuminate\Http\JsonResponse
     */

    public function updateUser(User $user, $data)
    {


        try {
            $validatedData = $data->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user->update($validatedData);
            return response()->json([
                'message' => 'User update successfully.',
                'data' => $user,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'update failed.',
                'errors' => $e->validator->errors(),
            ], 422);
        }
    }
    /**
     * *This function is creat to delet  a user.
     **@param User $uder
     * *@return \Illuminate\Http\JsonResponse
     */


    public function deletUser(User $user)
    {
        if ($user->delete()) {
            return response()->json(['message' => 'User deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'User not deleted.'], 500);
        }
    }



}
