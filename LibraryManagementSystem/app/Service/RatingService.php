<?php

namespace App\Service;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class RatingService
{
    /**
     * *This function is created to store a new Rating.
     ** @param$ data
     * *@return \Illuminate\Http\JsonResponse
     */

    public function createRating($data)
    {
        try {
            //creat new Rating
            $rating = Rating::create([
                'user_id' => Auth::user()->id,
                'book_id' => $data['book_id'],
                'rating' => $data['rating'],
                'review' => $data['review'],
            ]);
            //return Response::json
            return [
                'message' => 'تم التقييم بنجاح',
                'status' => 201,
            ];
        } catch (Exception $e) {
            return [
                'message' => 'حدث خطاء اثنا  التقييم',
                'status' => 500,
            ];
        }
    }
    //**________________________________________________________________________________________________

    /**
         **updat Rating
         **@param $id
         **@param $data
         **@return array(message,status,message)
         */

    public function updateRating($data, $id)
    {

        try {
            $rating = Rating::find($id);
            if (!$rating) {
                return [
                    'message' => 'التقيم غسر موجود غير موجود',
                    'status' => 404,
                    'data' => 'لا يوجد بيانات'
                ];
            } else {
                //filter null vules of data
                $filteredData = array_filter($data, function ($value) {
                    return !is_null($value);
                });

                $rating->update($filteredData);
                return [
                    'message' => 'تمت عملية التحديث',
                    'data' => $rating,
                    'status' => 200,
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in returning book: ' . $e->getMessage());
            return [
                'message' => 'حدث خطأ أثناء التحديث',
                'status' => 500,
                'data' => 'لم يتم تحديث البيانات'
            ];
        }
    }
    //**________________________________________________________________________________________________

    /**
     **delet the Rating
     **@param $id
     **@return array(message,status)
     */

    public function deleteRating($id)
    {
        try {
            //find the Rating
            $rating = Rating::find($id);
            if (!$rating) {
                return [
                    'message' => 'التقيم غير موجود',
                    'status' => 404,
                ];
            } else {
                //delete the Rating
                $rating->delete();

                return [
                    'message' => 'تمت عملية الحذف',
                    'status' => 200,
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in returning book: ' . $e->getMessage());
            return [
                'message' => 'حدث خطا اثناء عملية الحذف',
                'status' => 500,
            ];
        }
    }

    //**________________________________________________________________________________________________
  
    /**
       **show the ratings
       **@param $id
       **@return array(message,status,data)
       */

    public function showRating($id)
    {
        try {
            //find the Rating
            $rating = Rating::find($id);
            if (!$rating) {
                return [
                    'message' => 'التقيم غير موجود',
                    'status' => 404,
                    'data' => 'لا يوجد بيانات'
                ];
            } else {
                //show Rating data
                return [
                    'message' => 'التقييم',
                    'data' => $rating,
                    'status' => 200,
                ];
            }
        } catch (Exception $e) {
            Log::error('Error in returning book: ' . $e->getMessage());
            return [
                'message' => 'حدث خطا اثناء عملية الحذف',
                'status' => 500,

            ];
        }
    }
}
