<?php

namespace App\Http\Controllers;

use App\Http\Requests\crRoleFormRequest;
use App\Http\Requests\upRoleFormRequest;
use App\Models\Role;
use App\Service\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $RoleService;

    public function __construct(RoleService $RoleService)
    {
        $this->RoleService = $RoleService;
    }

    public function index()
    {
        $result = $this->RoleService->showAllRoles();
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }


    public function store(crRoleFormRequest $request)
    {
        // Get the validation of data
        $validatedData =  $request->validated();
        // get the result
        $result = $this->RoleService->createRole($validatedData);
        // return the result
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(upRoleFormRequest $request, string $id)
    {
        // Get the validation of data
        $validatedData =  $request->validated();
        // get the result
        $result = $this->RoleService->updateRole($validatedData, $id);
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
        $result = $this->RoleService->deleteRole($id);
        // return the result
        return response()->json([
            'message' => $result['message'],

        ], $result['status']);
    }
}
