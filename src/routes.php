<?php

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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function()
{
	//page templates
	Route::get('pages/templates', [ 'as' => 'admin.pages.templates.index', 'uses' => 'Gaia\Pages\TemplateController@index']);
	Route::get('pages/templates/create', [ 'as' => 'admin.pages.templates.create', 'uses' => 'Gaia\Pages\TemplateController@create']);
	Route::post('pages/templates/store', [ 'as' => 'admin.pages.templates.store',  'uses' => 'Gaia\Pages\TemplateController@store']);
	Route::get('pages/templates/{id}/build',  [ 'as' => 'admin.pages.templates.build',  'uses'  => 'Gaia\Pages\TemplateController@build']);
	Route::post('pages/templates/{id}/delete',  [ 'as' => 'admin.pages.templates.delete',  'uses'  => 'Gaia\Pages\TemplateController@destroy']);
	
	//Add sections/components
	Route::post('pages/templates/{id}/create-section',  [ 'as' => 'admin.pages.templates.add-section',  'uses'  => 'Gaia\Pages\TemplateController@storeSection']);
	Route::post('pages/templates/{id}/create-component',  [ 'as' => 'admin.pages.templates.add-component',  'uses'  => 'Gaia\Pages\TemplateController@storeComponent']);

	//Reorder Sections/Components
	Route::post('pages/templates/{id}/reorder-sections',  [ 'as' => 'admin.pages.templates.reorder-sections',  'uses'  => 'Gaia\Pages\TemplateController@reorderSections']);
	Route::post('pages/templates/{id}/reorder-components',  [ 'as' => 'admin.pages.templates.reorder-components',  'uses'  => 'Gaia\Pages\TemplateController@reorderComponents']);

	//Template Builder Editables
	Route::post('pages/templates/{id}/update-section-title',  [ 'as' => 'admin.pages.templates.update-section-title',  'uses'  => 'Gaia\Pages\TemplateController@updateSectionTitle']);
	Route::post('pages/templates/{id}/update-component-title',  [ 'as' => 'admin.pages.templates.update-component-title',  'uses'  => 'Gaia\Pages\TemplateController@updateComponentTitle']);
	Route::post('pages/templates/{id}/update-component-options',  [ 'as' => 'admin.pages.templates.update-component-options',  'uses'  => 'Gaia\Pages\TemplateController@updateComponentOptions']);

	//Remove Sections/Components
	Route::post('pages/templates/{id}/remove-section',  [ 'as' => 'admin.pages.templates.delete-section',  'uses'  => 'Gaia\Pages\TemplateController@destroySection']);
	Route::post('pages/templates/{id}/remove-component',  [ 'as' => 'admin.pages.templates.delete-component',  'uses'  => 'Gaia\Pages\TemplateController@destroyComponent']);


	//Pages
	Route::get('pages/', [ 'as' => 'admin.pages.index', 'uses' => 'Gaia\Pages\PageController@index']);
	Route::get('pages/create', [ 'as' => 'admin.pages.create', 'uses' => 'Gaia\Pages\PageController@create']);
	Route::post('pages/store', [ 'as' => 'admin.pages.store',  'uses' => 'Gaia\Pages\PageController@store']);
	Route::get('pages/{id}/edit',  [ 'as' => 'admin.pages.edit',  'uses'  => 'Gaia\Pages\PageController@edit']);
	Route::post('pages/{id}/update',  [ 'as' => 'admin.pages.update',  'uses'  => 'Gaia\Pages\PageController@update']);
	Route::post('pages/{id}/delete',  [ 'as' => 'admin.pages.delete',  'uses'  => 'Gaia\Pages\PageController@destroy']);

});
