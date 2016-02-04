<?php
namespace Caramba\Price\Repositories;

use Caramba\Price\Models\Price;

class PriceRepository
{

	private $model;

	public function __construct(Price $price)
	{
		$this->model = $price;
	}

	public function __call($method,$args)
	{
		return call_user_func_array(array($this->model, $method), $args);
	}

	public function find($id)
	{
		$price = Price::find($id);
		
		return $price;
	}

	public function save($price)
	{
		$price->save();
	}

	public function create($input)
	{

		$price = new Price();

		$price->name = $input['name'];

		$price->price = $input['price'];

		$price->price_group_id = $input['priceGroupID'];

		$price->save();

	}

	public function update($id, $input)
	{
        $price = $this->find($id);

        $price->name = $input['name'];

        $price->price = $input['price'];

        $price->save();
	}

}

