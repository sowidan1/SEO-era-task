<?php

function apiError(
    $message,
    $code = 400,
    $errors = []
) {
    $response = [
        'success' => false,
        'message' => $message,
        'errors' => $errors,
    ];

    return response()->json($response, $code);
}
