<?php 
namespace Caramba\Price\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model {

	public function items()
	{
		return $this->belongsToMany('Caramba\Item\Models\Item');
	}

	public function price_group()
	{
		return $this->belongsTo('Caramba\Price\Models\Price_group');
	}

	public function price_breakpoints()
	{
		return $this->hasMany('Caramba\Price\Models\Price_breakpoint');
	}	

}
