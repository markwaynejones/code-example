<?php 
namespace Caramba\Price\Models;

use Illuminate\Database\Eloquent\Model;

class Price_group extends Model {

	public function prices()
	{
		return $this->hasMany('Caramba\Price\Models\Price');
	}

}
