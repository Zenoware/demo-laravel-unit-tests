<?php

namespace Tests\Unit\Services\Queues;

use App\Services\Queues\FifoQueueService;
use PHPUnit\Framework\TestCase;
use UnderflowException;
use UnexpectedValueException;

/**
 * @coversDefaultClass \App\Services\Queues\FifoQueueService
 * @group new
 */
class FifoQueueServiceTest extends TestCase
{
    public function testPeekThrowsUnderflowExceptionForEmptyQueue() {
        $this->expectException(UnderflowException::class);

        $queue = new FifoQueueService();
        $queue->peek();
    }

    public function testPeekThrowsUnexpectedValueExceptionForNullFirstItem() {
        $this->expectException(UnexpectedValueException::class);

        $queue = new FifoQueueService();
        $queue->enqueue(null);
        $queue->peek();
    }

    public function testPeekReturnsFirstItemSuccessfully() {
        $queue = new FifoQueueService();
        $queue->enqueue('first');
        $queue->enqueue('second');

        $firstItem = $queue->peek();

        $this->assertEquals('first', $firstItem);
    }
}
