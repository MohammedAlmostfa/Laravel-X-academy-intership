<?php

namespace App\Http\Controllers;

use App\Http\Requests\crpermissionFormRequest;
use App\Http\Requests\uppermissionFormRequest;
use App\Models\Permission;
use App\Service\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $PermissionService;

    /**
     * Constructor to initialize PermissionService.
     *
     * @param PermissionService $PermissionService
     */
    public function __construct(PermissionService $PermissionService)
    {
        $this->PermissionService = $PermissionService;
    }

    /**
     * Display a listing of all permissions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = $this->PermissionService->showAllPermissions();
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param crpermissionFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(crpermissionFormRequest $request)
    {
        // Get the validation of data
        $validatedData = $request->validated();
        // Get the result
        $result = $this->PermissionService->createPermission($validatedData);
        // Return the result
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }

    /**
     * Update the specified permission in storage.
     *
     * @param uppermissionFormRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(uppermissionFormRequest $request, string $id)
    {
        // Get the validation of data
        $validatedData = $request->validated();
        // Get the result
        $result = $this->PermissionService->updatePermission($validatedData, $id);
        // Return the result
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        // Get the result
        $result = $this->PermissionService->deletePermission($id);
        // Return the result
        return response()->json([
            'message' => $result['message'],
        ], $result['status']);
    }

    /**
     * Display the specified permission.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Get the result
        $result = $this->PermissionService->showPermission($id);
        // Return the result
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
}
