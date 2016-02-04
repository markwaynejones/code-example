<?php namespace Caramba\Price;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
			'Caramba\Item\Events\ViewItem_MainSection' => [
					'Caramba\Price\Handlers\Events\ItemMainAreaRequired',
			], 	
			'Caramba\Order\Events\ViewItem_OrderSectionAdditionalContent' => [
					'Caramba\Price\Handlers\Events\ItemPricesFrontEnd',
			], 					
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		
		parent::boot($events);
		
		\Event::listen('Caramba\Core\Events\GetHeaderDetails', function($event)
		{
			// Handle the event...

			$sidebar_details = array();

			$sidebar_details[] = array('url' => '/price-groups', 'heading' => 'View All Price Groups');
			// $sidebar_details[] = array('url' => '/admin-item/create', 'heading' => 'Create an Item');

			return $sidebar_details;
				
		});

		\Event::listen('Caramba\Price\Events\Active', function()
		{
			return 1;
		});				

		\Event::listen('Caramba\Price\Events\TableName', function()
		{
			// Handle the event...
			return 'prices';
				
		});				

		\Event::listen('Caramba\Price\Events\GetByID', function($id)
		{
			// Handle the event...

			$priceModel = new \Caramba\Price\Models\Price;

			$price = $priceModel->find($id);

			return $price;
				
		});		
		
	/*
		always use below two event listeners coding methods 
		when displaying package data in html tables
		*/
		\Event::listen('Caramba\Core\Events\Frontend.Action_ViewItem_OrderSection', function()
		{

			$testArray = array();
			$testArray['th'] = '<th>Name</th>';
			$testArray['th'] .= '<th>Price</th>';
			$testArray['relatedListener'] = 'Frontend.Action_ViewItem_OrderSectionMainBody_Price';

			return $testArray;
		
		});

		\Event::listen('Caramba\Core\Events\Frontend.Action_ViewItem_OrderSectionMainBody_Price', function($item)
		{
			

			// start

			$tableTDs = '';

			// $formHTML = '<h3>Order</h3>';

			// $formHTML = '<form action="/update-item-prices/'.$item->id.'" method="POST">';

			// $formHTML .= '<table class="table">';

			// $formHTML .= '<tbody>';




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

				$tableTHs = '<tr><th>Name</th><th>Price</th></tr>';

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
					
					$tableTDs .= '<tr><td colspan="2" style="font-weight:bold;">'.$priceGroup->name.'</td></tr>';



					// $formHTML .= '';
					$tableTDs .= $pricesHtml;
				}

			}
			// end looping through price groups

			// $formHTML .= '</tbody>';

			// $formHTML .= '</table>';

			return $tableTDs;				


			// end




			// $customerModel = new \Caramba\UserManagement\Models\Customer;

			// $customer = $customerModel->where('user_id','=',17)->first();

			/*return '<td>Price Info Body 1</td>
					<td>Price Info Body 2</td>
				';*/
		
		});			

		//
	}
	
	public function register()
	{
		//
	}

}
