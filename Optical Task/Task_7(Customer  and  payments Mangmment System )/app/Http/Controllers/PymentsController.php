<?php

namespace App\Http\Controllers;

use App\Http\Requests\payment\paymentformrequesrget;
use App\Http\Requests\payment\paymentformrequestcreat;
use App\Http\Requests\payment\paymentformrequestupdate;
use App\Services\ApiResponseService;
use App\Services\PaymentsService;

class PymentsController extends Controller
{
    protected $PaymentsService;
    protected $apiRseponseService;

    public function __construct(PaymentsService $PaymentsService, ApiResponseService $apiRseponseService)
    {
        $this->PaymentsService = $PaymentsService;
        $this->apiRseponseService=$apiRseponseService;
    }

    public function index(paymentformrequesrget $request)
    {
        $validateddata=$request->validated();

        $result = $this->PaymentsService->showAllPayments($validateddata);
        return $this->apiRseponseService->Showdata('Orders data:', $result);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(paymentformrequestcreat  $request)
    {
        $validateddata=$request->validated();
        $result=$this->PaymentsService->createPayment($validateddata);
        return $this->apiRseponseService->success('Payment created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result=$this->PaymentsService->showPayment($id);
        return $this->apiRseponseService->Showdata('Payment data:', $result, );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(paymentformrequestupdate $request, $id)
    {
        $validateddata=$request->validated();
        $result=$this->PaymentsService->updatePayment($validateddata, $id);
        return $this->apiRseponseService->success('Payment updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result=$this->PaymentsService->deletePayment($id);
        return $this->apiRseponseService->success('Payment deleted successfully');

    }

    public function customer_pyment($id)
    {
        $result=$this->PaymentsService->customer_payment($id);
        return $this->apiRseponseService->Showdata(' customer Payments :', $result, );


    }

    public function lastpayment($id)
    {
        $result=$this->PaymentsService->lastPayment($id);
        return $this->apiRseponseService->Showdata(' last Payment data:', $result, );

    }
    public function oldestpayment($id)
    {
        $result=$this->PaymentsService->oldestPayment($id);
        return $this->apiRseponseService->Showdata(' oldest Payment data:', $result, );
    }
    public function lowestpayment($id)
    {
        $result=$this->PaymentsService->lowestPayment($id);
        return $this->apiRseponseService->Showdata(' Lowest Payment data:', $result, );
    }
    public function hightestpayment($id)
    {
        $result=$this->PaymentsService->highestPayment($id);
        return $this->apiRseponseService->Showdata(' hightest Payment data:', $result, );
    }
}
