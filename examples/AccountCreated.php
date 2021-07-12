<?php

use Jozi\Events\StoredRabbitEvent\StoredRabbitEvent;

class AccountCreated extends StoredRabbitEvent
{
    public function toPublish(): array
    {
        return [];
    }
}
