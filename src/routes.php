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
	Route::get('pages/templates', [ 'as' => 'admin.pages.templates.index', 'uses' => 'TemplateController@index']);
	Route::get('pages/templates/create', [ 'as' => 'admin.pages.templates.create', 'uses' => 'TemplateController@create']);
	Route::post('pages/templates/store', [ 'as' => 'admin.pages.templates.store',  'uses' => 'TemplateController@store']);
	Route::get('pages/templates/{id}/build',  [ 'as' => 'admin.pages.templates.build',  'uses'  => 'TemplateController@build']);
	Route::post('pages/templates/{id}/delete',  [ 'as' => 'admin.pages.templates.delete',  'uses'  => 'TemplateController@destroy']);
	
	//Add sections/components
	Route::post('pages/templates/{id}/create-section',  [ 'as' => 'admin.pages.templates.add-section',  'uses'  => 'TemplateController@storeSection']);
	Route::post('pages/templates/{id}/create-component',  [ 'as' => 'admin.pages.templates.add-component',  'uses'  => 'TemplateController@storeComponent']);

	//Reorder Sections/Components
	Route::post('pages/templates/{id}/reorder-sections',  [ 'as' => 'admin.pages.templates.reorder-sections',  'uses'  => 'TemplateController@reorderSections']);
	Route::post('pages/templates/{id}/reorder-components',  [ 'as' => 'admin.pages.templates.reorder-components',  'uses'  => 'TemplateController@reorderComponents']);

	//Template Builder Editables
	Route::post('pages/templates/{id}/update-section-title',  [ 'as' => 'admin.pages.templates.update-section-title',  'uses'  => 'TemplateController@updateSectionTitle']);
	Route::post('pages/templates/{id}/update-component-title',  [ 'as' => 'admin.pages.templates.update-component-title',  'uses'  => 'TemplateController@updateComponentTitle']);
	Route::post('pages/templates/{id}/update-component-options',  [ 'as' => 'admin.pages.templates.update-component-options',  'uses'  => 'TemplateController@updateComponentOptions']);

	//Remove Sections/Components
	Route::post('pages/templates/{id}/remove-section',  [ 'as' => 'admin.pages.templates.delete-section',  'uses'  => 'TemplateController@destroySection']);
	Route::post('pages/templates/{id}/remove-component',  [ 'as' => 'admin.pages.templates.delete-component',  'uses'  => 'TemplateController@destroyComponent']);

});
