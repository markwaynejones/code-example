<?php namespace Caramba\Price\Services;

use Validator;
use Redirect;

class PriceBreakPointValidator {

	private $errors;

    public function isValidForStore($input, $rules = null){

        if($rules == null)
        {
            $rules = array(
                'rangeFrom'  => 'required',
                'rangeTo'  => 'required',
                'price' => 'required'
            );
        }

        $validator = Validator::make($input,$rules);

        if($validator->fails())
        {
            $this->errors = $validator;
            return false;
        }

        //else validator passed
        return true;

    } 

	public function getErrors()
	{
		return $this->errors;
	}

}

