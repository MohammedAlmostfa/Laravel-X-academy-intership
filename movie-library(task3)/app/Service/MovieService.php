<?php

namespace App\Service;

use App\Models\Movie;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class MovieService
{


    /**
     **This function is created to store a new movie.
     ** @param$ data
     **@return \Illuminate\Http\JsonResponse
     */
    public function createMovie($data)
    {
        try {
            $movie = Movie::create($data);
            return [
                'message' => 'Movie created successfully.',
                'status' => 200
            ];
        } catch (Exception $e) {
            // Log the exception message
            Log::error('Movie creation failed: ' . $e->getMessage());
            return [
                'message' => 'Movie creation failed.',
                'status' => 422
            ];
        }
    }


    /**
     **This function is creat to update a  movie.
     ** @param $data
     **@param Movie $movie
     **@return \Illuminate\Http\JsonResponse
     */
    public function updateMovie($data, $id)
    {
        try {
            $movie = Movie::find($id);
            if ($movie) {
                $movie->update([
                    'title' => $data['title']??$movie->title,
                    'director' => $data['director']??$movie->director,
                    'genre' => $data['genre']??$movie->genre,
                    'release_year' => $data['release_year']??$movie->release_year,
                    'description' => $data['description']??$movie->description,
                ]);

                return [
                    'message' => 'Movie update  successfully.',
                    'status' => 200,
                ];
            } else {
                return [
                    'message' => 'Movie not found.',
                    'status' => 201,
                ];
            }
        } catch (Exception $e) {
            // Log the exception message
            Log::error('Movie update failed: ' . $e->getMessage());
            return [
                'message' => 'Movie update failed.',
                'status' => 422
            ];
        }
    }



    /**
     **This function is creat to delet   a movie.
     **@param Movie $movie
     **@return \Illuminate\Http\JsonResponse
     */

    public function deleteMovie($id)
    {
        try {
            $movie= Movie::find($id);
            if($movie) {
                $movie->delete();
                return [
                    'message' => 'Movie deleted.',
                    'status' => 201,
                ];

            } else {
                return [
                    'message' => 'Movie not found.',
                    'status' => 201,
                ];
            }
        } catch (Exception $e) {
            // Log the exception message
            Log::error('Movie delet failed: ' . $e->getMessage());
            return [
                'message' => 'Movie delet failed.',
                'status' => 422
            ];
        }
    }
    public function getMovie($id)
    {
        try {
            $movie= Movie::find($id);
            if($movie) {
               
                return [
                    'message' => 'Movie data.',
                    'data' => $movie,
                    'status' => 201,
                ];

            } else {
                return [
                    'message' => 'Movie not found.',
                    'data'=>'there arr not data',
                    'status' => 201,
                ];
            }
        } catch (Exception $e) {
            // Log the exception message
            Log::error('Movie get failed: ' . $e->getMessage());
            return [
                'message' => 'Movie get failed.',
                'data'=>'there arr not data',
                'status' => 422
            ];
        }
    }
    
    public function getMovies($data)
    {
        try {
            $query = Movie::query();

            if (!empty($data['genre'])) {
                $query->byGenre($data['genre']);
            }
            if (!empty($data['director'])) {
                $query->byDirector($data['director']);
            }
            if (!empty($data['sortDir'])) {
                $query->orderBy("release_year", $data['sortDir']);
            }
            if (!empty($data['perPage'])) {
                return $query->paginate($data['perPage']);
            }

            $movies = $query->get();
            return [
                'message' => 'Movies data.',
                'data' => $movies,
                'status' => 201,
            ];

        } catch (Exception $e) {
            // Log the exception message
            Log::error('Movies get failed: ' . $e->getMessage());
            return [
                'message' => 'Movie get failed.',
                'data' => 'There is no data',
                'status' => 422
            ];
        }
    }
}
