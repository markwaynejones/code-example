<?php namespace Caramba\Price\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Session;
use Validator;
use Caramba\Price\Repositories\PriceBreakPointRepository;
use Caramba\Price\Services\PriceBreakPointValidator;

class AdminPriceBreakPointController extends Controller
{

    private $priceBreakPointRepository;
    private $priceBreakPointValidator;
    private $errors;

    public function __construct(PriceBreakPointRepository $priceBreakPointRepository, PriceBreakPointValidator $priceBreakPointValidator)
    {
        $this->priceBreakPointRepository = $priceBreakPointRepository;

        $this->priceBreakPointValidator = $priceBreakPointValidator;
    }

    public function index()
    {
        return view('Price::index');
    }

    public function store()
    {

        $input = Input::all();

        if(! $this->priceBreakPointValidator->isValidForStore($input))
            return Redirect::back()->withErrors($this->priceBreakPointValidator->getErrors())->withInput();

        $this->priceBreakPointRepository->create($input);
        
        return Redirect::to('/admin-price/'.$input['priceID'].'/edit')->with('message','Successfully created Price Break-point');
        
    }

    public function destroy($id)
    {
        $this->priceBreakPointRepository->delete($id);

        return Redirect::back()->with('message','Successfully deleted Price Break-point');

    }

}