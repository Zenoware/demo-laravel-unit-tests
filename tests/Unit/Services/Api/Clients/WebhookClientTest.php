<?php

namespace Tests\Unit\Services\Api\Clients;

use App\Services\Api\Clients\WebhookClient;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @coversDefaultClass \App\Services\Api\Clients\WebhookClient
 *
 * @group new
 */
class WebhookClientTest extends TestCase
{
    /**
     * @covers ::dispatch
     */
    public function testDispatch(): void
    {
        $url = 'http://example.com';
        $data = ['foo' => 'bar'];
        $config = ['timeout' => 2.0];

        $response = $this->createMock(ResponseInterface::class);

        $httpClient = $this->createMock(HttpClient::class);
        $httpClient->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo($url),
                $this->equalTo(array_merge($config, ['json' => $data]))
            )
            ->willReturn($response);

        $webhookClient = new WebhookClient($config, $httpClient);

        $this->assertSame($response, $webhookClient->dispatch($url, $data));
    }

    /**
     * @covers ::dispatch
     */
    public function testDispatchThrowsExceptionFor400Error(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Error: 400 Bad Request');

        $url = 'http://example.com';
        $data = ['foo' => 'bar'];
        $config = ['timeout' => 2.0];

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(400);
        $response->method('getReasonPhrase')->willReturn('Bad Request');

        $httpClient = $this->createMock(HttpClient::class);
        $httpClient->method('post')->willReturn($response);

        $webhookClient = new WebhookClient($config, $httpClient);
        $webhookClient->dispatch($url, $data);
    }

    /**
     * @covers ::dispatch
     */
    public function testDispatchThrowsExceptionFor500Error(): void
    {
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Error: 500 Internal Server Error');

        $url = 'http://example.com';
        $data = ['foo' => 'bar'];
        $config = ['timeout' => 2.0];

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(500);
        $response->method('getReasonPhrase')->willReturn('Internal Server Error');

        $httpClient = $this->createMock(HttpClient::class);
        $httpClient->method('post')->willReturn($response);

        $webhookClient = new WebhookClient($config, $httpClient);
        $webhookClient->dispatch($url, $data);
    }
}
