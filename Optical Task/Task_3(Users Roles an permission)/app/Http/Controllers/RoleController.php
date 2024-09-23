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

    /**
     * Constructor to initialize RoleService.
     *
     * @param RoleService $RoleService
     */
    public function __construct(RoleService $RoleService)
    {
        $this->RoleService = $RoleService;
    }

    /**
     * Display a listing of all roles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = $this->RoleService->showAllRoles();
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }

    /**
     * Store a newly created role in storage.
     *
     * @param crRoleFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(crRoleFormRequest $request)
    {
        // Get the validation of data
        $validatedData =  $request->validated();
        // Get the result
        $result = $this->RoleService->createRole($validatedData);
        // Return the result
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }

    /**
     * Update the specified role in storage.
     *
     * @param upRoleFormRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(upRoleFormRequest $request, string $id)
    {
        // Get the validation of data
        $validatedData =  $request->validated();
        // Get the result
        $result = $this->RoleService->updateRole($validatedData, $id);
        // Return the result
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }

    /**
     * Remove the specified role from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        // Get the result
        $result = $this->RoleService->deleteRole($id);
        // Return the result
        return response()->json([
            'message' => $result['message'],
        ], $result['status']);
    }

    /**
     * Add a permission to a role.
     *
     * @param string $permission
     * @param string $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function addpermission(string $permission, string $role)
    {
        $result = $this->RoleService->addPermission($role, $permission);
        // Return the result
        return response()->json([
            'message' => $result['message'],
        ], $result['status']);
    }

    /**
     * Remove a permission from a role.
     *
     * @param string $permission
     * @param string $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletpermission(string $permission, string $role)
    {
        $result =  $this->RoleService->deletePermission($permission, $role);
        // Return the response
        return response()->json([
            'message' => $result['message'],
        ], $result['status']);
    }

    /**
     * Display the specified role.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $result =  $this->RoleService->showrole($id);
        // Return the response
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
}
