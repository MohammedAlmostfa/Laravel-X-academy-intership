<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructorRequestCreate;
use App\Http\Requests\InstructorRequestUpdate;
use App\Http\Requests\InstructorRequestGet;
use App\Services\InstructorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InstructorController extends Controller
{
    protected $instructorService;

    /**
     * Constructor to initialize InstructorService.
     *
     * @param InstructorService $instructorService
     */
    public function __construct(InstructorService $instructorService)
    {
        $this->instructorService = $instructorService;
    }

    /**
     * Display a listing of the Instructor.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(InstructorRequestGet $request)
    {
        $validatedData = $request->validated();

        $result = $this->instructorService->showAllInstructor($validatedData);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Store a newly created Instructor in storage.
     *
     * @param InstructorRequestCreate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(InstructorRequestCreate $request)
    {
        $validatedData = $request->validated();
        $result = $this->instructorService->createInstructor($validatedData);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Display the specified Instructor resource.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $result = $this->instructorService->showInstructor($id);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Update the specified Instructor in storage.
     *
     * @param InstructorRequestUpdate $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(InstructorRequestUpdate $request, string $id)
    {
        $validatedData = $request->validated();
        $result = $this->instructorService->updateInstructor($validatedData, $id);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Remove the specified Instructor from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $result = $this->instructorService->deleteInstructor($id);
        return response()->json(['message' => $result['message']], $result['status']);
    }
}
