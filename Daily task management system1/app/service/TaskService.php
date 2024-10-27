<?php

namespace App\Service;

use Exception;
use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function createTask($data)
    {
        try {
            $task = Task::create([
                'Task_name' => $data['Task_name'],
                'Description' => $data['Description'],
                'Due_time' => $data['Due_time'],
                'User_id' => Auth::user()->id,
            ]);

            return redirect()->route('view')->with('success', 'Task created successfully');
        } catch (Exception $e) {
            $task = Task::create([
               'Task_name' => $data['Task_name'],
               'Description' => $data['Description'],
               'Due_time' => $data['Due_time'],
               'User_id' => Auth::user()->id,
           ]);

            Log::error('Error creating task: ' . $e->getMessage());
            return $task;
        }
    }
}
