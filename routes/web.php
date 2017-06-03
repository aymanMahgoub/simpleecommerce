<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});


Route::get('/admin', [
    'uses' => 'HomeController@admin',
    'middleware'=>['auth'],
]);

Route::resource('product','productController');

 Route::get('products/{product_name}', [
        'uses' => 'ProductController@showproduct',
        'as'   => 'show.product',
    ]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('category','categoryController');



 Route::get('category/addsub/{id}', [
        'uses' => 'categoryController@addSubCategories',
        'as'   => 'category.addsub'
       
    ]);

    /** Post the Sub-Category Route **/
    Route::post('category/postsub/{id}', [
        'uses' => 'categoryController@addPostSubCategories',
        'as'   => 'category.postsub'
        
    ]);

    /** Show the Admin Edit Categories Page **/
    Route::get('category/editsub/{id}', [
        'uses' => 'categoryController@editSubCategories',
        'as'   => 'category.editsub'
    ]);

    /** Post the Sub-Category update Route**/
    Route::post('category/updatesub/{id}', [
        'uses' => 'categoryController@updateSubCategories',
        'as'   => 'category.updatesub'
    ]);


    /** Delete a sub-category **/
    Route::delete('category/deletesub/{id}', [
        'uses' => 'categoryController@deleteSubCategories',
        'as'   => 'category.deletesub'
    ]);



    /** Get all the products under a sub-category route **/
    Route::get('category/products/cat/{id}', [
        'uses' => 'categoryController@getProductsForSubCategory',
        'as'   => 'category.products',
        
    ]);

//product
    
     Route::get('admin/products/{id}', [
        'uses' => 'productController@displayImageUploadPage',
        'as'   => 'admin.product.upload',
        'middleware'=>['auth'],
    ]);

    /** Route for the sub-category drop-down */
    Route::get('api/dropdown', 'productController@categoryAPI');

    /** Post a photo to a Product **/
    Route::post('admin/product/{id}/photo', 'imageController@store');

    /** Delete Product photos **/
    Route::delete('admin/product/photos/{id}', 'imageController@destroy');

    /** Post the Product Add Featured Image Route **/
    Route::post('admin/product/add/featured/{id}', 'imageController@storeFeaturedPhoto');

