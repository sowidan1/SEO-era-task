<?php

function apiError(
    $error,
    $code = 400,
    $errors = []
) {
    $response = [
        'success' => false,
        'error' => $error,
        'errors' => $errors
    ];

    return response()->json($response, $code);
}
