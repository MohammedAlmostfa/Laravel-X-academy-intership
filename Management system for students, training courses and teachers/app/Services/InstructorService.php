<?php

namespace App\Services;

use App\Models\Instructor;
use App\Models\Specialty;
use Exception;

class InstructorService
{
    /**
     * Retrieve all specialties.
     *
     * @return array
     */
    public function showAllInstructor(array $data)
    {
        try {
            if(isset($data['filterdata'])&& $data['filterdata'] == 'havecourses') {
                $instructor =  Instructor::bycourses()->get();
            } elseif(isset($data['filterdata'])&& $data['filterdata']=='havenotcourses') {

                $instructor =  Instructor::withoutcourses()->get();
            } else {
                // Fetch all  Instructor from the database
                $instructor =  Instructor::all();
            }
            return [
                'message' => 'المدرسين الموجودة',
                'data' => $instructor,
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
     * Create a new instructor.
     *
     * @param array $data
     * @return array
     */
    public function createInstructor($data)
    {
        try {
            // Create a new instructor with the provided data
            $instructor = Instructor::create([
                    'name' => $data['name'],
                    'experience' => $data['experience'],
                    'specialty' => $data['specialty'],
            ]);
            return [
                'message' => 'تم إضافة المدرس',
                'data' => $instructor,
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
     * Update an existing instructor.
     *
     * @param array $data
     * @param int $id
     * @return array
     */
    public function updateInstructor($data, $id)
    {
        try {
            // Find the instructor by ID
            $instructor = Instructor::find($id);
            if ($instructor) {
                // Update the instructor with the new data
                $instructor->update([
                    'name' => $data['name']??$instructor->name,
                    'experience' => $data['experience']??$instructor->experience,
                    'specialty' => $data['specialty']??$instructor->specialty,
                ]);
                return [
                    'message' => 'تم تحديث المدرس',
                    'data' => $instructor,
                    'status' => 200,
                ];
            } else {
                // Handle the case where the instructor is not found
                return [
                    'message' => 'لم يتم العثور على المدرس',
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
     * Retrieve a specific instructor by ID.
     *
     * @param int $id
     * @return array
     */
    public function showInstructor($id)
    {
        try {
            // Find the instructor by ID

            $instructor = Instructor::with('courses')->find($id);
            if ($instructor) {
                return [
                    'message' => 'المدرس',
                    'data' => $instructor,
                    'status' => 200,
                ];
            } else {
                // Handle the case where the instructor is not found
                return [
                    'message' => 'لم يتم العثور على المدرس',
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
     * Delete a specific instructor by ID.
     *
     * @param int $id
     * @return array
     */
    public function deleteInstructor($id)
    {
        try {
            // Find the instructor by ID
            $instructor = Instructor::find($id);
            if ($instructor) {
                // Delete the instructor
                $instructor->delete();
                return [
                    'message' => 'تم حذف المدرس',
                    'status' => 200,
                ];
            } else {
                // Handle the case where the instructor is not found
                return [
                    'message' => 'لم يتم العثور على المدرس',
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
