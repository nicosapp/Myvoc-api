<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Auth::routes([
  'register' => false,
  'verify' => true,
  'reset' => true
]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return new UserResource($request->user());
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
  Route::post('signup', 'SignUpController');
  Route::get('signin/{service}', 'SocialLoginController@redirect');
  Route::get('signin/{service}/callback', 'SocialLoginController@callback');
});


Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'users', 'namespace' => 'Users'], function () {
  Route::get('{user}', 'UserController@show');

  Route::patch('{user}/infos', 'UserController@infos');
  Route::patch('{user}/email', 'UserController@email');
  Route::patch('{user}/profile', 'UserController@profile');
  Route::patch('{user}/password', 'UserController@password');
  Route::post('{user}/avatar', 'UserController@avatar');
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'terms', 'namespace' => 'Terms'], function () {
  Route::get('autocomplete', 'AutocompleteTermController');
  Route::get('filter', 'FilterController');

  Route::post('', 'TermController@store');
  Route::get('', 'TermController@index');
  Route::get('{term}', 'TermController@show');
  Route::patch('{term}', 'TermController@update');
  Route::delete('{term}', 'TermController@destroy');

  Route::post('{term}/translations/{translation}', 'LinkTranslationController@link');
  Route::delete('{term}/translations/{translation}', 'LinkTranslationController@unlink');

  Route::post('{term}/categories/{category}', 'LinkCategoryController@link');
  Route::delete('{term}/categories/{category}', 'LinkCategoryController@unlink');

  Route::post('{term}/grammars/{grammar}', 'LinkGrammarController@link');
  Route::delete('{term}/grammars/{grammar}', 'LinkGrammarController@unlink');

  Route::post('{term}/examples/{example}', 'LinkExampleController@link');
  Route::delete('{term}/examples/{example}', 'LinkExampleController@unlink');

  Route::post('{term}/synonyms/{synonym}', 'LinkSynonymController@link');
  Route::delete('{term}/synonyms/{synonym}', 'LinkSynonymController@unlink');

  Route::post('{term}/tags/{tag}', 'LinkTagController@link');
  Route::delete('{term}/tags/{tag}', 'LinkTagController@unlink');
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'dictionnaries', 'namespace' => 'Dictionnaries'], function () {
  Route::get('', 'DictionnaryController@index');
  Route::post('', 'DictionnaryController@store');
  Route::get('{dictionnary}', 'DictionnaryController@show');
  Route::patch('{dictionnary}', 'DictionnaryController@update');
  Route::delete('{dictionnary}', 'DictionnaryController@destroy');
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'categories', 'namespace' => 'Categories'], function () {
  Route::get('autocomplete', 'AutocompleteCategoryController');

  Route::get('', 'CategoryController@index');
  Route::post('', 'CategoryController@store');
  Route::get('{category}', 'CategoryController@show');
  Route::patch('bulk', 'CategoryController@bulkUpdate');
  Route::patch('{category}', 'CategoryController@update');
  Route::delete('{category}', 'CategoryController@destroy');
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'taxonomies', 'namespace' => 'Taxonomies'], function () {
  Route::get('autocomplete', 'AutocompleteTaxonomyController');
  Route::get('list', 'TaxonomyController@list');

  Route::get('', 'TaxonomyController@index');
  Route::post('', 'TaxonomyController@store');
  Route::get('{taxonomy}', 'TaxonomyController@show');
  Route::patch('{taxonomy}', 'TaxonomyController@update');
  Route::delete('{taxonomy}', 'TaxonomyController@destroy');
});

Route::group(['prefix' => 'media', 'namespace' => 'Media'], function () {
  Route::get('config', 'MediaConfigController@index');
});
