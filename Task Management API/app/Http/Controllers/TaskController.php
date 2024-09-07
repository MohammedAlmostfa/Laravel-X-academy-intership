<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Service\TaskService;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskservisce;
    public function __construct(TaskService $taskservisce)
    {

        $this->taskservisce = $taskservisce;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */






    /**
     ** creat new task
     **@parm TaskRequest $request
     **@return \Illuminate\Http\JsonResponse
     */
    public function store(TaskRequest $request)
    {
        $validatedData=$request->validated();
        $result= $this->taskservisce->createTask($validatedData);

        return response()->json([
                   'message' => $result['message'],
                   'data' => $result['data'],
               ], $result['status']);
    }



    public function show(Task $task)
    {
        //
    }


    public function edit(Task $task)
    {
        //
    }
    /**
        ** updat the   task
        **@parm TaskRequest $request
        **@parm $id(id of task)
        **@return \Illuminate\Http\JsonResponse
        */

    public function update(TaskRequest$request, $id)
    {
        $validatedData=$request->validated();
        $result= $this->taskservisce->updateTask($validatedData, $id);

        return response()->json([
                   'message' => $result['message'],
                   'data' => $result['data'],
               ], $result['status']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {

    }
}
