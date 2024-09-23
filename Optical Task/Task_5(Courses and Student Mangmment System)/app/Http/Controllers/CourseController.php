<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequestCreate;
use App\Http\Requests\CourseRequestGet;
use App\Http\Requests\CourseRequestUpdate;
use App\Http\Requests\CourseStudenAdd;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    protected $courseService;

    /**
     * Constructor to initialize CourseService.
     *
     * @param CourseService $courseService
     */
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of the courses.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $result = $this->courseService->showAllCourses();
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Store a newly created course in storage.
     *
     * @param CourseRequestCreate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CourseRequestCreate $request)
    {
        $validatedData = $request->validated();
        $result = $this->courseService->createCourse($validatedData);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Display the specified course resource.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $result = $this->courseService->showCourse($id);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Update the specified course in storage.
     *
     * @param CourseRequestUpdate $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CourseRequestUpdate $request, string $id)
    {
        $validatedData = $request->validated();
        $result = $this->courseService->updateCourse($validatedData, $id);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Remove the specified course from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $result = $this->courseService->deleteCourse($id);
        return response()->json(['message' => $result['message']], $result['status']);
    }

    public function addStudent(CourseStudenAdd $request, string $id)
    {
        $validatedData = $request->validated();
        $result = $this->courseService->AddStudent($validatedData, $id);
        return response()->json(['message' => $result['message']], $result['status']);

    }
    public function deletStudent(CourseStudenAdd $request, string $id)
    {
        $validatedData = $request->validated();
        $result = $this->courseService->deleteStudent($validatedData, $id);
        return response()->json(['message' => $result['message']], $result['status']);

    }


}
