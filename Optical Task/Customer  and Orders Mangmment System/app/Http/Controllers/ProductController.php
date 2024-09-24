<?php

namespace App\Http\Controllers;

use App\Http\Requests\prouduct\productformrequestcreat;
use App\Http\Requests\prouduct\productformrequestupdate;
use App\Models\Product;
use App\Services\ApiResponseService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $apiRseponseService;

    public function __construct(ProductService $productService, ApiResponseService $apiRseponseService)
    {
        $this->productService = $productService;
        $this->apiRseponseService=$apiRseponseService;
    }

    public function index()
    {
        //  $result=$this->productService->ShowAllProduct();
        //  return $this->apiRseponseService->paginated($result);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(productformrequestcreat $request)
    {
        $validateddata=$request->validated();
        $result=$this->productService->createProduct($validateddata);
        return $this->apiRseponseService->success('Product created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result=$this->productService->ShowProduct($id);
        return $this->apiRseponseService->ValueShow('product data:', $result);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(productformrequestupdate $request, $id)
    {
        $validateddata=$request->validated();
        $result=$this->productService->updateProduct($validateddata, $id);
        return $this->apiRseponseService->success('Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result=$this->productService->DeletProduct($id);
        return $this->apiRseponseService->success('Product deleted successfully');

    }
}
