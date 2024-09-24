<?php

namespace App\Http\Controllers;

use App\Http\Requests\customer\customernrequestcreat;
use App\Http\Requests\customer\customernrequestupdate;
use App\Models\Product;
use App\Services\ApiResponseService;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $CustomerService;
    protected $apiRseponseService;

    public function __construct(CustomerService $CustomerService, ApiResponseService $apiRseponseService)
    {
        $this->CustomerService = $CustomerService;
        $this->apiRseponseService=$apiRseponseService;
    }

    public function index()
    {
        //  $result=$this->CustomerService->ShowAllProduct();
        //  return $this->apiRseponseService->paginated($result);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(customernrequestcreat $request)
    {
        $validateddata=$request->validated();
        $result=$this->CustomerService->createCustomer($validateddata);
        return $this->apiRseponseService->success('Customer created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result=$this->CustomerService->ShowCustomer($id);
        return $this->apiRseponseService->ValueShow('Customer data:', $result, );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(customernrequestupdate $request, $id)
    {
        $validateddata=$request->validated();
        $result=$this->CustomerService->updateCustomer($validateddata, $id);
        return $this->apiRseponseService->success('Customer updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result=$this->CustomerService->DeleteCustomer($id);
        return $this->apiRseponseService->success('Customer deleted successfully');

    }
}
