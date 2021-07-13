<?php

if (!function_exists('publish_event')) {

    /**
     * Publishes an event to RabbitMQ and stores the event
     */
    function publish_event($event)
    {
        event($event);
        publish($event);
    }
}
