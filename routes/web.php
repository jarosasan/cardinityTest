<?php

Route::get('/', 'ProductController@index')->name('product.index');
Route::get('/order/{id}', 'OrderController@create')->name('order.create');
//Route::get('/payment/{id}', 'PaymentController@create')->name('payment.create');
//Route::post('/payment/', 'PaymentController@process')->name('payment.process');
//Route::post('/payment/approve', 'PaymentController@approved')->name('paymentapprove');
//Route::get('/payment/pending', 'PaymentController@pending')->name('paymentpending');
 Route::group(['prefix'=>'payment', 'as'=>'payment.'], function(){
     Route::get('/{id}', ['as'=>'create','uses'=>'PaymentController@create']);
     Route::post('/', ['as'=>'process','uses'=>'PaymentController@process']);
     Route::post('/approve', ['as'=>'approve','uses'=>'PaymentController@approved']);
     Route::get('/pending', ['as'=>'pending','uses'=> 'PaymentController@pending']);
});

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
