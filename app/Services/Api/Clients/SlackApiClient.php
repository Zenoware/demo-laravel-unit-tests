<?php

namespace App\Services\Api\Clients;

use App\Models\User;
use React\EventLoop\Factory as EventLoopFactory;
use Slack\ApiClient as SlackClient;
use Slack\ChannelInterface;
use Slack\ChannelInterface as SlackChannel;

/**
 * A Slack API client is always low-hanging fruit for demos like this.
 */
class SlackApiClient
{
    private User $user;
    private SlackClient $client;

    const string CHANNEL_GENERAL = '#general';

    public function __construct($token, SlackClient $client = null)
    {
        $loop = EventLoopFactory::create();

        $this->client = $client ?? new SlackClient($loop);
        $this->client->setToken($token);
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function announceUserDetails(SlackChannel $channel): void
    {
        $text = sprintf(
            'User Details: Name - %s, Email - %s',
            $this->user->name,
            $this->user->email
        );

        $message = $this->client
            ->getMessageBuilder()
            ->setChannel($channel)
            ->setText($text)
            ->create();

        $this->client->postMessage($message);
    }
}
