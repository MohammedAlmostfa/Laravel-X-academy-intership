<?php

namespace App\Service;

use App\Models\Task;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommentService
{
    /**
     * Add a comment to a task.
     *
     * @param Task $task
     * @param string $body
     * @return bool
     * @throws \Exception
     */
    public function addComment(Task $task, $body)
    {
        try {
            // Create a new comment
            $comment = new Comment();
            $comment->body = $body;

            // Save the comment to the task
            $task->comments()->save($comment);

            return true;

        } catch (\Exception $e) {
            // Log the error and throw an exception
            Log::error('Error adding comment: ' . $e->getMessage());
            throw new \Exception('Error adding comment: ' . $e->getMessage());
        }
    }

    /**
     * Update a comment on a task.
     *
     * @param Task $task
     * @param string $newbody
     * @param int $commentid
     * @return bool
     * @throws \Exception
     */
    public function UpdateComment($newbody, $commentid)
    {
        try {
            // Find the comment by its ID
            $comment = Comment::findOrFail($commentid);
            $comment->body = $newbody;

            // Save the updated comment
            $comment->save();

            return true;

        } catch (ModelNotFoundException $e) {
            // Log the error and throw an exception if the comment is not found
            Log::error('Comment not found: ' . $e->getMessage());
            throw new \Exception('Comment not found: ');

        } catch (\Exception $e) {
            // Log any other errors and throw an exception
            Log::error('Error updating comment: ' . $e->getMessage());
            throw new \Exception('Error updating comment: ' . $e->getMessage());
        }
    }
    /**
        * Delete a comment from a task.
        *
        * @param int $commentid
        * @return bool
        * @throws \Exception
        */
    public function deleteComment($commentid)
    {
        try {
            // Find the comment by its ID
            $comment = Comment::findOrFail($commentid);

            // Delete the comment
            $comment->delete();

            return true;

        } catch (ModelNotFoundException $e) {
            // Log the error and throw an exception if the comment is not found
            Log::error('Comment not found: ' . $e->getMessage());
            throw new \Exception('Comment not found: ');

        } catch (\Exception $e) {
            // Log any other errors and throw an exception
            Log::error('Error deleting comment: ' . $e->getMessage());
            throw new \Exception('Error deleting comment: ');
        }
    }

    /**
     * Restore a deleted comment on a task.
     *
     * @param int $commentid
     * @return bool
     * @throws \Exception
     */
    public function returnComment($commentid)
    {
        try {
            // Find the deleted comment by its ID
            $comment = Comment::withTrashed()->findOrFail($commentid);

            // Restore the deleted comment
            $comment->restore();

            return true;

        } catch (ModelNotFoundException $e) {
            // Log the error and throw an exception if the comment is not found
            Log::error('Comment not found: ' . $e->getMessage());
            throw new \Exception('Comment not found: ');

        } catch (\Exception $e) {
            // Log any other errors and throw an exception
            Log::error('Error restoring comment: ' . $e->getMessage());
            throw new \Exception('Error restoring comment: ');
        }
    }
}
