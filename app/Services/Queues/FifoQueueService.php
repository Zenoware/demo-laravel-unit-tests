<?php

namespace App\Services\Queues;

use UnderflowException;
use UnexpectedValueException;

class FifoQueueService {
    /** @var string[] */
    protected array $queue = [];

    public function enqueue($item): void
    {
        $this->queue[] = $item;
    }

    public function dequeue(): ?string
    {
        if (empty($this->queue)) {
            throw new UnderflowException('Cannot dequeue from an empty queue.');
        }

        return array_shift($this->queue);
    }

    public function peek(): string
    {
        if (empty($this->queue)) {
            throw new UnderflowException('Cannot peek into an empty queue.');
        }

        if ($this->queue[0] === null) {
            throw new UnexpectedValueException('The first item in the queue is null.');
        }

        return $this->queue[0];
    }
}
