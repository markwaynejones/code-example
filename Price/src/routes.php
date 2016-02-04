<?php

Route::group(array('namespace' => 'Caramba\Price\Controllers'), function()
{
	
	Route::post('/update-item-prices/{id}', array('as' => 'update-item-prices', 'uses' => 'AdminPriceController@update_item_prices'));

	Route::get('/price-groups', array('as' => 'price-groups', 'uses' => 'AdminPriceGroupController@allPriceGroups'));

	Route::get('sort-price/{priceGroupID}/{priceID}/{direction}', array('as' => 'sort-price', 'uses' => 'AdminPriceController@sortPrice'));

	//RESTful Resource Routes
	Route::resource('admin-price-group','AdminPriceGroupController');

	Route::resource('admin-price','AdminPriceController');

	Route::resource('admin-price-breakpoint','AdminPriceBreakPointController');

});

