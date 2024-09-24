<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductService
{
    /**
     * Show all products
     * @param none
     * @return array of products
     */
    public function ShowAllProduct()
    {
        try {
            // Fetch all products with selected fields
            $product = Product::select(['id', 'name', 'price', 'description'])->paginate(10)->get(); // Use get() instead of all()
            return $product;
        } catch (Exception $e) {
            Log::error('Error showing all products: ' . $e->getMessage());
            throw new Exception('Error showing all products');
        }
    }

    /**
     * Create a new product
     * @param array $data
     * @return bool
     */
    public function createProduct($data)
    {
        try {
            // Create a new product with the provided data
            $product = Product::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'description' => $data['description'],
            ]);
            return true;
        } catch (Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage());
            throw new Exception('Error creating product');
        }
    }

    /**
     * Update an existing product
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function UpdateProduct($data, $id)
    {
        try {
            // Find the product by ID
            $product = Product::findOrFail($id);

            // Update the product with the provided data
            $product->update([
                'name' => $data['name'] ?? $product->name,
                'price' => $data['price'] ?? $product->price,
                'description' => $data['description'] ?? $product->description,
            ]);

            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Product not found: ' . $e->getMessage());
            throw new Exception('Product not found');
        } catch (Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage());
            throw new Exception('Error updating product');
        }
    }

    /**
     * Show a specific product
     * @param int $id
     * @return Product
     */
    public function ShowProduct($id)
    {
        try {
            // Find the product by ID and select specific fields
            $product = Product::select(['id', 'name', 'price', 'description'])->findOrFail($id);
            return $product;
        } catch (ModelNotFoundException $e) {
            Log::error('Product not found: ' . $e->getMessage());
            throw new Exception('Product not found');
        } catch (Exception $e) {
            Log::error('Error showing product: ' . $e->getMessage());
            throw new Exception('Error showing product');
        }
    }

    /**
     * Delete a specific product
     * @param int $id
     * @return bool
     */
    public function DeletProduct($id)
    {
        try {
            // Find the product by ID
            $product = Product::findOrFail($id);
            // Delete the product
            $product->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Product not found: ' . $e->getMessage());
            throw new Exception('Product not found');
        } catch (Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            throw new Exception('Error deleting product');
        }
    }
}
