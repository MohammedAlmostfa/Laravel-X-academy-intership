<?php

namespace App\Service;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    /**
     * This function is created to store a new task.
     * @param array $data
     * @return array(data,status,message)
     */
    public function createTask($data)
    {
        try {
            // Create a new task
            $task = Task::create($data);
            // Return data
            return [
                'message' => 'تم إنشاء المهمة',
                'data' => $task,
                'status' => 200,
            ];
        } catch (Exception $e) {
            Log::error('Error in creating task: ' . $e->getMessage());

            return [
                'message' => 'حدث خطأ أثناء إنشاء المهمة',
                'status' => 500,
                'data' => 'لم يتم عرض البيانات'
            ];
        }
    }

    /**
     * This function is created to update an existing task.
     * @param array $data
     * @param int $id
     * @return array(data,status,message)
     */
    //بتم في هذا الكود التحقق من دور المستخدم الذي قوم بالعملية والتحقق بصلاحيتو بالتديل عليها و بالبيانات الت سوف يعدلها
    public function updateTask($data, $id)
    {
        try {
            $task = Task::find($id);
            // Check if the task exists
            if (!$task) {
                return [
                    'message' => 'المهمة غير موجودة',
                    'status' => 404,
                    'data' => 'لم يتم عرض البيانات'
                ];
            }

            // Check if the role of  user to allow him to change the status of the task and the task is assogned to him
            if (Auth::user()->role == 'user' && Auth::user()->id == $task->assigned_to) {
                // chck ih he want to updat the status of task
                if (isset($data['status'])) {
                    // Update the status
                    $task->update(['status' => $data['status'] ?? $task->status]);
                    //if he want update  the status of task
                    return [
                        'message' => 'تم تغيير حالة المهمة',
                        'data' => $task,
                        'status' => 201,
                    ];
                } else {
                    //if he want update  the information of task
                    return [
                        'message' => 'لا يحق لك تغيير إلا حالة المهمة',
                        'status' => 403,
                        'data' => 'لم يتم عرض البيانات'
                    ];
                }
                // Check if the role of user to allow him to change the information of task  and he add the task
            } elseif (Auth::user()->role != 'user' && Auth::user()->id == $task->assigned_by) {
                if (isset($data['status'])) {
                    return [
                        // if he want to update th status of task
                        'message' => 'لا يحق لك تغيير حالة المهمة',
                        'status' => 403,
                        'data' => 'لم يتم عرض البيانات'
                    ];
                } else {
                    // Update the data
                    $task->update([
                        'title' => $data['title'] ?? $task->title,
                        'description' => $data['description'] ?? $task->description,
                        'priority' => $data['priority'] ?? $task->priority,
                        'due_date' => $data['due_date'] ?? $task->due_date,
                        'assigned_to' => $data['assigned_to'] ?? $task->assigned_to,
                    ]);

                    return [
                        'message' => 'تمت عملية التحديث بنجاح',
                        'status' => 200,
                        'data' => $task
                    ];
                }
                // if he dos't check th prievous conditions
            } else {
                return [
                    'message' => 'لا يحق لك القيام بهذه العملية',
                    'status' => 403,
                    'data' => 'لم يتم عرض البيانات'
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in updating task: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء التحديث',
                'status' => 500,
                'data' => 'لم يتم تحديث البيانات'
            ];
        }
    }


    /**
     * This function is created to delete an existing task.
     * @param int $id
     * @return array(status,message)
     */
    public function deleteTask($id)
    {
        try {
            $task = Task::find($id);

            // Check if the task exists
            if (!$task) {
                return [
                    'message' => 'المهمة غير موجودة',
                    'status' => 404,
                ];
            }

            // Delete the task
            $task->delete();

            return [
                'message' => 'تمت عملية الحذف بنجاح',
                'status' => 200,
            ];
        } catch (Exception $e) {
            Log::error('Error in deleting task: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء الحذف',
                'status' => 500,
            ];
        }
    }
    /**
     * This function is created to show an existing task.
     * @param int $id
     * @return array(data,status,message)
     */
    public function showTask($id)
    {
        try {
            $task = Task::find($id);

            // Check if the task exists
            if (!$task) {
                return [
                    'message' => 'المهمة غير موجودة',
                    'data' => 'لا يوجد بيانات',
                    'status' => 404,
                ];
            }

            return [
                'message' => 'تمت عملية العرض بنجاح',
                'data' => $task,
                'status' => 200,
            ];
        } catch (Exception $e) {
            Log::error('Error in showing task: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء العرض',
                'status' => 500,
            ];
        }
    }

    /**
     * This function is created to show all tasks.
     * @param  TaskRequest $taskRequest
     * @return array(data,status,message)
     */
    public function showAllTasks(TaskRequest $taskRequest)
    {
        try {
            $tasks = Task::query();

            if ($taskRequest->has('priority')) {
                $tasks = $tasks->bypriority($taskRequest['priority']);
            }
            if ($taskRequest->has('status')) {
                $tasks = $tasks->bystatus($taskRequest['status']);
            }

            return [
                'message' => 'تمت عملية العرض بنجاح',
                'data' => $tasks,
                'status' => 200,
            ];
        } catch (Exception $e) {
            Log::error('Error in showing tasks: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء العرض',
                'status' => 500,
            ];
        }
    }
}
