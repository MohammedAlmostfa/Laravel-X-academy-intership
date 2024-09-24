<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator as PaginationLengthAwarePaginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiResponseService
{
    /**
     * Return a successful JSON response.
     *
     * @param mixed $data The data to be returned in the response.
     * @param string $message The success message.
     * @param int $status The HTTP status code.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($message = 'Done Successfully!', $data = null, $status = 200)
    {
        return response()->json([

            'message' => trans($message),
            'data' => $data,
        ], $status);
    }

    /**
     * Return an error JSON response.
     *
     * @param mixed $data The data to be returned in the response.
     * @param string $message The error message.
     * @param int $status The HTTP status code.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = 'Operation failed!', $data = null, $status = 400)
    {
        return response()->json([

            'message' => trans($message),
            'data' => $data,
        ], $status);
    }

    /**
     * Generates a JSON response with paginated data.
     *
     * Transforms the paginated items using the provided resource class and
     * returns the transformed data along with pagination information.
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $paginator The paginator instance containing the items.
     * @param string $resourceClass The resource class used to transform the paginated items.
     * @param string $message Optional message to be included in the response.
     * @param int $status HTTP status code.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response containing the transformed items and pagination details.
     */
    public static function paginated(LengthAwarePaginator $paginator, $resourceClass, $message = '', $status)
    {
        $transformedItems = $resourceClass::collection($paginator->items());

        return response()->json([

            'message' => trans($message),
            'data' => $transformedItems,
            'pagination' => [
                'total' => $paginator->total(),
                'count' => $paginator->count(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'total_pages' => $paginator->lastPage(),
            ],
        ], $status);
    }
    /**
       * Return a JSON response for not found resources.
       *
       * @param string $message The not found message.
       * @param int $status The HTTP status code.
       * @return \Illuminate\Http\JsonResponse
       */
    public static function notFound($message = 'Resource not found!', $status = 404)
    {
        return response()->json([

            'message' => trans($message),
            'data' => null,
        ], $status);
    }

    /**
     * Return a JSON response with a single value.
     *
     * @param mixed $value The value to be returned in the response.
     * @param string $message The success message.
     * @param int $status The HTTP status code.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function ValueShow($message = 'Value showing successfully', $data, $status = 200)
    {
        return response()->json([

            'message' => trans($message),
            'data' => $data,
        ], $status);
    }

}
