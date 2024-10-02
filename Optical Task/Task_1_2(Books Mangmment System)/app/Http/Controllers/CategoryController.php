<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryFormRequestCreate;
use App\Http\Requests\CategoryFormRequestUpdate;
use App\Models\Category;
use App\Services\ApiResponseService;
use App\Services\CategorieService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $apiResponseService;
    protected $categoryService;

    /**
     * Constructor to initialize services.
     *
     * @param ApiResponseService $apiResponseService
     * @param CategorieService $categoryService
     */
    public function __construct(ApiResponseService $apiResponseService, CategorieService $categoryService)
    {
        $this->apiResponseService = $apiResponseService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = $this->categoryService->showingAllCategories();
        return $this->apiResponseService->showData('Category data:', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryFormRequestCreate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryFormRequestCreate $request)
    {
        $validatedData = $request->validated();
        $this->categoryService->createCategorie($validatedData);
        return $this->apiResponseService->success('Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->categoryService->showingCategorie($id);
        return $this->apiResponseService->showData('Category data:', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryFormRequestUpdate $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryFormRequestUpdate $request, $id)
    {
        $validatedData = $request->validated();
        $this->categoryService->updateCategorie($id, $validatedData);
        return $this->apiResponseService->success('Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->categoryService->deleteCategorie($id);
        return $this->apiResponseService->success('Category deleted successfully');
    }

    /**
     * Display books by category.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showbookbycategory($id)
    {
        $result = $this->categoryService->showbookbycategory($id);
        return $this->apiResponseService->showData('Books of category:', $result);
    }
}
