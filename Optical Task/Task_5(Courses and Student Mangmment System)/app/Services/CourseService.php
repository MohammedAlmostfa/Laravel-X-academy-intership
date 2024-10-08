<?php

namespace App\Services;

use App\Models\Instructor;
use App\Models\Course;
use Exception;

class CourseService
{
    /**
     * Retrieve all courses.
     *
     * @return array
     */

    public function showAllCourses()
    {
        try {

            $courses = Course::all();



            return [
                'message' => 'الدورات الموجودة',
                'data' => $courses,
                'status' => 200,
            ];
        } catch (Exception $e) {
            // Handle any errors that occur during the fetch operation
            return [
                'message' => 'حدث خطأ أثناء عملية العرض' . $e,
                'data' => '',
                'status' => 500,
            ];
        }
    }

    /**
     * Create a new course.
     *
     * @param array $data
     * @return array
     */
    public function createCourse($data)
    {
        try {
            // Create a new course with the provided data
            $course = Course::create([
                'name' => $data['name'],
                'start_date' => $data['start_date'],
                'description' => $data['description'],
                'instructor_id' => $data['instructor_id'],
            ]);
            return [
                'message' => 'تم إضافة دورة',
                'data' => $course,
                'status' => 200,
            ];
        } catch (Exception $e) {
            // Handle any errors that occur during the creation process
            return [
                'message' => 'حدث خطأ أثناء عملية الإضافة' . $e,
                'data' => 'لا يوجد بيانات للإضافة',
                'status' => 500,
            ];
        }
    }

    /**
     * Update an existing course.
     *
     * @param array $data
     * @param int $id
     * @return array
     */
    public function updateCourse($data, $id)
    {
        try {
            // Find the course by ID
            $course = Course::find($id);
            if ($course) {
                // Update the course with the new data
                $course->update([
                    'name' => $data['name'] ?? $course->name,
                    'start_date' => $data['start_date'] ?? $course->start_date,
                    'description' => $data['description'] ?? $course->description,
                    'instructor_id' => $data['instructor_id'] ?? $course->instructor_id,
                ]);
                return [
                    'message' => 'تم تحديث الدورة',
                    'data' => $course,
                    'status' => 200,
                ];
            } else {
                // Handle the case where the course is not found
                return [
                    'message' => 'لم يتم العثور على الدورة',
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
     * Retrieve a specific course by ID.
     *
     * @param int $id
     * @return array
     */
    public function showCourse($id)
    {
        try {
            // Find the course by ID
            $course = Course::with('students')->find($id);
            if ($course) {
                return [
                    'message' => 'الدورة',
                    'data' => $course,
                    'status' => 200,
                ];
            } else {
                // Handle the case where the course is not found
                return [
                    'message' => 'لم يتم العثور على الدورة',
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
     * Delete a specific course by ID.
     *
     * @param int $id
     * @return array
     */
    public function deleteCourse($id)
    {
        try {
            // Find the course by ID
            $course = Course::find($id);
            if ($course) {
                // Delete the course
                $course->delete();
                return [
                    'message' => 'تم حذف الدورة',
                    'status' => 200,
                ];
            } else {
                // Handle the case where the course is not found
                return [
                    'message' => 'لم يتم العثور على الدورة',
                    'status' => 404,
                ];
            }
        } catch (Exception $e) {
            // Handle any errors that occur during the delete operation
            return [
                'message' => 'حدث خطأ أثناء عملية الحذف',
                'status' => 500,
            ];
        }
    }


    public function AddStudent($data, $courseId)
    {
        try {
            $course = Course::find($courseId);
            if ($course) {
                $student = $course->students()->wherePivot('student_id', $data['StudentId'])->exists();
                if ($student) {
                    return [
                       'message' => 'تم اضافة الطالب الى الدورة مسبقا',
                       'status' => 200
                   ];
                } else {

                    $course->students()->attach($data['StudentId']);
                    return [
                        'message' => 'تم اضافة الطالب الى الدورة',
                        'status' => 200       ];
                }
            } else {
                return [
                    'message' => ' الدورة غير موجودة',
                    'status' => 404
                ];
            }
        } catch (Exception $e) {
            // Handle any errors that occur during the delete operation
            return [
                'message' => 'حدث خطأ أثناء عملية الاضافة' . $e,
                'status' => 500,
            ];
        }
    }

    public function deleteStudent($data, $courseId)
    {
        try {
            $course = Course::find($courseId);
            if ($course) {
                $student = $course->students()->wherePivot('student_id', $data['StudentId'])->exists();
                if ($student) {
                    $course->students()->detach($data['StudentId']);
                    return [
                        'message' => 'تم حذف الطالب من الدورة',
                        'status' => 200,
                    ];
                } else {
                    return [
                        'message' => 'الطالب لا ينتمي الى الدورة',
                        'status' => 200,
                    ];
                }
            } else {
                return [
                    'message' => 'الدورة غير موجودة',
                    'status' => 404,
                ];
            }
        } catch (Exception $e) {
            // Handle any errors that occur during the delete operation
            return [
                'message' => 'حدث خطأ أثناء عملية الحذف: ' . $e->getMessage(),
                'status' => 500,
            ];
        }
    }
}
