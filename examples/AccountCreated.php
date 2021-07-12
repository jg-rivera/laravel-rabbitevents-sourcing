<?php

use Jozi\Events\StoredRabbitEvent;

class AccountCreated extends StoredRabbitEvent
{
    public function toPublish(): array
    {
        return [];
    }
}
