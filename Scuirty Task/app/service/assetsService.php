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
            // العثور على المهمة بواسطة معرفها
            $task = Task::findOrFail($taskId);

            // الحصول على اسم الملف الأصلي
            $originalName = $file->getClientOriginalName();

            // التأكد من أن الامتداد صالح ولا يوجد تحايل على المسار في اسم الملف
            if (preg_match('/\.[^.]+\./', $originalName)) {
                throw new Exception(trans('general.notAllowedAction'), 403);
            }

            // التحقق من تحايل المسار (باستخدام ../ أو ..\ أو / للصعود إلى الدلائل العليا)
            if (strpos($originalName, '..') !== false || strpos($originalName, '/') !== false || strpos($originalName, '\\') !== false) {
                throw new Exception(trans('general.pathTraversalDetected'), 403);
            }

            // توليد اسم ملف عشوائي وآمن
            $fileName = Str::random(32);
            $extension = $file->getClientOriginalExtension(); // طريقة آمنة للحصول على الامتداد
            $filePath = "Files/{$fileName}.{$extension}";

            // تخزين الملف بشكل آمن
            $path = Storage::disk('public')->putFileAs('Files', $file, $filePath);

            // ضمان أن الملف يمكن الوصول إليه بشكل عام (إذا لزم الأمر)
            Storage::disk('public')->setVisibility($path, 'public');

            // الحصول على رابط URL الكامل للملف المخزن
            $url = Storage::url($path);

            // تخزين معلومات الملف في قاعدة البيانات
            $attachment = new Attachment();
            $attachment->name = $originalName; // حفظ الاسم الأصلي للملف
            $attachment->path = $url;
            $task->attachments()->save($attachment);

            // إعادة رابط URL للملف المرفوع
            return $url;
        } catch (ModelNotFoundException $e) {
            // تسجيل الخطأ وإلقاء استثناء إذا لم يتم العثور على المهمة
            Log::error('Task not found: ' . $e->getMessage());
            throw new \Exception('Task not found: ' . $e->getMessage());
        } catch (\Exception $e) {
            // تسجيل أي أخطاء أخرى وإلقاء استثناء
            Log::error('Error uploading attachment: ' . $e->getMessage());
            throw new \Exception('Error uploading attachment: ' . $e->getMessage());
        }
    }

    public function downloadFile($id)
    {
        try {
            $attachment = Attachment::findOrFail($id);
            return Storage::disk('public')->download($attachment->path, $attachment->name);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('Attachment not found: ' . $e->getMessage());
        }
    }
}
