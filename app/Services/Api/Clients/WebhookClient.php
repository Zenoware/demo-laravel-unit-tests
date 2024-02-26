<?php

namespace App\Services\Api\Clients;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * This is just a plain old class that sends a webhook to a specified URL with a given payload.
 * Nothing fancy here.
 */
class WebhookClient
{
    protected HttpClient $httpClient;

    protected array $config = [];

    public function __construct(array $config = [], ?HttpClient $httpClient = null)
    {
        $this->config = $config;
        $this->httpClient = $httpClient ?? new HttpClient();
    }

    /**
     * Dispatch a webhook to the specified URL with the given payload.
     *
     * @param string $url The URL to which the webhook should be sent.
     * @param array $data The payload to send.
     */
    public function dispatch(string $url, array $data): ResponseInterface
    {
        try {
            $response = $this->httpClient->post($url, array_merge($this->config, ['json' => $data]));
            $statusCode = $response->getStatusCode();

            if ($statusCode >= 400 && $statusCode < 600) {
                throw new HttpException($statusCode, "Error: {$statusCode} {$response->getReasonPhrase()}");
            }

            return $response;
        } catch (GuzzleException $e) {
            // We don't really need to declare this, but just declaring it and re-throwing it to be explicit

            throw $e;
        }
    }
}
