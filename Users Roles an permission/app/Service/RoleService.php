<?php

namespace App\Service;

use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Log;

class RoleService
{
    public function showAllRoles()
    {
        try {
            $roles = Role::all();
            return ['message' => 'تم عرض الأدوار بنجاح', 'data' => $roles, 'status' => 200];
        } catch (Exception $e) {
            Log::error('Error in show all roles: ' . $e->getMessage());
            return ['message' => 'حدث خطأ أثناء عرض الأدوار', 'data' => 'لم يتم عرض البيانات', 'status' => 500];
        }
    }

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
            return ['message' => 'حدث خطأ أثناء إضافة الدور', 'data' => 'لم يتم إضافة البيانات', 'status' => 500];
        }
    }
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
            return ['message' => 'حدث خطأ أثناء تحديث الدور', 'data' => 'لم يتم تحديث البيانات', 'status' => 500];
        }
    }

    public function deleteRole($id)
    {
        try {
            $role = Role::find($id);
            if ($role) {
                $role->delete();
                return ['message' => 'تم حذف الدور بنجاح',  'status' => 200];
            } else {
                return ['message' => 'الدور غير موجود', 'status' => 404];
            }
        } catch (Exception $e) {
            Log::error('Error in delete role: ' . $e->getMessage());
            return ['message' => 'حدث خطأ أثناء حذف الدور', 'data' => 'لم يتم حذف البيانات', 'status' => 500];
        }
    }
}
