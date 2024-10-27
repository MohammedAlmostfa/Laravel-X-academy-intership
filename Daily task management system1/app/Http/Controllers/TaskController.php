<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Task;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        try {



            $task = Task::create([
                'Task_name' => $request->Task_name,
                'Description' => $request->Description,
                'Due_time' => $request->Due_time,
                   'User_id' => Auth::user()->id,
            ]);

            return redirect()->route('view')->with('success', 'Task created successfully');
        } catch (Exception $e) {
            Log::error('Error creating task: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create task');
        }
    }
}
