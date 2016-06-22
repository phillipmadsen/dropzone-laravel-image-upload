<?php
/**
 * Simple Routes output for quick access and reference
 * @author Phillip Madsen <contact@affordableprogrammer.com>
 */

Route::get('/r', function ()
{
    function philsroutes()
    {
        $routeCollection = Route::getRoutes();
        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';
        echo "<div class='container'><div class='col-md-12'><table class='table table-striped' style='width:100%'>";
        echo '<tr>';
        echo "<td width='10%'><h4>HTTP Method</h4></td>";
        echo "<td width='45%'><h4>Route</h4></td>";
        echo "<td width='45%'><h4>Corresponding Action</h4></td>";
        echo '</tr>';
        foreach ($routeCollection as $value)
        {
            echo '<tr>';
            echo '<td>' . $value->getMethods()[0] . '</td>';
            echo "<td><a href='" . $value->getPath() . "' target='_blank'>" . $value->getPath() . '</a> </td>';
            echo '<td>' . $value->getActionName() . '</td>';
            echo '</tr>';
        }
        echo '</table></div></div>';
        echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';
    }
    return philsroutes();
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('admin/products', ['as'=> 'admin.products.index', 'uses' => 'ProductController@index']);
Route::post('admin/products', ['as'=> 'admin.products.store', 'uses' => 'ProductController@store']);
Route::get('admin/products/create', ['as'=> 'admin.products.create', 'uses' => 'ProductController@create']);
Route::put('admin/products/{products}', ['as'=> 'admin.products.update', 'uses' => 'ProductController@update']);
Route::delete('admin/products/{products}', ['as'=> 'admin.products.destroy', 'uses' => 'ProductController@destroy']);
Route::get('admin/products/{products}', ['as'=> 'admin.products.show', 'uses' => 'ProductController@show']);
Route::get('admin/products/{products}/edit', ['as'=> 'admin.products.edit', 'uses' => 'ProductController@edit']);

Route::get('/', ['as' => 'upload', 'uses' => 'ImageController@getUpload']);
Route::post('upload', ['as' => 'upload-post', 'uses' =>'ImageController@postUpload']);
Route::post('upload/delete', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']);

Route::group(['prefix' => '/shop'], function () {
    Route::get('/', ['as' => 'shop', 'uses' => 'ShopController@index']);
    Route::get('/{slug}', ['as' => 'shop.product', 'uses' => 'ShopController@product']);

    Route::get('/cart', ['as' => 'shop.cart', 'uses' => 'CartController@showCart']);
        Route::get('/addProduct/{productId}', 'CartController@addItem');
        Route::get('/removeItem/{productId}', 'CartController@removeItem');

    Route::get('/cart/checkout', ['as' => 'shop.cart.checkout', 'uses' => 'CartController@checkout']);

});
