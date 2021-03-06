<?php

// github.com/gocanto/gocanyo-pkg


Route::group([

	'middleware' =>  ['web', 'auth', 'context'],
	'namespace' => 'Queridiam\FSxConnector\Http\Controllers',
	'prefix'    => 'fsx'

], function () {

//	Route::get('orders', ['as' => 'worders', 'uses' => 'WooOrdersController@index']);
//	Route::get('orders/statuses', 'WooOrdersController@getStatuses');	// Semms this endpoint does not exist /!\
//	Route::get('orders/{id}', 'WooOrdersController@show');
//	Route::post('orders/{id}', ['as' => 'wostatus', 'uses' => 'WooOrdersController@update']);


/*
	Route::get('/', ['uses' => 'FSxOrdersController@index', 
	                 'as'   => 'fsxorders.index'] );

	Route::get('fsxorders', ['uses' => 'FSxOrdersController@index', 
	                 'as'   => 'fsxorders.index'] );
*/


	Route::resource('fsxconfigurationkeys', 'FSxConfigurationKeysController');



	Route::get( 'fsxconfiguration', 'FSxConfigurationKeysController@configurationsEdit')
			->name('fsx.configuration');
	Route::post('fsxconfiguration', 'FSxConfigurationKeysController@configurationsUpdate')
			->name('fsx.configuration.update');

	Route::get( 'fsxconfiguration/paymentmethods', 'FSxConfigurationKeysController@configurationPaymentMethodsEdit')
			->name('fsx.configuration.paymentmethods');
	Route::post('fsxconfiguration/paymentmethods', 'FSxConfigurationKeysController@configurationPaymentMethodsUpdate')
			->name('fsx.configuration.paymentmethods.update');

	Route::get( 'fsxconfiguration/taxes', 'FSxConfigurationKeysController@configurationTaxesEdit')
			->name('fsx.configuration.taxes');
	Route::post('fsxconfiguration/taxes', 'FSxConfigurationKeysController@configurationTaxesUpdate')
			->name('fsx.configuration.taxes.update');


    Route::resource('fsxorders', 'FSxOrdersController');

    Route::post('fsxorders/export/orders' , array('uses' => 'FSxOrdersController@exportOrders', 
                                                        'as'   => 'fsxorders.export.orders' ));
    Route::get('fsxorders/{id}/export' , array('uses' => 'FSxOrdersController@export', 
                                                        'as'   => 'fsxorders.export' ));
    Route::get('fsxorders/customerfiles/delete' , 'FSxOrdersController@deleteCustomerFiles')->name('fsxorders.deletecustomerfiles' );
    Route::get('fsxorders/orderfiles/delete'    , 'FSxOrdersController@deleteOrderFiles')->name('fsxorders.deleteorderfiles' );


    Route::resource('fsxproducts', 'FSxProductsController');

    Route::post('fsxproducts/import/products' , array('uses' => 'FSxProductsController@importProducts', 
                                                        'as'   => 'fsxproducts.import.products' ));



	Route::post('fpas', ['uses' => 'FSxFPAsController@store', 
	                 'as'   => 'fpas.store'] );
	Route::post('fpas/{cod}', ['uses' => 'FSxFPAsController@update', 
	                 'as'   => 'fpas.update'] );
	Route::delete('fpas/{cod}', ['uses' => 'FSxFPAsController@destroy', 
	                 'as'   => 'fpas.destroy'] );


	Route::get('dummy', function () {

		return 'Hello world!';

	});


/*
	Route::get( 'wooconnect/configuration', 'WooConnectController@configurationsEdit')
			->name('wooconnect.configuration');
	Route::post('wooconnect/configuration', 'WooConnectController@configurationsUpdate')
			->name('wooconnect.configuration.update');

	Route::get( 'wooconnect/configuration/taxes', 'WooConnectController@configurationTaxesEdit')
			->name('wooconnect.configuration.taxes');
	Route::post('wooconnect/configuration/taxes', 'WooConnectController@configurationTaxesUpdate')
			->name('wooconnect.configuration.taxes.update');

	Route::get( 'wooconnect/configuration/paymentgateways', 'WooConnectController@configurationPaymentGatewaysEdit')
			->name('wooconnect.configuration.paymentgateways');
	Route::post('wooconnect/configuration/paymentgateways', 'WooConnectController@configurationPaymentGatewaysUpdate')
			->name('wooconnect.configuration.paymentgateways.update');

    Route::get('worders/{id}/import' , array('uses' => 'WooOrdersController@import', 
                                                        'as'   => 'worders.import' ));
    Route::get('worders/{id}/invoice', array('uses' => 'WooOrdersController@invoice', 
                                                        'as'   => 'worders.invoice' ));
    Route::get('worders/imported', array('uses' => 'WooOrdersController@importedIndex', 
                                                        'as'   => 'worders.imported' ));
    Route::resource('worders', 'WooOrdersController');
*/

});

