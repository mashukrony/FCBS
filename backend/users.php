<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Client;

$app->get('/api/users', function (Request $request, Response $response) {
    $client = new Client();
    $supabaseUrl = 'https://uawgdwbkpdazmqqyupwx.supabase.co/rest/v1';
    $apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InVhd2dkd2JrcGRhem1xcXl1cHd4Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTEwNDQxNDksImV4cCI6MjA2NjYyMDE0OX0.HipuiHPZkoUGN52t27ZNKx6vkwNmzLPJ0m7YyRRMvNY';

    $res = $client->request('GET', $supabaseUrl . '/users', [
        'headers' => [
            'apikey' => $apiKey,
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ]
    ]);

    $data = json_decode($res->getBody(), true);
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});
