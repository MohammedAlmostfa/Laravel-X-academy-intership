<?php

namespace App\Http\Controllers;

use App\Service\CommentService;
use Illuminate\Http\Request;
use App\Service\ApiResponseService;
use App\Http\Requests\commentRequestcreat;

class CommentController extends Controller
{
    protected $apiResponseService;
    protected $CommentService;

    /**
     * Constructor to initialize services.
     *
     * @param ApiResponseService $apiResponseService
     * @param CommentService $CommentService
     */
    public function __construct(ApiResponseService $apiResponseService, CommentService $CommentService)
    {
        $this->CommentService = $CommentService;
        $this->apiResponseService = $apiResponseService;
    }

    /**
     * Add a comment to a task.
     *
     * @param commentRequestcreat $request
     * @param int $taskid
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($taskid, commentRequestcreat $request)
    {
        // Retrieve the task from the request (set by Middleware)
        $task = $request->get('task');

        // Retrieve the body of the comment from the request
        $body = $request->input('body');

        // Use the service to add the comment to the task
        $this->CommentService->addComment($task, $body);

        // Return a success response
        return $this->apiResponseService->success('Comment added successfully');
    }

    /**
     * Update a comment on a task.
     *
     * @param commentRequestcreat $request
     * @param int $taskid
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($taskid, commentRequestcreat $request, $id)
    {

        // Retrieve the body of the comment from the request
        $body = $request->input('body');

        // Use the service to update the comment on the task
        $this->CommentService->UpdateComment($body, $id);

        // Return a success response
        return $this->apiResponseService->success('Comment updated successfully');
    }
    /**
     * Delete a comment on a task.
     *
     * @param int $taskid
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($taskid, $id)
    {
        // Use the service to delete the comment
        $this->CommentService->deleteComment($id);

        // Return a success response
        return $this->apiResponseService->success('Comment deleted successfully');
    }

    /**
     * Restore a deleted comment on a task.
     *
     * @param int $taskid
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function return($taskid, $id)
    {
        // Use the service to restore the deleted comment
        $this->CommentService->returnComment($id);

        // Return a success response
        return $this->apiResponseService->success('Comment restored successfully');
    }
}
