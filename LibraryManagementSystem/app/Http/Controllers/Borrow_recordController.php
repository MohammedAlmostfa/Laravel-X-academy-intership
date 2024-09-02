<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowRecordFormRequest;
use Illuminate\Http\Request;
use App\Models\BorrowRecord;
use App\Service\BorrowrecordService;

class Borrow_recordController extends Controller
{


    protected $borrowrecordService;

    public function __construct(BorrowrecordService $borrowrecordService)
    {
        $this->borrowrecordService =  $borrowrecordService;
    }

    //**________________________________________________________________________________________________
    public function store(BorrowRecordFormRequest $request)
    {
        // Retrieve the validated data from the request
        $validatedData =  $request->validated();
        //create a new borrow record
        $result = $this->borrowrecordService->createBorrow($validatedData);
        //return resposjson
        return response()->json([
            'message' => $result['message'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    public function update(BorrowRecordFormRequest $request, $id)
    {
        // Retrieve the validated data from the request
        $validateddue_date =  $request->validated();
        //updata the borrow record
        $result = $this->borrowrecordService->updateBorrow($id, $validateddue_date);
        return response()->json([
            'message' => $result['message'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    public function index()
    {
        return BorrowRecord::all();
    }
    //**________________________________________________________________________________________________

  
    public function show($id)
    {
        return BorrowRecord::find($id);
    }

    //**________________________________________________________________________________________________

    // حذف سجل استعارة
    public function destroy($id)
    {
        return BorrowRecord::destroy($id);
    }

}
