<?php

namespace App\Services\Api\Clients;

use GuzzleHttp\Client;

class ForgeApiClient
{
    private Client $client;

    private const string BASE_URI = 'https://forge.laravel.com/api/v1/';

    public function __construct(string $apiKey, Client $client = null)
    {
        $this->client = $client ?? new Client([
            'base_uri' => self::BASE_URI,
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function listServers(): array
    {
        $response = $this->client->get('servers');
        return json_decode($response->getBody(), true);
    }

    public function getServer(int $serverId): array
    {
        $response = $this->client->get("servers/{$serverId}");
        return json_decode($response->getBody(), true);
    }

    public function createServer(array $data): array
    {
        $response = $this->client->post('servers', [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }

    public function deleteServer(int $serverId): array
    {
        $response = $this->client->delete("servers/{$serverId}");
        return json_decode($response->getBody(), true);
    }
}
