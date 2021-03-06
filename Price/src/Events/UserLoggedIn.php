<?php namespace Caramba\Price\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class UserLoggedIn extends Event {

	use SerializesModels;
	
	public $userId;
	public $userName;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($userId, $userName)
	{
		
		$this->userId = $userId;

		$this->userName = $userName;
		
	}


}
