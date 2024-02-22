<?php

namespace Tests\Unit\Services\Api\Clients;

use App\Services\Api\Clients\ForgeApiClient;
use GuzzleHttp\Client;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * When unit testing API client classes, we're not so much concerned with the data that's being sent and received, but
 * rather the logic that's being used to send and receive that data. We want to ensure that the client is making the correct
 * method calls to the HTTP client, and that it's handling the responses correctly.
 *
 * In this test case, you can see that we've mocked the Guzzle HTTP client, and we're testing that the API client is making
 * the correct method calls to the HTTP client, and that it's handling the responses correctly.
 *
 * @coversDefaultClass \App\Services\Api\Clients\ForgeApiClient
 */
class ForgeApiClientTest extends TestCase
{
    private ForgeApiClient $client;
    private MockInterface $mock;

    private ResponseInterface $httpResponseMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = Mockery::mock(Client::class);
        $this->client = new ForgeApiClient('this-is-a-fake-api-key', $this->mock);
        $this->setupHttpResponseMock('{"message": "FooBarBaz"}');
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }

    /**
     * @covers ::listServers
     */
    public function testListServers(): void
    {
        $this->mock->shouldReceive('get')
            ->once()
            ->with('servers')
            ->andReturn($this->httpResponseMock);

        $this->assertEquals(['message' => 'FooBarBaz'], $this->client->listServers());
    }

    /**
     * @covers ::getServer
     */
    public function testGetServer(): void
    {
        $this->mock->shouldReceive('get')
            ->once()
            ->with('servers/1')
            ->andReturn($this->httpResponseMock);

        $this->assertEquals(['message' => 'FooBarBaz'], $this->client->getServer(1));
    }

    /**
     * @covers ::createServer
     */
    public function testCreateServer(): void
    {
        $this->mock->shouldReceive('post')
            ->once()
            ->with('servers', ['json' => ['name' => 'test']])
            ->andReturn($this->httpResponseMock);

        $this->assertEquals(['message' => 'FooBarBaz'], $this->client->createServer(['name' => 'test']));
    }

    /**
     * @covers ::deleteServer
     */
    public function testDeleteServer(): void
    {
        $this->mock->shouldReceive('delete')
            ->once()
            ->with('servers/1')
            ->andReturn($this->httpResponseMock);

        $this->assertEquals(['message' => 'FooBarBaz'], $this->client->deleteServer(1));
    }

    private function setupHttpResponseMock(string $body): void
    {
        $httpStreamMock = Mockery::mock(StreamInterface::class);

        $httpStreamMock->shouldReceive('__toString')
            ->once()
            ->andReturn($body);

        $this->httpResponseMock = Mockery::mock(ResponseInterface::class);

        $this->httpResponseMock->shouldReceive('getBody')
            ->once()
            ->andReturn($httpStreamMock);
    }
}
