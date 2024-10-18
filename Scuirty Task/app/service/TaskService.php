<?php

namespace App\Service;

use App\Models\Attachment;
use App\Models\Task;
use App\Models\Comment;
use App\Models\TaskDependencies;
use App\Models\TaskStatusUpdate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskService
{
    /**
     * Get all tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTasks($filters)
    {

        try {

            $query = Task::query();

            $tasks =$query->type($filters['type'] ?? null)
                ->status($filters['status'] ?? null)
                ->assignedTo($filters['assigned_to'] ?? null)
                ->dueDate($filters['due_date'] ?? null)
                ->priority($filters['priority'] ?? null)
                ->dependsOn($filters['depends_on'] ?? null)
                ->paginate(5);


            return $tasks;
        } catch (\Exception $e) {
            Log::error('Failed to retrieve tasks: ' . $e->getMessage());
            throw new \Exception('An error occurred on the server.');
        }

    }

    /**
     * Create a new task.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function createTask($data)
    {
        try {
            // Create a new task using the provided data
            $task = Task::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'type' => $data['type'],
                'status' => $data['status'],
                'priority' => $data['priority'],
                'due_date' => $data['due_date'],
            ]);

            return true;

        } catch (\Exception $e) {
            // Log the error and throw an exception
            Log::error('Error creating task: ' . $e->getMessage());
            throw new \Exception('Error creating task: '. $e->getMessage());
        }
    }

    /**
     * Update an existing task.
     *
     * @param int $id
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function updateTask($id, $data)
    {
        try {
            // Find the task by its ID
            $task = Task::findOrFail($id);

            // Update the task with the provided data
            $task->update([
                'title' => $data['title'] ?? $task->title,
                'description' => $data['description'] ?? $task->description,
                'type' => $data['type'] ?? $task->type,
                'status' => $data['status'] ?? $task->status,
                'priority' => $data['priority'] ?? $task->priority,
                'due_date' => $data['due_date'] ?? $task->due_date,
                'assigned_to' => $data['assigned_to'] ?? $task->assigned_to,
            ]);

        } catch (ModelNotFoundException $e) {
            // Log the error and throw an exception if the task is not found
            Log::error('Task not found: ' . $e->getMessage());
            throw new \Exception('Task not found: ');

        } catch (\Exception $e) {
            // Log any other errors and throw an exception
            Log::error('Error updating task: ' . $e->getMessage());
            throw new \Exception('Error updating task: ');
        }
    }

    /**
     * Show a specific task.
     *
     * @param int $id
     * @return Task
     * @throws \Exception
     */
    public function showTask($id)
    {
        try {
            // Find the task by its ID
            $task = Task::findOrFail($id);
            return $task;

        } catch (ModelNotFoundException $e) {
            // Log the error and throw an exception if the task is not found
            Log::error('Task not found: ' . $e->getMessage());
            throw new \Exception('Task not found: ');
        }
    }

    /**
     * Delete a task.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroyTask($id)
    {
        try {
            // Find the task by its ID
            $task = Task::findOrFail($id);
            $task->delete();

            return true;

        } catch (ModelNotFoundException $e) {
            // Log the error and throw an exception if the task is not found
            Log::error('Task not found: ' . $e->getMessage());
            throw new \Exception('Task not found: ');

        } catch (\Exception $e) {
            // Log any other errors and throw an exception
            Log::error('Error deleting task: ' . $e->getMessage());
            throw new \Exception('Error deleting task: ');
        }
    }



    /**
      * Update the status of a task.
      *
      * @param Task $task
      * @param string $status
      * @return bool
      * @throws \Exception
      */
    public function updateStatus(Task $task, $status)
    {
        try {

            $dependency = TaskDependencies::where('task_id', $task->id)->first();

            if ($dependency) {
                $dependentTask = Task::find($dependency->task_depend_on);
                if ($dependentTask->status != 'completed') {
                    return false;
                }
            }


            $task->status = $status;
            $task->save();


            TaskStatusUpdate::create([
                'task_id' => $task->id,
                'task_status' => $status,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Status update failed: ' . $e->getMessage());
            throw new \Exception('Status update failed: ' . $e->getMessage());
        }

    }


    public function assignTask($data, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->assigned_to = $data['user_id'];
            $task->save();
        } catch (ModelNotFoundException $e) {
            // Log the error and throw an exception if the task is not found
            Log::error('Task not found: ' . $e->getMessage());
            throw new \Exception('Task not found: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Log any other errors and throw an exception
            Log::error('Error assigning task: ' . $e->getMessage());
            throw new \Exception('Error assigning task: ' . $e->getMessage());
        }
    }

    public function reassiganTask($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->assigned_to = null;
            $task->save();
        } catch (ModelNotFoundException $e) {
            // Log the error and throw an exception if the task is not found
            Log::error('Task not found: ' . $e->getMessage());
            throw new \Exception('Task not found: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Log any other errors and throw an exception
            Log::error('Error reassigning task: ' . $e->getMessage());
            throw new \Exception('Error reassigning task: ' . $e->getMessage());
        }
    }

    public function connectTask($data)
    {
        try {
            TaskDependencies::create([
                'task_id' =>$data['task_id'],
                'task_depend_on' => $data['depend_on_task_id'],
            ]);
            $task=Task::find($data['task_id']);

            if($task->status!='completed') {
                $task->status='Blocked';
                $task->save();
            }
        } catch (\Exception $e) {
            Log::error('Failed to create task dependency: ' . $e->getMessage());
            throw new \Exception('Failed to create task dependency: ' . $e->getMessage());
        }
    }



}
