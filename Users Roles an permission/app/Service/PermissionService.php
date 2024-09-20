<?php

namespace App\Service;

use App\Models\permission;
use Exception;
use Illuminate\Support\Facades\Log;

class PermissionService
{
    // عرض جميع الصلاحيات
    public function showAllPermissions()
    {
        try {
            $permissions = permission::all();
            return ['message' => 'تم عرض الصلاحيات بنجاح', 'data' => $permissions, 'status' => 200,];
        } catch (Exception $e) {
            Log::error('Error in show all permissions: ' . $e->getMessage());
            return ['message' => 'حدث خطأ أثناء عرض الصلاحيات', 'data' => 'لم يتم عرض البيانات', 'status' => 500,];
        }
    }

    // إنشاء صلاحية جديدة
    public function createPermission($data)
    {
        try {
            $permission = permission::create([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);
            return ['message' => 'تم إضافة الصلاحية بنجاح', 'data' => $permission, 'status' => 200,];
        } catch (Exception $e) {
            Log::error('Error in create permission: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء إضافة الصلاحية'. $e->getMessage(),
                'data' => 'لم يتم إضافة البيانات',
                'status' => 500,
            ];
        }
    }

    // تحديث صلاحية موجودة
    public function updatePermission($data, $id)
    {
        try {
            $permission = permission::find($id);
            $permission->update([
                'name' => $data['name'] ?? $permission->name,
                'description' => $data['description'] ?? $permission->description,
            ]);
            return ['message' => 'تم تحديث الصلاحية بنجاح', 'data' => $permission, 'status' => 200,];
        } catch (Exception $e) {
            Log::error('Error in update permission: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء تحديث الصلاحية',
                'data' => 'لم يتم تحديث البيانات',
                'status' => 500,
            ];
        }
    }


    public function deletePermission($id)
    {
        try {
            $permission = Permission::find($id);
            $permission->delete();
            return [
                'message' => 'تم حذف الصلاحية بنجاح',
                'data' => $permission,
                'status' => 200,
            ];
        } catch (Exception $e) {
            Log::error('Error in delete permission: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء حذف الصلاحية',
                'data' => 'لم يتم حذف البيانات',
                'status' => 500,
            ];
        }
    }
}
