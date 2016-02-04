<?php namespace Caramba\Price\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Session;
use Validator;
use Caramba\Price\Repositories\PriceRepository;
use Listener;
use ListOrder;
use Helper;

class AdminPriceController extends Controller
{

    private $priceRepository;

    public function __construct(PriceRepository $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }

    public function index()
    {
        return view('Price::index');
    }

    // need to refactor below eventually
    // also use repository for below
    // below is used on the item page to attach and detach prices to items
    public function update_item_prices($itemID)
    {
        $this->updateItemPrices($itemID, Input::get('prices'));

    	return Redirect::to('/admin-item/'.$itemID);
    }

    public function edit($id)
    {
        $price = $this->priceRepository->find($id);

        $priceBreakPoints = $price->price_breakpoints()->get();

        return view('Price::edit-price')->with('price',$price)->with('priceBreakPoints',$priceBreakPoints);
    }

    public function store()
    {

        $input = Input::all();

        $this->priceRepository->create($input);

        return Redirect::to('/admin-price-group/'.$input['priceGroupID'].'/edit')->with('message','Successfully created Price Group');

    }    

    public function update($id)
    {

        $input = Input::all();

        $this->priceRepository->update($id, $input);

        return Redirect::to('/admin-price/'.$id.'/edit')->with('message','Successfully updated price');

    }

    public function sortPrice($priceGroupID, $priceID, $direction)
    {

        $args = array(
            'priceGroupID' => $priceGroupID
        );

        ListOrder::sort('price', $priceID, $direction, $this->priceRepository, false, $args);

        return Redirect::to('admin-price-group/'.$priceGroupID.'/edit');

    }

    // put below in service class in this package and purely related to this package
    private function updateItemPrices($itemID, $pricesChosen)
    {

        $item = Listener::get('Item','GetByID', array($itemID));

        $allPrices = $this->priceRepository->all();

        $pricesForThisItem = Listener::get('Item', 'GetPricesByID', array($itemID));

        $pricesForThisItemArray = Helper::convertObjectsToIDs($pricesForThisItem);

        foreach($allPrices as $price)
        {

            // if this price hasn't been ticked by user then remove assoication to item
            if(!in_array($price->id, $pricesChosen))
            {
                $item->prices()->detach($price->id);
                continue;
            }

            // if association does not already exist then add it
            if(!in_array($price->id, $pricesForThisItemArray))
                $item->prices()->attach($price->id);

        }

    }

}