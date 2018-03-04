<?php

$route->get('/', function ($request, $response) {
    $response->getBody()->write('/');
    return $response;
});