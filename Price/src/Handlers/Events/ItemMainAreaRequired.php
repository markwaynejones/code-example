<?php namespace Caramba\Price\Handlers\Events;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Intervention\Image\Facades\Image;
use League\Flysystem\Filesystem;
use Storage;
use Caramba\Resource\Repositories\ResourceRepository;
use Caramba\Item\Repositories\ItemRepository;

class ItemMainAreaRequired {

	// private $categoryHelper;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */

	private $resourceRepository;
	private $itemRepository;

	public function __construct(ResourceRepository $resourceRepository, ItemRepository $itemRepository)
	{
		//
		$this->resourceRepository = $resourceRepository;

		$this->itemRepository = $itemRepository;
	}

	/**
	 * Handle the event.
	 *
	 * @param  PodcastWasPurchased  $event
	 * @return void
	 */
	//public function handle(UserLoggedIn $event)
	// this class may need refactoring
	public function handle($event)
	{

		$item = $event->item;

		// maybe put below method into service class instead of this class
		$itemPrices = $this->getAllItemsPrices($item);

		$formHTML = $this->test($item);

		return view('Price::events.item-prices')->with('item',$item)->with('itemPrices',$itemPrices)->with('formHTML',$formHTML);

	}

	// maybe put below method into service class instead of this class
	private function getAllItemsPrices($item)
	{
		return $item->prices()->get();
	}

	private function test($item)
	{

		// start

			$formHTML = '<form action="/update-item-prices/'.$item->id.'" method="POST">';

			// get all prices associated to current item viewing
			$itemPrices = $this->getAllItemsPrices($item);
			$itemPricesArray = array();

			foreach ($itemPrices as $price) {
				$itemPricesArray[] = $price->id;
			}

			// get all price groups
			$priceGroups = \Caramba\Price\Models\Price_group::all();

			// loop through each price group and display the name
			foreach($priceGroups as $priceGroup){

				$formHTML .= '<p><strong>'.$priceGroup->name.'</strong></p>';

				// get prices associated to this group
				$pricesAssocWithGroup = $priceGroup->prices()->get();

				// loop through each price associated to this group
				foreach($pricesAssocWithGroup as $price)
				{
					
					$checked = '';

					if(in_array($price->id, $itemPricesArray))
					{
						$checked = 'checked="checked"';
					}

					// if the current price is associated to this item then check the box
					$formHTML .= '<p><input type="checkbox" name="prices[]" '.$checked.' value="'.$price->id.'"> - '.$price->name.' ('.$price->price.')</p>';

				}

			}

			$formHTML .= '<input type="submit" value="Update Prices" class="btn btn-small btn-info">';

			$formHTML .= '<input type="hidden" name="_token" value="'.csrf_token().'">';

			$formHTML .= '</form>';

			return $formHTML;
			

	}

}
