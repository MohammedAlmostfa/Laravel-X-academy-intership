<?php

namespace App\Service;

use Exception;
use App\Models\Task;
use App\Models\Attachment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class assetsService
{
    public function storeFile($file, $taskId)
    {
        try {
            // Find the task by its ID
            $task = Task::findOrFail($taskId);

            // Get the original file name
            $originalName = $file->getClientOriginalName();

            // Ensure the file extension is valid and there is no path traversal in the file name
            if (preg_match('/\.[^.]+\./', $originalName)) {
                throw new Exception(trans('general.notAllowedAction'), 403);
            }

            // Check for path traversal attack (e.g., using ../ or ..\ or / to go up directories)
            if (strpos($originalName, '..') !== false || strpos($originalName, '/') !== false || strpos($originalName, '\\') !== false) {
                throw new Exception(trans('general.pathTraversalDetected'), 403);
            }



            // Generate a safe, random file name
            $fileName = Str::random(32);
            $extension = $file->getClientOriginalExtension(); // Safe way to get file extension
            $filePath = "Files/{$fileName}.{$extension}";

            // Store the file securely
            $path = Storage::disk('public')->putFileAs('Files', $file, $filePath);

            // Ensure the visibility of the file is public (if necessary)
            Storage::disk('public')->setVisibility($path, 'public');

            // Get the full URL path of the stored file
            $url = Storage::url($path);

            // Store file information in the database
            $attachment = new Attachment();
            $attachment->name = $fileName;
            $attachment->path = $url;
            $task->attachments()->save($attachment);

            // Return the URL of the uploaded file
            return $url;
        } catch (ModelNotFoundException $e) {
            // Log the error and throw an exception if the task is not found
            Log::error('Task not found: ' . $e->getMessage());
            throw new \Exception('Task not found: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Log any other errors and throw an exception
            Log::error('Error uploading attachment: ' . $e->getMessage());
            throw new \Exception('Error uploading attachment: ' . $e->getMessage());
        }
    }
}
