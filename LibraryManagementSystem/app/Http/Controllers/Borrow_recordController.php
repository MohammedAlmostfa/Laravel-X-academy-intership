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
        $validatedData =  $request->only('book_id');
        $result = $this->borrowrecordService->createBorrow($validatedData);
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
    public function update(BorrowRecordFormRequest $request, $id)
    {
        $result = $this->borrowrecordService->updateBorrow($id);
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
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
