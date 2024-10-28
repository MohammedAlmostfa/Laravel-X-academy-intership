<?php
namespace App\Service;

use Exception;
use App\Models\Task;
use App\Jobs\SendMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class TaskService
{
    public function getAllTasks()
    {
        return Auth::user()->tasks()->byTask(null);
    }

    public function getFinishedTasks()
    {
        return Auth::user()->tasks()->byTask('finished');
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


            return ['success'=> 'Task created successfully'];
        } catch (Exception $e) {
            Log::error('Error creating task: ' . $e->getMessage());
            return ['error'=> 'Failed to create task'];
        }
    }

    public function deletTask($id)
    {
        try {
            $task=Task::find($id);
            $task->delete();
            return ['success'=> 'Task deleted successfully'];
        } catch (Exception $e) {
            Log::error('Error deleting task: ' . $e->getMessage());
            return ['error'=> 'Failed to delete task'];
        }
    }
    public function finishTask($data, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->update([
                'Task_name' => $task->Task_name,
                'Description' => $task->Description,
                'Due_time' => $task->Due_time,
                'User_id' => $task->User_id,
                'Status' => 'finished',
                'Result'=>$data['result'],
            ]);

            return ['success' => 'Task finished successfully'];
        } catch (Exception $e) {
            Log::error('Error finishing task: ' . $e->getMessage());
            return ['error' => 'Failed to finish task'];
        }
    }
}
