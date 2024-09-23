<?php

namespace App\Services;

use App\Models\Specialty;
use Exception;

class SpecialtyService
{
    /**
     * Retrieve all specialties.
     *
     * @return array
     */
    public function showAllSpecialty()
    {
        try {
            // Fetch all specialties from the database
            $specialty = Specialty::all();
            return [
                'message' => 'الصلاحيات الموجودة',
                'data' => $specialty,
                'status' => 200,
            ];
        } catch (Exception $e) {
            // Handle any errors that occur during the fetch operation
            return [
                'message' => 'حدث خطأ أثناء عملية العرض',
                'data' => 'لا يوجد بيانات للعرض',
                'status' => 500,
            ];
        }
    }

    /**
     * Create a new specialty.
     *
     * @param array $data
     * @return array
     */
    public function createSpecialty($data)
    {
        try {
            // Create a new specialty with the provided data
            $specialty = Specialty::create([
                'SpecialtyName' => $data['SpecialtyName'],
            ]);
            return [
                'message' => 'تم إضافة الاختصاص',
                'data' => $specialty,
                'status' => 200,
            ];
        } catch (Exception $e) {
            // Handle any errors that occur during the creation process
            return [
                'message' => 'حدث خطأ أثناء عملية الإضافة',
                'data' => 'لا يوجد بيانات للإضافة',
                'status' => 500,
            ];
        }
    }

    /**
     * Update an existing specialty.
     *
     * @param array $data
     * @param int $id
     * @return array
     */
    public function updateSpecialty($data, $id)
    {
        try {
            // Find the specialty by ID
            $specialty = Specialty::find($id);
            if ($specialty) {
                // Update the specialty with the new data
                $specialty->update([
                    'SpecialtyName' => $data['SpecialtyName']??$specialty->SpecialtyName,
                ]);
                return [
                    'message' => 'تم تحديث الاختصاص',
                    'data' => $specialty,
                    'status' => 200,
                ];
            } else {
                // Handle the case where the specialty is not found
                return [
                    'message' => 'لم يتم العثور على الاختصاص',
                    'data' => 'لا يوجد بيانات للتحديث',
                    'status' => 404,
                ];
            }
        } catch (Exception $e) {
            // Handle any errors that occur during the update process
            return [
                'message' => 'حدث خطأ أثناء عملية التحديث',
                'data' => 'لا يوجد بيانات للتحديث',
                'status' => 500,
            ];
        }
    }

    /**
     * Retrieve a specific specialty by ID.
     *
     * @param int $id
     * @return array
     */
    public function showSpecialty($id)
    {
        try {
            // Find the specialty by ID
            $specialty = Specialty::find($id);
            if ($specialty) {
                return [
                    'message' => 'صلاحية',
                    'data' => $specialty,
                    'status' => 200,
                ];
            } else {
                // Handle the case where the specialty is not found
                return [
                    'message' => 'لم يتم العثور على الصلاحية',
                    'data' => 'لا يوجد بيانات للعرض',
                    'status' => 404,
                ];
            }
        } catch (Exception $e) {
            // Handle any errors that occur during the fetch operation
            return [
                'message' => 'حدث خطأ أثناء عملية العرض',
                'data' => 'لا يوجد بيانات للعرض',
                'status' => 500,
            ];
        }
    }

    /**
     * Delete a specific specialty by ID.
     *
     * @param int $id
     * @return array
     */
    public function deleteSpecialty($id)
    {
        try {
            // Find the specialty by ID
            $specialty = Specialty::find($id);
            if ($specialty) {
                // Delete the specialty
                $specialty->delete();
                return [
                    'message' => 'تم حذف الصلاحية',
                    'status' => 200,
                ];
            } else {
                // Handle the case where the specialty is not found
                return [
                    'message' => 'لم يتم العثور على الصلاحية',
                    'status' => 404,
                ];
            }
        } catch (Exception $e) {
            // Handle any errors that occur during the delete operation
            return [
                'message' => 'حدث خطأ أثناء عملية الحذف',
                'data' => 'لا يوجد بيانات للحذف',
                'status' => 500,
            ];
        }
    }
}
