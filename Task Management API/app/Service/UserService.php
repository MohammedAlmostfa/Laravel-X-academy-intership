<?php

namespace App\Service;

use App\Models\User;

use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class UserService
{
    //**________________________________________________________________________________________________
    /**
     **This function is created to show all the user.
     ** @param$ data           (email, password,name,role)
     ** @return array          (message,data[name],status)
     */


    public function showUsers()
    {
        try {
            //get the data
            $data = User::byRole('user')->get(['id','name']);
            //return data of user
            return ['message' => 'بيانات المستخدمين', 'status' => 200, 'data' => $data,];
        } catch (Exception $e) {
            return [
                'message' => 'حدث خطاء اثنا عرض المستخدمسن',
                'status' => 500,
                'data' => 'لم يتم عرض البيانات'
            ];
        }
    }
    //**________________________________________________________________________________________________
    /**
     **This function is created to store a new User.
     ** @param$ data           (email, password,name,role)
     ** @return array          (message,data[name,email,role],status)
     */
    public function createUser($credentials)
    {
        try {
            // Create user
            $user = new User;
            $user->email = $credentials['email'];
            $user->name = $credentials['name'];
            $user->password = $credentials['password'];
            $user->role = $credentials['role'];
            $user->save();

            //return $user data
            return [
                'message' => 'نم انشاء الحساب',
                'status' => 200,
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
            ];
        } catch (Exception $e) {
            Log::error('Error in returning book: ' . $e->getMessage());
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
     **  @param$ data         (email, password,name,role)
     **  @param $id           (id of user)
     * *@return array         (message,data[name,email,role],status)
     */
    public function updateUser($data, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return [
                    'message' => 'المستخدم غير موجود',
                    'status' => 404,
                    'data' => 'لا يوجد بيانات'
                ];
            } else {
                //update user
                $user->name = $data['name'] ?? $user->name;
                $user->email = $data['email'] ?? $user->email;
                $user->password = $data['password'] ?? $user->password;
                $user->role = $data['role'] ?? $user->role;
                $user->save();

                return [
                    'message' => 'تمت عملية التحديث',
                    'status' => 200,
                    'data' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in updating user: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء التحديث',
                'status' => 500,
                'data' => 'لم يتم تحديث البيانات'
            ];
        }
    }
    //**________________________________________________________________________________________________
    /**
     * *This function is creat to delet  a user.
     **@param $id                (id of user)
     * *@return                  (status, data,message)
     */
    public function deletUser($id)
    {
        try {
            // find the user
            $user = User::find($id);
            if (!$user) {
                //if the user not exist
                return [
                    'message' => 'المستخدم غير موجود',
                    'status' => 404,
                ];
            } else {
                //delete the user
                $user->delete();
                return [
                    'message' => 'تمت عملية الحذف',
                    'status' => 200,
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in returning book: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء الحذف',
                'status' => 500,
            ];
        }
    }
    //**________________________________________________________________________________________________
    /**
     * *This function is creat to show  a user.
     **@param $id                    (id of user)
     * *@return                      ($message,status,data)
     */
    public function showUser($id)
    {

        try {
            //find the user
            $user = User::find($id);

            if (empty($user)) {
                //if the user not exist
                return [
                    'message' => 'المستخدم غير موجود',
                    'status' => 404,
                    'data' => 'لا يوجد بيانات'
                ];
            } else {
                // rturn uuser data
                return [
                    'message' => 'بيانات المستخدم',
                    'data' => $user,
                    'status' => 200,
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in returning book: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء العرض',
                'status' => 500,
                'data' => 'لا يوجد بيانات'
            ];
        }
    }
}