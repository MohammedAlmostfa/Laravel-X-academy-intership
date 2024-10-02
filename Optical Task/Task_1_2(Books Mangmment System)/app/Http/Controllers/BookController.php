<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookFormRequestCreate;
use App\Http\Requests\BookFormRequestUpdate;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;

class BookController extends Controller
{
    protected $apiResponseService;
    protected $bookService;

    /**
     * Constructor to initialize services.
     *
     * @param ApiResponseService $apiResponseService
     * @param BookService $bookService
     */
    public function __construct(ApiResponseService $apiResponseService, BookService $bookService)
    {
        $this->apiResponseService = $apiResponseService;
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = $this->bookService->showAllBook();
        return $this->apiResponseService->showData('Books data', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookFormRequestCreate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BookFormRequestCreate $request)
    {
        $validatedData = $request->validated();
        $this->bookService->createBook($validatedData);
        return $this->apiResponseService->success('Book created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->bookService->showBook($id);
        return $this->apiResponseService->showData('Book data', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookFormRequestUpdate $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BookFormRequestUpdate $request, $id)
    {
        $validatedData = $request->validated();
        $this->bookService->updateBook($id, $validatedData);
        return $this->apiResponseService->success('Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->bookService->deleteBook($id);
        return $this->apiResponseService->success('Book deleted successfully');
    }
}
