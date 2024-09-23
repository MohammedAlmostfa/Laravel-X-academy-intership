<?php

namespace App\Service;

use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Log;

class RoleService
{
    /**
     * Display a listing of all roles.
     *
     * @return array
     */
    public function showAllRoles()
    {
        try {
            $roles = Role::all();
            return ['message' => 'تم عرض الأدوار بنجاح', 'data' => $roles, 'status' => 200];
        } catch (Exception $e) {
            Log::error('Error in show all roles: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء عرض الأدوار',
                'data' => 'لم يتم عرض البيانات',
                'status' => 500
            ];
        }
    }

    /**
     * Create a new role.
     *
     * @param array $data
     * @return array
     */
    public function createRole($data)
    {
        try {
            $role = Role::create([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);
            return ['message' => 'تم إضافة الدور بنجاح', 'data' => $role, 'status' => 200];
        } catch (Exception $e) {
            Log::error('Error in create role: ' . $e->getMessage());
            return
                [
                    'message' => 'حدث خطأ أثناء إضافة الدور',
                    'data' => 'لم يتم إضافة البيانات',
                    'status' => 500
                ];
        }
    }

    /**
     * Update the specified role.
     *
     * @param array $data
     * @param string $id
     * @return array
     */
    public function updateRole($data, $id)
    {
        try {
            $role = Role::find($id);
            if (!$role) {
                return ['message' => 'الدور غير موجود', 'data' => null, 'status' => 404];
            }
            $role->update([
                'name' => $data['name'] ?? $role->name,
                'description' => $data['description'] ?? $role->description,
            ]);
            return ['message' => 'تم تحديث الدور بنجاح', 'data' => $role, 'status' => 200];
        } catch (Exception $e) {
            Log::error('Error in update role: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء تحديث الدور',
                'data' => 'لم يتم تحديث البيانات',
                'status' => 500
            ];
        }
    }

    /**
     * Remove the specified role.
     *
     * @param string $id
     * @return array
     */
    public function deleteRole($id)
    {
        try {
            $role = Role::find($id);
            if ($role) {
                $role->delete();
                return ['message' => 'تم حذف الدور بنجاح', 'status' => 200];
            } else {
                return ['message' => 'الدور غير موجود', 'status' => 404];
            }
        } catch (Exception $e) {
            Log::error('Error in delete role: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء حذف الدور',
                'data' => 'لم يتم حذف البيانات',
                'status' => 500
            ];
        }
    }

    /**
     * Display the specified role.
     *
     * @param string $id
     * @return array
     */
    public function showRole($id)
    {
        try {
            $role = Role::find($id);
            if ($role) {
                return [
                    'message' => 'الدور',
                    'data' => $role,
                    'status' => 200,
                ];
            } else {
                return [
                    'message' => 'الدور غير موجود',
                    'status' => 404,
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in show role: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء عرض الدور: ' . $e->getMessage(),
                'status' => 500,
                'data' => 'لا يوجد بيانات'
            ];
        }
    }


    /**
     * Add a permission to a role.
     *
     * @param string $roleId
     * @param string $permissionId
     * @return array
     */
    public function addPermission($roleId, $permissionId)
    {
        try {
            $role = Role::find($roleId);
            if ($role) {
                $permission = Permission::find($permissionId);
                if ($permission) {
                    $role->permissions()->attach($permission);
                    return [
                        'message' => 'تم إضافة الإذن إلى الدور بنجاح',
                        'status' => 200,
                    ];
                } else {
                    return [
                        'message' => 'الإذن غير موجود',
                        'status' => 404,
                    ];
                }
            } else {
                return [
                    'message' => 'الدور غير موجود',
                    'status' => 404,
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in add permission: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء إضافة الإذن: ' . $e->getMessage(),
                'status' => 500,
                'data' => 'لا يوجد بيانات'
            ];
        }
    }

    /**
     * Remove a permission from a role.
     *
     * @param string $roleId
     * @param string $permissionId
     * @return array
     */
    public function deletePermission($roleId, $permissionId)
    {
        try {
            $role = Role::find($roleId);
            if ($role) {
                $permission = Permission::find($permissionId);
                if ($permission && $role->permissions()->where('permissions_id', $permissionId)->exists()) {
                    $role->permissions()->detach($permissionId);
                    return [
                        'message' => 'تم إزالة الإذن من الدور بنجاح',
                        'status' => 200,
                    ];
                } else {
                    return [
                        'message' => 'الإذن غير موجود أو غير مرتبط بهذا الدور',
                        'status' => 404,
                    ];
                }
            } else {
                return [
                    'message' => 'الدور غير موجود',
                    'status' => 404,
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in delete permission: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء إزالة الإذن: ' . $e->getMessage(),
                'status' => 500,
                'data' => 'لا يوجد بيانات'
            ];
        }
    }
}
