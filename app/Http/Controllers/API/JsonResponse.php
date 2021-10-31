<?php

namespace App\Http\Controllers\API;

trait JsonResponse
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public static function response(
        $data,
        object $expansions = null,
        int $status = 200,
        array $headers = [],
        $options = 0)
    {
        $body = ['data' => $data];
        if ($expansions) $body['expansions'] = $expansions;
        return response()->json($body, $status, $headers, $options);
    }
}