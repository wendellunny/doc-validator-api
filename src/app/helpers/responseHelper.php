<?php

/**
 * Show String Response
 *
 * @param string $response
 * @param int $code
 * @return void
 */
function showResponse(string $response, int $code = 200): void
{
    http_response_code($code);
    echo $response;
    die();
}

/**
 * Format Array in Json
 *
 * @param Array $array
 * @return string
 */
function json(array $array, $code = 200): string
{
    http_response_code($code);
    return json_encode($array);
}