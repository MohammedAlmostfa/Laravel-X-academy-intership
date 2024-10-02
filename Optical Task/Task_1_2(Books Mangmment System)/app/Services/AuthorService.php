<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Service class for managing authors.
 */
class AuthorService
{
    /**
     * Retrieve all authors with pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \Exception
     */
    public function showingAllAuthors()
    {
        try {
            // Select id and name fields from authors and paginate the results
            $authors = Author::select(['id', 'name'])->paginate(10);
            return $authors;
        } catch (Exception $e) {
            Log::error('Error showing all authors: ' . $e->getMessage());
            throw new Exception('Error showing all authors');
        }
    }

    /**
     * Create a new author.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function createAuthor($data)
    {
        try {
            // Create a new author with the provided name
            Author::create([
                'name' => $data['name'],
            ]);
            return true;
        } catch (Exception $e) {
            Log::error('Error creating author: ' . $e->getMessage());
            throw new Exception('Error creating author'. $e->getMessage());
        }
    }

    /**
     * Update an existing author.
     *
     * @param int $id
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function updateAuthor($id, $data)
    {
        try {
            // Find the author by id or throw an exception if not found
            $author = Author::findOrFail($id);
            // Update the author name if provided, otherwise keep the current name
            $author->update([
                'name' => $data['name'] ?? $author->name,
            ]);
            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Author not found: ' . $e->getMessage());
            throw new Exception('Author not found');
        } catch (Exception $e) {
            Log::error('Error updating author: ' . $e->getMessage());
            throw new Exception('Error updating author');
        }
    }

    /**
     * Delete an author by id.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteAuthor($id)
    {
        try {
            // Find the author by id or throw an exception if not found
            $author = Author::findOrFail($id);
            // Delete the author
            $author->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            Log::error('Author not found: ' . $e->getMessage());
            throw new Exception('Author not found');
        } catch (Exception $e) {
            Log::error('Error deleting author: ' . $e->getMessage());
            throw new Exception('Error deleting author');
        }
    }

    /**
     * Retrieve a single author by id.
     *
     * @param int $id
     * @return \App\Models\Author
     * @throws \Exception
     */
    public function showingAuthor($id)
    {
        try {
            // Find the author by id or throw an exception if not found
            $author = Author::findOrFail($id);
            return $author;
        } catch (ModelNotFoundException $e) {
            Log::error('Author not found: ' . $e->getMessage());
            throw new Exception('Author not found');
        } catch (Exception $e) {
            Log::error('Error showing author: ' . $e->getMessage());
            throw new Exception('Error showing author');
        }
    }
    /**
        * Retrieve a single book og author .
        *
        * @param int $id(author)
        * @return \App\Models\Author
        * @throws \Exception
        */

    public function Authorbook($id)
    {
        try {
            $author=Author::findOrFail($id);
            $book=$author->books()->select(['id', 'title'])->get();
            return $book;
        } catch (ModelNotFoundException $e) {
            Log::error('Author not found: ' . $e->getMessage());
            throw new Exception('Author not found');
        } catch (Exception $e) {
            Log::error('Error showing book of author ' . $e->getMessage());
            throw new Exception('Error showing book of author');
        }
    }
}
