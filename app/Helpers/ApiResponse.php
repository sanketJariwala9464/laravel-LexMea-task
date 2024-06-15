<?php 

namespace App\Helpers;

class ApiResponse
{
    public static function success($data = [], $message = null, $code = 200, $pagination = []) {

        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];

        if (!empty($pagination)) {
            $response['pagination'] = $pagination;
        }

        return response()->json($response, $code);
    }

    public static function error($message = null, $code = 400, $errors = []) {

        $response = [
            'status' => 'error',
            'message' => $message
        ];

        if (is_string($errors)) {
            $response['errors'] = [$errors];
        }

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}

?>