<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookFormRequest;
use App\Models\Book;
use App\Service\BookService;

class BookController extends Controller
{

    protected $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    //**________________________________________________________________________________________________

    public function index()
    {
        return Book::all();
    }
    //**________________________________________________________________________________________________
    /**
     ** create a new book
    ** @param BookFormRequest $request
    ** @return Responsejson(data,message)
     */
    public function store(BookFormRequest $request)
    {
        $validatedData = $request->validated();
        $result = $this->bookService->createBook($validatedData);
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
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

    //**________________________________________________________________________________________________
    /**
     **update book
    **@parBookFormRequest $request
    **@parm $id
    **return Responsejson(data,message)
    */

    public function update(BookFormRequest $request, string $id)
    {
        $validatedData =  $request->validated();

        $result = $this->bookService->updateBook($validatedData, $id);

        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['status']);
    }
    //**________________________________________________________________________________________________
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
