<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($data = null, $message = 'Operação realizada com sucesso', $code = 200)
    {
        return response()->json([
            'error' => false,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function error($message = 'Erro inesperado', $code = 500, $data = null)
    {
        return response()->json([
            'error' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
