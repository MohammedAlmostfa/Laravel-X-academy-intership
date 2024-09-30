<?php

namespace App\Http\Controllers;

use App\Http\Requests\order\orderformrequestcreat;
use App\Http\Requests\order\orderformrequestupdate;
use App\Http\Requests\order\orderformrequestget;

use App\Models\Product;
use App\Services\ApiResponseService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $OrderService;
    protected $apiRseponseService;

    public function __construct(OrderService $OrderService, ApiResponseService $apiRseponseService)
    {
        $this->OrderService = $OrderService;
        $this->apiRseponseService=$apiRseponseService;
    }

    public function index(orderformrequestget  $request)
    {
        $validateddata=$request->validated();

        $result = $this->OrderService->showAllOrders($validateddata);
        return $this->apiRseponseService->Showdata('Orders data:', $result);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(orderformrequestcreat  $request)
    {
        $validateddata=$request->validated();
        $result=$this->OrderService->createOrder($validateddata);
        return $this->apiRseponseService->success('Order created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result=$this->OrderService->ShowOrder($id);
        return $this->apiRseponseService->Showdata('Order data:', $result, );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(orderformrequestupdate $request, $id)
    {
        $validateddata=$request->validated();
        $result=$this->OrderService->updateOrder($validateddata, $id);
        return $this->apiRseponseService->success('Order updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result=$this->OrderService->deleteOrder($id);
        return $this->apiRseponseService->success('Order deleted successfully');

    }
}
