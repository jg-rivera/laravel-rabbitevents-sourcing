# RabbitEvents Sourcing

A simple integration between `nuwber/rabbitevents` and `spatie/laravel-event-sourcing`.
Both are used to facilitate event sourcing and intraservice communication using RabbitMQ topic exchanges.

## Acknowledgements

- [nuwber/rabbitevents](https://github.com/nuwber/rabbitevents)
- [spatie/laravel-event-sourcing](https://github.com/spatie/laravel-event-sourcing/)

## Usage/Examples

All stored and published events extends the `StoredRabbitEvent` class. These events will be handled for both event sourcing (`spatie/laravel-event-sourcing`) and publishing to RabbitMQ (`nuwber/rabbitevents`).

```php
use Jozi\Events\StoredRabbitEvent;

class AccountCreated extends StoredRabbitEvent
{
    public $eventKey = 'account.created';

    /** @var array */
    public $accountAttributes;

    public function __construct(array $accountAttributes)
    {
        $this->accountAttributes = $accountAttributes;
    }

    public function toPublish(): array
    {
        return $this->accountAttributes;
    }
}
```

After an event has been defined, you may invoke it using the `publish_event` helper function. It is just a simple wrapper for invoking both `event` and `publish` as a one-liner.

```php
class Account extends Model
{
    protected $guarded = [];

    public static function createWithAttributes(array $attributes): Account
    {
        /*
         * Let's generate a uuid.
         */
        $attributes['uuid'] = (string) Uuid::uuid4();

        /*
         * The account will be created inside this event using the generated uuid.
         */
        publish_event(new AccountCreated($attributes));

        /*
         * The uuid will be used the retrieve the created account.
         */
        return static::getByUuid($attributes['uuid']);
    }
}
```
