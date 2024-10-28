<?php
namespace App\Http\Controllers;

use App\Http\Requests\taskformrequestcreat;
use App\Http\Requests\taskformrequestfinish;
use App\Service\TaskService;  // تأكد من أن اسم المسار والخدمة صحيحة
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->getAllTasks();
        return view('dashboard', compact('tasks'));
    }
    public function getfinishedTask()
    {
        $tasks = $this->taskService->getfinishedTasks();
        return view('finishidTask', compact('tasks'));
    }
    public function store(taskformrequestcreat $request)
    {
        $vaildateddata = $request->validated();
        $result = $this->taskService->createTask($vaildateddata);
        return redirect()->route('dashboard')->with($result);

    }

    public function destroy($id)
    {
        $result = $this->taskService->deletTask($id);
        return redirect()->route('dashboard')->with($result);
    }

    public function finish(taskformrequestfinish $Result, $id)
    {
        $vaildateddata=$Result->validated();
        $result = $this->taskService->finishTask($vaildateddata, $id);
        return redirect()->route('dashboard')->with($result);



    }
}
