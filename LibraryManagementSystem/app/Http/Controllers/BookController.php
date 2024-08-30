<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookFormRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Service\BookService;

class BookController extends Controller
{

    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     ** create a new book
    ** @param BookFormRequest $request
    ** @return Responsejson(data,message)
     */
    public function store(BookFormRequest $request)
    {
        $validatedData =  $request->all();
        $result = $this->bookService->createBook($validatedData);
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }

 
    /**
     ** show book
    **@parm $id
    **return Responsejson(data,message)
    */

    public function show(string $id)
    {
        $result = $this->bookService->ShowBook($id);
        return response()->json([
              'message' => $result['message'],
              'data' => $result['data'],
          ], $result['status']);
    }

    
    /**
     **update book
    **@parBookFormRequest $request
    **@parm $id
    **return Responsejson(data,message)
    */

    public function update(BookFormRequest $request, string $id)
    {
        $validatedData =  $request->all();
        $result = $this->bookService->updateBook($validatedData, $id);

        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }

    
    
    /**
     **delete a book
      **@parm $id
      **return Responsejson(data,message)
      */
    public function destroy(string $id)
    {
        $result = $this->bookService->deleteBook($id);
        return response()->json([
              'message' => $result['message'],
              'data' => $result['data'],
          ], $result['status']);
    }
}
