<?php namespace Caramba\Price\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
//use Caramba\Core\Events\GetSidebarDetails;

class GetPriceSidebar extends Event {

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

}
