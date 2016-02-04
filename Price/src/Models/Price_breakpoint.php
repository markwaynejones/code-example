<?php 
namespace Caramba\Price\Models;

use Illuminate\Database\Eloquent\Model;

class Price_breakpoint extends Model {

	public function price()
	{
		return $this->belongsTo('Caramba\Price\Models\Price');
	}

}
