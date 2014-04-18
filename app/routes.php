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

Route::get( 'about', function () {
        // Return about us page
        return View::make( 'site/about' );
    } );

Route::group( array( 'namespace' => 'Confess\Controllers' ), function () {
        Route::get( 'ns', 'ConfessionController@index' );

        Route::get( 'n/new', 'ConfessionController@create' );
        Route::post( 'n/new', 'ConfessionController@store' );

        Route::get( 'n/{hash}', 'ConfessionController@view' );

        Route::post( 'n/{hash}/vote', 'ConfessionVoteController@vote' );
        Route::post( 'n/{hash}/comment', 'ConfessionCommentController@comment' );

        Route::get( 'n/{hash}/approve/{pass}', array('as' => 'approveConfession', 'uses' => 'ConfessionController@approve') );
        Route::get( 'n/{hash}/approve/comment/{id}/{pass}', array('as' => 'approveConfessionComment', 'uses' => 'ConfessionCommentController@approve') );


        // Posts - Index
        Route::get( 'blog', 'BlogController@index' );
        Route::get( 'blog/{postSlug}', 'BlogController@view' );

        // Index Page - Last route, no matches
        Route::get( '/', 'ConfessionController@index' );
    } );
