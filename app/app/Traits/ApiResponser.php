<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Filter response
     * @param array $response
     * @return Illuminate\Http\JsonResponse
     */
    public function filterResponse(array $response)
    {
        if(isset($response['message'])) {
            return $this->errorResponse($response['message'], $response['code']);
        }

        return $this->successResponse($response['data']);
    }

    /**
     * Build success responses
     *
     * @param string|array $data
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        $responseData = ['data' => $data];

        return response()->json($responseData, $code);
    }

    /**
     * Build error responses
     *
     * @param string $message
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code = Response::HTTP_BAD_REQUEST)
    {
        $responseData = ['error' => $message, 'code' => $code];

        return response()->json($responseData, $code);
    }
}
