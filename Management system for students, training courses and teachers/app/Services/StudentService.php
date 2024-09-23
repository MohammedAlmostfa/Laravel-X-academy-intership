<?php

namespace App\Services;

use App\Models\Student;
use Exception;

class StudentService
{
    /**
     * Retrieve all students.
     *
     * @return array
     */
    public function showAllStudent()
    {
        try {
            $students = Student::all();
            return [
                'message' => 'الطلاب الموجودة',
                'data' => $students,
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
     * Create a new student.
     *
     * @param array $data
     * @return array
     */
    public function createStudent($data)
    {
        try {
            // Create a new student with the provided data
            $student = Student::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            return [
                'message' => 'تم إضافة الطالب',
                'data' => $student,
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
     * Update an existing student.
     *
     * @param array $data
     * @param int $id
     * @return array
     */
    public function updateStudent($data, $id)
    {
        try {
            // Find the student by ID
            $student = Student::find($id);
            if ($student) {
                // Update the student with the new data
                $student->update([
                    'name' => $data['name'] ?? $student->name,
                    'email' => $data['email'] ?? $student->email,
                    'password' => $data['password']?? $student->password,
                ]);
                return [
                    'message' => 'تم تحديث الطالب',
                    'data' => $student,
                    'status' => 200,
                ];
            } else {
                // Handle the case where the student is not found
                return [
                    'message' => 'لم يتم العثور على الطالب',
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
     * Retrieve a specific student by ID.
     *
     * @param int $id
     * @return array
     */
    public function showStudent($id)
    {
        try {
            // Find the student by ID
            $student = Student::find($id);
            if ($student) {
                return [
                    'message' => 'الطالب',
                    'data' => $student,
                    'status' => 200,
                ];
            } else {
                // Handle the case where the student is not found
                return [
                    'message' => 'لم يتم العثور على الطالب',
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
     * Delete a specific student by ID.
     *
     * @param int $id
     * @return array
     */
    public function deleteStudent($id)
    {
        try {
            // Find the student by ID
            $student = Student::find($id);
            if ($student) {
                // Delete the student
                $student->delete();
                return [
                    'message' => 'تم حذف الطالب',
                    'status' => 200,
                ];
            } else {
                // Handle the case where the student is not found
                return [
                    'message' => 'لم يتم العثور على ',
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
