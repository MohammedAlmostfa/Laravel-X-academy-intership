<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookService
{
    /**
     * Retrieve all book with pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \Exception
     */
    public function showAllBook()
    {
        try {
            // Select id and title fields from categories and paginate the results
            $Books = Book::select(['id', 'title'])->paginate(10);
            return $Books;
        } catch (Exception $e) {
            Log::error('Error showing all Books: ' . $e->getMessage());
            throw new Exception('Error showing all Books');
        }
    }

    /**
     * Create a new Book.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function createBook($data)
    {
        try {
            // Create a new book with the provided data
            $book = Book::create([
                'title' => $data['title'],
                'author_id' => $data['author_id'],
                'published_at' => $data['published_at'],
                'category_id' => $data['category_id']
            ]);
            return true;
        } catch (Exception $e) {
            Log::error('Error creating book: ');
            throw new Exception('Error creating book: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing Book.
     *
     * @param int $id
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function updateBook($id, $data)
    {
        try {
            // Find the Book by id or throw an exception if not found
            $book = Book::findOrFail($id);
            // Update the Book with provided data
            $book->update([
                'title' => $data['title'] ?? $book->title,
                'author_id' => $data['author_id'] ?? $book->author_id,
                'published_at' => $data['published_at'] ?? $book->published_at,
                'status' => $data['status'] ?? $book->status,
                'category_id' => $data['category_id'] ?? $book->category_id,
            ]);
            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Book not found: ' . $e->getMessage());
            throw new Exception('Book not found');
        } catch (Exception $e) {
            Log::error('Error updating book: ' . $e->getMessage());
            throw new Exception('Error updating book'. $e->getMessage());
        }
    }

    /**
     * Delete a Book by id.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteBook($id)
    {
        try {
            // Find the Book by id or throw an exception if not found
            $book = Book::findOrFail($id);
            // Delete the Book
            $book->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Book not found: ' . $e->getMessage());
            throw new Exception('Book not found');
        } catch (Exception $e) {
            Log::error('Error deleting book: ' . $e->getMessage());
            throw new Exception('Error deleting book');
        }
    }

    /**
     * Retrieve a single Book by id.
     *
     * @param int $id
     * @return \App\Models\Book
     * @throws \Exception
     */
    public function showBook($id)
    {
        try {
            // Find the Book by id or throw an exception if not found
            $book = Book::findOrFail($id);
            return $book;
        } catch (ModelNotFoundException $e) {
            Log::error('Book not found: ' . $e->getMessage());
            throw new Exception('Book not found');
        } catch (Exception $e) {
            Log::error('Error showing book: ' . $e->getMessage());
            throw new Exception('Error showing book');
        }
    }
}
