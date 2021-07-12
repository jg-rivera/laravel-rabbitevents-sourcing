<?php

namespace Jozi\Events\StoredRabbitEvent;

use Exception;
use Nuwber\Events\Event\ShouldPublish;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

/**
 * Represents an event that will be stored and published to a RabbitMQ queue; given a string `$eventKey`.
 */
abstract class StoredRabbitEvent extends ShouldBeStored implements ShouldPublish
{
    /**
     * Event name that is the same as RabbitMQ's routing key. Example: `item.created`.
     *
     * @var string
     */
    public $eventKey;

    public function publishEventKey(): string
    {
        if (empty($eventKey)) {
            throw new Exception('Cannot have empty event key for StoredRabbitEvent');
        }

        return $this->eventKey;
    }

    abstract public function toPublish(): array;
}
