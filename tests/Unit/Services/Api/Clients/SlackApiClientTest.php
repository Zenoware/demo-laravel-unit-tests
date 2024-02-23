<?php

namespace Tests\Unit\Services\Api\Clients;

use App\Models\User;
use App\Services\Api\Clients\SlackApiClient;
use PHPUnit\Framework\TestCase;
use Slack\ApiClient as SlackClient;
use Slack\Channel as SlackChannel;
use Slack\Message\Message;
use Slack\Message\MessageBuilder;
use Mockery;

class SlackApiClientTest extends TestCase
{
    /**
     * @dataProvider userDataProvider
     */
    public function testAnnounceUserDetails($name, $email, $expectedMessage): void
    {
        $user = Mockery::mock(User::class);

        $user->shouldReceive('getAttribute')
            ->with('name')
            ->andReturn($name);
        $user->shouldReceive('getAttribute')
            ->with('email')
            ->andReturn($email);

        $slackChannel = Mockery::mock(SlackChannel::class);

        $slackMessage = Mockery::mock(Message::class);

        $slackMessageBuilder = Mockery::mock(MessageBuilder::class);

        $slackMessageBuilder->shouldReceive('setChannel')
            ->once()
            ->andReturnSelf();
        $slackMessageBuilder->shouldReceive('setText')
            ->with($expectedMessage)
            ->andReturnSelf();
        $slackMessageBuilder->shouldReceive('create')->once()->andReturn($slackMessage);

        $slackClient = Mockery::mock(SlackClient::class);

        $slackClient->shouldReceive('setToken')->once()->with(Mockery::mock('string'));
        $slackClient->shouldReceive('getMessageBuilder')->once()->andReturn($slackMessageBuilder);
        $slackClient->shouldReceive('postMessage')->once()->with($slackMessageBuilder);

        $slackApiClient = new SlackApiClient('token', $slackClient);

        $slackApiClient->setUser($user);
        $slackApiClient->announceUserDetails($slackChannel);

        $this->addToAssertionCount(Mockery::getContainer()->mockery_getExpectationCount());
    }

    public static function userDataProvider(): array
    {
        return [
            ['Test User 1', 'test1@example.com', 'User Details: Name - Test User 1, Email - test1@example.com'],
            ['Test User 2', 'test2@example.com', 'User Details: Name - Test User 2, Email - test2@example.com'],
            ['Test User 3', 'test3@example.com', 'User Details: Name - Test User 3, Email - test3@example.com'],
        ];
    }
}
