<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get( 'about', function() {
		// Return about us page
		return View::make( 'site/about' );
	} );

Route::group( array( 'namespace' => 'Confess\Controllers' ), function () {
		Route::get( 'ns', 'ConfessionController@getIndex' );
		Route::post( 'ns/vote', 'ConfessionController@postVote' );
		Route::get( 'n/new', 'ConfessionController@create' );
		Route::post( 'n/new', 'ConfessionController@store' );
		Route::get( 'n/{link}', 'ConfessionController@getView' );
		Route::post( 'n/{link}', 'ConfessionController@postView' );

		// Posts - Index
		Route::get( 'blog', 'BlogController@getIndex' );
		Route::get( 'blog/{postSlug}', 'BlogController@getView' );
		Route::post( 'blog/{postSlug}', 'BlogController@postView' );

		// Index Page - Last route, no matches
		Route::get( '/', 'ConfessionController@getIndex' );
	} );
