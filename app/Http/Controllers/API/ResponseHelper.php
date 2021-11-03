<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ResponseHelper
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

    /**
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    public static function abort(
        $message,
        int $status = 400,
        array $headers = [],
        $options = 0
    ) {
        $body = ['msg' => $message];
        $resp = response()->json($body, $status, $headers, $options);
        throw new HttpResponseException($resp);
    }
}