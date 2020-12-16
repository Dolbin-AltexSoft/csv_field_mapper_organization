<?php

use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', 'DashboardController@index')
    ->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/contacts', 'ContactsController@index')
    ->name('contacts');

Route::middleware(['auth:sanctum', 'verified'])
    ->post('/import/parse-contacts', 'ImportController@parseContacts')
    ->name('parse_contacts');

Route::middleware(['auth:sanctum', 'verified'])
    ->post('/import/import-contacts', 'ImportController@importContacts')
    ->name('import_contacts');
