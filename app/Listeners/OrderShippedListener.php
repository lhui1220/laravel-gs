<?php

namespace App\Listeners;

use App\Events\OrderShippedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class OrderShippedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderShippedEvent  $event
     * @return void
     */
    public function handle(OrderShippedEvent $event)
    {
        Log::debug("RECV OrderShippedEvent orderId={$event->orderId}");
    }
}
