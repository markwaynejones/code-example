<?php namespace Caramba\Price\Handlers\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Caramba\Item\Repositories\ItemRepository;

use Action;

class ItemPricesFrontEnd {

	// private $categoryHelper;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */

	// private $itemRepository;

	// public function __construct(ItemRepository $itemRepository)
	public function __construct()
	{
		// $this->itemRepository = $itemRepository;
		// die('In event handler construct');
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
		// die('in handle');
		// die('In event handler');

		// return 'Hello world';

		$item = $event->item;

		// var_dump($item->name);
		// die;
		
		// maybe put below method into service class instead of this class
		$itemPrices = $this->getAllItemsPrices($item);

		// var_dump($itemPrices);

		// $priceHtml = $this->buildPriceTable($item);

		// start

		// $viewOrdersTableTHs = Action::getFrontend('ViewItem', 'OrderSection');

		// var_dump($viewOrdersTableAction);
		// die;

		// end

		// $priceHtml = $this->buildPriceTableArray($item);


		// print_r($priceHtml);

		$orderSectionTable = $this->getOrderSectionTable($item);

		return $orderSectionTable;
		// echo '<h3>Order</h3>';

		// echo $orderSectionTable;

		// echo '<br /><input type="submit" value="Submit" />';

		// die;


		// $formHTML = $this->buildForm($item);

		// return view('Order::events.item-prices')->with('item',$item)->with('itemPrices',$itemPrices)->with('formHTML',$formHTML);
		// return view('Price::events.item-prices-front-end')->with('item',$item)->with('itemPrices',$itemPrices);

	}

	// maybe put below method into service class instead of this class
	private function getAllItemsPrices($item)
	{
		return $item->prices()->get();
	}

	private function getOrderSectionTable($item)
	{
			
			// start

			$testArray = array();
			$testArray['th'] = '<th>Name</th>';
			$testArray['th'] .= '<th>Price</th>';

			// end

			$viewOrdersTableTHs = $testArray;	

			// var_dump($viewOrdersTableTHs);
			// die;

			$formHTML = '';

			$formHTML .= '<table class="table" style="border:1px solid black;">';

				$formHTML .= '<tbody>';		

				// $viewOrdersTableTHs = array($viewOrdersTableTHs);

				

					// $formHTML .= '<tr>';

								// get td's from action
								// foreach ($viewOrdersTableTHs as $tableHeading){

									// $viewOrdersTableTDs = Action::getRelated($tableHeading['relatedListener'],$item);



									// echo($tableHeading['relatedListener']);
									// var_dump($viewOrdersTableTDs);
									// die;

									$formHTML .= $this->getTableData($item);



								// }					

					// $formHTML .= '</tr>';									

				$formHTML .= '</tbody>';								

			$formHTML .= '</table>';

			return $formHTML; 

	}

	private function getTableData($item)
	{
			
		$tableTDs = '';


		// get all prices associated to current item viewing
			$itemPrices = $item->prices()->get();
			$itemPricesArray = array();

			foreach ($itemPrices as $price) {
				$itemPricesArray[] = $price->id;
			}

			// get all price groups
			$priceGroups = \Caramba\Price\Models\Price_group::all();

			// loop through each price group and display the name
			foreach($priceGroups as $priceGroup){

				$showPriceGroup = false;

				// get prices associated to this group
				$pricesAssocWithGroup = $priceGroup->prices()->get();

				$tableTHs = '<tr style="background-color:#eee;"><th>Size</th><th>Price</th><th>Qty</th></tr>';

				$pricesHtml = '';

				// loop through each price associated to this group
				foreach($pricesAssocWithGroup as $price)
				{


					if(in_array($price->id, $itemPricesArray))
					{

						$pricesHtml .= '<tr><td style="width:35%;">'.$price->name.'</td><td style="width:35%;">'.$price->price.'</td>
						<td style="width:40%;"><input style="width:40%;" name="qty_'.$price->id.'" type="text" /></td>
						</tr>';

						$showPriceGroup = true;
					}

				}
				

				if($showPriceGroup === true)
				{
					
					

					$tableTDs .= '<tr><td colspan="3" style="font-weight:bold;background-color:#ddd;">
									'.$priceGroup->name.'
									</td></tr>';
$tableTDs .= $tableTHs;


					// $formHTML .= '';
					$tableTDs .= $pricesHtml;
				}

			}
			// end looping through price groups

			// $formHTML .= '</tbody>';

			// $formHTML .= '</table>';

			return $tableTDs;
	}

	/*
	// instead of doing inline styling in below method, maybe create big array
	// then pass it to the view to echo out rather than echo out in below method
	private function buildPriceTable($item)
	{

		// start

			$formHTML = '<h3>Order</h3>';

			// $formHTML = '<form action="/update-item-prices/'.$item->id.'" method="POST">';

			$formHTML .= '<table class="table">';

			$formHTML .= '<tbody>';




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

				$showPriceGroup = false;

				// get prices associated to this group
				$pricesAssocWithGroup = $priceGroup->prices()->get();

				$pricesHtml = '';

				// loop through each price associated to this group
				foreach($pricesAssocWithGroup as $price)
				{

					if(in_array($price->id, $itemPricesArray))
					{
						$pricesHtml .= '<tr><td>'.$price->name.'</td><td>'.$price->price.'</td></tr>';

						$showPriceGroup = true;
					}

				}

				if($showPriceGroup === true)
				{
					$formHTML .= '<tr><td colspan="2" style="font-weight:bold;">'.$priceGroup->name.'</td></tr>';

					$formHTML .= '<tr>
							<th style="text-align:left;">Size</th>
							<th style="text-align:left;">Price</th>
						</tr>';

					// $formHTML .= '';
					$formHTML .= $pricesHtml;
				}

			}

			$formHTML .= '</tbody>';

			$formHTML .= '</table>';

			return $formHTML;
			

	}
	*/

	/*private function buildPriceTableArray($item)
	{

		// start

			// $formHTML = '<h3>Order</h3>';

			// $formHTML = '<form action="/update-item-prices/'.$item->id.'" method="POST">';

			// $formHTML .= '<table class="table">';

			// $formHTML .= '<tbody>';

			$priceTableArray = array();
			// $priceTableArray['th'] = array();
			// $priceTableArray['priceGroups'] = array();

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

				$showPriceGroup = false;

				// get prices associated to this group
				$pricesAssocWithGroup = $priceGroup->prices()->get();

				$pricesHtml = '';
				$pricesArray = array();

				// loop through each price associated to this group
				foreach($pricesAssocWithGroup as $price)
				{

					if(in_array($price->id, $itemPricesArray))
					{
						$pricesHtml .= '<tr><td>'.$price->name.'</td><td>'.$price->price.'</td></tr>';

						$pricesArray[] = $price;

						$showPriceGroup = true;
					}

				}

				if($showPriceGroup === true)
				{
					
					// start

					$priceTableArray[$priceGroup->id]['priceGroup'] = $priceGroup;
					$priceTableArray[$priceGroup->id]['th'] = array('Size','Price');
					$priceTableArray[$priceGroup->id]['prices'] = array($pricesArray);

					// end


					// $formHTML .= '<tr><td colspan="2" style="font-weight:bold;">'.$priceGroup->name.'</td></tr>';

					/*$formHTML .= '<tr>
							<th style="text-align:left;">Size</th>
							<th style="text-align:left;">Price</th>
						</tr>';

					// $formHTML .= '';
					$formHTML .= $pricesHtml;
					
				}

			}
*/
			// $formHTML .= '</tbody>';

			// $formHTML .= '</table>';

			// return $priceTableArray;
			

	// }

}
