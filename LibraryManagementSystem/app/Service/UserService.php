<?php

namespace App\Service;

use App\Models\User;

use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{

    /**
        * *This function is created to store a new User.
        ** @param$ data
        * *@return \Illuminate\Http\JsonResponse
        */

    public function createUser($credentials)
    {
        try {
            $user = User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password']),
            ]);
            return [
                'message' => 'تم تسجيل الدخول',
                'status' => 201,
                'data' => $user,
            ];
        } catch (Exception $e) {
            return [
                'message' => 'حدث خطاء اثنا انشاء الحساب',
                'status' => 500,
                'data' => 'لم يتم عرض البيانات'
            ];
        }
    }
    //**________________________________________________________________________________________________
    
    /**
     * *This function is creat to update a  user.
     * * @param $data
     * *@param User $user
     * *@return \Illuminate\Http\JsonResponse
     */
    public function updateUser($data, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return [
                'message' => 'المستخدم غير موجود',
                'status' => 404,
                'data' => 'لا يوجد بيانات'
            ];
        } else {
            try {
                $user->update($data);
                return [
                    'message' => 'تمت عملية التحديث',
                    'data' => $data,
                    'status' => 200,
                ];
            } catch (Exception $e) {
                return [
                    'message' => 'حدث خطأ أثناء التحديث',
                    'status' => 500,
                    'data' => 'لم يتم تحديث البيانات'
                ];
            }
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
