<?php

namespace App\Service;

use App\Models\Movie;
use App\Models\Rating;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RatingService
{
    /**
     * This function is created to store a new Rating.
     * @param array $data
     * @return array
     */
    public function createRating($data)
    {
        try {
            $rating = Rating::create([
                'user_id' => Auth::user()->id,
                'rating' => $data['rating'],
                'review' => $data['review'],
                'movie_id' => $data['movie_id'],
            ]);
            return [
                'message' => 'Rating created successfully.',
                'status' => 201,
            ];
        } catch (Exception $e) {
            // Log the exception message
            Log::error('Rating creation failed: ' . $e->getMessage());
            return [
                'message' => 'Rating creation failed.',
                'status' => 422
            ];
        }
    }
    /**
     * This function is created to update a Rating.
     * @param Rating $rating
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRating($data, $id)
    {
        try {
            $rating = Rating::find($id);
            if ($rating) {
                if($rating->user_id==Auth::user()->id||Auth::user()->role=='admin') {
                    $rating->update([
                        'rating' => $data['rating'] ?? $rating->rating,
                        'review' => $data['review'] ?? $rating->review,
                        'movie_id' => $data['movie_id'] ?? $rating->movie_id,
                    ]);
                    return [
                        'message' => 'Rating updated successfully.',
                        'status' => 200,
                    ];
                } else {
                    return [
                         'message' => 'you have not addind tha rating',
                         'status' => 200,
                          ];
                }
            } else {
                return [
                    'message' => 'Rating not found',
                    'status' => 200,
                ];
            }
        } catch (Exception $e) {
            // Log the exception message
            Log::error('Rating update failed: ' . $e->getMessage());
            return [
                'message' => 'Rating update failed.',
                'status' => 422
            ];
        }
    }

    /**
     * This function is created to delete a rating.
     * @param Rating $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRating($id)
    {
        try {
            $rating = Rating::find($id);

            if ($rating) {
                if($rating->user_id==Auth::user()->id ||Auth::user()->role=='admin') {
                    $rating->delete();
                    return [
                        'message' => 'Rating delet successfully.',
                        'status' => 200,
                    ];
                } else {
                    return [
                         'message' => 'you have not addind tha rating',
                         'status' => 200,
                            ];
                }

            } else {
                return [

                    'message' => 'Rating not found',
                    'status' => 200,
                ];
            }
        } catch (Exception $e) {
            // Log the exception message
            Log::error('Rating delet failed: ' . $e->getMessage());
            return [
                'message' => 'Rating delet failed.',
                'status' => 422
            ];
        }
    }

    public function ShowRating($id)
    {
        try {
            $rating = Rating::find($id);
            if ($rating) {
                return [
                    'message' => 'Rating delet successfully.',
                    'data' => $rating,
                    'status' => 200,
                ];
            } else {
                return [
                    'message' => 'Rating not found',
                    'dara'=>'data Not Found',
                    'status' => 200,
                ];
            }
        } catch (Exception $e) {
            // Log the exception message
            Log::error('Rating delet failed: ' . $e->getMessage());
            return [
                'message' => 'Rating delet failed.',
                'status' => 422
            ];
        }
    }



}
