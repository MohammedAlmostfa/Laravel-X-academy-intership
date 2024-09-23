<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieFromRequest;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Service\MovieService;

class MovieController extends Controller
{

    protected $movieService;
    //construct to injecte movieService
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * *This function is created to To display a specific number of moviese.
     * *@param \Illuminate\Http\Request $request
     * *@return \Illuminate\Http\JsonResponse
     */

    
    public function index(MovieFromRequest $request)
    {
        $validatedData = $request->validated();
        $result = $this->movieService->getMovies($validatedData);
        return response()->json(['message' => $result['message'], 'data' => $result['data']], $result['status']);
    }


    /**
     * *This function is created to store a new movie.
     ** @param \Illuminate\Http\MovieFromRequest
     * *@return \Illuminate\Http\JsonResponse
     */

    public function store(MovieFromRequest $request)
    {
        $validatedData = $request->validated();
        $result = $this->movieService->createMovie($validatedData);
        ($validatedData);
        return response()->json(['message' => $result['message']], $result['status']);
    }

    /**
     * *This function is creat to update a  movie.
     * * @param $id
     * *@param \Illuminate\Http\Request $request
     * *@return \Illuminate\Http\JsonResponse
     */
    
    public function update(MovieFromRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $result = $this->movieService->updateMovie($validatedData, $id);
        return response()->json(['message' => $result['message']], $result['status']);
    }
    /**
     **This function is creat to show th detelis of  a movie.
     **@param $id
     **@return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $result = $this->movieService->getMovie($id);
        return response()->json(['message' => $result['message'],'data'=>$result['data']], $result['status']);
    }
    /**
     **This function is creat  to delet a  movie.
     **@param $id
     **@return \Illuminate\Http\JsonResponse
     */

    public function destroy(string $id)
    {
        $result = $this->movieService->deleteMovie($id);
        return response()->json(['message' => $result['message']], $result['status']);
    }

}
