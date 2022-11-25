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
}

/**
 * Format Array in Json
 *
 * @param Array $array
 * @return string
 */
function json(Array $array): string
{
    return json_encode($array);
}