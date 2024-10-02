<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\Authorformrequesrcreat;
use App\Http\Requests\Authorformrequesrupdate;
use App\Services\ApiResponseService;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    protected $apiResponseService;
    protected $authorService;

    /**
     * Constructor to initialize services.
     *
     * @param ApiResponseService $apiResponseService
     * @param AuthorService $authorService
     */
    public function __construct(ApiResponseService $apiResponseService, AuthorService $authorService)
    {
        $this->apiResponseService = $apiResponseService;
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = $this->authorService->showingAllAuthors();
        return $this->apiResponseService->showData('Author data:', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryFormRequestCreate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Authorformrequesrcreat $request)
    {
        $validatedData = $request->validated();
        $this->authorService->createAuthor($validatedData);
        return $this->apiResponseService->success('Author created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->authorService->showingAuthor($id);
        return $this->apiResponseService->showData('Author data:', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryFormRequestUpdate $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Authorformrequesrupdate $request, $id)
    {
        $validatedData = $request->validated();
        $this->authorService->updateAuthor($id, $validatedData);
        return $this->apiResponseService->success('Author updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->authorService->deleteAuthor($id);
        return $this->apiResponseService->success('Author deleted successfully');
    }
    public function Authorbook($id)
    {
        $result=$this->authorService->Authorbook($id);
        return $this->apiResponseService->showData('Author book:', $result);
    }
}
