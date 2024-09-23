<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialtyRequestCreate;
use App\Services\SpecialtyService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpecialtyController extends Controller
{
    protected $specialtyService;

    /**
     * Constructor to initialize SpecialtyService.
     *
     * @param SpecialtyService $specialtyService
     */
    public function __construct(SpecialtyService $specialtyService)
    {
        $this->specialtyService = $specialtyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = $this->specialtyService->showAllSpecialty();
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SpecialtyRequestCreate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SpecialtyRequestCreate $request)
    {
        $validatedData = $request->validated();
        $result = $this->specialtyService->createSpecialty($validatedData);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $result = $this->specialtyService->showSpecialty($id);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SpecialtyRequestCreate $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SpecialtyRequestCreate $request, string $id)
    {
        $validatedData = $request->validated();
        $result = $this->specialtyService->updateSpecialty($validatedData, $id);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $result = $this->specialtyService->deleteSpecialty($id);
        return response()->json(['message' => $result['message']], $result['status']);
    }
}
