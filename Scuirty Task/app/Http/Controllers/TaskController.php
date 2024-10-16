<?php

namespace App\Http\Controllers;

use App\Http\Requests\statusFormRequestUpdate;
use App\Models\Task;
use App\Service\TaskService;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Service\ApiResponseService;
use App\Http\Requests\TaskFormRequestCreat;
use App\Http\Requests\TaskFormRequestUpdate;

class TaskController extends Controller
{
    protected $apiResponseService;
    protected $taskService;

    /**
     * Constructor to initialize services.
     *
     * @param TaskService $taskService
     * @param ApiResponseService $apiResponseService
     */
    public function __construct(ApiResponseService $apiResponseService, TaskService $taskService)
    {
        $this->taskService = $taskService;
        $this->apiResponseService = $apiResponseService;
    }

    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Retrieve all tasks and return them in the response
        $tasks = $this->taskService->getAllTasks();
        return $this->apiResponseService->Showdata('All tasks', $tasks);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param TaskFormRequestCreat $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TaskFormRequestCreat $request)
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Create the task using the TaskService
        $this->taskService->createTask($validatedData);

        // Return a success response
        return $this->apiResponseService->success('Task created successfully');
    }

    /**
     * Display the specified task.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Retrieve the task by its ID and return its data in the response
        $task = $this->taskService->showTask($id);
        return $this->apiResponseService->Showdata('Task data', $task);
    }

    /**
     * Update the specified task in storage.
     *
     * @param TaskFormRequestUpdate $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TaskFormRequestUpdate $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Update the task using the TaskService
        $this->taskService->updateTask($id, $validatedData);

        // Return a success response
        return $this->apiResponseService->success('Task updated successfully');
    }

    /**
     * Remove the specified task from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Delete the task using the TaskService
        $this->taskService->destroyTask($id);

        // Return a success response
        return $this->apiResponseService->success('Task deleted successfully');
    }


    /**
     * Update the status of a task.
     *
     * @param StatusFormRequestUpdate $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(StatusFormRequestUpdate $request, $id)
    {
        // Retrieve the task from the request (set by Middleware)
        $task = $request->get('task');

        // Retrieve the status from the request
        $status = $request->input('status');

        // Use the service to update the status
        $this->taskService->updateStatus($task, $status);

        return $this->apiResponseService->success('Status updated successfully');





    }
}
