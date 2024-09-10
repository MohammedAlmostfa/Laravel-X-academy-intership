<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingFormRequest;
use Illuminate\Http\Request;
use App\Service\RatingService;
use Illuminate\Validation\ValidationException;
use App\Models\Rating;

class RatingController extends Controller
{

    protected $ratingService;
    //construct to injecte ratingService
    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * *This function is created to store a new Rating.
     * *@param \Illuminate\Http\Request $request
     * *@return \Illuminate\Http\JsonResponse
     */
    public function store(RatingFormRequest $request)
    {
        $validatData=$request->validated();
        $result=$this->ratingService->createRating($validatData);
        return response()->json(['message' => $result['message']], $result['status']);
    
    }
    /**
     * *This function is created to  show  Rating information.
     * *@param $id
     * *@return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $rating = Rating::find($id);
        if (!$rating) {
            return response()->json(['error' => 'Rating not found'], 404);
        }
        return response()->json(["data" => $rating], 200);
    }

    /**
     * *This function is creat to update a  Rating.
     * *@param $id
     * *@param \Illuminate\Http\Request $request
     * *@return \Illuminate\Http\JsonResponse
     */
    public function update(RatingFormRequest $request, string $id)
    {
        $validatData=$request->validated();
        $result=$this->ratingService->updateRating($validatData, $id);
        return response()->json(['message' => $result['message']], $result['status']);
    }




    /**
     * *This function is creat  to delet a  Rating.
     * *@param $id
     * *@return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $rating = Rating::find($id);
        if (!$rating) {
            return response()->json(['error' => 'Rating not found'], 404);
        }
        return $this->ratingService->deleteRating($rating);
    }
}
