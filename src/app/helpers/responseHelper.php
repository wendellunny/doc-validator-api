<?php

/**
 * Show String Response
 *
 * @param string $response
 * @return void
 */
function showResponse(string $response): void
{
    echo $response;
    die();
}

/**
 * Format Array in Json
 *
 * @param Array $array
 * @return string
 */
function json(Array $array, int $code = 200): string
{
    return json_encode($array,$code);
}