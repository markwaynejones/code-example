<?php namespace Caramba\Price\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
//use Caramba\Core\Events\GetSidebarDetails;

class ItemPricesFrontEnd extends Event {

    use SerializesModels;

    public $item;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($item)
    {

    	$this->item = $item;

    }

}
