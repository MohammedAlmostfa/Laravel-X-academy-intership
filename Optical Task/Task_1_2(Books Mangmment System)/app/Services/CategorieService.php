<?php
namespace App\Services;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Service class for managing categories.
 */
class CategorieService
{
    /**
     * Retrieve all categories with pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \Exception
     */
    public function showingAllCategories()
    {
        try {
            // Select id and name fields from categories and paginate the results
            $categories = Category::select(['id', 'name'])->paginate(10);
            return $categories;
        } catch (Exception $e) {
            Log::error('Error showing all categories: ' . $e->getMessage());
            throw new Exception('Error showing all categories');
        }
    }

    /**
     * Create a new category.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function createCategorie($data)
    {
        try {
            // Create a new category with the provided name
            $category = Category::create([
                'name' => $data['name'],
            ]);
            return true;
        } catch (Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
            throw new Exception('Error creating category');
        }
    }

    /**
     * Update an existing category.
     *
     * @param int $id
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function updateCategorie($id, $data)
    {
        try {
            // Find the category by id or throw an exception if not found
            $category = Category::findOrFail($id);
            // Update the category name if provided, otherwise keep the current name
            $category->update([
                'name' => $data['name'] ?? $category->name,
            ]);
            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Category not found: ' . $e->getMessage());
            throw new Exception('Category not found');
        } catch (Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            throw new Exception('Error updating category');
        }
    }

    /**
     * Delete a category by id.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteCategorie($id)
    {
        try {
            // Find the category by id or throw an exception if not found
            $category = Category::findOrFail($id);
            // Delete the category
            $category->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Category not found: ' . $e->getMessage());
            throw new Exception('Category not found');
        } catch (Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            throw new Exception('Error deleting category');
        }
    }

    /**
     * Retrieve a single category by id.
     *
     * @param int $id
     * @return \App\Models\Category
     * @throws \Exception
     */
    public function showingCategorie($id)
    {
        try {
            // Find the category by id or throw an exception if not found
            $category = Category::findOrFail($id);
            return $category;
        } catch (ModelNotFoundException $e) {
            Log::error('Category not found: ' . $e->getMessage());
            throw new Exception('Category not found');
        } catch (Exception $e) {
            Log::error('Error showing category: ' . $e->getMessage());
            throw new Exception('Error showing category');
        }
    }

    /**
     * Retrieve book by Category.
     *
     * @param int $id
     * @return \App\Models\Category
     * @throws \Exception
     */

    public function showbookbycategory($id)
    {

        try {

            $category=Category::findOrFail($id);
            $books = $category->books()->select(['id', 'title'])->get();

            return $books;
        } catch (ModelNotFoundException $e) {
            Log::error('Category not found: ' . $e->getMessage());
            throw new Exception('Category not found');
        } catch (Exception $e) {
            Log::error('Error showing book of category: ' . $e->getMessage());
            throw new Exception('Error showing  book of category');
        }
    }
}
