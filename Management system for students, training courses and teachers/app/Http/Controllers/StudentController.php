<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequestCreat;
use App\Http\Requests\StudentRequestUpdate;

use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    protected $StudentService;

    /**
     * Constructor to initialize StudentService.
     *
     * @param StudentService $StudentService
     */
    public function __construct(StudentService $StudentService)
    {
        $this->StudentService = $StudentService;
    }

    /**
     * Display a listing of the Student.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = $this->StudentService->showAllStudent();
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Store a newly created Student in storage.
     *
     * @param StudentRequestCreate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StudentRequestCreat $request)
    {
        $validatedData = $request->validated();
        $result = $this->StudentService->createStudent($validatedData);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Display the specified Student resource.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $result = $this->StudentService->showStudent($id);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Update the specified Student in storage.
     *
     * @param StudentRequestUpdate $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StudentRequestUpdate $request, string $id)
    {
        $validatedData = $request->validated();
        $result = $this->StudentService->updateStudent($validatedData, $id);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Remove the specified Student from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $result = $this->StudentService->deleteStudent($id);
        return response()->json(['message' => $result['message']], $result['status']);
    }
}
