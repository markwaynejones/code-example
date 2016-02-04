<?php namespace Caramba\Price\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Session;
use Validator;
use Caramba\Price\Repositories\PriceGroupRepository;

class AdminPriceGroupController extends Controller
{

    private $priceGroupRepository;

    public function __construct(PriceGroupRepository $priceGroupRepository)
    {
        $this->priceGroupRepository = $priceGroupRepository;
    }

    public function index()
    {
        return view('Price::index');
    }
    
    public function allPriceGroups()
    {

        $priceGroups = $this->priceGroupRepository->all();

    	return view('Price::view-all-price-groups')->with('priceGroups',$priceGroups);

    }

    public function edit($id)
    {
        $priceGroup = $this->priceGroupRepository->find($id);

        $prices = $this->priceGroupRepository->prices($priceGroup)->sortBy('list_order');

        return view('Price::edit-price-group')->with('priceGroup',$priceGroup)->with('prices',$prices);
    }

    public function update($id)
    {

        $input = Input::all();

        $this->priceGroupRepository->update($id, $input);

        return Redirect::to('/admin-price-group/'.$id.'/edit')->with('message','Successfully updated Price Group');

    }

    public function store()
    {

        $input = Input::all();

        $this->priceGroupRepository->create($input);

        return Redirect::to('/price-groups')->with('message','Successfully created Price Group');

    }

}