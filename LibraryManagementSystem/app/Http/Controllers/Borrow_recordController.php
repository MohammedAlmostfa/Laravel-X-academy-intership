<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowRecordFormRequest;
use Illuminate\Http\Request;
use App\Models\BorrowRecord;

class Borrow_recordController extends Controller
{


    protected $borrowrecord;

    public function __construct(Borrowrecord $borrowrecord)
    {
        $this->borrowrecord =  $borrowrecord;
    }


    // عرض جميع سجلات الاستعارة
    public function index()
    {
        return BorrowRecord::all();
    }

    // عرض سجل استعارة محدد
    public function show($id)
    {
        return BorrowRecord::find($id);
    }

    // إنشاء سجل استعارة جديد
    public function store(BorrowRecordFormRequest $request)
    {
        $validatedData =  $request->validate();
        $result = $this->borrowrecord->createborrow($validatedData);
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }

    // تحديث سجل استعارة موجود
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'borrowed_at' => 'required|date',
            'returned_at' => 'nullable|date',
        ]);

        $borrowRecord = BorrowRecord::find($id);
        $borrowRecord->update($request->all());

        return $borrowRecord;
    }

    // حذف سجل استعارة
    public function destroy($id)
    {
        return BorrowRecord::destroy($id);
    }

}
