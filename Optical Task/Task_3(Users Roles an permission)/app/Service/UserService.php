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
     ** @param$ dat(email, password,name,role)
     ** @return array(message,data[name],status)
     */
    public function showUsers()
    {
        try {
            //get the data
            $data = User::get();
            //return data of user
            return [
                'message' => 'بيانات المستخدمين',
                'status' => 200,
                'data' => $data,
            ];
        } catch (Exception $e) {
            Log::error('Error in show all users  : ' . $e->getMessage());
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
     ** @param$ data email, password,name,role)
     ** @return array (message,data[name,email,role],status)
     */
    public function createUser($credentials)
    {
        try {
            $user = User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password'=>$credentials['password'],

            ]);


            //return $user data
            return [
                'message' => 'نم انشاء الحساب',
                'status' => 200,
                'data' => [
                    'name' => $user['name'],
                    'email' => $user['email'],
                ],
            ];
        } catch (Exception $e) {
            Log::error('Error in creat user  : ' . $e->getMessage());
            return [
                'message' => 'حدث خطاء اثنا انشاء الحساب' . $e->getMessage(),
                'status' => 500,
                'data' => $credentials,
            ];
        }
    }
    //**________________________________________________________________________________________________
    /**
     * *This function is creat to update a  user.
     **  @param$ data (email, password,name,role)
     **  @param $id (id of user)
     * *@return array (message,data[name,email,role],status)
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
                $user->update([
                    'name' => $data['name'] ?? $user->name,
                    'email' => $data['email'] ?? $user->email,
                    'password'=>$data['password']?? $user->password,

                ]);


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
     **@param $id (id of user)
     * *@return  (status, data,message)
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
            Log::error('Error in delet user: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء الحذف',
                'status' => 500,
            ];
        }
    }

    //**________________________________________________________________________________________________
    /**
     * *This function is creat to show  a user.
     **@param $id(id of user)
     * *@return ($message,status,data)
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
            Log::error('Error in show user s task: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء العرض',
                'status' => 500,
                'data' => 'لا يوجد بيانات'
            ];
        }
    }

    public function addRole($userId, $roleId)
    {
        try {
            $user = User::find($userId);
            if ($user) {
                $user->roles()->attach($roleId);
                return [
                    'message' => 'تم تعيين المستخدم بدور',
                    'status' => 200,
                ];
            } else {
                return [
                    'message' => 'المستخدم غير موجود',
                    'status' => 404,
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in add role: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء تعيين الدور'. $e->getMessage(),
                'status' => 500,
                'data' => 'لا يوجد بيانات'
            ];
        }
    }
    public function deleteRole($userId, $roleId)
    {
        try {
            $user = User::find($userId);
            if ($user && $user->roles()->where('role_id', $roleId)->exists()) {
                $user->roles()->detach($roleId);
                return [
                    'message' => 'تم إلغاء الدور للمستخدم بنجاح',
                    'status' => 200,
                ];
            } else {
                return [
                    'message' => 'المستخدم أو الدور غير موجود',
                    'status' => 404,
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in delete role: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء إلغاء الدور: ' . $e->getMessage(),
                'status' => 500,
                'data' => 'لا يوجد بيانات'
            ];
        }

    }



}
