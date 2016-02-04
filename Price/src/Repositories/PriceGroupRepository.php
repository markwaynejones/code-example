<?php
namespace Caramba\Price\Repositories;

use Caramba\Price\Models\Price_group;

class PriceGroupRepository
{

	private $model;

	public function __construct(Price_group $priceGroup)
	{
		$this->model = $priceGroup;
	}

	public function __call($method,$args)
	{
		return call_user_func_array(array($this->model, $method), $args);
	}

	public function find($id)
	{
		$priceGroup = Price_group::find($id);
		
		return $priceGroup;
	}

	public function prices($priceGroup)
	{
		$prices = $priceGroup->prices()->get();

		return $prices;
	}

	public function save($priceGroup)
	{
		$priceGroup->save();
	}

	public function create($input)
	{

		$priceGroup = new Price_group();

		$priceGroup->name = $input['name'];

		$priceGroup->save();

	}

	public function update($id,$input)
	{
		$priceGroup = $this->find($id);

        $priceGroup->name = $input['name'];

        $this->save($priceGroup);
	}


}

