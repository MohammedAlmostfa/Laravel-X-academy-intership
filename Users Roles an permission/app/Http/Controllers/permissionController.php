<?php

namespace App\Http\Controllers;

use App\Http\Requests\crpermissionFormRequest;
use App\Http\Requests\uppermissionFormRequest;
use App\Models\permission;
use App\Service\PermissionService;
use Illuminate\Http\Request;

class permissionController extends Controller
{
    protected $PermissionService;
    public function __construct(PermissionService $PermissionService)
    {
        $this->PermissionService=$PermissionService;


    }



    public function index()
    {
        $result = $this->PermissionService->showAllPermissions();
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }


    public function store(crpermissionFormRequest $request)
    {
        // Get the validation of data
        $validatedData =  $request->validated();
        // get the result
        $result = $this->PermissionService->createPermission($validatedData);
        // return the result
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(uppermissionFormRequest $request, string $id)
    {
        // Get the validation of data
        $validatedData =  $request->validated();
        // get the result
        $result = $this->PermissionService->updatePermission($validatedData, $id);
        // return the result
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // get the result
        $result = $this->PermissionService->deletePermission($id);
        // return the result
        return response()->json([
            'message' => $result['message'],

        ], $result['status']);
    }
}
