<?php

namespace App\Http\Controllers;

use App\Http\Requests\ratingformrequest;
use App\Http\Requests\TaskRequest;

use App\Service\TaskService;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskservisce;
    public function __construct(TaskService $taskservisce)
    {

        $this->taskservisce = $taskservisce;
    }
    //**________________________________________________________________________________________________
    /**
     ** show all task
     **@parm TaskRequest $request
     **@return \Illuminate\Http\JsonResponse(data,message,status)
     */
    public function index(TaskRequest $request)
    {
        $validatedData = $request->validated();
        $result = $this->taskservisce->showAllTasks($validatedData);

        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    /**
     ** creat new task
     **@parm TaskRequest $request
     **@return \Illuminate\Http\JsonResponse (data,message,status)
     */
    public function store(TaskRequest $request)
    {// validate data
        $validatedData = $request->validated();
        $result = $this->taskservisce->createTask($validatedData);

        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    /**
     ** updat the   task
     **@parm TaskRequest $request
     **@parm $id(id of task)
     **@return \Illuminate\Http\JsonResponse(data,message,status)
     */
    public function update(TaskRequest $request, $id)
    {
        $validatedData = $request->validated();
        $result = $this->taskservisce->updateTask($validatedData, $id);

        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    /**
     ** delet one of tasks
     **@parm T$id
     **@return \Illuminate\Http\JsonResponse(message,status)
     */

    public function destroy($id)
    {
        $result = $this->taskservisce->deleteTask($id);
        return response()->json([
            'message' => $result['message'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    /**
     ** show one of tasks
     **@parm T$id
     **@return \Illuminate\Http\JsonResponse(data,message,status)
     */
    public function show($id)
    {
        $result = $this->taskservisce->showTask($id);
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    /**
     **  assign one of tasks to user
     **@parm $id (id of taxk)
     **@parm assign  (id of user)
     **@return \Illuminate\Http\JsonResponse(data,message,status)
     */
    public function assign($id, $assign)
    {
        $result = $this->taskservisce->assignTask($id, $assign);
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    /**
   ** return one of tasks
   **@parm $id (id of taxk)
   **@return \Illuminate\Http\JsonResponse(data,message,status)
   */
    public function returntask($id)
    {
        $result =  $this->taskservisce->returnTask($id);
        //return the response
        return response()->json([
            'message' => $result['message'],
           'data' => $result['data'],
        ], $result['status']);

    }
    //**________________________________________________________________________________________________

    public function Rating($id, ratingformrequest $request)
    {
        $valitedData=$request->validated();
        $result =  $this->taskservisce->RatingUserTask($id, $valitedData);

        return response()->json([
                 'message' => $result['message'],
             ], $result['status']);


    }



}
