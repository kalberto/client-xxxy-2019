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

// temp pages to validate files
// Route::view('/contrato', 'documents.contract.page1');
// Route::view('/checklist', 'documents.checklist.smartbox.page1');
Route::view('/{any}', 'spa')->where('any', '.*');