<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use GuzzleHttp\Client;

return function (App $app) {
    $SUPABASE_URL = 'https://uawgdwbkpdazmqqyupwx.supabase.co';
    $SUPABASE_API_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InVhd2dkd2JrcGRhem1xcXl1cHd4Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTEwNDQxNDksImV4cCI6MjA2NjYyMDE0OX0.HipuiHPZkoUGN52t27ZNKx6vkwNmzLPJ0m7YyRRMvNY';

    // Get all slots
    $app->get('/api/slots', function (Request $request, Response $response) use ($SUPABASE_URL, $SUPABASE_API_KEY) {
        $client = new Client();
        $res = $client->request('GET', "$SUPABASE_URL/rest/v1/slots?select=*", [
            'headers' => [
                'apikey' => $SUPABASE_API_KEY,
                'Authorization' => "Bearer $SUPABASE_API_KEY",
            ]
        ]);
        $data = $res->getBody()->getContents();
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'application/json');
    });

    // Create a new slot
    $app->post('/api/slots', function (Request $request, Response $response) use ($SUPABASE_URL, $SUPABASE_API_KEY) {
        $params = (array)$request->getParsedBody();

        $client = new Client();
        $res = $client->request('POST', "$SUPABASE_URL/rest/v1/slots", [
            'headers' => [
                'apikey' => $SUPABASE_API_KEY,
                'Authorization' => "Bearer $SUPABASE_API_KEY",
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'date' => $params['date'],
                'start_time' => $params['start_time'],
                'end_time' => $params['end_time']
            ])
        ]);

        $data = $res->getBody()->getContents();
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'application/json');
    });
};
