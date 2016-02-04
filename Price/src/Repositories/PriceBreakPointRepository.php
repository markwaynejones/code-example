<?php
namespace Caramba\Price\Repositories;

use Caramba\Price\Models\Price;
use Caramba\Price\Models\Price_breakpoint;

class PriceBreakPointRepository
{

	private $model;

	public function __construct(Price_breakpoint $priceBreakpoint)
	{
		$this->model = $priceBreakpoint;
	}

	public function __call($method,$args)
	{
		return call_user_func_array(array($this->model, $method), $args);
	}

	public function find($id)
	{
		$priceBreakpoint = Price_breakpoint::find($id);
		
		return $priceBreakpoint;
	}

	public function save($priceBreakpoint)
	{
		$priceBreakpoint->save();
	}

	public function delete($id)
	{
		$priceBreakpoint = Price_breakpoint::find($id);

		$priceBreakpoint->delete();
	}

	public function create($input)
	{

		$priceBreakpoint = new Price_breakpoint();

		$priceBreakpoint->price_id = $input['priceID'];

		$priceBreakpoint->range_from = $input['rangeFrom'];

		$priceBreakpoint->range_to = $input['rangeTo'];

		$priceBreakpoint->price = $input['price'];

		$priceBreakpoint->save();

	}

	public function update($id, $input)
	{
        $priceBreakpoint = $this->find($id);

        $priceBreakpoint->name = $input['name'];

        $priceBreakpoint->price = $input['price'];

        $priceBreakpoint->save();
	}

}

