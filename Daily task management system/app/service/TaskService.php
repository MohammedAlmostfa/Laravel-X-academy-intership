<?php
namespace App\Service;

use Exception;
use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function getAllTasks()
    {
        return Auth::user()->tasks()->select(['id', 'Task_name', 'Description'])->get();
    }

    public function createTask($data)
    {
        try {
            $task = Task::create([
                'Task_name' => $data['Task_name'],
                'Description' => $data['Description'],
                'Due_time' => $data['Due_time'],
                'User_id' => Auth::user()->id,
            ]);

            return ['success', 'Task created successfully'];
        } catch (Exception $e) {
            Log::error('Error creating task: ' . $e->getMessage());
            return ['error', 'Failed to create task'];
        }
    }

    public function deletTask($id)
    {
        try {
            $task=Task::find($id);
            $task->delete();
            return ['success', 'Task deleted successfully'];
        } catch (Exception $e) {
            Log::error('Error deleting task: ' . $e->getMessage());
            return ['error', 'Failed to delete task'];
        }
    }
}
