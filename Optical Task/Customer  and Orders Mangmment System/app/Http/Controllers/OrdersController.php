<?php

namespace App\Http\Controllers;

use App\Http\Requests\customer\customernrequestcreat;
use App\Http\Requests\customer\customernrequestupdate;
use App\Models\Product;
use App\Services\ApiResponseService;
use App\Services\OrdertService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $OrdertService;
    protected $apiRseponseService;

    public function __construct(OrdertService $OrdertService, ApiResponseService $apiRseponseService)
    {
        $this->OrdertService = $OrdertService;
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
        $result=$this->OrdertService->createOrder($validateddata);
        return $this->apiRseponseService->success('Order created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result=$this->OrdertService->ShowOrder($id);
        return $this->apiRseponseService->ValueShow('Order data:', $result, );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(customernrequestupdate $request, $id)
    {
        $validateddata=$request->validated();
        $result=$this->OrdertService->updateOrder($validateddata, $id);
        return $this->apiRseponseService->success('Order updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result=$this->OrdertService->DeletOrder($id);
        return $this->apiRseponseService->success('Order deleted successfully');

    }
}
